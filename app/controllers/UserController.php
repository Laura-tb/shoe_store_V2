<?php

// Carga el modelo de usuarios para acceder a la base de datos
require __DIR__ . '/../models/UserModel.php';

// Obtiene el listado completo de usuarios
$users = UserModel::getAll($db);

// Carga la vista que muestra los usuarios
require __DIR__ . '/../views/UserView.php';
?>

