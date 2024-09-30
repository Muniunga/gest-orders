<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'allowed_balance', 'approver_id'];

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id');  // O grupo pertence a um usuário que é o aprovador
    }

    public function requesters()
    {
        return $this->hasMany(Requester::class, 'group_id');  // Um grupo pode ter vários solicitantes
    }
    

    public function orders()
    {
        return $this->hasMany(Order::class, 'group_id');  // Um grupo pode ter vários pedidos
    }
}
