@props(['color', 'isDisabled' => false])

@php
    // Determinar el color de fondo y texto según el tipo
    $bgColor = '';
    $textColor = '';

    switch ($color) {
        case 'primary':
            $bgColor = 'bg-[#3D449A]';
            $textColor = 'text-white';
            break;
        case 'secondary':
            $bgColor = 'bg-blue-400';
            $textColor = 'text-white';
            break;
        case 'warning':
            $bgColor = 'bg-yellow-400';
            $textColor = 'text-gray-800';
            break;
        case 'danger':
            $bgColor = 'bg-red-500';
            $textColor = 'text-white';
            break;
        default:
            $bgColor = 'bg-gray-500';
            $textColor = 'text-white';
            break;
    }
@endphp

<button
    {{ $attributes->merge(['class' => 'block text-xs w-full ' . $bgColor . ' ' . $textColor . '  py-2 rounded-none focus:outline-none hover:opacity-75']) }}
    {{ $isDisabled ? 'disabled' : '' }}>
    {{ $slot }}
</button>
