<?php
class User {
    // Connexion properties
    private $table="users";
    private $connexion = null;

    // User properties
    private $id;
    private $username;
    private $email;
    private $password;
    private $date_of_birth;

    // Constructor
    public function __construct($conn) {
        $this->connexion = $conn;
        //$this->table = $table;
    }

    // CRUD Methods

    public function create($username, $email, $password, $date_of_birth) {
        try {
            $sql = "INSERT INTO $this->table (username, email, password, date_of_birth) VALUES (?, ?, ?, ?)";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute([$username, $email, $password, $date_of_birth]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Create user error: " . $e->getMessage();
        }
    }

    public function readAll() {
        try {
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->connexion->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Read all users error: " . $e->getMessage();
        }
        
    }

    public function update($id, $username, $email, $password, $date_of_birth) {
        try {
            $sql = "UPDATE $this->table SET username=?, email=?, password=?, date_of_birth=? WHERE id=?";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute([$username, $email, $password, $date_of_birth, $id]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Update user error: " . $e->getMessage();
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM $this->table WHERE id=?";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute([$id]);
            return $stmt->rowCount();
        } catch (PDOException $e) {
            echo "Delete user error: " . $e->getMessage();
        }
    }

    public function login($email, $password) {
        try {
            $sql = "SELECT * FROM $this->table WHERE email=? AND password=?";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute([$email, $password]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Login error: " . $e->getMessage();
        }
    }
}
?>