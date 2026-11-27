@props([
    'name',
])

@php
    $parts = explode(' / ', $name, 2);
@endphp

@if (count($parts) === 2)
    {{ $parts[0] }}&nbsp;/ <span class="whitespace-nowrap">{{ $parts[1] }}</span>
@else
    {{ $name }}
@endif
