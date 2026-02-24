<!DOCTYPE html>
<html lang="es">

<?php
$title = "Tienda";
include('app/views/layout/head.php');
?>

<body>
    <div class="page">
        <?php

        include('app/views/layout/navigation.php');
        ?>

        <main>
            <!-- Banner -->
            <section class="hero">
                <div class="container">
                    <div class="hero-card"
                        data-alt="Persona con zapatillas modernas en movimiento sobre fondo urbano.">
                        <div class="hero-text">
                            <h2 class="hero-title">Define Tu Próximo Paso</h2>
                            <p class="hero-subtitle">
                                Descubre los últimos lanzamientos de las mejores marcas. Estilo que impulsa.
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Productos -->
            <section class="products-section">
                <div class="container">
                    <header class="products-header">
                        <h1 class="products-title">Nuestra Colección</h1>
                        <p class="products-subtitle">
                            Explora los últimos modelos y encuentra tu par perfecto.
                        </p>
                    </header>

                    <div class="products-grid">

                        <?php if (empty($products)): ?>
                            <p>No hay productos disponibles.</p>
                        <?php else: ?>
                            <?php foreach ($products as $product): ?>
                                <?php
                                $stock = (int)$product['stock_product'];
                                $isAvailable = $stock > 0;
                                ?>
                                <article class="product-card">
                                    <div class="product-image-wrapper">
                                        <img src="img/<?= htmlspecialchars($product['image_product']); ?>"
                                            alt="<?= htmlspecialchars($product['name_product']); ?>"
                                            class="product-image">
                                    </div>

                                    <div class="product-body">
                                        <div class="product-header-body">
                                            <h3 class="product-name">
                                                <?= htmlspecialchars($product['name_product']); ?>
                                            </h3>

                                            <?php if ($isAvailable): ?>
                                              
                                                <form method="post" action="<?= BASE_URL ?>/cart.php">
                                                    <input type="hidden" name="action" value="add">
                                                    <input type="hidden" name="product_id"
                                                        value="<?= (int)$product['id_product'] ?>">

                                                    <button class="add-cart-btn" aria-label="Añadir al carrito" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="#ffffff"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                                                            <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                                        </svg>
                                                    </button>
                                                </form>
                                                
                                            <?php else: ?>                                            
                                                <span class="product-badge-out">Agotado</span>
                                            <?php endif; ?>
                                        </div>

                                        <p class="product-price">
                                            <?= number_format((float)$product['price_product'], 2, ',', '.'); ?>€
                                        </p>

                                        <div class="product-stock">
                                            <span>Stock disponible:</span>
                                            <span class="product-stock-value"><?= $stock ?></span>
                                        </div>
                                    </div>
                                </article>
                            <?php endforeach; ?>

                        <?php endif; ?>

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