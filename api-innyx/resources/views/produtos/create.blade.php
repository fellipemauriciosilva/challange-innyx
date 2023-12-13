@extends('layouts.app')

@section('content')
    <h1>Criar Novo Produto</h1>
    <form action="{{ url('/produtos') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome"><br>

        <label for="descricao">Descrição:</label>
        <input type="text" id="descricao" name="descricao"><br>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco"><br>

        <label for="data_validade">Data de Validade:</label>
        <input type="date" id="data_validade" name="data_validade"><br>

        <label for="imagem">Imagem:</label>
        <input type="file" id="imagem" name="imagem"><br>

        <label for="categoria_id">Categoria:</label>
        <select id="categoria_id" name="categoria_id">
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
            @endforeach
        </select><br>

        <button type="submit">Salvar</button>
    </form>
@endsection
