@if (auth()->check() && ! $user->hasVerifiedEmail())
    <div {{ $attributes->merge(['class' => 'bg-gradient-to-r from-indigo-400 to-indigo-300 font-semibold py-3 text-center text-sm text-white']) }}>
        <div class="container">
            <div>Veuillez confirmer votre adresse e-mail afin d'utiliser Larabiz à son plein potentiel.</div>

            <x-form method="POST" action="{{ route('verification.send') }}" class="mt-2">
                <button type="submit" class="bg-white/20 font-bold px-3 py-1 rounded">Renvoyer la confirmation</button>
            </x-form>
        </div>
    </div>
@endif
