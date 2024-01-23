@extends('layouts.app')

@section('content')
    <div class="container">
        <form action="{{ route('admin.restaurant.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" name='name'>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Indirizzo</label>
                <input type="text" class="form-control" name='address'>
            </div>
            <div class="mb-3">
                <label for="piva" class="form-label">P.Iva</label>
                <input type="text" class="form-control" name='piva'>
            </div>
            <div class="mb-3">
                <label for="photo" class="form-label">Foto</label>
                <input type="file" class="form-control" name='photo'>
            </div>
            <button type="submit" class="btn btn-primary">Crea Ristorante</button>
        </form>
    </div>
@endsection
