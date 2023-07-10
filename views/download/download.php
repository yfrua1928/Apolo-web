<?php
include 'views/header.php';
include 'views/menu.php';
?>

<table id="initTable" class="table datatable resp table-hover">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Usuario que carga</th>
            <th scope="col">Institucion</th>
            <th scope="col">Fecha Creacion</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
</table>

<?php
include 'views/download/modalDownload.php';
include 'views/footer.php';
?>