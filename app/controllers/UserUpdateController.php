<?php

// Carga el modelo de usuarios
require __DIR__ . '/../models/UserModel.php';

$id = intval($_GET['id'] ?? 0);

if ($id <= 0) {
    header("Location: " . BASE_URL . "/admin_users.php");
    exit;
}

// POST: actualiza el usuario y redirige
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $surname = trim($_POST['surname'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $pass_hash   = trim($_POST['pass_hash'] ?? '');
    $role    = trim($_POST['role'] ?? '');

    // Actualiza los datos del usuario en base de datos
    UserModel::update($db, $id, $name, $surname, $email, $pass_hash, $role);

    header("Location: " . BASE_URL . "/admin_users.php");
    exit;
}

// GET: carga los datos del usuario y muestra el formulario de edición
$user = UserModel::getById($db, $id);
if (!$user) {
    header('Location: ' . BASE_URL . '/admin_users.php');
    exit;
}

$mode = "";
// Carga la vista de crear/editar usuario
require __DIR__ . '/../views/UserUpdateView.php';
