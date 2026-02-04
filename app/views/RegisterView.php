<!doctype html>
<html lang="es">

<?php
$title = "Registro";
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
                        <a href="<?= BASE_URL ?>/index.php">Volver</a>

                        <h1 class="title">Registro</h1>


                        <form method="post" id="register-form" action="<?= BASE_URL ?>/register-start.php" autocomplete="off" novalidate>
                            <div class="field">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" placeholder="tuemail@email.com" />
                                <span class="error" id="emailError"></span>
                            </div>

                            <div class="field">
                                <label for="name">Nombre</label>
                                <input id="name" name="name" type="text" placeholder="Tu nombre" />
                                <span class="error" id="nameError"></span>
                            </div>

                            <div class="field">
                                <label for="surname">Apellidos</label>
                                <input id="surname" name="surname" type="text" placeholder="Tus apellidos" />
                            </div>

                            <div class="field">
                                <label for="password">Contraseña</label>
                                <div class="password">
                                    <input id="password" name="password" type="password" placeholder="••••••••"
                                        title="Mínimo 8 caracteres con al menos una letra minúscula, una mayúscula, un carácter especial y un número." />
                                    <span class="error" id="passwordError"></span>
                                </div>
                            </div>

                            <button class="btn btn-primary btn-lg" type="submit">Crear cuenta</button>
                        </form>

                        <p class="link-wrap">
                            <a href="<?= BASE_URL ?>/login.php" class="link">Ya tengo cuenta</a>
                        </p>

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