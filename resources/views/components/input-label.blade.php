@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-stone-950 ']) }}>
    {{ $value ?? $slot }}
</label>
