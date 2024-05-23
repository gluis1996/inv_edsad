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
                                    <th style="width: 10%; text-align: center;">ID OFICINA</th>
                                    <th style="width: 25%; text-align: center;">NOMBRE</th>
                                    <th style="width: 25%; text-align: center;">SEDE</th>
                                    <th style="width: 40%; text-align: center;">ACCION</th>
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
                    <label for="id_sede">Sedes</label>
                    <div class="input-group">
                        <select id="id_sede" class="form-control custom-select">
                            <option value="1">Selecccione</option>
                            <option value="2">Sede 1</option>
                            <option value="3">Sede 2</option>
                
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