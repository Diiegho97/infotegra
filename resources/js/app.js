import './bootstrap';

$(document).ready(function() {
    $('#charactersTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json' // Traducción al español
        }
    });
});
