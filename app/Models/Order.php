<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['total', 'status', 'created_at', 'updated_at', 'requester_id', 'group_id'];

    public function requester()
    {
        return $this->belongsTo(Requester::class, 'requester_id');  // O pedido pertence a um solicitante
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id');  // O pedido pertence a um grupo
    }

    public function materials()
    {
        return $this->belongsToMany(Material::class, 'order_has_materials')  // Muitos para muitos entre pedidos e materiais
            ->withPivot('quantity', 'subtotal');  // Campos adicionais na tabela pivô
            
    }
}
