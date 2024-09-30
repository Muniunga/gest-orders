<div>
    <div class="flex justify-between mb-6">
        <div class=" grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
            <!-- Products  -->
            @foreach($materials as $material)

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/300" alt="Product 1" class="w-full h-48 object-cover">
                <div class="p-4">

                    <h3 class="text-xl font-bold mb-2"> {{ $material->name }}</h3>
                    <p class="text-gray-700">Description of product 1.</p>
                    <p class="text-blue-600 mt-4"> {{ $material->price }}</p>
                    <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700" wire:click="addMaterial({{ $material->id }})"> Adicionar</button>
                </div>
            </div>
            @endforeach


        </div>
        <!-- Materiais selecionados -->
        <div class="w-1/2">
        @if (session()->has('message'))
            <div class="bg-green-500 text-white p-2 rounded mb-4">
                {{ session('message') }}
            </div>
            @endif

            @if (session()->has('error'))
            <div class="bg-red-500 text-white p-2 rounded mb-4">
                {{ session('error') }}
            </div>
            @endif
            <h3 class="text-xl font-semibold mb-4">Materiais Selecionados</h3>
            @if(count($selectedMaterials) > 0)
            <ul>
                @foreach($selectedMaterials as $material)
                <li class="flex justify-between py-2">
                    <span>{{ $material['name'] }} - {{ $material['price'] }} Kz</span>
                    <input type="number" min="1" wire:model.lazy="quantities[{{ $material['id'] }}]"
                        wire:change="updateQuantity({{ $material['id'] }}, $event.target.value)"
                        class="w-16 border rounded" />
                    <button class="bg-red-500 text-white px-2 py-1 rounded" wire:click="removeMaterial({{ $material['id'] }})">
                        Remover
                    </button>
                </li>
                @endforeach

            </ul>


            <div class="mt-4">
                <h3 class="text-xl font-bold">Total: {{ $total }} Kz</h3>
                <button class="bg-green-500 text-white px-4 py-2 rounded mt-4" wire:click="placeOrder">
                    Fazer Pedido
                </button>
            </div>
            @else
            <p>Nenhum material selecionado.</p>
            @endif
        </div>
    </div>
</div>
