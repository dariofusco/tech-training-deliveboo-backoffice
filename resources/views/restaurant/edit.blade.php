@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <form class="glass-form" action="{{ route('admin.restaurant.update', ['id' => $userRestaurant->id]) }}" method="POST"
            enctype="multipart/form-data">
            <a href={{ route('admin.restaurant.index') }} class="btn btn-danger rounded-circle mb-3"> <i
                    class="fa-solid fa-arrow-left "></i></a>
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input required minlength="3" maxlength="200" type="text"
                    class="form-control @error('name') is-invalid @enderror" name='name'
                    value="{{ old('name', $userRestaurant->name) }}">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input minlength="3" required maxlength="200" type="text"
                    class="form-control @error('address') is-invalid @enderror" name='address'
                    value="{{ old('address', $userRestaurant->address) }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="piva" class="form-label">P.Iva</label>
                <input minlength="10" maxlength="14" required type="text"
                    class="form-control @error('piva') is-invalid @enderror" name='piva'
                    value="{{ old('piva', $userRestaurant->piva) }}">
                @error('piva')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <span class="">
                <div class="">
                    <label for="typologies" class="form-label">Tipologie:</label>
                </div>
                <div class="mb-3">
                    @foreach ($typologies as $typology)
                        <input type="checkbox" class="form-check-input" name='typologies[]' value="{{ $typology->id }}"
                            {{ in_array($typology->id, old('typologies', $userRestaurant->typologies->pluck('id')->toArray())) ? 'checked' : '' }}>
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
            <div class="mb-3">
                <label for="photo" class="form-label">Opzionale: nuova foto</label>
                <input type="file" class="form-control  @error('photo') is-invalid @enderror" name='photo'>
                @error('photo')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
            <div class="d-flex align-items-end justify-content-between">
                <div class="mb-3">
                    <label for="current_photo" class="form-label">Foto Attuale</label>
                    <img src="{{ $userRestaurant->photo }}" alt="Current Photo" class="img-thumbnail"
                        style="max-width: 200px;">
                </div>
                <input type="hidden" name="current_photo" value="{{ $userRestaurant->photo }}">

                <button type="submit" class="btn btn-warning">Aggiorna Ristorante</button>
            </div>
        </form>
    </div>
@endsection
