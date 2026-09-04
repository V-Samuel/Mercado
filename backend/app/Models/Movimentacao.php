<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Movimentacao extends Model
{
    protected $table = 'movimentacoes';

    protected $fillable = [
        'produto_id',
        'tipo',
        'quantidade',
        'usuario_id',
        'motivo'
    ];

    protected static function booted()
    {
        static::addGlobalScope('user', function (Builder $builder) {
            if (Auth::check()) {
                $builder->where('usuario_id', Auth::user()->tenant_id);
            }
        });

        static::creating(function ($model) {
            if (Auth::check() && empty($model->usuario_id)) {
                $model->usuario_id = Auth::user()->tenant_id;
            }
        });
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
