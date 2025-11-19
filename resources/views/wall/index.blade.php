<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mur de Témoignages</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Tailwind via CDN, si tu veux (facultatif) --}}
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Mur de post-it */
        .postit-wall {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
        }

        .postit {
            background: #fff9a8;
            padding: 1.2rem;
            box-shadow: 0 10px 15px rgba(0, 0, 0, .15);
            border-radius: 4px;
            transform: rotate(-1.5deg);
            position: relative;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .postit::before {
            content: '';
            width: 45px;
            height: 15px;
            background: rgba(255,255,255,0.6);
            position: absolute;
            top: -8px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 3px 5px rgba(0,0,0,0.2);
        }

        .postit:nth-child(2n) {
            transform: rotate(1.4deg);
            background: #ffd9a8;
        }

        .postit:nth-child(3n) {
            transform: rotate(-0.7deg);
            background: #d9ffb3;
        }

        .postit:hover {
            transform: translateY(-3px) scale(1.01);
            box-shadow: 0 14px 25px rgba(0,0,0,0.25);
        }

        .postit-title {
            font-weight: 700;
            margin-bottom: .5rem;
        }

        .postit-meta {
            font-size: .8rem;
            opacity: .8;
            margin-bottom: .4rem;
        }

        .postit-text {
            font-size: .9rem;
            white-space: pre-line;
        }

        /* Style "status" pour vidéo */
        .status-card {
            position: relative;
            padding: 1rem;
            border-radius: 1rem;
            overflow: hidden;
            background: radial-gradient(circle at top, #4ade80, #166534);
            color: #f9fafb;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            min-height: 260px;
        }

        .status-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.65), transparent);
        }

        .status-content {
            position: relative;
            z-index: 1;
        }

        .status-play {
            position: absolute;
            top: 1rem;
            right: 1rem;
            z-index: 2;
            background: rgba(0,0,0,0.4);
            border-radius: 999px;
            padding: .4rem .7rem;
            display: flex;
            align-items: center;
            gap: .35rem;
            font-size: .8rem;
        }

        .status-play-icon {
            width: 18px;
            height: 18px;
            border-radius: 999px;
            border: 2px solid #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .status-play-icon::before {
            content: '';
            margin-left: 2px;
            border-style: solid;
            border-width: 5px 0 5px 8px;
            border-color: transparent transparent transparent #fff;
        }

        .status-title {
            font-weight: 700;
            margin-bottom: .25rem;
        }

        .status-meta {
            font-size: .8rem;
            opacity: .9;
            margin-bottom: .25rem;
        }

        .status-text {
            font-size: .9rem;
            opacity: .95;
        }
    </style>
</head>
<body class="bg-slate-100 text-slate-800">

