@extends('layouts.app')

@section('content')
    @if ($userRestaurant === null)
        <div class="container d-flex align-items-center flex-column">
            <h1 class="my-4 fw-bold">Non hai ancora creato un ristorante</h1>
            <a href={{ route('admin.restaurant.create') }} class="btn btn-primary">Crea ristorante</a>
        </div>
    @else
        <div class="container mt-3">

            <div class="text-center mb-3">
                <h1>Il tuo ristorante</h1>
            </div>
            <div class="d-flex justify-content-center">
                <div class="card" style="width: 18rem;">
                    <img class="card-img-top" src="{{ $userRestaurant->photo }}" alt="{{ $userRestaurant->name }}">
                    <div class="card-body text-center ">
                        <h5 class="card-title fw-bolder fs-3 mb-2">{{ $userRestaurant->name }}</h5>
                        <p class="card-text"> <span class="fw-bold">Indirizzo:</span> {{ $userRestaurant->address }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
