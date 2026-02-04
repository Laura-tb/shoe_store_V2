<?php
// Cargar config según entorno
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    require __DIR__ . '/app/config/config.local.php';
} else {
    require __DIR__ . '/app/config/config.prod.php';
}

//Sesión y control de acceso
require __DIR__ . '/app/helpers/session.php';
requireRole('client');

//Inicia conexión a BD
require __DIR__ . '/app/config/db.php'; 
//Carga el controlador
require __DIR__ . '/app/controllers/CartController.php';


?>

