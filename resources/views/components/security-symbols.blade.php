@props([
    'symbol' => 'shield',
    'size' => '24',
])

@php
    $symbols = ['shield', 'lock', 'phone', 'globe', 'key'];
    $symbol = in_array($symbol, $symbols) ? $symbol : 'shield';
@endphp

<img
    {{ $attributes->merge(['class' => 'inline-block']) }}
    src="{{ asset('images/icons/' . $symbol . '.svg') }}"
    width="{{ $size }}"
    height="{{ $size }}"
    aria-hidden="true"
    alt=""
/>
