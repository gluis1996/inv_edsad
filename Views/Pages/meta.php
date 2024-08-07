<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Registro de Metas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Registro de Metas</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Formulario de registro Metas</h3>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-2">
                        <!-- Button trigger modal -->
                        <!-- Button registrar equipo -->
                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_meta">
                            Registrar Meta
                        </button>
                    </div>

                </div>

                <div class="col mt-5">
                    <label for="Datos Local">Registro de Metas</label>
                    <table class="table table-bordered table-striped dt-responsive" id="tb_lista_meta" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 10%; text-align: center;">ID META</th>
                                <th style="width: 50%; text-align: center;">NOMBRE</th>

                                <th style="width: 40%; text-align: center;">ACCIÓN</th>
                                <!-- donde iran los botones para cada fila eliminar Actualizar-->
                            </tr>
                        </thead>
                    </table>

                </div>

            </div>
        </div>

    </section>

</div>


<!-- Modal registrar Meta -->
<div id="modal_registrar_meta" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Meta</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_marca">Nombre Meta</label>
                    <input type="text" id="nombre_meta" class="form-control">
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_registrar_meta" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal listar empleado

<div id="modal_listar_empleado" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
  
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <label for="Datos Local">Registro de Empleados</label>
                <table class="table table-bordered table-striped dt-responsive w-100" id="tb_listar_equipo_empleados" style="margin: auto;">
                    <thead>
                        <tr>
                            <th style="width: 10%; text-align: center;">ID EMPLEADO</th>
                            <th style="width: 20%; text-align: center;">NOMBRE DEL EMPLEADO</th>
                            <th style="width: 10%; text-align: center;">NOMBRE EQUIPO</th>
                            <th style="width: 10%; text-align: center;">ID DETALLE ASIGNACIÓN</th>
                            <th style="width: 10%; text-align: center;">COD PATRIMONIAL</th>
                            <th style="width: 20%; text-align: center;">NOMBRE SEDE</th>
                            <th style="width: 20%; text-align: center;">NOMBRE OFICINA</th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_registrarEmpleado" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div> -->
