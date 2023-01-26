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
                        <a href="{{ route('posts.show', $subscription->subscribable) }}" class="font-bold leading-tight text-indigo-900">
                            {{ $subscription->subscribable->title }}
                        </a>

                        <x-form method="POST" action="{{ route('unsubscribe-from-post', $subscription->subscribable) }}">
                            <button type="submit" class="border border-red-100 hover:bg-red-100 flex items-center justify-center rounded-full transition-colors w-8 h-8">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-red-400 translate-y-[-1px] w-4 h-4"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" /></svg>

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
