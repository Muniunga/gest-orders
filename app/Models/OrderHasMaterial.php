<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHasMaterial extends Model
{
    use HasFactory;

    protected $table = 'order_material';  // Definindo explicitamente o nome da tabela pivô

    protected $fillable = ['order_id', 'material_id', 'quantity', 'subtotal'];

    public $timestamps = false;  // Caso não haja timestamps na tabela pivô
}
