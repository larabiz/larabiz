<x-app>
    <x-breadcrumb class="mt-16">
        <x-breadcrumb-item>Mes notifications</x-breadcrumb-item>
    </x-breadcrumb>

    <x-section>
        <div class="grid gap-4 sm:gap-8">
            @forelse ($user->subscriptions as $subscription)
                <div class="bg-white/50 flex items-center justify-between gap-4 sm:gap-6 px-4 py-6 sm:p-6 rounded-lg shadow-lg shadow-indigo-200/50">
                    <p class="font-bold leading-tight text-indigo-900">
                        {{ $subscription->subscribable->title }}
                    </p>

                    <x-form method="POST" action="{{ route('unsubscribe-from-post', $subscription->subscribable) }}">
                        <button type="submit" class="border border-red-100 hover:bg-red-100 flex items-center justify-center rounded-full transition-colors w-8 h-8">
                            <x-heroicon-o-trash class="text-red-400 translate-y-[-1px] w-4 h-4" />
                            <span class="sr-only">Supprimer</span>
                        </button>
                    </x-form>
                </div>
            @empty
                <p class="text-center text-indigo-300">Vous n'avez aucun abonnement en cours.</p>
            @endforelse
        </div>
    </x-section>
</x-app>
