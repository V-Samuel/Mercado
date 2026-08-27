@props(['href'])

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-white bg-indigo-600 hover:bg-indigo-700 rounded-md py-1 px-2 transition-colors']) }}>
    {{ $slot->isEmpty() ? 'Editar' : $slot }}
</a>