@extends('layouts.app')

@section('content')
    <h1>Listagem de Produtos</h1>
    <a href="{{ url('/produtos/create') }}">Criar Novo Produto</a>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Preço</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>

        @foreach($produtos as $produto)
            <tr>
                <td>{{ $produto->id }}</td>
                <td>{{ $produto->nome }}</td>
                <td>{{ $produto->descricao }}</td>
                <td>{{ $produto->preco }}</td>
                <td>
                    <a href="{{ url('/produtos/' . $produto->id) }}">Ver</a>
                    <a href="{{ url('/produtos/' . $produto->id . '/edit') }}">Editar</a>
                    <form action="{{ url('/produtos/' . $produto->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
