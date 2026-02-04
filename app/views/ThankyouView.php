<!-- VISTA CONFIRMACIÓN DE PEDIDO-->
<!DOCTYPE html>
<html lang="es">

<?php
$title = "Gracias por tu compra";
include('app/views/layout/head.php');
?>

<body class="thankyou">
    <div class="page">
        <?php include('app/views/layout/navigation.php'); ?>

        <main class="thankyou-main">
            <section class="hero">
                <div class="container">

                    <div class="thankyou-wrapper">
                        <div class="thankyou-card">
                            <h1 class="thankyou-title">¡Gracias por tu compra!</h1>
                            <p class="thankyou-subtitle">
                                Tu pedido ha sido procesado correctamente.
                            </p>

                            <div class="order-summary">
                                <div class="order-summary-header">
                                    <span>Nº pedido</span>
                                    <span class="order-summary-id">#<?= (int)$order['id_order'] ?></span>
                                </div>

                                <div class="order-summary-row">
                                    <span>Fecha</span>
                                    <?php
                                    $date = new DateTime($order['created_at']);
                                    ?>
                                    <span><?= $date->format('d/m/Y') ?></span>
                                </div>

                                <div class="order-summary-divider"></div>

                                <div class="order-summary-items-title">Artículos</div>

                                <ul class="order-summary-items">
                                    <?php foreach ($items as $item): ?>
                                        <li class="order-summary-item">
                                            <div class="order-summary-row">
                                                <?= htmlspecialchars($item['name_product']) ?>
                                            </div>
                                            <div class="order-summary-item-qty">
                                                × <?= (int)$item['qty_order_items'] ?>
                                            </div>
                                            <div class="order-summary-row">
                                                <?= number_format((float)$item['unit_price_order_items'], 2, ',', '.') ?>€
                                            </div>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="order-summary-divider"></div>

                                <div class="order-summary-header">
                                    <span>Importe total</span>
                                    <span class="order-summary-id"><?= number_format((float)$order['total'], 2, ',', '.') ?>€</span>
                                </div>

                            </div>

                            <a class="thankyou-btn" href="<?= BASE_URL ?>/index.php">
                                Volver a la tienda
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php include('app/views/layout/footer.php'); ?>
    </div>
</body>

</html>