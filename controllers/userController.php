<?php
class userController{
    public $userModel;
    public $response;

    public function __construct(){
        require_once "models/userModel.php";

        $this->userModel = new userModel();
    }

    public function loginAction(){
        if(isset($_POST["txtUser"]) && isset($_POST["txtPassword"])){
            if(!empty($_POST["txtUser"]) && !empty($_POST["txtPassword"])){
                $params = [
                    "option" => "login",
                    "username" => $_POST["txtUser"],
                    "password" => md5($_POST["txtPassword"])
                ];

                $this->response = $this->userModel->getUser($params);
                $result = $this->response->fetch_array();

                if($result != null){
                    $_SESSION["authorizationAccess"] = true;

                    header("refresh:1");
                }else{
                    $_SESSION["authorizationAccess"] = false;

                    echo '<script type="text/javascript">
                    Swal.fire({
                        icon: "error",
                        text: "Parece que el usuario no existe, o los datos ingresados son incorrectos",
                        confirmButtonText: "Entendido"
                    })</script>';
                }
            }else{
                echo '<script type="text/javascript">
                Swal.fire({
                    icon: "info",
                    title: "¡Campos vacíos!",
                    text: "Parece que no haz rellenado algunos campos",
                    confirmButtonText: "Entendido"
                })</script>';
            }
        }

        require_once "views/user/loginView.php";
    }

    public function logoutAction(){
        session_destroy();

        header("refresh:1;url=".PATH_ROOT_PROJECT);
    }
}