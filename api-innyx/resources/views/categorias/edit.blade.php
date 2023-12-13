@extends('layouts.app')

@section('content')
    <h1>Editar Categoria #{{ $categoria->id }}</h1>
    <form action="{{ url('/categorias/' . $categoria->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ $categoria->nome }}"><br>

        <button type="submit">Salvar</button>
    </form>
@endsection
