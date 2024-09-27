<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">


        <!-- Products  -->
        @foreach($materials as $material)

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://via.placeholder.com/300" alt="Product 1" class="w-full h-48 object-cover">
            <div class="p-4">

                <h3 class="text-xl font-bold mb-2"> {{ $material->name }}</h3>
                <p class="text-gray-700">Description of product 1.</p>
                <p class="text-blue-600 mt-4"> {{ $material->price }}</p>
                <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Buy Now</button>
            </div>
        </div>
        @endforeach


    </div>
</div>
