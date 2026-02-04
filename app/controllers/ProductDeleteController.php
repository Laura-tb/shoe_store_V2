
<?php
// Carga el modelo de productos
require __DIR__ . '/../models/ProductModel.php';

$id_product = intval($_GET['id_product'] ?? 0);

if ($id_product > 0) {

    try {
        ProductModel::delete($db, $id_product);
    } catch (mysqli_sql_exception $e) {
        // Error de clave foránea: el producto está asociado a pedidos
        if ($e->getCode() === 1451) {  
            header("Location: " . BASE_URL . "/admin_products.php?e=product_used");
            exit;
        }
        // Cualquier otro error de BD
        header("Location: " . BASE_URL . "/admin_products.php?e=error");
        exit;
    }
}

// Redirige al listado de productos con mensaje de eliminación correcta
header("Location: " . BASE_URL . "/admin_products.php?deleted=1");
exit;
