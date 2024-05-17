
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DASHBOARD</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DASHBOARD</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">

            </div>
            <div class="card-body">

                <div class="col-2">
                    <!-- Button para abrir el modal -->
                    <button type="button" class="btn btn-primary mb-2"  data-toggle="modal" data-target="#modal_registrar_usuario">
                        Registrar Nuevo Usuario
                    </button>
                </div>


                <div class="card">
                    <div class="col">
                        <label for="Datos Local">Lista de Usuarios</label>
                        <table class="table table-bordered table-striped dt-responsive" id="tb_lista_usuario" width="100%">
                            <thead>
                                <tr>
                                <th style="width: 5%; text-align: center;">ID USUARIO</th>
                                <th style="width: 30%; text-align: center;">NOMBRE DEL USUARIO</th>
                                <th style="width: 15%; text-align: center;">USER</th>
                                <th style="width: 15%; text-align: center;">CONTRASEÑA</th>
                                <th style="width: 35%; text-align: center;">ACCION</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                Footer
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>


<!-- Modal registrar Sede -->
<div id="modal_registrar_usuario" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_marca">Nombres</label>
                    <input type="text" id="nombre_usuario" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombre_marca">User</label>
                    <input type="text" id="user" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombre_marca">Constraseña</label>
                    <input type="password" id="contraseña" class="form-control">
                </div>

            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_registrar_usuario" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>