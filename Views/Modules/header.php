<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="dashboard" class="nav-link">Home</a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                <!-- Aquí se insertará la imagen generada -->
                <img id="user-image" class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline" id="usuario_sesion" id_lg_usuario="<?php echo $_SESSION['idusuario']; ?>" data-usu="<?php echo $_SESSION['usu']; ?>"><?php echo $_SESSION['usu']; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
                <li class="user-footer">
                    <a href="salir" class="btn btn-default btn-flat float-right">Sign out</a>
                </li>
            </ul>
        </li>
    </ul>
</nav>