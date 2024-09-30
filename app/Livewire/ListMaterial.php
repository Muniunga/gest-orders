<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Material;
use App\Models\OrderHasMaterial;
use App\Models\Order;
use App\Models\Requester;
use Auth;

class ListMaterial extends Component
{
    public $materials = [];
    public $selectedMaterials = [];
    public $quantities = [];
    public $total = 0;

    public function resetCart()
    {
        $this->selectedMaterials = [];  // Limpa a lista de materiais selecionados
        $this->total = 0;  // Reseta o total
    }

    public function mount()
    {
        $this->materials = Material::all();
    }

    public function addMaterial($materialId)
    {
        $material = Material::find($materialId);

        // Verificar se o material já foi adicionado
        foreach ($this->selectedMaterials as $selectedMaterial) {
            if ($selectedMaterial['id'] == $material->id) {
                return; // Se já foi adicionado, não fazer nada
            }
        }

        // Adicionar o material à lista de materiais selecionados
        $this->selectedMaterials[] = [
            'id' => $material->id,
            'name' => $material->name,
            'price' => $material->price,
            'quantity' => 1, // Quantidade padrão
        ];

        // Atualizar o total
        $this->updateTotal();
    }

    public function removeMaterial($materialId)
    {
        $this->selectedMaterials = array_filter($this->selectedMaterials, function ($material) use ($materialId) {
            return $material['id'] !== $materialId;
        });

        // Atualizar o total
        $this->updateTotal();
    }
    public function calculateTotal()
    {
        $this->total = 0;

        foreach ($this->selectedMaterials as $material) {
            $this->total += $material['price'] * $material['quantity'];
        }
    }


    public function updateQuantity($materialId, $quantity)
    {
        // Valida a quantidade (não permitir valores negativos)
        if ($quantity < 1) {
            $quantity = 1;
        }

        // Atualiza a quantidade na lista de materiais selecionados
        foreach ($this->selectedMaterials as &$selectedMaterial) {
            if ($selectedMaterial['id'] == $materialId) {
                $selectedMaterial['quantity'] = $quantity;
            }
        }

        // Atualiza o array de quantidades
        $this->quantities[$materialId] = $quantity;

        // Recalcula o total
        $this->calculateTotal();
    }

    public function updateTotal()
    {
        $this->total = array_reduce($this->selectedMaterials, function ($carry, $material) {
            return $carry + ($material['price'] * $material['quantity']);
        }, 0);
    }
    public function placeOrder()
    {
        // Verificar se os materiais selecionados estão presentes
        if (empty($this->selectedMaterials)) {
            session()->flash('error', 'Você precisa selecionar pelo menos um material.');
            return;
        }

        // Obter o requester associado ao usuário autenticado
        $requester = Requester::where('user_id', Auth::id())->first();

        if (!$requester) {
            session()->flash('error', 'Não foi possível encontrar um requester associado ao usuário.');
            return;
        }

        // Criar o pedido
        $order = Order::create([
            'requester_id' => $requester->id, // Usando o requester_id correto
            'group_id' => $requester->group_id, // Obtendo o group_id correto
            'total' => $this->total,
            'status' => 'new',
        ]);

        // Associar os materiais ao pedido
        foreach ($this->selectedMaterials as $material) {
            $order->materials()->attach($material['id'], [
                'quantity' => $material['quantity'],
                'subtotal' => $material['quantity'] * $material['price']
            ]);
        }

        // Mensagem de sucesso
        session()->flash('message', 'Pedido realizado com sucesso!');

        // Resetar o carrinho após o pedido
        $this->resetCart();
    }



    public function render()
    {
        $data['materials'] = Material::all();
        return view('livewire.list-material', $data);
    }
}
