<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = [
        'nome',
        'valor_unidade_medida',
        'unidade_medida',
        'sku',
        'data_validade',
        'preco_custo',
        'preco_venda',
        'estoque_atual',
        'estoque_minimo',
        'categoria_id'
    ];

    protected $casts = [
        'data_validade' => 'date', 
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function movimentacoes()
    {
        return $this->hasMany(Movimentacao::class);
    }
}
