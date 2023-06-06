
<!-- Modal -->
<div class="modal fade" id="modal{{ $item->id }}" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel{{ $item->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel{{ $item->id }}">Datos del curso
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered align-middle">
                    <tbody>
                        <tr>
                            <th scope="col">Nombre de Curso:</th>
                            <th scope="col" class="fw-normal">{{$item->curso_nombre}}</th>
                        </tr>
                        <tr>
                            <th scope="col">Profesor:</th>
                            <th scope="col" class="fw-normal">{{$item->profesor}}</th>
                        </tr>
                        <tr>
                            <th scope="row">Código del profesor:</th>
                            <td class="fw-normal">{{$item->codigo}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nrc:</th>
                            <td class="fw-normal">{{$item->nrc}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nivel:</th>
                            <td class="fw-normal text-capitalize">{{$item->nivel}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Cupo:</th>
                            <td class="fw-normal">{{$item->cupo}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Alumnos registrados:</th>
                            <td class="fw-normal">{{$item->alumnos_registrados}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Ciclo:</th>
                            <td class="fw-normal">{{$item->ciclo}}</td>
                        </tr>
                    </tbody>

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary"
                    data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>