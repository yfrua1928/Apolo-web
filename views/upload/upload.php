<?php
include 'views/header.php';
include 'views/menu.php';
?>
<div class="row mb-2">
    <div class="col-6">
        <p><span class="reto"> * </span>Recuerde que el archivo debe ser un .csv</p>
    </div>
    <div class="col-6 d-flex justify-content-end">
    <a class="btn btn-success btnCharge" type="button" id="template" href="#">Plantilla</a>
    </div>
</div>

<div class="input-group">
    <input type="file" class="form-control" id="fileImport" placeholder="Cargar Archivo">
    <button id="charge" class="btn btn-outline-secondary btnCharge" type="button" data-bs-target="#fileModal" >Cargar</button>
</div>
<div>
    <pre id="contenido"></pre>
    <table id="files" class="table display">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Fecha Creacion</th>
            </tr>
        </thead>
    </table>
    
<?php
include 'views/upload/modalUpload.php';
include 'views/footer.php';
?>