@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inserisci il tuo piatto</h1>
        <form action="{{ route('admin.dish.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input required minlength="3" maxlength="200" type="text" class="form-control @error('name') is-invalid @enderror" name='name' value="{{ old('name') }}">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
                        </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <input minlength="3" maxlength="200" required type="text" class="form-control @error('description') is-invalid @enderror" name='description' value="{{ old('description') }}" >
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti</label>
                <input required maxlength="200" type="text" class="form-control @error('ingredients') is-invalid @enderror" name='ingredients' value="{{ old('ingredients') }}">
                @error('ingredients')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="visible" class="form-label">Visibile</label>
                <select required type="select" class="form-select @error('visible') is-invalid @enderror" name="visible" @>
                    <option @if (old('visible'))
                        selected
                    @endif value="1">Si</option>
                    <option @if (!old('visible'))
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
                <input required min="0.01" type="number" class="form-control @error('price') is-invalid @enderror" name='price' step="0.01" value="{{ old('price') }}">
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Foto</label>
                <input required type="file" class="form-control @error('photo') is-invalid @enderror" name='photo'>
                @error('photo')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            </div>
            <a href={{ route('admin.dish.index') }} class="btn btn-danger">Indietro</a>
            <button type="submit" class="btn btn-primary">Aggiungi Piatto</button>
        </form>
    </div>
@endsection
