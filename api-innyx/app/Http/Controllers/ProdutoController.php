<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Produto;
use Illuminate\Http\Request;


class ProdutoController extends Controller
{
    public function index(Request $request)
    {
        $produtos = Produto::query();

        if ($request->has('nome')) {
            $produtos->where('nome', 'like', '%' . $request->nome . '%');
        }

        if ($request->has('descricao')) {
            $produtos->where('descricao', 'like', '%' . $request->descricao . '%');
        }

        $produtos->paginate(10);

        return view('produtos.index', ['produtos' => $produtos->paginate(10)]);
    }

    public function create()
    {
        $categorias = Categoria::query();
        return view('produtos.create', ['categorias' => $categorias->paginate(10)]);
    }

    public function show($id)
    {
        $produto = Produto::findOrFail($id);
        return view('produtos.show', ['produto' => $produto]);
    }

    public function edit($id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::query();

        return view('produtos.edit', ['produto' => $produto], ['categorias' => $categorias->paginate(10)]);
    }

    public function store(Request $request)
    {
        return DB::transaction(function () use ($request) {
            $request->validate([
                'nome' => 'required|max:50',
                'descricao' => 'required|max:200',
                'preco' => 'required|numeric|min:0',
                'data_validade' => 'required|date|after_or_equal:today',
                'imagem' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'categoria_id' => 'required|exists:categorias,id'
            ]);

            $imagem = $request->file('imagem');
            \Log::info("Nome do arquivo: " . $imagem->getClientOriginalName());
            \Log::info("Tipo do arquivo: " . $imagem->getClientMimeType());
            \Log::info("Tamanho do arquivo: " . $imagem->getSize());

            $nomeArquivo = $request->file('imagem')->store('imagens', 'public');

            $produto = Produto::create([
                'nome' => $request->nome,
                'descricao' => $request->descricao,
                'preco' => $request->preco,
                'data_validade' => $request->data_validade,
                'imagem' => $nomeArquivo,
                'categoria_id' => $request->categoria_id
            ]);

            return response()->json($produto, 201);
        });
    }

    public function update(Request $request, $id)
    {
        return DB::transaction(function () use ($request, $id) {
            $produto = Produto::findOrFail($id);

            $request->validate([
                'nome' => 'required|max:50',
                'descricao' => 'required|max:200',
                'preco' => 'required|numeric|min:0',
                'data_validade' => 'required|date|after_or_equal:today',
                'categoria_id' => 'required|exists:categorias,id'
            ]);

            if ($request->hasFile('imagem')) {
                $nomeArquivo = $request->file('imagem')->store('imagens', 'public');
                $produto->imagem = $nomeArquivo;
            }

            $produto->nome = $request->nome;
            $produto->descricao = $request->descricao;
            $produto->preco = $request->preco;
            $produto->data_validade = $request->data_validade;
            $produto->categoria_id = $request->categoria_id;
            $produto->save();

            return response()->json($produto, 200);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            $produto = Produto::findOrFail($id);
            Storage::disk('public')->delete($produto->imagem); // Delete a imagem associada ao produto
            $produto->delete();

            return response()->json(null, 204);
        });
    }
}
