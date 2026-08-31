<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

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
        'categoria_id',
        'user_id'
    ];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('user_id', Auth::id());
            }
        });

        static::creating(function ($model) {
            if (Auth::check() && empty($model->user_id)) {
                $model->user_id = Auth::id();
            }
        });
    }

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
