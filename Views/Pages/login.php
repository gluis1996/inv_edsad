<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>

    <link rel="stylesheet" type="text/css" href="Assets/css/login.css">

</head>

<body>
    <div class="login-container">
        <div class="login-box">

            <div class="login-logo">
                <img src="Assets/images/logo2.png" alt="Icono de Usuario" style="width: 300px; padding-right: 70px;">

                <!-- <i class="fas fa-user-circle fa-5x text-primary"></i>  -->
            </div>
            <h2>Iniciar Sesión</h2>
            <form method="post">
                <!-- Campo de Usuario con icono -->
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fas fa-user"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
                    </div>
                </div>
                <!-- Campo de Contraseña con icono -->
                <div class="form-group">
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="fas fa-lock"></i>
                        </span>
                        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Ingresar</button>
                <?php
                $login = new ControllerLogin();
                $login->login();
                ?>
            </form>
        </div>
    </div>
</body>

</html>