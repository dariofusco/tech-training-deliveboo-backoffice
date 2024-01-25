@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Inserisci il tuo piatto</h1>
        <form action="{{ route('admin.dish.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" name='name'>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Descrizione</label>
                <input type="text" class="form-control" name='description'>
            </div>
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredienti</label>
                <input type="text" class="form-control" name='ingredients'>
            </div>
            <div class="mb-3">
                <label for="visible" class="form-label">Visibile</label>
                <select type="select" class="form-select" name="visible">
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Prezzo</label>
                <input type="number" class="form-control" name='price' step="0.01">
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Foto</label>
                <input type="file" class="form-control" name='photo'>
            </div>
            <a href={{ route('admin.dish.index') }} class="btn btn-danger">Indietro</a>
            <button type="submit" class="btn btn-primary">Aggiungi Piatto</button>
        </form>
    </div>
@endsection
