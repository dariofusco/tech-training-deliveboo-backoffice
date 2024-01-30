@extends('layouts.app')

@section('content')


    @if ($userRestaurant === null)
        <div class="container mt-5">
            <form action="{{ route('admin.restaurant.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input required minlength="3" maxlength="200" type="text" class="form-control @error('name') is-invalid @enderror" name='name'
                        value="{{ old('name') }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Indirizzo</label>
                    <input minlength="3" required maxlength="200" type="text" class="form-control @error('address') is-invalid @enderror" name='address'
                        value="{{ old('address') }}">
                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="piva" class="form-label">P.Iva</label>
                    <input minlength="10" maxlength="14" required type="text" class="form-control @error('piva') is-invalid @enderror" name='piva'
                        value="{{ old('piva') }}">
                    @error('piva')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <span>
                    <div class="mb-3">
                        <label for="typologies" class="form-label">Tipologie:</label>
                    </div>
                    <div class="mb-3">
                        @foreach ($typologies as $typology)
                            <input type="checkbox" class="form-check-input" name='typologies[]'
                                value="{{ $typology->id }} @checked(old('typologies'))">
                            <label for="{{ $typology->id }}" class="form-check-label">{{ $typology->name }}</label>
                        @endforeach
                        @error('typologies')
                            <div>
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            </div>
                        @enderror
                    </div>
                </span>

                <div class="mb-5">
                    <label for="photo" class="form-label">Foto</label>
                    <input required type="file" class="form-control  @error('photo') is-invalid @enderror" name='photo'>
                    @error('photo')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Crea Ristorante</button>
            </form>
        </div>
    @else
        <div class="container d-flex align-items-center flex-column">
            <h1>Il tuo account ha già un ristorante, non puoi crearne altri</h1>
            <a href={{ route('admin.restaurant.index') }} class="btn btn-primary d-block">Vai al tuo ristorante</a>
        </div>
    @endif

@endsection
