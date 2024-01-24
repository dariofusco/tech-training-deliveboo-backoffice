@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h1>I tuoi piatti</h1>
    </div>
    @foreach ($restaurantDishes as $restaurantDish)
        <div class="container d-flex justify-content-center mt-2">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{ $restaurantDish->photo }}" alt="{{ $restaurantDish->name }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $restaurantDish->name }}</h5>
                    <p class="card-text">Descrizione: {{ $restaurantDish->description }}</p>
                    <p class="card-text">Ingredienti: {{ $restaurantDish->ingredients }}</p>
                </div>
            </div>
        </div>
    @endforeach
@endsection
