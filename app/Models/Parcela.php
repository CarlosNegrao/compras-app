<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; 
use Illuminate\Database\Eloquent\Model;

class Parcela extends Model
{
    use HasFactory;

    protected $fillable = ['compra_id', 'numero', 'valor', 'data', 'paga'];

    public function compra()
    {
        return $this->belongsTo(Compra::class);
    }
}
