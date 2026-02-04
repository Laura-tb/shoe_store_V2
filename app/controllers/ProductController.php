<?php
// Carga el modelo de productos para acceder a la base de datos
require __DIR__ . '/../models/ProductModel.php';

// Obtiene el listado completo de productos
$products = ProductModel::getAll($db);

// Carga la vista que muestra los productos
require __DIR__ . '/../views/ProductView.php';
?>
