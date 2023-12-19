@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-purple-400 text-left text-base font-medium text-purple-400 bg-purple-50 focus:outline-none focus:text-purple-800 focus:bg-purple-100 focus:border-purple-700 transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base font-medium text-purple-400 hover:text-purple-800 hover:bg-purple-50 hover:border-purple-300 focus:outline-none focus:text-purple-800 focus:bg-purple-50 focus:border-purple-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
