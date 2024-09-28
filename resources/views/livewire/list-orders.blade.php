<div>
    <div class="container mx-auto mt-8">
        <h1 class="text-2xl font-semibold mb-4">Lista de Pedidos</h1>

        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID do Pedido</th>
                    <th class="py-3 px-6 text-left">Total</th>
                    <th class="py-3 px-6 text-left">Status</th>
                    <th class="py-3 px-6 text-left">Ações</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @foreach($orders as $order)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    <td class="py-3 px-6">{{ $order->id }}</td>

                    <td class="py-3 px-6">{{ number_format($order->total, 2, ',', '.') }} Kz</td>
                    <td class="py-3 px-6">{{ $order->status }}</td>
                    <td class="py-3 px-6">

                        <button
                            class="text-blue-500 hover:underline"
                            wire:click="selectOrder({{ $order->id }})"
                            data-modal-toggle="orderModal">
                            Ver
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if($orders->isEmpty())
        <div class="mt-4 text-center">
            <p class="text-gray-500">Nenhum pedido encontrado.</p>
        </div>
        @endif
    </div>
    <!-- Modal -->
    @if($selectedOrder)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-lg max-w-md w-full">
            <div class="p-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-semibold mb-2">Detalhes do Pedido</h2>
                    <button wire:click="resetSelectedOrder" class="bg-red-500 text-white px-4 py-2 rounded">
                      <i class="fa fa-close" aria-hidden="true>"></i>
                    </button>
                </div>
                <p><strong>ID do Pedido:</strong> {{ $selectedOrder->id }}</p>
                <p><strong>Total:</strong> {{ number_format($selectedOrder->total, 2, ',', '.') }} Kz</p>
                <p><strong>Saldo:</strong> </p>
                <p><strong>Status:</strong> {{ $selectedOrder->status }}</p>

                <h3 class="mt-4 font-semibold">Produtos:</h3>
                <table class="min-w-full bg-gray-100 border border-gray-200 mt-2">
                    <thead>
                        <tr class="bg-gray-300 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Produto</th>
                            <th class="py-3 px-6 text-left">Quantidade</th>
                            <th class="py-3 px-6 text-left">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($selectedOrder->materials as $material)
                        <tr class="border-b border-gray-200 hover:bg-gray-50">
                            <td class="py-3 px-6">{{ $material->name }}</td>
                            <td class="py-3 px-6">{{ $material->pivot->quantity }}</td>
                            <td class="py-3 px-6">{{ number_format($material->pivot->subtotal, 2, ',', '.') }} Kz</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="flex items-center justify-between">
                    <button wire:click="approveOrder({{ $selectedOrder->id }})" class="bg-green-500 text-white px-4 py-2 rounded">
                        Aprovar
                    </button>
                    <button wire:click="requestChangeOrder({{ $selectedOrder->id }})" class="bg-orange-500 text-white px-4 py-2 rounded">
                        Solicitar alterações
                    </button>
                    <button wire:click="rejectOrder({{ $selectedOrder->id }})" class="bg-red-500 text-white px-4 py-2 rounded">
                        Rejeitar
                    </button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
