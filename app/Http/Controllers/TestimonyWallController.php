<?php

namespace App\Http\Controllers;

use App\Models\MemberProfile;
use App\Models\Testimony;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Mail; // si tu veux envoyer des emails

class TestimonyWallController extends Controller
{
    /**
     * Affiche le mur des témoignages + le formulaire d’envoi.
     */
    public function index()
    {
        $approvedTestimonies = Testimony::query()
            ->where('status', 'approved')
            ->orderByDesc('created_at')
            ->get();

        return view('pages.home', [
            'testimonies' => $approvedTestimonies,
        ]);
    }

    /**
     * Enregistre un nouveau témoignage (status = pending)
     * + génère / renvoie un code de vérification.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],
            'email'      => ['required', 'email', 'max:254'],
            'phone'      => ['required', 'string', 'max:30'],
            'title'      => ['required', 'string', 'max:255'],
            'category'   => ['nullable', 'string', 'max:100'],

            'kind'       => ['required', 'in:text,video,mix'],
            'text'       => ['nullable', 'string'],
            'video'      => ['nullable', 'url', 'max:200'],

            'postit_color' => ['nullable', 'string', 'max:20'],
            'font_family'  => ['nullable', 'string', 'max:100'],
        ]);

        // 1. Création / mise à jour du profil membre
        $member = MemberProfile::updateOrCreate(
            ['email' => $data['email']],
            [
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'updated_at' => now(),
            ] + (MemberProfile::where('email', $data['email'])->exists()
                ? []
                : ['created_at' => now()])
        );

        // 2. Génération du code de vérification
        $code = strtoupper(Str::random(6)); // tu peux passer à 6 chiffres numériques si tu veux

        $verification = VerificationCode::updateOrCreate(
            ['email' => $data['email']],
            [
                'first_name' => $data['first_name'],
                'last_name'  => $data['last_name'],
                'code'       => $code,
                'created_at' => now(),
                'expires_at' => now()->addDay(),
                'used'       => false,
                'attempts'   => 0,
            ]
        );

        // 3. Création du témoignage (en attente / pending)
        $testimony = Testimony::create([
            'kind'             => $data['kind'],
            'first_name'       => $data['first_name'],
            'last_name'        => $data['last_name'],
            'title'            => $data['title'],
            'text'             => $data['text'] ?? null,
            'video'            => $data['video'] ?? null,
            'video_file'       => null,
            'postit_color'     => $data['postit_color'] ?? '#FFEB3B',
            'font_family'      => $data['font_family'] ?? 'Poppins, sans-serif',
            'category'         => $data['category'] ?? null,
            'email'            => $data['email'],
            'phone'            => $data['phone'],
            'verification_type'=> 'email',
            'status'           => 'pending',
            'created_at'       => now(),
        ]);

        // 4. Envoi du code par email (optionnel)
        /*
        Mail::to($data['email'])->send(new \App\Mail\TestimonyVerificationMail($verification));
        */

        return redirect()
            ->route('wall.verify.form')
            ->with('email', $data['email'])
            ->with('status', 'success')
            ->with('message', "Merci pour votre témoignage ! Nous vous avons envoyé un code de vérification par email.");
    }

    /**
     * Formulaire où l’utilisateur encode son code de vérification.
     */
    public function showVerifyForm(Request $request)
    {
        return view('wall.verify', [
            'email' => session('email'),
            'flashStatus' => session('status'),
            'flashMessage' => session('message'),
        ]);
    }

    /**
     * Vérifie le code envoyé et approuve les témoignages en attente pour cet email.
     */
    public function verify(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email', 'max:254'],
            'code'  => ['required', 'string', 'max:64'],
        ]);

        $verification = VerificationCode::where('email', $data['email'])
            ->where('code', $data['code'])
            ->first();

        if (! $verification) {
            return back()
                ->withInput()
                ->with('status', 'error')
                ->with('message', 'Code invalide ou email incorrect.');
        }

        // Vérifie expiration
        if (Carbon::now()->greaterThan($verification->expires_at)) {
            return back()
                ->withInput()
                ->with('status', 'error')
                ->with('message', 'Ce code a expiré. Veuillez soumettre à nouveau votre témoignage.');
        }

        // Incrémente les tentatives
        $verification->attempts = $verification->attempts + 1;

        // Marque comme utilisé
        $verification->used = true;
        $verification->save();

        // Approuve tous les témoignages en attente pour cet email
        Testimony::where('email', $data['email'])
            ->where('status', 'pending')
            ->update(['status' => 'approved']);

        return redirect()
            ->route('wall.index')
            ->with('status', 'success')
            ->with('message', 'Merci ! Votre témoignage a été vérifié et approuvé.');
    }
}
