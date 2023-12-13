<?php

namespace Tests\Feature;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Produto;

class ProdutoControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_method_returns_correct_view()
    {
        \App\Models\Produto::factory()->count(15)->create();

        $response = $this->get(route('produtos.index'));

        $response->assertStatus(200);
        $response->assertViewIs('produtos.index');
        $response->assertViewHas('produtos');
        $this->assertCount(10, $response->viewData('produtos'));
    }

    /** @test */
    public function show_method_returns_correct_product()
    {
        $produto = Produto::factory()->create();

        $response = $this->get(route('produtos.show', $produto->id));

        $response->assertStatus(200);
        $response->assertViewIs('produtos.show');
        $response->assertViewHas('produto', $produto);
    }

    /** @test */
    public function store_method_creates_a_new_product()
    {
        $produtoData = [
            'nome' => 'Teste Produto',
            'descricao' => 'Descrição do teste',
            'preco' => 100.00,
            'data_validade' => now()->addDays(10)->format('Y-m-d'),
            'imagem' => UploadedFile::fake()->image('produto.jpg'),
            'categoria_id' => Categoria::factory()->create()->id
        ];

        $response = $this->post(route('produtos.store'), $produtoData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('produtos', ['nome' => 'Teste Produto']);
    }
}
