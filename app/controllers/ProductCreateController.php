<?php
// Carga el modelo de productos
require __DIR__ . '/../models/ProductModel.php';

// Si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name_product     = trim($_POST['name_product'] ?? '');

    $price_raw  = str_replace(',', '.', $_POST['price_product'] ?? '0');
    $price_product = number_format((float)$price_raw, 2, '.', ''); 
    
    $stock_product = (int)($_POST['stock_product'] ?? 0);

    // Crea el producto en base de datos sin imagen
    $id = ProductModel::create($db, $name_product, $price_product, $stock_product);

    if (!$id) {
        exit('Error al crear producto');
    }

    // Procesa la imagen del producto si se ha subido correctamente
    if (
        !empty($_FILES['image_product']['tmp_name']) &&
        $_FILES['image_product']['error'] === UPLOAD_ERR_OK
    ) {

        $tmpPath  = $_FILES['image_product']['tmp_name'];
        $origName = $_FILES['image_product']['name'];

        $ext = strtolower(pathinfo($origName, PATHINFO_EXTENSION)); 

        $fileName = $id . '.' . $ext;   
        $destPath = __DIR__ . '/../../img/' . $fileName;

        if (move_uploaded_file($tmpPath, $destPath)) {
            ProductModel::updateImage($db, $id, $fileName);
        }
    }

    // Redirige al listado de productos con mensaje de éxito
    header('Location: ' . BASE_URL . '/admin_products.php?registered=1');
    exit;
}

// Modo creación: inicializa el producto vacío para la vista
$products = [
    'id_product'        => null,
    'image_product'     => '',
    'name_product'      => '',
    'price_product'   => '',
    'stock_product' => ''
];

$mode = "create";

// Carga la vista de creación / edición de producto
require __DIR__ . '/../views/ProductUpdateView.php';
