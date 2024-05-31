<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTROS DE UBICACIÓN Y ÁREA</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Registros</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
       
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Formulario de registros</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Column for sede -->
                    <div class="col-md-4">
                        <div class="col-12 mb-2">
                            <!-- Button to open the modal for registering Oficina -->
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_sede">
                                Registrar Nueva sede
                            </button>
                        </div>
                        <div class="card">
                            <div class="col">
                                <label for="Datos Local">Lista de Sedes</label>
                                <table class="table table-bordered table-striped dt-responsive" id="tb_lista_sede_oficina" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%; text-align: center;">ID</th>
                                            <th style="width: 25%; text-align: center;">NOMBRE</th>
                                            <!-- <th style="width: 25%; text-align: center;">SEDE</th> -->
                                            <th style="width: 40%; text-align: center;">ACCION</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Column for Oficina -->
                    <div class="col-md-4">
                        <div class="col-12 mb-2">
                            <!-- Button to open the modal for registering Oficina -->
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_oficina">
                                Registrar Nueva Oficina
                            </button>
                        </div>
                        <div class="card">
                            <div class="col">
                                <label for="Datos Local">Lista de Oficinas</label>
                                <table class="table table-bordered table-striped dt-responsive" id="tb_lista_oficina" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%; text-align: center;">ID</th>
                                            <th style="width: 25%; text-align: center;">NOMBRE</th>
                                            <th style="width: 25%; text-align: center;">SEDE</th>
                                            <th style="width: 40%; text-align: center;">ACCION</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Column for Área Usuaria -->
                    <div class="col-md-4">
                        <div class="col-12 mb-2">
                            <!-- Button to open the modal for registering Área Usuaria -->
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_ausuaria">
                                Registrar Área Usuaria
                            </button>
                        </div>
                        <div class="card">
                            <div class="col">
                                <label for="Datos Local">Lista de Áreas Usuarias</label>
                                <table class="table table-bordered table-striped dt-responsive" id="tb_lista_area" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%; text-align: center;">ID</th>
                                            <th style="width: 25%; text-align: center;">NOMBRE</th>
                                            <th style="width: 40%; text-align: center;">ACCION</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
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
<div id="modal_registrar_sede" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Sede</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_marca">Nombre de la Sede</label>
                    <input type="text" id="nombre_sede" class="form-control">
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_registrarSede" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal registrar oficina -->
<div id="modal_registrar_oficina" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Oficina</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_marca">Nombre de la Oficina</label>
                    <input type="text" id="nombre_oficina" class="form-control">
                </div>

                <div class="form-group">
                    <label for="id_oficina_select">Sedes</label>
                    <div class="input-group">
                        <select id="id_oficina_select_2" class="form-control custom-select">
                            <option value="0">Selecccione</option>
                        </select>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_registrarOficina" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal registrar area usuaria -->
<div id="modal_registrar_ausuaria" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registar Área usuaria</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_marca">Nombre de Área</label>
                    <input type="text" id="nombre_a_usuaria" class="form-control">
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_registrarAreaUsuaria" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>