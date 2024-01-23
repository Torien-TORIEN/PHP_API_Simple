<?php
require_once '../Controllers/UserController.php';

/*class UserRoute {
    private $userController;

    public function __construct() {
        $this->userController = new UserController();
    }

    public function route() {
        $action = isset($_GET['action']) ? $_GET['action'] : null;

        switch ($action) {
            case 'create':
                $this->userController->create();
                break;
            case 'readAll':
                $this->userController->readAll();
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
}*/

class UserRoute {
    private $userController;

    public function __construct() {
        $this->userController = new UserController();
    }

    public function route() {
        $request_uri = $_SERVER['REQUEST_URI'];
        echo $request_uri;

        // Supprimez la partie du chemin après le nom de votre application
        $base_path = '/PHP_API';
        $clean_uri = str_replace($base_path, '', $request_uri);

        $parts = explode('/', $clean_uri);
        $action = isset($parts[1]) ? $parts[1] : null;

        switch ($action) {
            case 'create':
                $this->userController->create();
                break;
            case 'readAll':
                $this->userController->readAll();
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