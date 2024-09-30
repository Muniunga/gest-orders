<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;

class ListOrders extends Component
{
    public $selectedOrder;
    public $isEditing;
    public $groupBalance;
    public function resetSelectedOrder()
    {
        $this->selectedOrder = null;
    }
    public function selectOrder($orderId)
    {
        $this->selectedOrder = Order::find($orderId);

        if ($this->selectedOrder) {
            // Verifique se o status do pedido não é 'approved' antes de mudar para 'under_review'
            if ($this->selectedOrder->status !== 'approved') {
                // Muda o estado do pedido para "em revisão"
                $this->selectedOrder->status = 'under_review';
                $this->selectedOrder->save();
            }

            $requester = $this->selectedOrder->requester;

            // Carrega o saldo do grupo, se disponível
            if ($requester && $requester->group) {
                $this->groupBalance = $requester->group->balance;
            } else {
                $this->groupBalance = null; // Define como nulo se o grupo não existir
            }
        }

        $this->isEditing = true; // Marca como sendo editado
    }

    public function approveOrder($orderId)
    {
        // Encontra o pedido
        $order = Order::find($orderId);

        // Obtemos o requester relacionado ao pedido
        $requester = $order->requester;

        // Verificamos se o requester existe
        if (!$requester) {
            session()->flash('error', 'O pedido não está associado a um solicitante válido.');
            return;
        }

        // Verificamos o grupo ao qual o requester pertence
        $group = $requester->group;

        // Verificamos se o saldo do grupo é suficiente
        if ($group && $group->allowed_balance >= $order->total) {
            // Reduzimos o saldo do grupo pelo valor do total do pedido
            $group->allowed_balance -= $order->total;
            $group->save();

            // Mudamos o estado do pedido para "aprovado"
            $order->status = 'approved';
            $order->save();

            // Enviar uma mensagem de sucesso
            session()->flash('message', 'Pedido aprovado com sucesso!');
        } else {
            // Caso o saldo seja insuficiente, lançar um erro
            session()->flash('error', 'Saldo insuficiente para aprovar o pedido.');
        }

        // Atualiza a variável de controle para exibir o pedido atualizado
        $this->selectedOrder = $order;
    }



    public function requestChangeOrder(Order $order)
    {
        // Muda o estado do pedido para "Alterações solicitadas"
        $order->status = 'changes_requested';
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
