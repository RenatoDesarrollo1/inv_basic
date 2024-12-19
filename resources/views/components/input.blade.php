@props(['label', 'type', 'error' => null, 'isDisabled' => false])

<div>
    @if ($label != '')
        <label for="{{ $attributes->get('id') }}"
            class="block mb-1 text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif
    <input
        {{ $attributes->merge(['class' => 'text-sm px-2 py-1 block w-full border border-gray-300 rounded-none focus:outline-none focus:border-indigo-500']) }}
        {{ $isDisabled ? 'disabled' : '' }} type="{{ $type }}">
    @if ($error)
        <p class="mt-1 text-xs text-red-500">{{ $error }}</p>
    @endif
</div>
