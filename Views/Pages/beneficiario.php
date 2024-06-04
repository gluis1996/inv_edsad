<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTRO DE BENEFICIARIOS Y METAS</h1>
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
                    <!-- Column for Beneficiario -->
                    <div class="col-md-6">
                        <div class="col-12 mb-2">
                            <!-- Button para abrir el modal -->
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_beneficiario">
                                Registrar Beneficiario
                            </button>
                        </div>
                        <div class="card">
                            <div class="col">
                                <label for="Datos Local">Lista de Beneficiarios</label>
                                <table class="table table-bordered table-striped dt-responsive" id="tb_lista_beneficiario" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 15%; text-align: center;">ID BENEFICIARIO</th>
                                            <th style="width: 40%; text-align: center;">NOMBRES</th>
                                            <th style="width: 45%; text-align: center;">ACCION</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Column for Meta -->
                    <div class="col-md-6">
                        <div class="col-12 mb-2">
                            <!-- Button para abrir el modal -->
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_meta">
                                Registrar Meta
                            </button>
                        </div>
                        <div class="card">
                            <div class="col">
                                <label for="Datos Local">Registro de Metas</label>
                                <table class="table table-bordered table-striped dt-responsive" id="tb_lista_meta" width="100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%; text-align: center;">ID META</th>
                                            <th style="width: 50%; text-align: center;">NOMBRE</th>
                                            <th style="width: 40%; text-align: center;">ACCIÓN</th>
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
<div id="modal_registrar_beneficiario" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Beneficiario</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_marca">Nombre del Beneficiario</label>
                    <input type="text" id="nombre_beneficiario" class="form-control">
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_registrarBeneficiario" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar Beneficiario -->
<div id="modal_editar_beneficiario" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Beneficiario</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_marca">Nombre del Beneficiario</label>
                    <input type="text" id="modal_beneficiario_editar_nombre" class="form-control">
                    <input type="hidden" id="modal_beneficiario_id" value="">
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_editar_Beneficiario" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
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

<!-- Modal editar Meta -->
<div id="modal_editar_meta" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Editar Meta</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="">Nombre Meta</label>
                    <input type="text" id="modal_meta_editar_nombre" class="form-control">
                    <input type="hidden" id="modal_meta_id">
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_editar_meta" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>
