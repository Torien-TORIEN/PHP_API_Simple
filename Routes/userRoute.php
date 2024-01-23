<?php
require_once 'Controllers/UserController.php';

class UserRoute {
    private $userController;

    public function __construct() {
        $this->userController = new UserController();
    }
    public function route() {
        $request_uri = $_SERVER['REQUEST_URI'];
        $baseURI="/php_api/index.php";
        
        if ($request_uri === "$baseURI/create_user") {
            $this->userController->create();
            
        } elseif ($request_uri === "$baseURI/users") {
            $this->userController->readAll();
            
        } elseif (strpos($request_uri, "$baseURI/update_user?id=") === 0)// vérifie si la route commence par "$baseURI/update_user", ce qui permettra d'accepter n'importe quelle valeur d'ID dans l'URI.
        {
            $this->userController->update();
            
        } elseif (strpos($request_uri, "$baseURI/delete_user?id=") === 0) {
            $this->userController->delete();
            
        } elseif ($request_uri === "$baseURI/login") {
            $this->userController->login();
            
        } elseif (strpos($request_uri, "$baseURI/users?id=") !== false) {
            $this->userController->getById();
            
        } else {
            header("HTTP/1.1 404 Not Found");
            echo "Not Found";
        }
    }
}
?>