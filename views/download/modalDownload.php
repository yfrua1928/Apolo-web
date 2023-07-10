<div class="modal fade " id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" >
    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content" style="z-index: 1">
            <div class="modal-header d-flex  flex-column">
                <div class="row w-100">
                    <div class="col-10">
                        <h3 class="modal-title" id="registerTitle"></h3>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <button id="send" type="button" class="btn btn-success mx-1" data-bs-toggle="tooltip" data-bs-title="Reenviar"><i class="bi bi-send"></i></button>
                        <button id="export" type="submit" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-title="Descargar Documento"><i class="bi bi-cloud-download"></i></button>
                        <button id="update" type="submit" class="btn btn-primary mx-1" data-bs-toggle="tooltip" data-bs-title="Actualizar Tabla"><i class="bi bi-arrow-clockwise"></i></button>
                        <button id="exit" type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-title="Salir"><i class="bi bi-door-open"></i></button>
                    </div>
                </div>
                <hr class="border border-secondary border-2 opacity-50 w-100">
                <div class="row w-100 ">
                    <div class="col-auto pe-1 pt-1 ">
                        <label for="total">Total</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="total" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto pe-1 pt-1">
                        <label for="and" class="text-center">Agenda Disponible</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="ad" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto pe-1 pt-1">
                        <label for="and">Agenda No Disponible</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="and" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto pe-1 pt-1">
                        <label for="confir">Confirmacion</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="confir" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto pe-1 pt-1">
                        <label for="nothing">Tipo Vacio</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="nothing" class="form-control input-lg" type="text" readonly>
                    </div>
                </div>
                <hr class="border border-secondary border-1 opacity-50 w-100">
                <div class="row w-100">
                    <div class="col-auto pe-1 ">
                        <i data-bs-toggle="tooltip" data-bs-title="Sin Gestionar" style="color:#ffc800db;" class="bx bxs-message-rounded-minus fs-2"></i>
                    </div>
                    <div class="col-auto ps-0 pe-1 pt-1">
                        <label> Sin Gestionar</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="sg" class="form-control" type="text" readonly>
                    </div>

                    <div class="col-auto pe-1 ">
                        <i data-bs-toggle="tooltip" data-bs-title="Sin Confirmar" class="bx bx-check fs-2"></i>
                    </div>
                    <div class="col-auto ps-0 pe-1 pt-1">
                        <label class="text-center"> Sin Respuesta</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="sr" class="form-control" type="text" readonly>
                    </div>

                    <div class="col-auto pe-1 ">
                        <i data-bs-toggle="tooltip" data-bs-title="Confirmado" style="color:#53bdeb;"class="fs-2 bx bx-check-double"></i>
                    </div>
                    <div class="col-auto ps-0 pe-1 pt-1">
                        <label class="text-center"> Confirmado</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="con" class="form-control" type="text" readonly>
                    </div>

                    <div class="col-auto pe-2 ">
                        <i data-bs-toggle="tooltip" data-bs-title="Cancelada Por El Usuario" style="color:red;" class="fs-4 bi bi-x-octagon"></i>
                    </div>
                    <div class="col-1 ps-0 pe-1 pt-1">
                        <label class="text-center"> Cancelada Por El Usuario</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="can" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto pe-2 ">
                        <i data-bs-toggle="tooltip" data-bs-title="Cancelada Por El Usuario" style="color:orange;" class="fs-4 bi bi-hourglass"></i>
                    </div>
                    <div class="col-1 ps-0 pe-1 pt-1">
                        <label class="text-center"> Cancelada Por Tiempo Limite</label>
                    </div>
                    <div class="col-1 ps-0 input-group-sm">
                        <input id="canTimeOut" class="form-control" type="text" readonly>
                    </div>
                </div>

            </div>
            
            <div class=" contenedor modal-body position-relative">            
                
                
                
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

        <div id="sonUp" class="charge">
            <div class="spinner-border text-primary " role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">>Loading...</span>
            </div>
        </div>
    </div>
</div>