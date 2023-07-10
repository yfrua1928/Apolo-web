<?php
class App {

    public $url;

    function __construct(){
        session_start();
        
        $url = isset($_GET['url']) ? $_GET['url'] : null;
        $url = rtrim($url, "/");
        $url = explode("/", $url);
        $GLOBALS['URL'] = $url[0];
    
        $this->sessionStarted($url);
        $this->notSession($url);

    }
    

    function notSession($url){

        switch($url[0]){

            case 'validate':
                $login = $this->loginSession();
                $result = $login->register($_POST['username'], $_POST['password']);
                if($result === true){
                    unset($_POST['username']);
                    unset($_POST['password']);
                    $_SESSION['logged_in'] = 1;
                    if ($login->updateLogin($_SESSION['id'])){
                        header('Location: '.constant('URL').'home');
                    }else{
                        setcookie("error", "Error al iniciar sesion, intentelo mas tarde", time()+5);
                        header('Location: '.constant('URL').'login');
                        exit;
                    }
                }else{
                    if( $result === "0001"){
                        setcookie("error", "Credenciales incorrectas, vuelva a iniciar sesion", time()+5);
                    }else{
                        setcookie("error", "No es posible conectarse con el servidor, Comuniquese con el administrador", time()+5);
                    }
                    header('Location: '.constant('URL').'login');
                    exit;
                }
                break;
            case 'register':
                include 'controllers/registerController.php';
                $controller = new Register();
                $controller->render();
                break;
            case 'record':
                include 'controllers/registerController.php';
                $controller = new Register();
                $controller->loadModel('register');
                if($controller->registerUser($_POST)){
                    header('Location: '.constant('URL').'login');
                }else{
                    ?>
                <script Language="JavaScript" type="text/javascript">
                    alert("Ese nombre de usuario ya existe, use otro");
                    window.location.href = window.location.protocol + "//" + window.location.host + '/Apolo-web/register';
                </script>
                <?php
                }
                $controller->render();
                break;
            case 'login':
                if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == 0){
                    $controller = $this->loginSession();
                    $controller->render();
                }
                break;
            default:
                
                if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== 1){
                    header('Location: '.constant('URL').'login');
                }
        }
    }

    function sessionStarted($url){
        if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){
            
            switch($url[0]){
                case 'login':
                    header('Location: '.constant('URL').'home');
                    break;
                case 'logout':
                    session_unset();
                    session_destroy();
                    header('Location: '.constant('URL').'login');   
                    break;
                case 'filterWaiting':
                    
                    break;
                default:
                $fileController = 'controllers/'.$url[0].'Controller.php';
                if(file_exists($fileController)){
                    include $fileController;
                    $controller = new $url[0];
                    $controller->loadModel($url[0]);

                }else{
                    header('Location: '.constant('URL').'home');
                }
                $controller->render();
            }
        }
    }

    function loginSession(){
        include 'controllers/loginController.php';
        $controller =  new Login();
        $controller->loadModel('login');
        return $controller;
    }

    
}
