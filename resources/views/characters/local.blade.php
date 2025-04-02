@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Personajes Guardados</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Estado</th>
                <th>Especie</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($characters as $character)
            <tr>
                <td>{{ $character['id'] }}</td>
                <td>{{ $character['name'] }}</td>
                <td>{{ $character['status'] }}</td>
                <td>{{ $character['species'] }}</td>
                <td>
                    <a href="{{ route('characters.edit', $character['id']) }}" class="btn btn-primary">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection