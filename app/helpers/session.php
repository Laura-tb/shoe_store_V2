<?php

// Inicia sesión si no está iniciada (evita errores por session_start repetido)

function startSession()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

// Crea la sesión cuando el login es correcto
function createUserSession($user)
{
    startSession();
    session_regenerate_id(true);

    $_SESSION['user_id']   = $user['id'];
    $_SESSION['role']      = $user['role'];
}

// Restringe el acceso a una página según rol
function requireRole(string $role): void
{
    startSession();

    if ($_SESSION['role'] !== $role) {
        header('Location: ' . BASE_URL . '/index.php');
        exit;
    }
}

// Si ya hay sesión iniciada, redirige al usuario a su área según rol
function isSessionInit()
{
    startSession();

    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] === 'admin') {
            header('Location: ' . BASE_URL . '/admin.php');
            exit;
        } else if ($_SESSION['role'] === 'client') {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }
    }
}

// Cierra sesión: elimina datos y destruye la sesión
function logout()
{
    startSession();
    $_SESSION = [];
    session_destroy();
}

// TEST- // Comprueba si el usuario está autenticado
function isLoggedIn()
{
    startSession();
    return isset($_SESSION['user_id']);
}

// --- Sesión del carrito ---
// Asegura que la sesión esté iniciada (para usar $_SESSION['cart'])
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];     
}