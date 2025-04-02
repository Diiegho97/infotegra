@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Personajes de Rick and Morty (API)</h2>
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
            @foreach($characters as $char)
            <tr>
                <td>{{ $char['id'] }}</td>
                <td>{{ $char['name'] }}</td>
                <td>{{ $char['status'] }}</td>
                <td>{{ $char['species'] }}</td>
                <td>
                    <button onclick="alert('Detalles: {{ json_encode($char) }}')" class="btn btn-info">Ver Detalles</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <form action="{{ route('characters.store') }}" method="POST">
        @csrf
        <button type="submit" class="btn btn-success">Guardar en BD</button>
    </form>
</div>
@endsection
