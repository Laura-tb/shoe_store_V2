<!-- VISTA DETALLE DE PEDIDO-->
<!DOCTYPE html>

<html lang="es">

<?php
$title = "Detalle de pedido";
include('app/views/layout/head.php');
?>


<body>
  <div class="page admin_products">
    <?php
    include('app/views/layout/navigation.php');
    ?>

    <main>
      <section class="hero">
        <a href="<?= BASE_URL ?>/orders.php">Volver</a>

        <h1>Detalle del pedido</h1>

        <div class="container">

          <div style="margin-bottom:16px;">
            <p><strong>Nº Pedido:</strong> <?= htmlspecialchars((string)$order['id_order']) ?></p>
            <p><strong>Fecha:</strong> <?= htmlspecialchars((new DateTime($order['created_at']))->format('d/m/Y')) ?></p>
            <p><strong>Total:</strong> <?= htmlspecialchars(number_format((float)$order['total'], 2, ',', '.')) ?>€</p>
          </div>

          <table class="table orders">
            <thead>
              <tr>
                <th>PRODUCTO</th>
                <th>IMAGEN</th>
                <th>CANTIDAD</th>
              </tr>
            </thead>

            <tbody>
              <?php if (empty($items)) : ?>
                <tr>
                  <td colspan="3">Este pedido no tiene productos.</td>
                </tr>
              <?php else : ?>
                <?php foreach ($items as $it) : ?>
                  <tr>
                    <td><?= htmlspecialchars((string)$it['name_product']) ?></td>

                    <td>
                      <?php if (!empty($it['image_product'])) : ?>
                        <img
                          src="img/<?= htmlspecialchars($it['image_product']) ?>"
                          alt="<?= htmlspecialchars((string)$it['name_product']) ?>"
                          style="width:60px; height:auto; border-radius:6px;">
                      <?php else : ?>
                        -
                      <?php endif; ?>
                    </td>

                    <td><?= htmlspecialchars((string)$it['qty_order_items']) ?></td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>

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