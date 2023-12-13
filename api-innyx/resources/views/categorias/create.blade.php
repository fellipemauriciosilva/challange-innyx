@extends('layouts.app')

@section('content')
    <h1>Criar Novo Produto</h1>
    <form action="{{ url('/categorias') }}" method="POST">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome"><br>

        <button type="submit">Salvar</button>
    </form>
@endsection
