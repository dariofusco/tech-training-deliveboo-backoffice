@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifica il tuo piatto</h1>
    <form action="{{ route('admin.dish.update', ['id' => $dish->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name='name' value="{{ old('name', $dish->name) }}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
                    </div>
        <div class="mb-3">
            <label for="description" class="form-label">Descrizione</label>
            <input type="text" class="form-control @error('description') is-invalid @enderror" name='description' value="{{ old('description', $dish->description) }}" >
            @error('description')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredienti</label>
            <input type="text" class="form-control @error('ingredients') is-invalid @enderror" name='ingredients' value="{{ old('ingredients', $dish->ingredients) }}">
            @error('ingredients')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="mb-3">
            <label for="visible" class="form-label">Visibile</label>
            <select type="select" class="form-select @error('visible') is-invalid @enderror" name="visible" @>
                <option @if (old('visible', $dish->visible))
                    selected
                @endif value="1">Si</option>
                <option @if (!old('visible', $dish->visible))
                selected
            @endif value="0">No</option>
                @error('visible')
                <div>
                <span class="text-danger" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            </div>
            @enderror
            </select>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Prezzo</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" name='price' step="0.01" value="{{ old('price', $dish->price) }}">
            @error('price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="mb-3">
            <label for="photo" class="form-label">Foto</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" name='photo'>
            @error('photo')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <span>
            <div class="mb-3">
                <label for="current_photo" class="form-label">Foto Attuale</label>
                <img src="{{ $dish->photo }}" alt="Current Photo" class="img-thumbnail"
                    style="max-width: 200px;">
            </div>
            <input type="hidden" name="current_photo" value="{{ $dish->photo }}">
        </span>
        <a href={{ route('admin.dish.index') }} class="btn btn-danger">Indietro</a>
        <button type="submit" class="btn btn-primary">Aggiorna Piatto</button>
    </form>
</div>
@endsection