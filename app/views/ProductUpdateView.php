<!DOCTYPE html>

<html lang="es">

<?php
$title = "Edición de Productos";
include('app/views/layout/head.php');
?>

<body>
    <div class="page login">
        <?php
        include('app/views/layout/navigation.php');
        ?>

        <main>
            <section class="hero">
                <div class="container">
                    <section class="card">
                        <a href="<?= BASE_URL ?>/admin_products.php">Volver</a>

                        <h1 class="title"><?= $mode === 'create' ? 'Crear producto' : 'Editar producto' ?></h1>

                        <form method="POST" id="product-form" enctype="multipart/form-data" data-mode="<?= $mode ?>" novalidate>

                            <?php if ($mode !== 'create' && !empty($products['image_product'])): ?>
                                <div class="field">
                                    <label>Imagen actual:</label>
                                    <img src="img/<?= htmlspecialchars($products['image_product']) ?>"
                                        alt="Imagen del producto"
                                        class="product-image-preview">
                                </div>
                            <?php endif; ?>

                            <div class="field">
                                <label>Imagen:
                                    <input id="image_product" type="file" name="image_product">
                                </label>
                            </div>
                            <div class="field">
                                <label>Nombre:
                                    <input id="name_product" type="text" name="name_product" value="<?= $products['name_product'] ?>" required>
                                    <span class="error" id="nameError"></span>
                                </label>
                            </div>

                            <div class="field">
                                <label>Precio:
                                    <input id="price_product" type="number"
                                        step="0.01"
                                        min="0"
                                        lang="es" name="price_product" value="<?= $products['price_product'] ?>"
                                        required>
                                    <span class="error" id="priceError"></span>
                                </label>
                            </div>

                            <div class="field">
                                <label>Stock:
                                    <input id="stock_product" type="number" name="stock_product" value="<?= $products['stock_product'] ?>" required>
                                    <span class="error" id="stockError"></span>
                                </label>
                            </div>

                            <button class="btn btn-primary btn-lg" type="submit">
                                <?= $mode === 'create' ? 'Crear' : 'Guardar cambios' ?>
                            </button>
                        </form>
                    </section>
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