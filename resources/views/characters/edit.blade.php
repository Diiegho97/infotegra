@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Editar Personaje</h2>
    <form action="{{ route('characters.update', $character->id) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="name" value="{{ $character->name }}" class="form-control">
        <button type="submit" class="btn btn-success">Guardar Cambios</button>
    </form>
</div>
@endsection
