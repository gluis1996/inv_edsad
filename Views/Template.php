<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestion</title>
    <link rel="stylesheet" href="Assets/css/global.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <?php
    if (isset($_SESSION['iniciarsesion']) && $_SESSION['iniciarsesion'] == 'ok') {
        echo '<div class="wrapper"> ';
        include "Modules/header.php";
        include "Modules/menu.php";
        if (isset($_GET['page'])) {
            if (
                $_GET['page'] == 'pageCambioEquipo'     ||
                $_GET['page'] == 'asignacionequipos'    || 
                $_GET['page'] == 'registroequipos'      ||
                $_GET['page'] == 'perfiles'             ||
                $_GET['page'] == 'Sede'                 ||
                $_GET['page'] == 'empleado'             ||
                $_GET['page'] == 'usuario'              ||
                $_GET['page'] == 'oficina'              ||
                $_GET['page'] == 'beneficiario'         ||
                $_GET['page'] == 'dashboard'            ||
                $_GET['page'] == 'historico'            ||
                $_GET['page'] == 'adquisicionequipos'   ||
                $_GET["page"] == "salir"
            ) {
                include "Pages/" . $_GET['page'] . ".php";
            } else {
                include "Modules/error.php";
            }
        } else {
            include 'Pages/dashboard.php';
        }
        echo '</div>';
    } else {
        include 'Pages/login.php';
    }

    ?>


    <?php include "Modules/foother.php"; ?>
    </div>
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

    <script src="Assets/js/sede.js"></script>
    <script src="Assets/js/empleado.js"></script>
    <script src="Assets/js/usuario.js"></script>
    <script src="Assets/js/oficina.js"></script>
    <script src="Assets/js/beneficiario.js"></script>
    <script src="Assets/js/asignacion_equipo.js"></script>
    <script src="Assets/js/equipo.js"></script>
    <script src="Assets/js/historico.js"></script>
    <script src="Assets/js/adquisicion.js"></script>

</body>

</html>