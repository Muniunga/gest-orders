@extends('layouts.app')

@section('content')
   <!-- Main Content (Products) -->
   <main class="container mx-auto py-10">
        <h2 class="text-3xl font-semibold mb-8 text-center">Our Products</h2>


        @livewire('list-material')
    </main>
@endsection
