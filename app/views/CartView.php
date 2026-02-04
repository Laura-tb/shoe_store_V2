<!-- VISTA CARRITO-->
<!DOCTYPE html>
<html lang="es">

<?php
$title = "Cesta";
include('app/views/layout/head.php');
?>

<body>
    <div class="page">
        <?php
        include('app/views/layout/navigation.php');
        ?>

        <main>
            <section class="hero">
                <div class="container">

                    <header class="cart-header">
                        <h1 class="cart-title">Cesta</h1>
                    </header>

                    <!-- Layout principal -->
                    <div class="cart-layout">
                        <!-- Lista de productos -->
                        <section class="cart-items-card">
                            <?php if (empty($cartItems)): ?>
                                <p>No tienes productos en la cesta.</p>
                            <?php else: ?>
                                <?php foreach ($cartItems as $item): ?>
                                    <article class="cart-item">
                                        <div class="cart-item-main">
                                            <div class="cart-item-image"
                                                style="background-image:url('img/<?= htmlspecialchars($item['img']) ?>');">
                                            </div>
                                            <div class="cart-item-text">
                                                <p class="cart-item-name">
                                                    <?= htmlspecialchars($item['name']) ?>
                                                </p>

                                                <form method="post" action="<?= BASE_URL ?>/cart.php">
                                                    <input type="hidden" name="action" value="remove">
                                                    <input type="hidden" name="product_id" value="<?= (int)$item['id'] ?>">
                                                    <button class="cart-item-remove" type="submit">Eliminar</button>
                                                </form>
                                            </div>
                                        </div>

                                        <div class="cart-item-side">
                                            <p class="cart-item-price">
                                                <?= number_format($item['price'], 2, ',', '.') ?>€
                                            </p>

                                            <form method="post" action="<?= BASE_URL ?>/cart.php" class="cart-qty">
                                                <input type="hidden" name="action" value="update">
                                                <input type="hidden" name="product_id" value="<?= (int)$item['id'] ?>">

                                                <button type="submit" class="qty-btn"
                                                    name="qty" value="<?= max(1, $item['qty'] - 1) ?>">−</button>

                                                <input type="number" class="qty-input"
                                                    value="<?= (int)$item['qty'] ?>" min="1" readonly>

                                                <button type="submit" class="qty-btn"
                                                    name="qty" value="<?= $item['qty'] + 1 ?>">+</button>
                                            </form>
                                        </div>
                                    </article>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </section>

                        <!-- Resumen -->
                        <aside class="cart-summary">
                            <h2 class="cart-summary-title">Resumen del Pedido</h2>

                            <div class="cart-summary-lines">
                                <div class="cart-summary-row">
                                    <p>Subtotal</p>
                                    <p class="cart-summary-value">
                                        <?= number_format($total, 2, ',', '.') ?>€
                                    </p>
                                </div>
                                <div class="cart-summary-row">
                                    <p>Envío</p>
                                    <p class="cart-summary-value">Gratis</p>
                                </div>
                            </div>

                            <div class="cart-summary-total">
                                <p>Total</p>
                                <p><?= number_format($total, 2, ',', '.') ?>€</p>
                            </div>

                            <form method="post" action="<?= BASE_URL ?>/cart.php">
                                <input type="hidden" name="action" value="checkout">
                                <button type="submit" class="cart-summary-btn">
                                    Finalizar Compra
                                </button>
                            </form>
                        </aside>
                    </div>
                </div>
            </section>
        </main>

        <?php
        include('app/views/layout/footer.php');
        ?>
    </div>
        <script src="<?= BASE_URL ?>/js/app.js"></script>

</body>
</html>