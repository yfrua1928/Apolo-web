<!-- Modal -->

<div class="modal fade " id="fileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">

        <div class="modal-content" style="z-index: 1">
            <div class="modal-header d-flex  flex-column">
                <div class="row w-100">
                    <div class="col-10">
                        <h3 class="modal-title" id="exampleModalLabel">Cargando Informacion</h3>
                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <button id="export" type="submit" class="btn btn-warning mx-1" data-bs-toggle="tooltip" data-bs-title="Exportar Fallos"><i class="bi bi-cloud-download"></i></button>
                        <button id="save" type="submit" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-title="Guardar"><i class="bi bi-sd-card-fill"></i></button>
                        <button id="cancel" type="button" class="btn btn-danger mx-1" data-bs-toggle="tooltip" data-bs-title="Cancelar"><i class="bi bi-door-open"></i></button>
                    </div>
                </div>
                <hr class="border border-secondary border-2 opacity-50 w-100">
                <div class="row w-100">
                    <div class="col-auto pt-1">
                        <label class="text-center" for="total"><strong>Total Procesados</strong></label>
                    </div>
                    <div class="col-1 ps-0">
                        <input id="process" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto pt-1">
                        <label class="text-center" for="total"><strong>Total Correctos</strong></label>
                    </div>
                    <div class="col-1 ps-0">
                        <input id="success" class="form-control" type="text" readonly>
                    </div>
                    <div class="col-auto pt-1">
                        <label class="text-center" for="total"><strong>Total Fallos</strong></label>
                    </div>
                    <div class="col-1 ps-0">
                        <input id="failes" class="form-control" type="text" readonly>
                    </div>
                </div>
                <div class="row mt-2 align-items-start w-100">
                    <div class="col-auto pe-1 pt-1">
                        <i data-bs-toggle="tooltip" data-bs-title="Agenda disponible" style="color:green;" class="fs-3 bx bx-task"></i>
                    </div>
                    <div class="col-auto px-0 pt-2">
                        <label><strong>Agenda Disponible</strong></label>
                    </div>
                    <div class="col-auto pe-1 pt-1">
                        <i data-bs-toggle="tooltip" data-bs-title="Agenda no Disponible" style="color:red;" class="fs-3 bx bx-task-x"></i>
                    </div>
                    <div class="col-auto px-0 pt-2">
                        <label><strong>Agenda no Disponible</strong></label>
                    </div>
                    <div class="col-auto pe-1">
                        <i data-bs-toggle="tooltip" data-bs-title="Confirmacion" style="color:blue;" class="fs-4 bi bi-check-circle"></i>
                    </div>
                    <div class="col-auto px-0 pt-2">
                        <label><strong>Confirmacion</strong></label>
                    </div>
                </div>


            </div>
            <div class=" contenedor modal-body position-relative">
                <div class="row">
                    <table id="modalFile" class="resp table table-hover"></table>
                </div>
            </div>
        </div>
        <div id="sonUp" class="charge">
            <div class="spinner-border text-primary " role="status" style="width: 3rem; height: 3rem;">
                <span class="visually-hidden">>Loading...</span>
            </div>
        </div>

    </div>
</div>