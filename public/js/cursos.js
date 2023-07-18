function importarHorarios(event) {
    console.log(event);
    let horarios = document.querySelector('#importCursos');
    // horarios.addEventListener('submit', function (event) {
        event.preventDefault();
        Swal.fire({
                title: '¿Deseas importar nuevos cursos?',
                showDenyButton: true,
                confirmButtonText: 'Importar',
                denyButtonText: `Cancelar`,
            })
            .then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    horarios.submit();
                } else if (result.isDenied) {
                    Swal.fire('Datos no importados', '', 'info')
                }
            })
    // })
}



function deleteConfirm(url, elemento='Curso') {
    Swal.fire({
        title: `¿Estás seguro de eliminar el ${elemento}?`,
        text: "Esta acción no podrá ser revertida",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                `${elemento} eliminado correctamente`,
                '',
                'success'
            ).then(() => {
                window.location.href = url; // Redirige a la URL de eliminación
            });
        }
    });
    
}


function guardarCurso() {
    let formSubmit = document.querySelector('#guardarCurso');

    Swal.fire({
            title: '¿Deseas guardar el curso?',
            showDenyButton: true,
            confirmButtonText: 'Guardar',
            denyButtonText: `Regresar`,
        })
        .then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                formSubmit.submit();
            } else if (result.isDenied) {
                Swal.fire('Datos no guardados', '', 'info')
            }
        })
}



$(document).ready( function () {
    $('#tablaAreas').DataTable({
        responsive: true,
        pagination: true,
        language: {
            // search: '<button type="button" style="border:none; background-color:transparent" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg></button>Buscar:',
            zeroRecords: 'No hay áreas con disponibilidad',
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json',
        },
    });
} );

$(document).ready( function () {
    $('#tablaResultados').DataTable({
        responsive: true,
        pagination: true,
        language: {
            // search: '<button type="button" style="border:none; background-color:transparent" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg></button>Buscar:',
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json',
        },
    });
} );



$('#modalBtn').on('click', function() {
    $('#myModal').modal('show');
});

$(document).ready(function() {
    $('#miTabla').DataTable({
        order: [],
        responsive: true,
        searching: true,
        columnDefs: [{
            targets: 2,
            type: 'enum',
            // orderDataType: 'enum',
        },
        {
            targets: 4,
            type: 'custom-area',
            orderDataType: 'custom-area',
        }],
        language: {
            // search: '<button type="button" style="border:none; background-color:transparent" data-bs-toggle="modal" data-bs-target="#exampleModal"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-info-circle" viewBox="0 0 16 16"><path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/><path d="m8.93 6.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM9 4.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/></svg></button>Buscar:',
            url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-MX.json',
        },
    });

    // Definir el tipo de ordenamiento personalizado para el enum de días
    $.fn.dataTable.ext.type.order['enum-pre'] = function(data) {
        let firstWord = data.match(/(\b\w+\b)/)[0]; //Exp. Regular para encontrar la primera palabra, con el 0 accede a la primera coincidencia
        let daysOrder = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado']; //Orden deseado
        return daysOrder.indexOf(
            firstWord
        ); //Busca el indice de la primera palabra, retorna el indice de acuerdo al arreglo de dias
    };

    // Ordenamiento personalizado de areas
    $.fn.dataTable.ext.type.order['custom-area-pre'] = function(data) {
        let regex =/(\S+)\s+(\d+)/; //Expresión regular(cadena de una o mas letras/caracteres, seguido de uno o mas espacios y seguido de uno o mas digitos)
        let match = data.match(regex); //guarda los datos y devuelve un arreglo de coincidencias (match tendra la palabra y el numero)
        let word = match && match[1]; //obtiene la primera palabra de las coincidencias,  si no coincide es null
        let number = match && parseInt(match[2]); //Se obtiene el numero de coincidencias y lo pasa entero sino es null
        // Si el numero es menor que 10 se le agrega un 0 antes
        if (number < 10) {
            number = '0' + number;
        }
        // Devolvemos un arreglo que contiene la primera palabra y el numero
        return [word, number];
    };
});