<input type="{{$type ?? 'text'}}" {{ $attributes->merge(['class' => 'bg-white/75 dark:bg-gray-800/80 focus:bg-white dark:focus:bg-gray-700/50 border-0 placeholder-indigo-200/75 dark:placeholder-gray-700 mt-1 px-4 py-3 rounded shadow shadow-indigo-100 dark:shadow-none transition-colors w-full']) }} />
<x-forms.error :name="$name" :bag="$bag ?? 'default'"  />
