@extends('layouts.app')

@section('content')


    @if ($userRestaurant === null)
        <div class="container d-flex align-items-center flex-column">
            <h1 class="main-gradient">Non hai ancora creato un ristorante</h1>
            <a href={{ route('admin.restaurant.create') }} class="btn btn-primary d-block">Crea ristorante</a>
        </div>
    @else
        <div class="container text-center mb-5 mt-2">
            @if (session('updated'))
                <div class="alert alert-info">
                    {{ session('updated') }}
                </div>
            @endif
            <h1 class="main-gradient">Il tuo ristorante</h1>
        </div>
        <div class="container d-flex justify-content-center flex-column align-items-center">
            <div class="overlay">
                <div class="card mb-3 position-relative" style="width: 18rem;">
                    <img class="card-img-top" src="{{ $userRestaurant->photo }}" alt="{{ $userRestaurant->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $userRestaurant->name }}</h5>
                        <p class="card-text">Indirizzo: {{ $userRestaurant->address }}</p>
                        <p class="card-text">PIVA: {{ $userRestaurant->piva }}</p>
                        <p class="card-text">Tipologie:
                            @foreach ($userRestaurant->typologies as $restaurantTypology)
                                <span class="badge text-bg-warning">{{ $restaurantTypology->name }}</span>
                            @endforeach
                        </p>
                    </div>
                    <div class="overlay-content">
                        <div class="btn-modify">
                            <a href="{{ route('admin.restaurant.edit') }}" class="">
                                <i class="fa-solid fa-pencil"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <a href={{ route('admin.dish.index') }} class="btn btn-primary d-block">
                        I Tuoi Piatti
                    </a>
                </div>
            </div>
        </div>
    @endif

@endsection
