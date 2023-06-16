<div class="modal fade " id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content ">
            <div class="modal-header">
                <h3 class="modal-title" id="registerTitle"></h3>
                <div class="col-auto">
                    <button id="send" type="button" class="btn btn-success" data-bs-toggle="tooltip" data-bs-title="Reenviar"><i class="bi bi-send"></i></button>
                    <button id="export" type="submit" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-title="Descargar Documento"><i class="bi bi-cloud-download"></i></button>
                    <button id="update" type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-title="Actualizar Tabla"><i class="bi bi-arrow-clockwise"></i></button>
                    <button id="exit" type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-title="Salir"><i class="bi bi-door-open"></i></button>
                </div>
            </div>
            <div class=" contenedor modal-body position-relative">

                <!-- <div id="son" class="son p-5 position-absolute ">
                        <div class="text-center p-4">
                            <div class="spinner-border m-5 text-primary" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div>  -->
                
                
                <div class="row align-items-center">
                    <div class="col-auto">
                        <label for="total">Total</label>
                    </div>
                    <div class="col-1">
                        <input id="total" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto">
                        <label for="and" class="text-center">Agenda Disponible</label>
                    </div>
                    <div class="col-1">
                        <input id="ad" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto">
                        <label for="and">Agenda No Disposible</label>
                    </div>
                    <div class="col-1">
                        <input id="and" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto">
                        <label for="confir">Confirmacion</label>
                    </div>
                    <div class="col-1">
                        <input id="confir" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto">
                        <label for="nothing">Tipo Vacio</label>
                    </div>
                    <div class="col-1">
                        <input id="nothing" class="form-control" type="text" readonly>
                    </div>
                </div>
                <hr class="my-2">
                <div class="row mb-0 align-items-center">
                    <div class="col-auto pe-1">
                        <i data-bs-toggle="tooltip" data-bs-title="Sin Gestionar" style="color:#ffc800db;" class="bx bxs-message-rounded-minus fs-2"></i>
                    </div>
                    <div class="col-auto ps-0">
                        <label> Sin Gestionar</label>
                    </div>
                    <div class="col-auto pe-1">
                        <i data-bs-toggle="tooltip" data-bs-title="Sin Confirmar" class="bx bx-check fs-2"></i>
                    </div>
                    <div class="col-auto ps-0">
                        <label class="text-center"> Sin Respuesta</label>
                    </div>
                    <div class="col-auto pe-1">
                        <i data-bs-toggle="tooltip" data-bs-title="Confirmado" style="color:#53bdeb;"class="fs-2 bx bx-check-double"></i>
                    </div>
                    <div class="col-auto ps-0">
                        <label class="text-center"> Confirmado</label>
                    </div>
                    <div class="col-auto pe-2">
                        <i data-bs-toggle="tooltip" data-bs-title="Cancelada Por El Usuario" style="color:red;" class="fs-4 bi bi-x-octagon"></i>
                    </div>
                    <div class="col-auto ps-0">
                        <label class="text-center"> Cancelada Por El Usuario</label>
                    </div>
                </div>
                <div class="row mb-0 align-items-center">
                    <div class="col-auto pe-1">
                        <i data-bs-toggle="tooltip" data-bs-title="Cancelado Por Tiempo" style="color:red;" class="bx bx-alarm-off fs-2"></i>
                    </div>
                    <div class="col-auto ps-0">
                        <label class="text-center"> Cancelada Por Tiempo de Respuesta</label>
                    </div>
                    <div class="col-auto pe-1">
                        <i data-bs-toggle="tooltip" data-bs-title="Cancelada Por Respuestas Erradas" style="color:red;" class="bx bx-user-x fs-2"></i>
                    </div>
                    <div class="col-auto ps-0">
                        <label class="text-center"> Cancelada Por Respuestas Erradas</label>
                    </div>
                    <div class="col-auto pe-1">
                        <i data-bs-toggle="tooltip" data-bs-title="Esperando Respuesta Correcta" class="bx bxs-message-rounded-x fs-2"></i>
                    </div>
                    <div class="col-auto ps-0">
                        <label class="text-center"> Esperando Respuesta Correcta</label>
                    </div>
                </div>
                <div class="row uploadModal" >
                    <table id="tableRegister" class="table mt-2">
                        <thead>
                            <tr>
                                <!-- <th scope="col">Id</th> -->
                                <th scope="col">Tipo Documento</th>
                                <th scope="col">Documento</th>
                                <th scope="col">Nombre Completo</th>
                                <th scope="col">Numero Celular</th>
                                <!-- <th scope="col">Inst</th> -->
                                <th scope="col">Fecha Cita</th>
                                <th scope="col">Hora Cita</th>
                                <th scope="col">Especialista</th>
                                <th scope="col">Especialidad</th>
                                <th scope="col">N° Aut</th>
                                <th scope="col">Tipo</th>
                                <th scope="col">Estado</th>

                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="modal-footer"> </div>
            </div>
        </div>
    </div>
</div>