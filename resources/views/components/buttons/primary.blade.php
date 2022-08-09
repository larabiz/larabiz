<x-buttons.base
    {{ $attributes->merge(['class' => 'bg-gradient-to-r from-gray-700 dark:from-gray-600
    to-gray-800 dark:to-gray-700 shadow-lg shadow-indigo-200 dark:shadow-none text-white']) }}
>
    {{ $slot }}
</x-buttons.base>
