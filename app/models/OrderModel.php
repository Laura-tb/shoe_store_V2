<?php

class OrderModel
{
    //Crea el pedido en ORDERS y sus líneas en ORDER_ITEMS
    public static function createOrder(mysqli $db, int $userId, array $cart)
    {
        if (empty($cart)) {
            return false;
        }

        $db->begin_transaction();

        try {
            // Calcular total y obtener precios actualizados
            $total = 0;
            $productsData = [];

            $stmtProduct = $db->prepare(
                'SELECT id_product, price_product FROM products WHERE id_product = ?'
            );

            foreach ($cart as $productId => $item) {
                $stmtProduct->bind_param('i', $productId);
                $stmtProduct->execute();
                $res = $stmtProduct->get_result();
                $product = $res->fetch_assoc();

                if (!$product) {
                    continue;
                }

                $qty   = (int)$item['qty'];
                $price = (float)$product['price_product'];

                $productsData[] = [
                    'id'    => $productId,
                    'qty'   => $qty,
                    'price' => $price,
                ];

                $total += $price * $qty;
            }

            $stmtProduct->close();

            if (empty($productsData)) {
                $db->rollback();
                return false;
            }

            // Insertar en ORDERS
            $stmtOrder = $db->prepare(
                'INSERT INTO orders (user_id, total, created_at)
                 VALUES (?, ?, NOW())'
            );
            $stmtOrder->bind_param('id', $userId, $total);
            $stmtOrder->execute();
            $orderId = $db->insert_id;
            $stmtOrder->close();

            // Insertar líneas en ORDER_ITEMS
            $stmtItem = $db->prepare(
                'INSERT INTO order_items
                    (order_id, product_id, qty_order_items, unit_price_order_items)
                 VALUES (?, ?, ?, ?)'
            );

            // preparar update de stock
            $stmtStock = $db->prepare(
                'UPDATE products
                 SET stock_product = stock_product - ?
                 WHERE id_product = ?'
            );

            foreach ($productsData as $p) {
                $stmtItem->bind_param(
                    'iiid',
                    $orderId,
                    $p['id'],
                    $p['qty'],
                    $p['price']
                );
                $stmtItem->execute();

                $stmtStock->bind_param(
                    'ii',
                    $p['qty'],
                    $p['id']
                );
                $stmtStock->execute();
            }

            $stmtItem->close();
            $stmtStock->close();

            $db->commit();
            return $orderId;
        } catch (Throwable $e) {
            $db->rollback();
            return false;
        }
    }

    //Obtiene un pedido por ID (sin validar usuario).
    public static function getById(mysqli $db, int $orderId): ?array
    {
        $stmt = $db->prepare(
            'SELECT id_order, user_id, total, created_at
             FROM orders
             WHERE id_order = ?'
        );
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $res = $stmt->get_result();
        $order = $res->fetch_assoc();
        $stmt->close();

        return $order ?: null;
    }

    //Obtiene las líneas de un pedido (incluye nombre de producto).
    public static function getItems(mysqli $db, int $orderId): array
    {
        $stmt = $db->prepare(
            'SELECT oi.product_id,
                    oi.qty_order_items,
                    oi.unit_price_order_items,
                    p.name_product
             FROM order_items oi
             JOIN products p ON p.id_product = oi.product_id
             WHERE oi.order_id = ?'
        );
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $res = $stmt->get_result();
        $items = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $items;
    }

    //Obtiene las líneas de un pedido incluyendo imagen del producto.
    public static function getItemsImg(mysqli $db, int $orderId): array
    {
        $stmt = $db->prepare(
            'SELECT oi.product_id,
                    oi.qty_order_items,
                    oi.unit_price_order_items,
                    p.name_product,
                    p.image_product AS image_product
             FROM order_items oi
             JOIN products p ON p.id_product = oi.product_id
             WHERE oi.order_id = ?'
        );
        $stmt->bind_param('i', $orderId);
        $stmt->execute();
        $res = $stmt->get_result();
        $items = $res->fetch_all(MYSQLI_ASSOC);
        $stmt->close();

        return $items;
    }

    //Obtiene todos los pedidos de un usuario, ordenados del más reciente al más antiguo.
    public static function getByUserId(mysqli $db, int $userId): ?array
    {
        $stmt = $db->prepare(
            'SELECT id_order, user_id, total, created_at
             FROM orders
             WHERE user_id = ?
             ORDER BY created_at DESC'
        );
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        $res = $stmt->get_result();
        $orders = $res->fetch_all(MYSQLI_ASSOC);

        $stmt->close();

        return $orders;
    }

    //Obtiene un pedido validando que pertenece al usuario indicado.
    public static function getOrderByIdAndUserId(mysqli $db, int $orderId, int $userId): ?array
    {
        $stmt = $db->prepare(
            'SELECT id_order, user_id, total, created_at
         FROM orders
         WHERE id_order = ? AND user_id = ?'
        );
        $stmt->bind_param('ii', $orderId, $userId);
        $stmt->execute();
        $res = $stmt->get_result();
        $order = $res->fetch_assoc();
        $stmt->close();
        return $order ?: null;
    }
}

