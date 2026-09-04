@extends('errors.layout')

@section('title', '404 - Página Não Encontrada')
@section('code', '404')
@section('message', 'Página Não Encontrada')
@section('description', 'A página que você está procurando pode ter sido removida, mudou de nome ou está temporariamente indisponível.')

@section('icon')
<svg class="w-24 h-24 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
</svg>
@endsection