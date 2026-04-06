@props([
    'symbol' => 'shield',
    'size' => '24',
])

@php
    $symbols = ['shield', 'lock', 'phone', 'globe', 'key'];
    $symbol = in_array($symbol, $symbols) ? $symbol : 'shield';
@endphp

<svg
    {{ $attributes->merge(['class' => 'inline-block']) }}
    width="{{ $size }}"
    height="{{ $size }}"
    viewBox="0 0 24 24"
    fill="white"
    xmlns="http://www.w3.org/2000/svg"
    aria-hidden="true"
>
    @if ($symbol === 'shield')
        {{-- Shield: simple rounded shield shape --}}
        <path d="M12 2L3 7v5c0 5.25 3.83 10.15 9 11.25C17.17 22.15 21 17.25 21 12V7L12 2zm0 2.18l7 3.82v4c0 4.33-3.07 8.36-7 9.38C8.07 20.36 5 16.33 5 12V8l7-3.82z"/>
    @elseif ($symbol === 'lock')
        {{-- Lock: padlock shape --}}
        <path d="M17 9V7A5 5 0 0 0 7 7v2a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-7a2 2 0 0 0-2-2zM9 7a3 3 0 0 1 6 0v2H9V7zm8 11H7v-7h10v7zm-4-3.5a1.5 1.5 0 1 1-2 0v-1a1.5 1.5 0 0 1 2 0v1z"/>
    @elseif ($symbol === 'phone')
        {{-- Phone: smartphone shape --}}
        <path d="M7 2a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2H7zm0 2h10v16H7V4zm5 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
    @elseif ($symbol === 'globe')
        {{-- Globe: earth/internet symbol --}}
        <path d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20zm0 2a8 8 0 0 1 5.29 2H6.71A8 8 0 0 1 12 4zM4.13 8h15.74a8 8 0 0 1 .63 2H3.5a8 8 0 0 1 .63-2zM4 12c0-.34.03-.67.07-1h15.86c.04.33.07.66.07 1s-.03.67-.07 1H4.07A8 8 0 0 1 4 12zm.13 2h15.74a8 8 0 0 1-.63 2H4.76a8 8 0 0 1-.63-2zM12 20a8 8 0 0 1-5.29-2h10.58A8 8 0 0 1 12 20zm0-18c1.66 0 3 3.58 3 8s-1.34 8-3 8-3-3.58-3-8 1.34-8 3-8z"/>
    @elseif ($symbol === 'key')
        {{-- Key: classic key shape --}}
        <path d="M7 14a3 3 0 1 1 0-6 3 3 0 0 1 0 6zm0-2a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm0-6a5 5 0 0 0-4.9 4H2v4h.1A5 5 0 0 0 7 18a5 5 0 0 0 4.9-4H14v2h2v-2h2v2h2v-4h-8.1A5 5 0 0 0 7 6z"/>
    @endif
</svg>
