<?php
//require_once 'Models/User.php';
//require_once '../Config/Database.php';
require_once __DIR__ . '/../Config/Database.php';
require_once __DIR__ . '/../Models/User.php';

class UserController {
    private $db;

    public function __construct() {
        $database = new Database();
        $this->db = $database->connect_to_db();
    }

    

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du corps de la requête
            $requestData = json_decode(file_get_contents("php://input"), true);
    
            // Vérifier si les données sont présentes et valides
            if (!$requestData || !isset($requestData['username']) || !isset($requestData['email']) || !isset($requestData['password']) || !isset($requestData['date_of_birth'])) {
                $response = [
                    'success' => false,
                    'message' => 'Invalid data. Please provide valid information.',
                ];
            } else {
                // Extraire les données du tableau
                $username = htmlspecialchars($requestData['username']);
                $email = filter_var($requestData['email'], FILTER_VALIDATE_EMAIL);
                $password = password_hash($requestData['password'], PASSWORD_DEFAULT);
                $date_of_birth = $requestData['date_of_birth'];
    
                // Validation des données
                if (empty($username) || empty($email) || empty($password) || empty($date_of_birth) || !$email) {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid data. Please provide valid information.',
                    ];
                } else {
                    // Création de l'utilisateur
                    $user = new User($this->db);
                    $result = $user->create($username, $email, $password, $date_of_birth);
    
                    if ($result > 0) {
                        $response = [
                            'success' => true,
                            'message' => 'User created successfully!',
                        ];
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Error creating user.',
                        ];
                    }
                }
            }
    
            // Envoyer la réponse au format JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo "Method Not Allowed";
        }
    }
    

    public function readAll() {
        //echo "read all \n";
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Récupérer la liste de tous les utilisateurs
            $user = new User($this->db);
            $users = $user->readAll();
    
            // Envoyer la liste au format JSON
            header('Content-Type: application/json');
            echo json_encode($users);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo "Method Not Allowed";
        }
    }

    // UserController.php

    public function getById() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            // Récupérer l'ID de l'utilisateur à récupérer depuis l'URI
            $id = isset($_GET['id']) ? $_GET['id'] : null;

            // Validation de l'ID
            if (empty($id)) {
                $response = [
                    'success' => false,
                    'message' => 'Invalid data. Please provide a valid user ID.',
                ];
            } else {
                // Obtenir l'utilisateur par ID
                $user = new User($this->db);
                $userData = $user->getById($id);

                if ($userData) {
                    $response = [
                        'success' => true,
                        'user' => $userData,
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'User not found.',
                    ];
                }
            }

            // Envoyer la réponse au format JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo "Method Not Allowed";
        }
    }


    
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            // Récupérer l'id depuis l'URI
            $id = isset($_GET['id']) ? $_GET['id'] : null; // recuperer l'attribut id dans l'uri après ?id=
            //echo "id=$id";

            // Récupérer les données du corps de la requête
            $requestData = json_decode(file_get_contents("php://input"), true);

            // Vérifier si l'id est présent et les données sont valides
            if (!$id || !$requestData || !isset($requestData['username']) || !isset($requestData['email']) || !isset($requestData['password']) || !isset($requestData['date_of_birth'])) {
                $response = [
                    'success' => false,
                    'message' => 'Invalid data. Please provide valid information.',
                ];
            } else {
                // Extraire les données du tableau
                $username = htmlspecialchars($requestData['username']);
                $email = filter_var($requestData['email'], FILTER_VALIDATE_EMAIL);
                $password = password_hash($requestData['password'], PASSWORD_DEFAULT);
                $date_of_birth = $requestData['date_of_birth'];

                // Validation des données
                if (empty($id) || empty($username) || empty($email) || empty($password) || empty($date_of_birth) || !$email) {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid data. Please provide valid information.',
                    ];
                } else {
                    // Mise à jour de l'utilisateur
                    $user = new User($this->db);
                    $result = $user->update($id, $username, $email, $password, $date_of_birth);

                    if ($result > 0) {
                        $response = [
                            'success' => true,
                            'message' => 'User updated successfully!',
                        ];
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Error updating user.',
                        ];
                    }
                }
            }

            // Envoyer la réponse au format JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo "Method Not Allowed";
        }
    }

    
    public function delete() {
        if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // Récupérer l'ID de l'utilisateur à supprimer
            $id = isset($_GET['id']) ? $_GET['id'] : null; // recuperer l'attribut id dans l'uri après ?id=
    
            // Validation de l'ID
            if (empty($id)) {
                $response = [
                    'success' => false,
                    'message' => 'Invalid data. Please provide a valid user ID.',
                ];
            } else {
                // Supprimer l'utilisateur
                $user = new User($this->db);
                $result = $user->delete($id);
    
                if ($result > 0) {
                    $response = [
                        'success' => true,
                        'message' => 'User deleted successfully!',
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'message' => 'Error deleting user. User may not exist.',
                    ];
                }
            }
    
            // Envoyer la réponse au format JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo "Method Not Allowed";
        }
    }
    
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du corps de la requête
            $requestData = json_decode(file_get_contents("php://input"), true);

            // Vérifier si les données sont présentes et valides
            if (!$requestData || !isset($requestData['email']) || !isset($requestData['password'])) {
                $response = [
                    'success' => false,
                    'message' => 'Invalid data. Please provide valid email and password.',
                ];
            } else {
                // Extraire les données du tableau
                $email = filter_var($requestData['email'], FILTER_VALIDATE_EMAIL);
                $password = $requestData['password'];

                // Validation des données
                if (empty($email) || empty($password)) {
                    $response = [
                        'success' => false,
                        'message' => 'Invalid data. Please provide valid email and password.',
                    ];
                } else {
                    // Effectuer l'authentification
                    $user = new User($this->db);
                    $loggedInUser = $user->login($email, $password);

                    if ($loggedInUser) {
                        $response = [
                            'success' => true,
                            'message' => 'Login successful!',
                            'user' => $loggedInUser,
                        ];
                    } else {
                        $response = [
                            'success' => false,
                            'message' => 'Login failed. Invalid email or password.',
                        ];
                    }
                }
            }

            // Envoyer la réponse au format JSON
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo "Method Not Allowed";
        }
    }

    
}
?>