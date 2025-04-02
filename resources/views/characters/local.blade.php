@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Personajes Guardados en la BD</h2>
    <table class="table table-striped table-hover" id="charactersTable">
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
                    <a href="{{ route('characters.edit', $character['id']) }}" class="btn btn-sm btn-primary">Editar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Controles de paginación -->
    <div class="d-flex justify-content-center">
        {{ $characters->links() }}
    </div>
    <a href="../characters/api" class="btn btn-sm btn-secondary">Volver</a>
</div>
@endsection