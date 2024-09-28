<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class ListOrders extends Component
{
    public $selectedOrder;
    public function resetSelectedOrder()
    {
        $this->selectedOrder = null;
    }
    public function selectOrder(Order $order)
    {
        // Muda o estado do pedido para "em revisão"
        $order->status = 'under_review';
        $order->save();
        $this->selectedOrder = $order;
    }

    public function requestChangeOrder(Order $order)
    {
        // Muda o estado do pedido para "Alterações solicitadas"
        $order->status = 'changes_requested';
        $order->save();
        $this->selectedOrder = $order;
    }
    public function approveOrder(Order $order)
    {
        // Muda o estado do pedido para "aprovado"
        $order->status = 'approved';
        $order->save();
        $this->selectedOrder = $order;
    }
    public function rejectOrder(Order $order)
    {
        // Muda o estado do pedido para "rejeitado"
        $order->status = 'rejected';
        $order->save();
        $this->selectedOrder = $order;
    }


    public function render()
    {
        $data['orders'] = Order::with('materials',)->get();

        return view('livewire.list-orders', $data);
    }
}
