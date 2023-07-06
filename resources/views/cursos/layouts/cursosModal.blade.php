
<!-- Modal -->
<div class="modal fade" id="modal{{ $horario['curso']['id'] }}" data-bs-backdrop="static"
    data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalLabel{{ $horario['curso']['id'] }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel{{ $horario['curso']['id'] }}">Datos del curso
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered align-middle">
                    <tbody>
                        <tr>
                            <th scope="row">Ciclo:</th>
                            <td class="fw-normal">{{$horario['curso']['ciclo']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Sede:</th>
                            <td class="fw-normal">{{$horario['area']['sede']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Profesor:</th>
                            <td class="fw-normal">{{$horario['curso']['profesor']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Código del profesor:</th>
                            <td class="fw-normal">{{$horario['curso']['codigo']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nrc:</th>
                            <td class="fw-normal">{{$horario['curso']['nrc']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Nivel:</th>
                            <td class="fw-normal text-capitalize">{{$horario['curso']['nivel']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Cupo:</th>
                            <td class="fw-normal">{{$horario['curso']['cupo']}}</td>
                        </tr>
                        <tr>
                            <th scope="row">Alumnos registrados:</th>
                            <td class="fw-normal">{{$horario['curso']['alumnos_registrados']}}</td>
                        </tr>
                        {{-- @dd($item['curso']->observaciones) --}}
                        @if($horario['curso']['observaciones'] != null )
                            <tr>
                                <th scope="row">Observaciones:</th>
                                <td class="fw-normal">{{$horario['curso']['observaciones']}}</td>
                            </tr>
                        @endif    
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