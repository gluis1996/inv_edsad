<div id="back"></div>
<div class="login-box">
    <div class="login-logo">
        <!-- <img src="vista/img/plantilla/logo-blanco-bloque.png" class="img-responsive" style="padding: 30px 100px 0px 100px"> -->
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">Ingresa al sistema</p>

        <form method="post">

            <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" required>
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                <input type="password" class="form-control" placeholder="Password" name="ingPassword" required>
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
                </div>
                <!-- /.col -->
            </div>
            <?php 
                $login = new ControllerLogin();
                $login ->login();
            ?>
        </form>
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->