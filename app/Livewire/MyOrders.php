<?php

namespace App\Livewire;

use App\Models\Material;
use Livewire\Component;
use App\Models\Order;
use App\Models\OrderHasMaterial;
use Auth;

class MyOrders extends Component
{
    public $orders;
    public $selectedOrder;
    public $isEditing = false;
    public $materialQuantities = []; // Quantidades dos materiais
    public $total = 0; // Total do pedido

    public function mount()
    {
        if (Auth::check()) {
            $requester = Auth::user()->requester;
            if ($requester) {
                $this->orders = collect($requester->requests); // Obtém os pedidos
            } else {
                $this->orders = collect(); // Cria uma coleção vazia
            }
        } else {
            $this->orders = collect(); // Cria uma coleção vazia se o usuário não estiver autenticado
        }
    }

    public function selectOrder($orderId)
    {
        $this->selectedOrder = Order::find($orderId);
        $this->isEditing = true; // Inicia a edição
        $this->initializeQuantities(); // Inicializa as quantidades
        $this->calculateTotal(); // Calcula o total inicial
    }

    public function initializeQuantities()
    {
        foreach ($this->selectedOrder->materials as $material) {
            $this->materialQuantities[$material->id] = $material->pivot->quantity; // Quantidade existente
        }

        // Calcula o total inicial
        $this->calculateTotal();
    }

    public function calculateTotal()
    {
        $this->total = 0;

        foreach ($this->selectedOrder->materials as $material) {
            $quantity = $this->materialQuantities[$material->id];
            $subtotal = $quantity * $material->pivot->price; // Calcula o subtotal

            // Soma o subtotal ao total
            $this->total += $subtotal;
        }
    }

    public function updateOrder()
    {
        $total = 0;

        foreach ($this->selectedOrder->materials as $material) {
            $quantity = $this->materialQuantities[$material->id];
            $subtotal = $quantity * $material->pivot->price; // Calcula o subtotal

            // Atualiza a quantidade e o subtotal na tabela pivot (order_has_material)
            $this->selectedOrder->materials()->updateExistingPivot($material->id, [
                'quantity' => $quantity,
                'subtotal' => $subtotal, // Atualiza o subtotal
            ]);

            $total += $subtotal; // Soma ao total
        }

        // Atualiza o total do pedido e o status para 'new'
        $this->selectedOrder->total = $total;
        $this->selectedOrder->status = 'new';
        $this->selectedOrder->save();

        session()->flash('message', 'Pedido atualizado com sucesso!');
        $this->isEditing = false; // Fecha o modo de edição
    }

    public function resetSelectedOrder()
    {
        $this->selectedOrder = null;
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.my-orders', [
            'orders' => $this->orders,
        ]);


    }
}
