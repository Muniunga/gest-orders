<?php

namespace App\Livewire;

use App\Models\Material;
use Livewire\Component;

class ListMaterial extends Component
{
    public function render()
    {
        $data['materials']= Material::all();
        return view('livewire.list-material', $data);
    }
}
