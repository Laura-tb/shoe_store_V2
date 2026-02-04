<?php
// Carga el modelo de usuarios
require __DIR__ . '/../models/UserModel.php';

$id = intval($_GET['id'] ?? 0);

if ($id > 0) {
    UserModel::delete($db, $id);
}

// Redirige al listado de usuarios
header("Location: " . BASE_URL . "/admin_users.php");
exit;
?>
