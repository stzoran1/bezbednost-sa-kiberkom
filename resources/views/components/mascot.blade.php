@props([
    'variant' => 'default',
    'class' => 'w-32 h-32',
])

@php
    $variants = ['default', 'warning', 'thumbsup'];
    $variant = in_array($variant, $variants) ? $variant : 'default';
@endphp

<img
    src="{{ asset("images/mascot/mascot-{$variant}.svg") }}"
    alt="Kiberko the cyber hedgehog"
    {{ $attributes->merge(['class' => $class]) }}
/>
