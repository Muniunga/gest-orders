<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'price'];

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_material')  // Muitos para muitos entre materiais e pedidos
            ->withPivot('quantity', 'subtotal');  // Campos adicionais na tabela pivô
    }
}
