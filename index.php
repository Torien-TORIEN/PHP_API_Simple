<?php

// Autoload des classes
spl_autoload_register(function ($class) {
    if (strpos($class, 'Controller') !== false) {
        // Inclure les contrôleurs depuis le dossier Controllers
        include 'Controllers/' . $class . '.php';
    } elseif (strpos($class, 'Model') !== false) {
        // Inclure les modèles depuis le dossier Models
        include 'Models/' . $class . '.php';
    }
    // Ajoutez d'autres chemins si nécessaire
});




// Déclaration des routes
require_once 'Routes/UserRoute.php';

// Instanciation du routeur et traitement des routes
$userRoute = new UserRoute();
$userRoute->route();

?>