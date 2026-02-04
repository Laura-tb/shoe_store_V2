<?php
// Cargar config según entorno
if ($_SERVER['HTTP_HOST'] === 'localhost') {
    require __DIR__ . '/../config/config.local.php';
} else {
    require __DIR__ . '/../config/config.prod.php';
}

require __DIR__ . '/session.php';

logout();

header('Location: ' . BASE_URL . '/index.php?logout=1');
exit;
?>