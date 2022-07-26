@if (session('status'))
    <div
        class="fixed bottom-0 left-0 right-0"
        x-init="setTimeout(() => open = false, 5000)"
        x-data="{ open: true }"
        x-show="open"
    >
        <div class="container mb-4">
            <div class="bg-gradient-to-r from-gray-700 to-gray-800 flex items-center justify-between gap-5 px-5 py-4 rounded-lg shadow-lg shadow-indigo-900/20">
                <div class="font-bold text-white">
                    {{ session('status') }}
                </div>

                <button class="text-indigo-400" @click="open = false">
                    <span class="sr-only">Fermer</span>
                    <x-heroicon-o-x class="w-5 h-5 translate-y-[-0.5px]" />
                </button>
            </div>
        </div>
    </div>
@endif
