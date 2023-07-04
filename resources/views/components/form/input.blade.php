@props(['name'])

<x-form.label name="{{ $name }}"/>

<input class="mt-6 border border-gray-200 p-2 w-full rounded"
       name="{{ $name }}"
       id="{{ $name }}"
    {{ $attributes(['value' => old($name)]) }}
>

<x-form.error name="{{ $name }}"/>

