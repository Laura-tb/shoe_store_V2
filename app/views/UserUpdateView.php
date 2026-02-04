<!DOCTYPE html>

<html lang="es">

<?php
$title = "Edición de Usuarios";
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
                        <a href="<?= BASE_URL ?>/admin_users.php">Volver</a>

                        <h1 class="title"><?= $mode === 'create' ? 'Crear usuario' : 'Editar usuario' ?></h1>

                        <form method="POST" id="user-form">
                            <div class="field">
                                <label>Nombre:
                                    <input id="name" type="text" name="name" value="<?= $user['name'] ?>">
                                    <span class="error" id="nameError"></span>
                                </label>
                            </div>

                            <div class="field">
                                <label>Apellidos:
                                    <input id="surname" type="text" name="surname" value="<?= $user['surname'] ?>">
                                </label>
                            </div>

                            <div class="field">
                                <label>Email:
                                    <input id="email" type="email" name="email" value="<?= $user['email'] ?>">
                                    <span class="error" id="emailError"></span>
                                </label>
                            </div>

                            <div class="field">
                                <label>Contraseña:
                                    <input id="password" type="text" name="pass_hash" value="<?= $user['pass_hash'] ?>">
                                    <span class="error" id="passwordError"></span>
                                </label>
                            </div>

                            <div class="field">
                                <label>Rol:
                                    <select name="role">
                                        <option value="client" <?= $user['role'] === 'client' ? 'selected' : '' ?>>Cliente</option>
                                        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                    </select>
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