<div class="min-h-screen flex flex-col">
    {{-- Header --}}
    <header class="bg-slate-900 text-white py-6 shadow-md">
        <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold">Mur de Témoignages</h1>
                <p class="text-sm text-slate-300">
                    Partage ce que Dieu a fait dans ta vie et encourage les autres.
                </p>
            </div>
            <a href="#form-temoignage" class="inline-flex items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-white px-4 py-2 rounded-lg text-sm font-semibold">
                Je veux témoigner
            </a>
        </div>
    </header>

    {{-- Messages flash --}}
    @if(session('message'))
        <div class="bg-{{ session('status') === 'success' ? 'emerald' : 'red' }}-100 border-b border-{{ session('status') === 'success' ? 'emerald' : 'red' }}-300">
            <div class="max-w-6xl mx-auto px-4 py-3 text-sm text-{{ session('status') === 'success' ? 'emerald' : 'red' }}-800">
                {{ session('message') }}
            </div>
        </div>
    @endif

    <main class="flex-1">
        <div class="max-w-6xl mx-auto px-4 py-10 grid md:grid-cols-2 gap-10">
            {{-- Formulaire --}}
            <section id="form-temoignage" class="bg-white rounded-xl shadow-lg p-6 md:p-8">
                <h2 class="text-xl font-bold mb-1">Partager un témoignage</h2>
                <p class="text-sm text-slate-500 mb-4">
                    Votre témoignage sera d’abord vérifié par code avant d’être publié.
                </p>

                <form method="POST" action="{{ route('wall.store') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Prénom *</label>
                            <input type="text" name="first_name" value="{{ old('first_name') }}"
                                   class="w-full border rounded-md px-3 py-2 text-sm @error('first_name') border-red-500 @enderror" required>
                            @error('first_name')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Nom *</label>
                            <input type="text" name="last_name" value="{{ old('last_name') }}"
                                   class="w-full border rounded-md px-3 py-2 text-sm @error('last_name') border-red-500 @enderror" required>
                            @error('last_name')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Email *</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                   class="w-full border rounded-md px-3 py-2 text-sm @error('email') border-red-500 @enderror" required>
                            @error('email')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium mb-1">Téléphone *</label>
                            <input type="text" name="phone" value="{{ old('phone') }}"
                                   class="w-full border rounded-md px-3 py-2 text-sm @error('phone') border-red-500 @enderror" required>
                            @error('phone')
                            <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Catégorie (optionnel)</label>
                        <input type="text" name="category" value="{{ old('category') }}"
                               placeholder="Guérison, Finances, Famille..."
                               class="w-full border rounded-md px-3 py-2 text-sm @error('category') border-red-500 @enderror">
                        @error('category')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Titre du témoignage *</label>
                        <input type="text" name="title" value="{{ old('title') }}"
                               class="w-full border rounded-md px-3 py-2 text-sm @error('title') border-red-500 @enderror" required>
                        @error('title')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Type de témoignage *</label>
                        <select name="kind" class="w-full border rounded-md px-3 py-2 text-sm @error('kind') border-red-500 @enderror" required>
                            <option value="">Choisir...</option>
                            <option value="text" {{ old('kind') == 'text' ? 'selected' : '' }}>Texte</option>
                            <option value="video" {{ old('kind') == 'video' ? 'selected' : '' }}>Vidéo (lien)</option>
                            <option value="mix" {{ old('kind') == 'mix' ? 'selected' : '' }}>Texte + Vidéo</option>
                        </select>
                        @error('kind')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Témoignage (texte)</label>
                        <textarea name="text" rows="5"
                                  class="w-full border rounded-md px-3 py-2 text-sm @error('text') border-red-500 @enderror"
                                  placeholder="Décrivez ce que Dieu a fait pour vous...">{{ old('text') }}</textarea>
                        @error('text')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Lien vidéo (YouTube, etc.)</label>
                        <input type="url" name="video" value="{{ old('video') }}"
                               class="w-full border rounded-md px-3 py-2 text-sm @error('video') border-red-500 @enderror">
                        @error('video')
                        <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-slate-500 mt-1">
                            Si vous choisissez "Vidéo" ou "Texte + Vidéo", collez ici le lien vers votre vidéo.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Couleur post-it (optionnel)</label>
                            <input type="text" name="postit_color" value="{{ old('postit_color') }}"
                                   placeholder="Ex: #FFEB3B ou yellow"
                                   class="w-full border rounded-md px-3 py-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Police (optionnel)</label>
                            <input type="text" name="font_family" value="{{ old('font_family') }}"
                                   placeholder='Ex: "Poppins, sans-serif"'
                                   class="w-full border rounded-md px-3 py-2 text-sm">
                        </div>
                    </div>

                    <button type="submit"
                            class="w-full md:w-auto inline-flex justify-center items-center gap-2 bg-emerald-500 hover:bg-emerald-400 text-white px-5 py-2.5 rounded-md text-sm font-semibold">
                        Envoyer mon témoignage
                    </button>

                    <p class="text-xs text-slate-500 mt-2">
                        Après l’envoi, vous recevrez un code de vérification par email pour confirmer votre témoignage.
                    </p>
                </form>
            </section>

            {{-- Mur des témoignages --}}
            <section>
                <h2 class="text-xl font-bold mb-1">Témoignages publiés</h2>
                <p class="text-sm text-slate-500 mb-4">
                    Voici quelques témoignages approuvés. Soyez encouragés !
                </p>

                @if($testimonies->isEmpty())
                    <p class="text-sm text-slate-500">
                        Aucun témoignage publié pour l’instant. Soyez le premier à témoigner !
                    </p>
                @else
                    <div class="postit-wall">
                        @foreach($testimonies as $t)
                            @if($t->kind === 'text' || ($t->kind === 'mix' && $t->text))
                                {{-- Post-it texte --}}
                                <article class="postit" style="background: {{ $t->postit_color ?? '#fff9a8' }}; font-family: {{ $t->font_family ?? 'inherit' }};">
                                    <div class="postit-meta">
                                        {{ $t->first_name }} {{ strtoupper($t->last_name) }}
                                        @if($t->category) · <span class="font-semibold">{{ $t->category }}</span> @endif
                                        <br>
                                        <span>{{ \Carbon\Carbon::parse($t->created_at)->format('d/m/Y') }}</span>
                                    </div>
                                    <h3 class="postit-title">{{ $t->title }}</h3>
                                    @if($t->text)
                                        <p class="postit-text">{{ $t->text }}</p>
                                    @endif
                                </article>
                            @else
                                {{-- Carte "status" vidéo --}}
                                <article class="status-card">
                                    <div class="status-overlay"></div>

                                    <div class="status-play">
                                        <div class="status-play-icon"></div>
                                        <span>Voir la vidéo</span>
                                    </div>

                                    <div class="status-content">
                                        <div class="status-meta text-xs mb-1">
                                            {{ $t->first_name }} {{ strtoupper($t->last_name) }}
                                            @if($t->category) · <span class="font-semibold">{{ $t->category }}</span> @endif
                                            · {{ \Carbon\Carbon::parse($t->created_at)->format('d/m/Y') }}
                                        </div>
                                        <h3 class="status-title text-base mb-1">{{ $t->title }}</h3>
                                        @if($t->text)
                                            <p class="status-text text-sm mb-2 line-clamp-3">
                                                {{ $t->text }}
                                            </p>
                                        @endif

                                        @if($t->video)
                                            <a href="{{ $t->video }}" target="_blank"
                                               class="inline-flex items-center gap-2 text-xs font-semibold underline">
                                                Ouvrir la vidéo
                                            </a>
                                        @endif
                                    </div>
                                </article>
                            @endif
                        @endforeach
                    </div>
                @endif
            </section>
        </div>
    </main>
</div>

</body>
</html>
