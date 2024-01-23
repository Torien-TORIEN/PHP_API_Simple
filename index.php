<?php

//imports
require_once("./Config/Database.php");
require_once("./Models/User.php");

//Connexion
$db=new Database();
$conn=$db->connect_to_db();

//Models
$user =new User($conn);

$data=$user->readAll();

var_dump($data);