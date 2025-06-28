<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;
    protected $fillable = ['descricao', 'numero_parcelas', 'valor_parcela', 'data_primeira_parcela'];

    public function parcelas()
    {
        return $this->hasMany(Parcela::class);
    }
}
