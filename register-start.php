<?php
// Cargar config según entorno
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    require __DIR__ . '/app/config/config.local.php';
} else {
    require __DIR__ . '/app/config/config.prod.php';
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Sesión y control de acceso
require __DIR__ . '/app/helpers/session.php';
startSession();

//Inicia conexión a BD
require __DIR__ . '/app/config/db.php';
//Carga el controlador
require __DIR__ . '/app/controllers/RegisterController.php';

RegisterController::register($db);
