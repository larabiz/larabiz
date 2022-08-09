<x-buttons.base
    {{ $attributes->merge(['class' => 'bg-gradient-to-r from-indigo-300 dark:from-indigo-500 to-indigo-400
    dark:to-indigo-600 shadow-lg shadow-indigo-200 dark:shadow-none text-indigo-50 hover:text-white']) }}
>
    {{ $slot }}
</x-buttons.base>
