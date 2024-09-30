<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Requester extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'group_id'];

    public function requests()
    {
        return $this->hasMany(Order::class, 'requester_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);  // O solicitante pertence a um usuário
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'z');  // Um solicitante pode criar vários pedidos
    }
}
