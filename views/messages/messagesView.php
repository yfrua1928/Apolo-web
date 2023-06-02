<div>
    <div class="container-fluid" id="header">
        <div class="row" id="headerRow">
            <div class="col-md-10 ">
                <h4 id="tittle">Agendador de citas automático</h4>
            </div>
            <div class="col-md-2 d-flex justify-content-end" id="buttonCol">
                <a href="<?php echo PATH_ROOT_PROJECT;?>user/logout">
                    <button type="button" class="btn btn-sm" id="closeButton">
                        <span class="text-white">Cerrar Sesión    <i class="fas fa-sign-out"></i></span>
                    </button>
                </a>
        </div>
        </div>
    </div>
    <div class="container-fluid" id="body">
    <form method="POST" enctype="multipart/form-data">
        <div class="form-group">
        <label for="fileImportMessagesWpp" id="uploadLabel">Cargar Archivo (.csv)</label>
            <div class="row">
            <div class="col-md-10">
                <input type="file" name="fileImportMessagesWpp" id="fileImportMessagesWpp" class="form-control">
            </div>
                <div class="col-md-2 form-group" id="selectFile">
                    <button type="submit" class="btn text-white" id="submitButton">Importar</button>
                    <button type="submit" class="btn text-white" id="exportButton">Exportar</button>
                </div>
            </div>
        </div>
    </form>
    <br>

    <table class=" table table-stripped table-hover text-center" style="width:100%" id="myTable">
        <thead class="tableHead">
            <tr>
                <th>Nombre Completo</th>
                <th>Tipo Documento</th>
                <th>Nro Documento</th>
                <th>Nro Celular</th>
                <th>Fecha Cita</th>
                <th>Hora Cita</th>
                <th>Especialidad</th>
                <th>NIT Institución</th>
                <th>Estado</th>
                <!-- <th>Acciones</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
                while($row = $results->fetch_object()){
            ?>
            <tr>
                <td><?php echo $row->name;?></td>
                <td><?php echo $row->typeDocument;?></td>
                <td><?php echo $row->document;?></td>
                <td><?php echo $row->cellPhone;?></td>
                <td><?php echo $row->dateAppointment;?></td>
                <td><?php echo $row->appointmentHour;?></td>
                <td><?php echo $row->speciality;?></td>
                <td><?php echo $row->idInstitute;?></td>
                <td>
                    <?php 
                    switch($row->status){
                        case 0:
                            echo '<span class="badge bg-primary" >Sin Gestionar</span>';
                        break;
                        case 1:
                            echo '<span class="badge bg-secondary">En proceso</span>';
                        break;
                        case 2:
                            echo '<span class="badge bg-success">Cita programada</span>';
                        break;
                        case 3:
                            echo '<span class="badge bg-danger">Reprogramar</span>';
                        break;
                    }
                    ?>
                </td>
                <!-- <td>
                    <div>
                    <button type="button" class="btn btn-sm" id="editButton">
                        <i class="fas fa-pen"></i>
                    </button>
                    <button type="button" class="btn btn-sm" id="deleteButton">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                    </div>
                </td> -->
            </tr>
            <?php
                }
            ?>
        </tbody>
        
        <script>
         $(document).ready(function() {
        $('#myTable').DataTable(
            {"language": {"url": "//cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"}}
        );
        });
        </script>
    </table>
</div>

