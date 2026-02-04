<?php
// Carga el modelo de usuarios
require __DIR__ . '/../models/UserModel.php';

// Si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email'] ?? '');
    $name     = trim($_POST['name'] ?? '');
    $surname  = trim($_POST['surname'] ?? '');
    $pass_hash = trim($_POST['pass_hash'] ?? '');
    $role     = trim($_POST['role'] ?? '');


    // --- VALIDACIONES ---

    // Validación de email correcto
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ' . BASE_URL . '/users_create.php?e=val');
        exit;
    }

    // Validación: email duplicado
    if (UserModel::existsByEmail($db, $email)) {
        header('Location: ' . BASE_URL . '/users_create.php?e=dup');
        exit;
    }

    // Validación de contraseña fuerte
    $regexPass = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
    if (!preg_match($regexPass, $pass_hash)) {
        header('Location: ' . BASE_URL . '/users_create.php?e=pass');
        exit;
    }

    // Crear usuario
    UserModel::create($db, $email, $name, $surname, $pass_hash, $role);

    header('Location: ' . BASE_URL . '/admin_users.php?registered=1');
    exit;
}

// Modo creación → $user vacío
$user = [
    'id'        => null,
    'email'     => '',
    'name'      => '',
    'surname'   => '',
    'pass_hash' => '',
    'role'      => 'client'
];

$mode = "create";

// Carga la vista de creación / edición de usuario
require __DIR__ . '/../views/UserUpdateView.php';
