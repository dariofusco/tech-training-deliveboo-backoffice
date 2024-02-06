@extends('layouts.app')

@section('content')
    <div class="container text-center main-gradient">
        <h1>I tuoi piatti</h1>
    </div>

    <div class="container text-center">
        @if (session('deleted'))
            <div class="alert alert-danger">
                {{ session('deleted') }}
            </div>
        @endif

        @if (session('updated'))
            <div class="alert alert-info">
                {{ session('updated') }}
            </div>
        @endif
        <div class="row">

            @foreach ($restaurantDishes as $restaurantDish)
                <div class="col-3 mt-3">
                    <div class="overlay">

                        <div class="card" style="">
                            <img class="card-img-top" src="{{ $restaurantDish->photo }}" alt="{{ $restaurantDish->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $restaurantDish->name }}</h5>
                                <p class="card-text mb-0">Descrizione: {{ $restaurantDish->description }}</p>
                                <p class="card-text">Ingredienti: {{ $restaurantDish->ingredients }}</p>
                                <p class="card-text mb-0">Visibile: {{ $restaurantDish->visible ? 'SI' : 'NO' }}</p>
                                <p class="card-text">Prezzo: {{ $restaurantDish->price }}&euro;</p>
                                <div class="overlay-content">

                                    <form class='delete-button'
                                        action="{{ route('admin.dish.delete', ['id' => $restaurantDish->id]) }}"
                                        method='POST'>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Confermi di voler eliminare questo piatto?')"
                                            class="btn-delete fw-bold">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <div class="btn-modify">
                                            <a href="{{ route('admin.dish.edit', $restaurantDish->id) }}" class="fw-bold">
                                                <i class="fa-solid fa-pencil"></i>
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
        <a href={{ route('admin.restaurant.index') }} class="btn btn-danger">Indietro</a>
        <a href={{ route('admin.dish.create') }} class="btn btn-primary m-3">Aggiungi Nuovo Piatto</a>
    </div>
@endsection
