<!DOCTYPE html>

<html lang="es">

<?php
$title = "Gestión de Usuarios";
include('app/views/layout/head.php');
?>

<body>
    <div class="page admin_users">
        <?php
        include('app/views/layout/navigation.php');
        ?>

        <main>
            <section class="hero">
                <a href="<?= BASE_URL ?>/admin.php">Volver</a>

                <h1>Gestión de Usuarios</h1>
                <div>
                    <a href="<?= BASE_URL ?>/users_create.php">Crear usuario</a>
                </div>
                <div class="container">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>EMAIL</th>
                                <th>NOMBRE</th>
                                <th>APELLIDOS</th>
                                <th>CONTRASEÑA</th>
                                <th>ROL</th>
                                <th>FECHA CREACIÓN</th>
                                <th>ACCIONES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $u) : ?>
                                <tr>
                                    <td><?= $u['id'] ?></td>
                                    <td><?= $u['email'] ?></td>
                                    <td><?= $u['name'] ?></td>
                                    <td><?= $u['surname'] ?></td>
                                    <td><?= $u['pass_hash'] ?></td>
                                    <td><?= $u['role'] ?></td>
                                    <td><?= $u['created_at'] ?></td>
                                    <td>
                                        <a href="<?= BASE_URL ?>/users_update.php?id=<?= $u['id'] ?>">Editar</a>
                                        <a class="btn-red" href="<?= BASE_URL ?>/users_delete.php?id=<?= $u['id'] ?>" onclick="return confirm('¿Eliminar?');">Eliminar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
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