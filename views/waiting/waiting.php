<?php
include 'views/header.php';
include 'views/menu.php';

?>

<form class="row" action="<?php echo constant('URL') ?>filterWaiting" method="POST">
    <div class="col-auto">
        <label class="form-label" for="dateInitial">Fecha Inicial</label>
        <input class="form-control" type="date" name="dateInitial">
    </div>
    <div class="col-auto">
        <label class="form-label" for="dateFinal">Fecha Final</label>
        <input class="form-control" type="date" id="dateFinal" name="dateFinal">
    </div>
    <div class="col-auto">
        <label class="form-label" for="institution">Institucion</label>
        <select class="form-control" id="institution" name="institution">
            <option selected>Seleccione</option>
            <?php foreach ($this->institutions as $item) { ?>
                <option value=<?php echo $item["idInstitution"]; ?>><?php echo $item["name"]; ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="col-auto pt-2">
        <button type="button" class="btn btn-outline-primary mt-4">Filtrar</button>
    </div>
</form>
<hr>
<div class="row">
    <table class="table datatable">
        <thead>
            <tr>
                <th scope="col">Numero Documento</th>
                <th scope="col">Tipo Documento</th>
                <th scope="col">Fecha Creacion</th>
                <th scope="col">Numero de Contacto</th>
                <th scope="col">Nombre del Paciente</th>
                <th scope="col">EPS</th>
                <th scope="col">Especialidad</th>
                <th scope="col">Institucion</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->datos as $user) { ?>
                <tr>
                    <th scope="row"><a type="button" class=" btn btn-sm" id="<?php echo $user['document'] ?>_id" data-bs-target="#userModal"><?php echo $user["document"] ?></a> </th>
                    <th scope="row"><?php echo $user['typeDocument']; ?></th>
                    <td><?php echo $user['dateRegister']; ?></td>
                    <td><?php echo $user['numberPatient']; ?></td>
                    <td><?php echo $user['fullName']; ?></td>
                    <td><?php echo $user['eps']; ?></td>
                    <td><?php echo $user['speciality']; ?></td>
                    <td><?php echo $user['idInstitution']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php
include 'views/footer.php';
