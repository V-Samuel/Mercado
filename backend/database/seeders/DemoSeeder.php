<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(User $user): void {
        $userId = $user ? $user->id : 1;

        $catEletronicos = \App\Models\Categoria::create(['nome' => 'Eletrônicos', 'descricao' => 'Produtos de tecnologia', 'user_id' => $userId]);
        $catAlimentos = \App\Models\Categoria::create(['nome' => 'Alimentos', 'descricao' => 'Itens de mercearia e grãos', 'user_id' => $userId]);
        $catBebidas = \App\Models\Categoria::create(['nome' => 'Bebidas', 'descricao' => 'Sucos, refrigerantes e bebidas alcoólicas', 'user_id' => $userId]);
        $catLimpeza = \App\Models\Categoria::create(['nome' => 'Limpeza', 'descricao' => 'Produtos de limpeza em geral', 'user_id' => $userId]);
        $catVestuario = \App\Models\Categoria::create(['nome' => 'Vestuário', 'descricao' => 'Roupas, calçados e acessórios', 'user_id' => $userId]);

        $prod1 = \App\Models\Produto::create([
            'nome' => 'Smartphone Galaxy S23', 'valor_unidade_medida' => 1, 'unidade_medida' => 'un',
            'sku' => '7892509127790', 'preco_custo' => 3500.00, 'preco_venda' => 4500.00,
            'estoque_atual' => 15, 'estoque_minimo' => 5, 'categoria_id' => $catEletronicos->id, 'user_id' => $userId
        ]);
        
        $prod2 = \App\Models\Produto::create([
            'nome' => 'Notebook Dell Inspiron', 'valor_unidade_medida' => 1, 'unidade_medida' => 'un',
            'sku' => '07899864905698', 'preco_custo' => 4200.00, 'preco_venda' => 5500.00,
            'estoque_atual' => 8, 'estoque_minimo' => 10, 'categoria_id' => $catEletronicos->id, 'user_id' => $userId
        ]);

        $prod3 = \App\Models\Produto::create([
            'nome' => 'Arroz Branco Tipo 1', 'valor_unidade_medida' => 5, 'unidade_medida' => 'Kg',
            'sku' => '7896290300011', 'data_validade' => now()->addDays(60), 'preco_custo' => 15.00, 'preco_venda' => 19.90,
            'estoque_atual' => 120, 'estoque_minimo' => 50, 'categoria_id' => $catAlimentos->id, 'user_id' => $userId
        ]);

        $prod4 = \App\Models\Produto::create([
            'nome' => 'Feijão Preto', 'valor_unidade_medida' => 5, 'unidade_medida' => 'Kg',
            'sku' => '7896116900668', 'data_validade' => now()->addDays(10), 'preco_custo' => 12.00, 'preco_venda' => 14.90,
            'estoque_atual' => 120, 'estoque_minimo' => 50, 'categoria_id' => $catAlimentos->id, 'user_id' => $userId
        ]);

        $prod5 = \App\Models\Produto::create([
            'nome' => 'Pespi', 'valor_unidade_medida' => 2, 'unidade_medida' => 'L',
            'sku' => '7892840800054', 'data_validade' => now()->addDays(2), 'preco_custo' => 5.00, 'preco_venda' => 8.90,
            'estoque_atual' => 9, 'estoque_minimo' => 10, 'categoria_id' => $catBebidas->id, 'user_id' => $userId
        ]);

        $prod6 = \App\Models\Produto::create([
            'nome' => 'Colgate Tripla Ação', 'valor_unidade_medida' => 90, 'unidade_medida' => 'g',
            'sku' => '07793100111143', 'preco_custo' => 4.00, 'preco_venda' => 9.90,
            'estoque_atual' => 40, 'estoque_minimo' => 10, 'categoria_id' => $catLimpeza->id, 'user_id' => $userId
        ]);

        $prod7 = \App\Models\Produto::create([
            'nome' => 'Camisa Hering', 'valor_unidade_medida' => 1, 'unidade_medida' => 'un',
            'sku' => '07891702979632', 'preco_custo' => 40.00, 'preco_venda' => 90.00,
            'estoque_atual' => 30, 'estoque_minimo' => 10, 'categoria_id' => $catVestuario->id, 'user_id' => $userId
        ]);

        \App\Models\Movimentacao::create([
            'produto_id' => $prod1->id, 'tipo' => 'entrada', 'quantidade' => 20, 'motivo' => 'Compra inicial', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod1->id, 'tipo' => 'saida', 'quantidade' => 5, 'motivo' => 'Venda balcão', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod3->id, 'tipo' => 'entrada', 'quantidade' => 150, 'motivo' => 'Chegada de carreta', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod3->id, 'tipo' => 'saida', 'quantidade' => 30, 'motivo' => 'Venda atacado', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod2->id, 'tipo' => 'saida', 'quantidade' => 5, 'motivo' => 'Venda atacado', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod4->id, 'tipo' => 'entrada', 'quantidade' => 15, 'motivo' => 'Chegada de carreta', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod4->id, 'tipo' => 'saida', 'quantidade' => 20, 'motivo' => 'Venda atacado', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod5->id, 'tipo' => 'saida', 'quantidade' => 20, 'motivo' => 'Venda atacado', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod6->id, 'tipo' => 'entrada', 'quantidade' => 50, 'motivo' => 'Chegada de carreta', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod6->id, 'tipo' => 'saida', 'quantidade' => 10, 'motivo' => 'Venda atacado', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod7->id, 'tipo' => 'entrada', 'quantidade' => 30, 'motivo' => 'Chegada de carreta', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod7->id, 'tipo' => 'saida', 'quantidade' => 17, 'motivo' => 'Venda atacado', 'usuario_id' => $userId
        ]);
        \App\Models\Movimentacao::create([
            'produto_id' => $prod5->id, 'tipo' => 'saida', 'quantidade' => 31, 'motivo' => 'Venda atacado', 'usuario_id' => $userId
        ]);

    }
}
