@extends('layouts.app')

@section('content')
@if ($userRestaurant === null)
<div class="container d-flex align-items-center flex-column">
    <h1>Non hai ancora creato un ristorante</h1>
    <a href={{route('admin.restaurant.create')}} class="btn btn-primary d-block">Crea ristorante</a>
</div>

@else

<div class="container text-center">
    <h1>Il tuo ristorante</h1>
</div>
    <div class="container d-flex justify-content-center mt-2">
        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="{{$userRestaurant->photo}}" alt="{{$userRestaurant->name}}">
            <div class="card-body">
              <h5 class="card-title">{{$userRestaurant->name}}</h5>
              <p class="card-text">Indirizzo: {{$userRestaurant->address}}</p>
            </div>
          </div>
    </div>
    @endif

@endsection
