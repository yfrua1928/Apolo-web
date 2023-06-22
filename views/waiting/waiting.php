<?php
include 'views/header.php';
include 'views/menu.php';

?>

<form class="row">
    <div class="col-2">
        <label class="form-label" for="institution">Institucion</label>
        <select class="form-control" id="institution" name="institution">
            <option value=0 selected>Seleccione</option>
            <?php foreach ($this->institutions as $item) { ?>
                <option value=<?php echo $item["idInstitution"]; ?>><?php echo $item["name"]; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-2">
        <label class="form-label" for="dateInitial">Fecha Inicial</label>
        <input class="form-control" type="date" name="dateInitial" id="dateInitial" disabled>
    </div>
    <div class="col-2">
        <label class="form-label" for="dateFinal">Fecha Final</label>
        <input class="form-control" type="date" id="dateFinal" name="dateFinal" disabled>
    </div>

    <div class="col-3 pt-2">
        <button id="filter" type="button" class="btn btn-outline-primary mt-4">Buscar</button>
        <button id="clear" type="button" class="btn btn-outline-danger mt-4">Limpiar</button>
    </div>

    <div class="col-3 pt-2 d-flex justify-content-end">
        <button id="download" type="button" class="btn btn-outline-success mt-4" disabled>Descargar Busqueda</button>
    </div>
</form>
<hr>
<div class="row">
    <table id="waiting" class="resp table datatable table-hover ">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Fecha Creacion</th>
                <th scope="col">Numero de Contacto</th>
                <th scope="col">Tipo Documento</th>
                <th scope="col">Numero Documento</th>
                <th scope="col">Nombre del Paciente</th>
                <!-- <th scope="col">Direccion</th>
                <th scope="col">Fecha de Nacimiento</th>
                <th scope="col">Municipio</th>
                <th scope="col">Correo</th>
                <th scope="col">Telefono Principal</th>
                <th scope="col">Telefono Secundario</th> -->
                <th scope="col">EPS</th>
                <th scope="col">Numero de Autorizacion</th>
                <th scope="col">Fecha limite Autorizacion</th>
                <th scope="col">Tipo de Agendamiento</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Institucion</th>
            </tr>
        </thead>

    </table>
</div>


<?php
include 'views/footer.php';
