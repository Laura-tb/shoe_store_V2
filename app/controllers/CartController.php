<?php

/*CONTROLADOR CARRITO 
Gestiona las operaciones del carrito: añadir productos, actualizar cantidades,
eliminar ítems, calcular totales y finalizar el pedido (checkout).*/

require_once __DIR__ . '/../models/ProductModel.php';
require_once __DIR__ . '/../models/OrderModel.php';

class CartController
{
    private mysqli $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    //Añadir un producto al carrito
    public function add(int $productId): void
    {
        $product = ProductModel::getById($this->db, $productId);

        if (!$product) {
            return;
        }

        if ((int)$product['stock_product'] <= 0) {
            return;
        }

        if (!isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId] = ['qty' => 1];
        } else {
            $_SESSION['cart'][$productId]['qty']++;
        }
    }

    //Actualizar cantidad
    public function updateQty(int $productId, int $qty): void
    {
        $product = ProductModel::getById($this->db, $productId);

        if (!isset($_SESSION['cart'][$productId])) {
            return;
        }

        if ($qty <= 0) {
            unset($_SESSION['cart'][$productId]);
            return;
        }

        if ($qty <= (int)$product['stock_product']) {
            $_SESSION['cart'][$productId]['qty'] = $qty;
        }
    }

    //Eliminar un producto del carrito
    public function remove(int $productId): void
    {
        unset($_SESSION['cart'][$productId]);
    }

    //Obtener información completa del carrito
    public function getCart(): array
    {
        $items = [];

        if (empty($_SESSION['cart'])) {
            return $items;
        }

        foreach ($_SESSION['cart'] as $id => $item) {
            $product = ProductModel::getById($this->db, $id);

            if (!$product) {
                continue;
            }

            $items[] = [
                'id'    => $product['id_product'],
                'name'  => $product['name_product'],
                'img'   => $product['image_product'],
                'price' => (float)$product['price_product'],
                'qty'   => (int)$item['qty'],
            ];
        }

        return $items;
    }

    //Calcular total del carrito
    public function getTotal(): float
    {
        $items = $this->getCart();
        $total = 0;

        foreach ($items as $i) {
            $total += $i['price'] * $i['qty'];
        }

        return $total;
    }

    //Checkout: insertar en DB (ORDERS + ORDER_ITEMS)
    public function checkout(int $userId): bool
    {
        if (empty($_SESSION['cart'])) {
            return false;
        }

        $orderId = OrderModel::createOrder($this->db, $userId, $_SESSION['cart']);

        if ($orderId === null) {
            return false;
        }

        $_SESSION['cart'] = [];
        $_SESSION['last_order_id'] = $orderId;
        

        header('Location: ' . BASE_URL . '/thankyou.php');
        exit;
    }
}

// Instancia del controlador del carrito
$cartController = new CartController($db);

// Gestionar acciones del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action    = $_POST['action'] ?? '';
    $productId = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

    switch ($action) {
        case 'add':
            $cartController->add($productId);
            break;
        case 'update':
            $qty = (int)($_POST['qty'] ?? 1);
            $cartController->updateQty($productId, $qty);
            break;
        case 'remove':
            $cartController->remove($productId);
            break;
        case 'checkout':            
            $cartController->checkout((int)$_SESSION['user_id']);
            break;
    }

    header('Location: ' . BASE_URL . '/cart.php');
    exit;
}

// Datos necesarios para la vista
$cartItems = $cartController->getCart();
$total     = $cartController->getTotal();

// Carga la vista del carrito
require __DIR__ . '/../views/CartView.php';
