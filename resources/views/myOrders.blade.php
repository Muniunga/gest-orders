@extends('layouts.app')

@section('content')
   <!-- Main Content (Products) -->
   <main class="container mx-auto py-10">
        <h2 class="text-3xl font-semibold mb-8 text-center">Materiais disponiveis</h2>
        @livewire('my-orders')
    </main>
@endsection
