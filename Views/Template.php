<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion de edsan</title>
    <link rel="icon" href="Assets/images/logo_home.png">
    <link rel="stylesheet" href="Assets/css/global.css">
    <link rel="stylesheet" href="Assets/css/stylo_comentario.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <script src="Views/Resources/plugins/datatablesv2/jQuery-3.7.0/jquery-3.7.0.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/jQuery-3.7.0/jquery-3.7.0.min.js"></script>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="Views/Resources/plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="Views/Resources/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="Views/Resources/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="Views/Resources/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="Views/Resources/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="Views/Resources/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="Views/Resources/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="Views/Resources/plugins/summernote/summernote-bs4.min.css">

    <!-- cards -->
    <!-- <link rel="stylesheet" href="Assets/css/card.css"> -->

    <!-- cards -->
    <!-- <link rel="stylesheet" href="Assets/css/card2.css"> -->

    <!-- DataTables -->
    <link href="Views/Resources/plugins/datatablesv2/Bootstrap-5-5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="Views/Resources/plugins/datatablesv2/DataTables-2.0.3/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="Views/Resources/plugins/datatablesv2/Buttons-3.0.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <link href="Views/Resources/plugins/datatablesv2/Responsive-3.0.1/css/responsive.bootstrap5.min.css" rel="stylesheet">
    <link href="Views/Resources/plugins/datatablesv2/RowGroup-1.5.0/css/rowGroup.bootstrap5.min.css" rel="stylesheet">


   


    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    



</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    if (isset($_SESSION['iniciarsesion']) && $_SESSION['iniciarsesion'] == 'ok') {
        echo '<div class="wrapper">';
        include "Modules/header.php";
        include "Modules/menu.php";

        $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
        $validPages = [
            'registroequipos',
            'asignacionequipos',
            'Sede',
            'empleado',
            'usuario',
            'oficina',
            'beneficiario',
            'meta',
            'dashboard',
            'incidencias',
            'historico',
            'adquisicionequipos',
            'salir'
        ];

        if (in_array($page, $validPages)) {
            include "Pages/" . $page . ".php";
        } else {
            include "Modules/error.php";
        }
        echo '</div>';
    } else {
        include "Pages/login.php";
    }

    ?>


    <!-- ./wrapper -->
    <!-- <script src="Views/Resources/plugins/jquery/jquery.min.js"></script> -->

    <!-- jQuery UI 1.11.4 -->
    <!-- <script src="Views/Resources/plugins/jquery-ui/jquery-ui.min.js"></script> -->
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <!-- Bootstrap 4 -->
    <script src="Views/Resources/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="Views/Resources/plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="Views/Resources/plugins/sparklines/sparkline.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="Views/Resources/plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="Views/Resources/plugins/moment/moment.min.js"></script>
    <script src="Views/Resources/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="Views/Resources/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="Views/Resources/plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="Views/Resources/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="Views/Resources/dist/js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="Views/Resources/dist/js/demo.js"></script>
    <!-- Alertas -->
    <script src="Views/Resources/plugins/sweetalert2/sweetalert2.2.js"></script>



    <!--Datatables JS-->


    <script src="Views/Resources/plugins/datatablesv2/Bootstrap-5-5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/JSZip-3.10.1/jszip.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/pdfmake-0.2.7/pdfmake.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/pdfmake-0.2.7/vfs_fonts.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/DataTables-2.0.3/js/dataTables.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/DataTables-2.0.3/js/dataTables.bootstrap5.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/Buttons-3.0.1/js/dataTables.buttons.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/Buttons-3.0.1/js/buttons.bootstrap5.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/Buttons-3.0.1/js/buttons.colVis.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/Buttons-3.0.1/js/buttons.html5.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/Responsive-3.0.1/js/dataTables.responsive.min.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/Responsive-3.0.1/js/responsive.bootstrap5.js"></script>
    <script src="Views/Resources/plugins/datatablesv2/RowGroup-1.5.0/js/dataTables.rowGroup.min.js"></script>






    <script src="Assets/js/header.js"></script>
    <?php
    $scripts = [
        'asignacionequipos' => ['Assets/js/asignacion_equipo.js'],
        'empleado' => [
            'Assets/js/jsEmpleado/empleado.js',
            'Assets/js/jsEmpleado/validaciones_empleado.js',
            'Assets/js/jsEmpleado/listar.js',
            'Assets/js/jsEmpleado/listarequipoxEmpleado.js',
            'Assets/js/jsEmpleado/registrar.js',
            'Assets/js/jsEmpleado/usuario.js',
            'Assets/js/jsEmpleado/buscar.js',
            'Assets/js/jsEmpleado/editar.js',
            'Assets/js/jsCargo/listar.js',
            'Assets/js/jsCargo/registrar.js',
            'Assets/js/jsCargo/editar.js',
            'Assets/js/jsCargo/eliminar.js',
            'Assets/js/jsDirecciones/listar.js',
            'Assets/js/jsDirecciones/editar.js',
            'Assets/js/jsDirecciones/registrar.js',
            'Assets/js/jsDirecciones/eliminar.js'
        ],
        'oficina' => ['Assets/js/sede.js', 'Assets/js/oficina.js', 'Assets/js/areausuaria.js'],
        'usuario' => ['Assets/js/usuario.js'],
        'beneficiario' => ['Assets/js/beneficiario.js', 'Assets/js/meta.js'],
        'historico' => ['Assets/js/historico.js'],
        'registroequipos' => ['Assets/js/marca.js', 'Assets/js/equipo.js',],
        'adquisicionequipos' => ['Assets/js/adquisicion.js'],
        'incidencias' => [
            'Assets/js/jsIncidencias/listar_incidencias.js',
            'Assets/js/jsIncidencias/buscar_incidencias.js',
            'Assets/js/jsIncidencias/registrar_incidencias.js',
            'Assets/js/jsIncidencias/buscar_ticket_activity.js',
            'Assets/js/jsIncidencias/aventos_adicionales.js',
            'Assets/js/jsIncidencias/eliminar_incidencias.js'
        ],
        'dashboard' => ['Assets/js/DashBoard/dash_ticket.js']
        // Añade más mapeos según sea necesario
    ];

    if (isset($scripts[$page])) {
        foreach ($scripts[$page] as $script) {
            if (file_exists($script)) {
                echo "<script src='{$script}'></script>";
            }
        }
    }
    ?>



</body>

</html>