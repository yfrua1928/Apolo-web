<?php
class messagesController{
    public $messagesModel;
    public $response;

    public function __construct(){
        require_once "models/messagesModel.php";

        $this->messagesModel = new messagesModel();
    }

    public function indexAction(){
        if(isset($_FILES["fileImportMessagesWpp"]) && !empty($_FILES["fileImportMessagesWpp"])){
            $filename = $_FILES["fileImportMessagesWpp"]["name"];
            $info = new SplFileInfo($filename);
            $extension = pathinfo($info->getFilename(), PATHINFO_EXTENSION);

            if($extension == "csv"){
                $filename = $_FILES['fileImportMessagesWpp']['tmp_name'];
                $handle = fopen($filename, "r");
                $i = 0;

                while( ($row = fgetcsv($handle, 1000, ";") ) !== FALSE ){
                    if($i > 0){
                        $params = [
                            "cellPhone" => $row[0],
                            "typeDocument" => $row[1],
                            "document" => $row[2],
                            "name" => $row[3],
                            "idInstitute" => $row[4],
                            "dateAppointment" => $row[5],
                            "appointmentHour" => $row[6],
                            "speciality" => $row[7],
                            "status" => 0
                        ];

                        $this->response = $this->messagesModel->setMessages($params);

                        if($this->response){
                            echo '<script type="text/javascript">
                            Swal.fire({
                                icon: "success",
                                title: "¡Importación exitosa!",
                                text: "Los datos han sido cargados correctamente a la base de datos",
                                confirmButtonText: "Perfecto"
                            })</script>';
                        }else{
                            echo '<script type="text/javascript">
                            Swal.fire({
                                icon: "info",
                                title: "¡Upss!",
                                text: "Parece que a habido un problema al intentar cargar los datos a la base de datos, intenta nuevamente. Si el problema persiste comunicate con los administradores del sitio",
                                confirmButtonText: "Intentare de nuevo"
                            })</script>';
                        }
                    }
                    
                    $i++;
                }
            }else{
                echo '<script type="text/javascript">
                Swal.fire({
                    icon: "error",
                    title: "¡Formato incorrecto!",
                    html: "El formato del archivo no es valido, recuerda que debe de ser un archivo <strong>.CSV</strong>",
                    confirmButtonText: "Entendido"
                })</script>';
            }
        }

        $results = $this->messagesModel->getMessages();

        require_once "views/messages/messagesView.php";
    }
}