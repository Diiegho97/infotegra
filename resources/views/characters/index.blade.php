@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Personajes de Rick and Morty (API)</h2>
        <table class="table table-striped table-hover" id="charactersTable">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Especie</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($characters as $char)
                    <tr>
                        <td>{{ $char['id'] }}</td>
                        <td>{{ $char['name'] }}</td>
                        <td>{{ $char['status'] }}</td>
                        <td>{{ $char['species'] }}</td>
                        <td>
                            <button class="btn btn-sm btn-info"
                                onclick="showDetails({{ json_encode($char, JSON_PRETTY_PRINT) }})">
                                <i class="bi bi-eye"></i> Detalles
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <form action="{{ route('characters.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-sm btn-success">
                <i class="bi bi-save"></i> Guardar
            </button>
        </form>
    </div>
    {{-- modal de detalles --}}
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Detalles del Personaje</h5>
                    <button type="button" class="btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tbody id="characterDetailsTable">
                            <!-- Los detalles del personaje se llenarán dinámicamente aquí -->
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">
                        <i class="bi bi-x-circle"></i> Cerrar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#charactersTable').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "first": "Primero",
                        "last": "Último",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });

        function showDetails(character) {
            const detailsTable = document.getElementById('characterDetailsTable');
            detailsTable.innerHTML = '';


            for (const [key, value] of Object.entries(character)) {
                const row = document.createElement('tr');


                const keyCell = document.createElement('td');
                keyCell.textContent = key;
                keyCell.style.fontWeight = 'bold';


                const valueCell = document.createElement('td');
                if (key === 'image' && typeof value === 'string') {

                    const img = document.createElement('img');
                    img.src = value;
                    img.alt = 'Imagen del personaje';
                    img.style.width = '100px';
                    valueCell.appendChild(img);
                } else if (typeof value === 'object' && value !== null) {

                    valueCell.textContent = JSON.stringify(value, null, 2);
                } else {

                    valueCell.textContent = value;
                }


                row.appendChild(keyCell);
                row.appendChild(valueCell);


                detailsTable.appendChild(row);
            }


            const modal = new bootstrap.Modal(document.getElementById('detailsModal'));
            modal.show();
        }
    </script>
@endsection
