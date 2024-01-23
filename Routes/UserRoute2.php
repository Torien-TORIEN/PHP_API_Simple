<?php
require_once '../Controllers/UserController.php';

class UserRoute {
    private $userController;

    public function __construct() {
        $this->userController = new UserController();
    }

    public function route() {
        $action = isset($_GET['action']) ? $_GET['action'] : null; 
        //URI doit etre comme ci : http://localhost/php_api/routes/UserRoute2.php?action=readAll

        switch ($action) {
            case 'create':
                $this->userController->create();
                break;
            case 'readAll':
                $this->userController->readAll();
                break;
            case 'getbyid':
                $this->userController->getById();
                break;
            case 'update':
                $this->userController->update();
                break;
            case 'delete':
                $this->userController->delete();
                break;
            case 'login':
                $this->userController->login();
                break;
            default:
                header("HTTP/1.1 404 Not Found");
                echo "Route Not Found\n";
        }
    }
}



// Instancier le routeur et exécuter les actions
$userRoute = new UserRoute();
$userRoute->route();
?>