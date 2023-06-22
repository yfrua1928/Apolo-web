<?php
include 'views/header.php';
include 'views/menu.php';
?>

<!-- Table with stripped rows -->
<table id="initTable" class="table datatable">
    <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Fecha Creacion</th>
        </tr>
    </thead>
    <!-- <tbody>
        <?php foreach ($this->datos as $file) { ?>
            <tr>
                <th scope="row"><a type="button" class="btn_register btn btn-sm" id="<?php echo $file["idFile"] ?>_id" data-bs-target="#userModal"> <strong> <?php echo $file["idFile"] ?></strong></a> </th>
                <td><?php echo $file['name']; ?></td>
                <td><?php echo $file['dateCreated']; ?></td>
            </tr>
        <?php } ?>
    </tbody> -->
</table>
<!-- End Table with stripped rows -->
<!-- Modal -->



<?php
include 'views/download/modalDownload.php';
include 'views/footer.php';
?>