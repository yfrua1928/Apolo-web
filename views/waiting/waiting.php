<?php
include 'views/header.php';
include 'views/menu.php';

?>

<form class="row">
    <!-- <div class="col-auto">
        <label class="form-label" for="dateInitial">Fecha Inicial</label>
        <input class="form-control" type="date" name="dateInitial">
    </div>
    <div class="col-auto">
        <label class="form-label" for="dateFinal">Fecha Final</label>
        <input class="form-control" type="date" id="dateFinal" name="dateFinal">
    </div> -->
    <div class="col-auto">
        <label class="form-label" for="institution">Institucion</label>
        <select class="form-control" id="institution" name="institution">
            <option value=0 selected>Seleccione</option>
            <?php foreach ($this->institutions as $item) { ?>
                <option value=<?php echo $item["idInstitution"]; ?>><?php echo $item["name"]; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-auto pt-2">
        <button id="filter" type="button" class="btn btn-outline-primary mt-4">Filtrar</button>
    </div>
</form>
<hr>
<div class="row">
    <table id="waiting" class="table datatable">
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
                <!-- <th scope="col">Numero de Autorizacion</th>
                <th scope="col">Fecha limite Autorizacion</th>
                <th scope="col">Tipo de Agendamiento</th>     -->
                <th scope="col">Especialidad</th>
                <th scope="col">Institucion</th>
            </tr>
        </thead>
     
    </table>
</div>


<?php
include 'views/footer.php';
