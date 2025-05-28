@props([
    'href',
    'active' => false,
])

@php
    $baseClasses = 'block px-4 py-2 rounded-md transition';
    $colorClasses = $active
        ? 'bg-sky-100 text-sky-700'
        : 'text-black hover:text-sky-700';
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => $baseClasses . ' ' . $colorClasses]) }}
>
    {{ $slot }}
</a>
