@extends('layouts.app')

@section('content')
    <h1>Listagem de Categorias</h1>
    <a href="{{ url('/categorias/create') }}">Criar Nova Categoria</a>

    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome</th>
        </tr>
        </thead>
        <tbody>

        @foreach($categorias as $categoria)
            <tr>
                <td>{{ $categoria->id }}</td>
                <td>{{ $categoria->nome }}</td>
                <td>
                    <a href="{{ url('/categorias/' . $categoria->id) }}">Ver</a>
                    <a href="{{ url('/categorias/' . $categoria->id . '/edit') }}">Editar</a>
                    <form action="{{ url('/categorias/' . $categoria->id) }}" method="POST">
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
