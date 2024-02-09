@extends('layouts.app')

@section('content')
    <div class="container text-center my-3 ">
        <h1 class=" main-gradient ">I tuoi piatti</h1>
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <a tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-placement="right"
                    data-bs-content="Torna al ristorante" href={{ route('admin.restaurant.index') }}
                    class="btn btn-danger rounded-circle"><i class="fa-solid fa-arrow-left"></i>

                </a>
            </div>
            <div>
                <a tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-placement="left"
                    data-bs-content="aggiungi un nuovo piatto" href={{ route('admin.dish.create') }}
                    class="btn btn-danger rounded-circle"> <i class="fa-solid fa-plus"></i>
                </a>

            </div>
        </div>
    </div>
    <div class="container text-center px-5">
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
                <div class="col-3 my-3">
                    <div class="overlay">

                        <div class="card">
                            <img class="card-img-top" src="{{ $restaurantDish->photo }}" alt="{{ $restaurantDish->name }}"
                                style="min-height:200px ">
                            <div class="card-body">
                                <h5 class="card-title">{{ $restaurantDish->name }}</h5>
                                <p class="card-text mb-1">Descrizione: {{ $restaurantDish->description }}</p>
                                <p class="card-text mb-1">Ingredienti: {{ $restaurantDish->ingredients }}</p>
                                <p class="card-text mb-0">Visibile: {{ $restaurantDish->visible ? 'SI' : 'NO' }}</p>
                                <p class="card-text mt-2">Prezzo: {{ $restaurantDish->price }}&euro;</p>
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

    </div>
@endsection
