@extends('layouts.app')

@section('content')
    <h1>Detalhes do Produto #{{ $produto->id }}</h1>
    <p><strong>Nome:</strong> {{ $produto->nome }}</p>
    <p><strong>Descrição:</strong> {{ $produto->descricao }}</p>
    <p><strong>Preço:</strong> {{ $produto->preco }}</p>
    <p><strong>Data Validade:</strong> {{ $produto->data_validade }}</p>
    <p><strong>Imagem:</strong> {{ $produto->imagem }}</p>
    <p><strong>Categoria:</strong> {{ $produto->categoria_id }}</p>

    <a href="{{ url('/produtos') }}">Voltar para a lista</a>
@endsection
