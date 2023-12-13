<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index(Request $request)
    {
        $categorias = Categoria::query();

        if ($request->has('nome')) {
            $categorias->where('nome', 'like', '%' . $request->nome . '%');
        }

        return view('categorias.index', ['categorias' => $categorias->paginate(10)]);
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show', ['categoria' => $categoria]);
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);

        return view('categorias.edit', ['categoria' => $categoria]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|max:100',
        ]);

        return DB::transaction(function () use ($request) {
            $categoria = Categoria::create($request->all());
            return response()->json($categoria, 201);
        });
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|max:100',
        ]);

        return DB::transaction(function () use ($request, $id) {
            $categoria = Categoria::findOrFail($id);
            $categoria->update($request->all());
            return response()->json($categoria, 200);
        });
    }

    public function destroy($id)
    {
        return DB::transaction(function () use ($id) {
            Categoria::findOrFail($id)->delete();
            return response()->json(null, 204);
        });
    }
}
