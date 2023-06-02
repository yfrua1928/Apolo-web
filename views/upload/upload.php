<?php
include 'views/header.php';
include 'views/menu.php';
?>

<p><span class="reto"> * </span>Recuerde que el archivo debe ser un .csv</p>
<div class="input-group">
    <input type="file" class="form-control" id="fileImport">
    <button class="btn btn-outline-secondary" data-bs-target="#fileModal" type="button" id="charge">Cargar</button>
</div>
<div>
    <pre id="contenido"></pre>
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha Creacion</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach($this->datos as $file){?>
            <tr>
            <th scope="row"><strong> <?php echo $file["idFile"] ?></strong></th>
            <td><?php echo $file['name']; ?></td>
            <td><?php echo $file['dateCreated']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
    </table>
    <!-- Modal -->
    <div class="modal fade " id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">

            <div class="modal-content ">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel">Cargando Informacion</h3>
                    <div class="col-auto">
                        <button id="export" type="submit" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-title="Exportar Fallos"><i class="bi bi-cloud-download"></i></button>
                        <button id="save" type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-title="Guardar"><i class="bi bi-sd-card-fill"></i></button>
                        <button id="cancel" type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-title="Cancelar"><i class="bi bi-door-open"></i></button>
                    </div>
                </div>
                <div class=" contenedor modal-body position-relative">

                    <div id="sonUp" class="son p-5 position-absolute ">
                        <div class="text-center p-4">
                            <div class="spinner-border m-5 text-primary" style="width: 3rem; height: 3rem;" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                    </div> 
                    <div class="row mb-2  align-items-center">
                        <div class="col-auto">
                            <label for="total">Total Procesados</label>
                        </div>
                        <div class="col-1">
                            <input id="process" class="form-control" type="text" readonly>
                        </div>
                        <div class="col-auto">
                            <label for="total">Total Correctos</label>
                        </div>
                        <div class="col-1">
                            <input id="success" class="form-control" type="text" readonly>
                        </div>
                        <div class="col-auto">
                            <label for="total">Total Fallos</label>
                        </div>
                        <div class="col-1">
                            <input id="failes" class="form-control" type="text" readonly>
                        </div>

                        <div class="col-auto">
                        </div>
                        <div class="col-auto">
                            
                        </div>
                        <div class="col-auto">
                            
                        </div>
                    </div>
                    <hr class="my-2">
                    <div class="row mb-0 align-items-center">
                        <div class="col-auto pe-1">
                            <i data-bs-toggle="tooltip" data-bs-title="Agenda disponible" style="color:green;" class="fs-3 bx bx-task"></i>
                        </div>
                        <div class="col-auto ps-0">
                            <label>Agenda Disponible</label>
                        </div>
                        <div class="col-auto pe-1">
                            <i data-bs-toggle="tooltip" data-bs-title="Agenda no Disponible" style="color:red;" class="fs-3 bx bx-task-x"></i>
                        </div>
                        <div class="col-auto ps-0">
                            <label class="text-center">Agenda no Disponible</label>
                        </div>
                        <div class="col-auto pe-1">
                            <i data-bs-toggle="tooltip" data-bs-title="Confirmacion" style="color:blue;"class="fs-4 bi bi-check-circle"></i>
                        </div>
                        <div class="col-auto ps-0">
                            <label class="text-center"> Confirmacion</label>
                        </div>
                    </div>
                    <div class="row uploadModal">
                        <table id="table" class="table mt-2">
                            <thead>
                                <tr>
                                    <th scope="col">Tipo Documento</th>
                                    <th scope="col">Documento</th>
                                    <th scope="col">Nombre Completo</th>
                                    <th scope="col">Numero Celular</th>
                                    <th scope="col">NIT Institucion</th>
                                    <th scope="col">Fecha Cita</th>
                                    <th scope="col">Hora Cita</th>
                                    <th scope="col">Especialista</th>
                                    <th scope="col">Especialidad</th>
                                    <th scope="col">Autorizacion</th>
                                    <th scope="col">Tipo</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    <div class="modal-footer"> </div>
                </div>
            </div>
        </div>
    </div>


    <?php
    include 'views/footer.php';
    ?>