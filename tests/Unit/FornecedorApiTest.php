<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Fornecedor;

class FornecedorApiTest extends TestCase
{
    use RefreshDatabase;

    #[\PHPUnit\Framework\Attributes\Test]
    public function pode_criar_fornecedor(): void
    {
        $data = [
            'nome' => 'Empresa Teste',
            'cnpj' => '04470781000139',
            'email' => 'teste@empresa.com',
        ];

        $response = $this->postJson('/api/fornecedores', $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Fornecedor criada com sucesso.',
            ]);

        $this->assertDatabaseHas('fornecedores', [
            'nome' => 'Empresa Teste',
            'cnpj' => '04470781000139',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function nao_pode_criar_cnpj_duplicado(): void
    {
        $fornecedor = Fornecedor::factory()->create([
            'cnpj' => '12345678000199',
        ]);

        $data = [
            'nome' => 'Outra Empresa',
            'cnpj' => '12345678000199',
            'email' => 'outra@empresa.com',
        ];

        $response = $this->postJson('/api/fornecedores', $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('cnpj');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function pode_atualizar_fornecedor(): void
    {
        $fornecedor = Fornecedor::factory()->create();

        $data = [
            'nome' => 'Novo Nome',
            'cnpj' => '11222333000181',
            'email' => 'novo@email.com',
        ];

        $response = $this->putJson("/api/fornecedores/{$fornecedor->id}", $data);

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Fornecedor atualizada com sucesso.',
            ]);

        $this->assertDatabaseHas('fornecedores', [
            'id' => $fornecedor->id,
            'nome' => 'Novo Nome',
            'cnpj' => '11222333000181',
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function nao_pode_atualizar_para_cnpj_duplicado(): void
    {
        $fornecedor1 = Fornecedor::factory()->create(['cnpj' => '12345678000199']);
        $fornecedor2 = Fornecedor::factory()->create(['cnpj' => '98765432000188']);

        $data = [
            'nome' => 'Atualizando Nome',
            'cnpj' => '12345678000199',
            'email' => 'novo@empresa.com',
        ];

        $response = $this->putJson("/api/fornecedores/{$fornecedor2->id}", $data);

        $response->assertStatus(422)
            ->assertJsonValidationErrors('cnpj');
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function pode_deletar_fornecedor(): void
    {
        $fornecedor = Fornecedor::factory()->create();

        $response = $this->deleteJson("/api/fornecedores/{$fornecedor->id}");

        $response->assertStatus(200)
            ->assertJson([
                'success' => true,
                'message' => 'Success',
                'data' => 'Fornecedor excluída com sucesso.',
            ]);

        $this->assertSoftDeleted('fornecedores', [
            'id' => $fornecedor->id,
        ]);
    }

    #[\PHPUnit\Framework\Attributes\Test]
    public function retorna_erro_quando_fornecedor_nao_existe(): void
    {
        $response = $this->getJson('/api/fornecedores/999');

        $response->assertStatus(404)
            ->assertJson([
                'success' => false,
                'message' => 'Fornecedor não encontrado.',
            ]);
    }
}
