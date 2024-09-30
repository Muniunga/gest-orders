   <!-- Header -->
   <header class="bg-blue-600 text-white p-4 shadow-md">
       <div class="container mx-auto flex justify-between items-center">
           @if(Auth::user()->profile === 'requester')
           <a href="{{ route('home')}}" class="text-2xl font-bold">Inicio</a>
           <a href="{{ route('myOrders')}}" class="px-4 hover:text-gray-200 text-2xl font-bold">Meus Pedidos</a>
           @else
           <a href="{{ route('orders')}}" class="text-2xl font-bold">Inicio</a>
           @endif
           Olá, {{ Auth::user()->name }}
           <nav>
               @if(Auth::user()->profile === 'approver')
               <a href="{{ route('home')}}" class="px-4 hover:text-gray-200 text-2xl font-bold">Mudar para Solicitante</a>
               @elseif(Auth::user()->profile === 'requester')
               <a href="{{ route('orders')}}" class="px-4 hover:text-gray-200 text-2xl font-bold">Mudar para Aprovador</a>
               @endif
           </nav>
       </div>
   </header>
