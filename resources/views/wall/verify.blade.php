<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Vérifier mon témoignage</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 text-slate-800">

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-6 md:p-8">
        <h1 class="text-xl font-bold mb-1">Vérifier mon témoignage</h1>
        <p class="text-sm text-slate-500 mb-4">
            Saisissez le code que vous avez reçu par email pour valider votre témoignage.
        </p>

        @if($flashMessage ?? false)
            <div class="mb-4 px-3 py-2 rounded text-sm
                {{ ($flashStatus ?? '') === 'success'
                    ? 'bg-emerald-100 text-emerald-800'
                    : 'bg-red-100 text-red-800' }}">
                {{ $flashMessage }}
            </div>
        @endif

        @if(session('status') && session('status') === 'error' && session('message'))
            <div class="mb-4 px-3 py-2 rounded text-sm bg-red-100 text-red-800">
                {{ session('message') }}
            </div>
        @endif

        <form method="POST" action="{{ route('wall.verify') }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium mb-1">Email utilisé pour le témoignage *</label>
                <input type="email" name="email" value="{{ old('email', $email) }}"
                       class="w-full border rounded-md px-3 py-2 text-sm @error('email') border-red-500 @enderror" required>
                @error('email')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-medium mb-1">Code de vérification *</label>
                <input type="text" name="code" value="{{ old('code') }}"
                       class="w-full border rounded-md px-3 py-2 text-sm tracking-[0.25em] uppercase @error('code') border-red-500 @enderror"
                       placeholder="ABC123" required>
                @error('code')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                    class="w-full inline-flex justify-center items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-white px-5 py-2.5 rounded-md text-sm font-semibold">
                Valider mon témoignage
            </button>

            <p class="text-xs text-slate-500 mt-2">
                Si vous n’avez pas reçu de code, vérifiez vos spams ou soumettez à nouveau votre témoignage.
            </p>

            <p class="text-xs text-slate-500 mt-1">
                <a href="{{ route('wall.index') }}" class="underline">
                    ↩ Retour au mur de témoignages
                </a>
            </p>
        </form>
    </div>
</div>

</body>
</html>
