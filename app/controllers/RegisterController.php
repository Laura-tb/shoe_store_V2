<?php
// Carga el modelo de usuarios para operar con la base de datos
require_once __DIR__ . '/../models/UserModel.php';

class RegisterController
{
    //Gestiona el registro de nuevos usuarios
    public static function register(mysqli $db): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require __DIR__ . '/../views/RegisterView.php';
            return;
        }

        $email   = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $name    = trim($_POST['name'] ?? '');
        $surname = trim($_POST['surname'] ?? '');
        $pass    = $_POST['password'] ?? '';

        // Patrón de contraseña: mínimo 8 caracteres, mayúscula, minúscula, número y símbolo
        $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        // Valida campos obligatorios
        if (!$email || !$name || !$surname) {
            header('Location: ' . BASE_URL . '/register-start.php?e=val');
            exit;
        }
        if (!preg_match($pattern, $pass)) {
            header('Location: ' . BASE_URL . '/register-start.php?e=pass');
            exit;
        }

         // Crea el usuario con rol "client"
        $user = UserModel::create($db, $email, $name, $surname, $pass, 'client');

        if ($user) {
            header('Location: ' . BASE_URL . '/login.php?registered=1');
            exit;
        }

        header('Location: ' . BASE_URL . '/register-start.php?e=dup');
        exit;

    }
}
