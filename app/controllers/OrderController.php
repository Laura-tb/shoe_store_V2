
<?php
// Carga el modelo de pedidos para acceder a la base de datos
require_once __DIR__ . '/../models/OrderModel.php';

class OrderController
{
    //Muestra el listado de pedidos del usuario autenticado
    public static function index(int $userId): array
    {
        global $db;
        return OrderModel::getByUserId($db, $userId) ?? [];
    }

    //Muestra el detalle de un pedido concreto del usuario
    public static function show(int $userId, int $orderId): array
    {
        global $db;

        $order = OrderModel::getOrderByIdAndUserId($db, $orderId, $userId);
        if (!$order) {
            header('Location: ' . BASE_URL . '/orders.php');
            exit;
        }

        $items = OrderModel::getItemsImg($db, $orderId);

        return ['order' => $order, 'items' => $items];
    }
}

// Identificador del usuario autenticado
$userId = $_SESSION['user_id'];
$action  = $_GET['action'] ?? 'index';

if ($action === 'show') {
    // Muestra el detalle de un pedido concreto
    $orderId = (int)($_GET['id'] ?? 0);
    $data = OrderController::show($userId, $orderId); 
    $order = $data['order'];
    $items = $data['items'];

    // Carga la vista de detalle del pedido
    require __DIR__ . '/../views/OrderDetailView.php';
    exit;
}
// Obtiene el listado de pedidos del usuario
$orders = OrderController::index($userId);

// Carga la vista con el listado de pedidos
require __DIR__ . '/../views/OrderView.php';