@props(['action'])

<form action="{{ $action }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <button type="button" onclick="abrirModal(this.closest('form'))" {{ $attributes->merge(['class' => 'text-white bg-red-500 hover:bg-red-600 rounded-md py-1 px-2 uppercase transition-colors cursor-pointer']) }}>
        {{ $slot->isEmpty() ? 'Excluir' : $slot }}
    </button>
</form>