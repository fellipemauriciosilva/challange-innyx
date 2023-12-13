@extends('layouts.app')

@section('content')
    <h1>Editar Produto #{{ $produto->id }}</h1>
    <form action="{{ url('/produtos/' . $produto->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="{{ $produto->nome }}"><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao" value="{{ $produto->descricao }}"><br>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" value="{{ $produto->preco }}"><br>

        <label for="data_validade">Data de Validade:</label>
        <input type="date" id="data_validade" name="data_validade" value="{{ $produto->data_validade }}"><br>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem" value="{{ $produto->imagem }}"><br>

        <label for="categoria_id">Categoria:</label>
        <select id="categoria_id" name="categoria_id">
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}" {{ $categoria->id == $produto->categoria_id ? 'selected' : '' }}>
                    {{ $categoria->nome }}
                </option>
            @endforeach
        </select><br>

        <button type="submit">Salvar</button>
    </form>
@endsection
