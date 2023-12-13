@extends('layouts.app')

@section('content')
    <h1>Detalhes da Categoria #{{ $categoria->id }}</h1>
    <p><strong>Nome:</strong> {{ $categoria->nome }}</p>
    <a href="{{ url('/categorias') }}">Voltar para a lista</a>
@endsection
