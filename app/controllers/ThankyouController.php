<?php
// Carga el modelo de pedidos para recuperar datos de la compra
require_once __DIR__ . '/../models/OrderModel.php';

class ThankyouController
{
    //Muestra la página de confirmación con el pedido recién creado
    public static function showOrder(mysqli $db): void
    {
        $orderId = $_SESSION['last_order_id'] ?? null;

        if (!$orderId) {
            header('Location: ' . BASE_URL . '/index.php');
            exit;
        }

        $order = OrderModel::getById($db, (int)$orderId);
        $items = OrderModel::getItems($db, (int)$orderId);

        // Carga la vista de confirmación
        require __DIR__ . '/../views/ThankyouView.php';
    }
}

