<x-app>
    <x-breadcrumb class="container mt-8 sm:mt-16">
        <x-breadcrumb-item>Mes notifications</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section>
        <x-slot:title>
            Mes notifications
        </x-slot:title>

        @if ($user->subscriptions->isNotEmpty())
            <div class="grid gap-4 mt-8">
                @foreach ($user->subscriptions as $subscription)
                    <div class="bg-gradient-to-b from-white/50 to-white/30 flex items-center justify-between gap-4 sm:gap-6 px-4 py-6 sm:p-6 rounded-lg shadow-md shadow-indigo-100">
                        <a href="{{ route('posts.show', [$subscription->subscribable->random_id, $subscription->subscribable->slug]) }}" class="font-bold leading-tight text-indigo-900">
                            {{ $subscription->subscribable->title }}
                        </a>

                        <x-form method="POST" action="{{ route('unsubscribe-from-post', $subscription->subscribable) }}">
                            <button type="submit" class="border border-red-100 hover:bg-red-100 flex items-center justify-center rounded-full transition-colors w-8 h-8">
                                <x-heroicon-o-trash class="text-red-400 translate-y-[-1px] w-4 h-4" />
                                <span class="sr-only">Supprimer</span>
                            </button>
                        </x-form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-indigo-300">Vous n'avez aucun abonnement en cours.</p>
        @endif
    </x-section>
</x-app>
