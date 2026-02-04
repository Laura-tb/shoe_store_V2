
<?php
// Carga el modelo de usuarios para acceder a la base de datos
require __DIR__ . '/../models/UserModel.php';

class LoginController
{
    //Gestiona el proceso de login de usuarios
    public static function login(mysqli $db): void
    {

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            require __DIR__ . '/../views/LoginView.php';
            return;
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pass  = $_POST['password'] ?? '';

        if (!$email || $pass === '') {
            header('Location: ' . BASE_URL . '/login.php?e=val');
            exit;
        }

        // Busca el usuario por email en la base de datos
        $user = UserModel::getByEmail($db, $email);

        if ($user && $pass === $user['pass_hash']) {
            // Crea la sesión del usuario autenticado
            createUserSession($user);

            if ($user['role'] === 'admin') {
                header('Location: ' . BASE_URL . '/admin.php');
            } else {
                header('Location: ' . BASE_URL . '/index.php');
            }
            exit;
        } else {
            // Credenciales incorrectas: email o contraseña no válidos
            header('Location: ' . BASE_URL . '/login.php?e=cred');
            exit;
        }
    }
}

?>