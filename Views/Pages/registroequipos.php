<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTRO DE EQUIPOS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Registro</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="d-flex justify-content-center align-items-center h-100">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Formulario de registro equipos</h3>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-14">
                            <div class="col-12 mb-2">
                                <!-- Botones registradores -->
                                <div class="d-flex justify-content-start">
                                    <button type="button" class="btn btn-primary mr-2 btn_modal_registrar">
                                        Registrar Equipo
                                    </button>
                                    <button type="button" class="btn btn-primary btn_equipo_rgistrar_marca">
                                        Registrar Marca
                                    </button>
                                </div>
                            </div>
                            <div class="card">
                                <div class="col">
                                    <label for="Datos Local">Equipos registrados</label>
                                    <table class="table table-bordered table-striped dt-responsive mx-auto" id="tb_listar_equipos" width="100%">
                                        <thead>
                                            <tr>
                                                <th style="width: 5%; text-align: center;">ID EQUIPOS</th>
                                                <th style="width: 15%; text-align: center;">MODELO</th>
                                                <th style="width: 25%; text-align: center;">DESCRIPCIÓN</th>
                                                <th style="width: 10%; text-align: center;">FECHA DE REGISTRO</th>
                                                <th style="width: 15%; text-align: center;">MARCA</th>
                                                <th style="width: 20%; text-align: center;">ACCIÓN</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Modal registrar equipos-->
    <div class="modal fade" id="modal_equipo_registrar" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 10px;">
                <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                    <h5 class="modal-title" id="exampleModalLabel">Registrar Equipos Informáticos</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <!-- INICIO -->
                    <div class="form-group">
                        <label for="cod_patrimonial">Modelo</label>
                        <input type="text" id="modal_equipo_modelo" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="cod_patrimonial">Descripcion</label>
                        <input type="text" id="modal_equipo_descripcion" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="fecha">Fecha de Registro</label>
                        <input type="date" id="modal_equipo_fecha" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="modal_select_id_marca">Marca</label>
                        <div class="input-group">
                            <select id="modal_select_id_marca" class="form-control custom-select">
                                <option value="1">Selecccione</option>
                            </select>
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-eye"></i></span>
                            </div>
                        </div>
                    </div>
                    <!-- FIN  -->
                </div>
                <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                    <button type="button" class="btn btn-primary btn_regitrar_equipo" style="background-color: #007bff; color: #fff;">Registrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


<!-- Modal registrar marca -->
<div id="modal_registrar_marca" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Marca</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_marca">Nombre de la Marca</label>
                    <input type="text" id="modal_nombre_marca" class="form-control">
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary btn_registrar_marca" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal editar modelo -->
<div class="modal fade" id="modal_editar_equipo">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel">Editar Modelo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 20px;">
                <!-- INICIO -->
                <div class="form-group">
                    <label for="cod_patrimonial">ID Equipo</label>
                    <input type="text" id="modal_idequipo_editar_modelo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="cod_patrimonial">Modelo</label>
                    <input type="text" id="modal_equipo_editar_modelo" class="form-control">
                </div>

                <div class="form-group">
                    <label for="cod_patrimonial">Descripcion</label>
                    <input type="text" id="modal_equipo_editar_descripcion" class="form-control">
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha de Registro</label>
                    <input type="date" id="modal_equipo_editar_fecha" class="form-control">
                </div>

                <div class="form-group">
                    <label for="modal_select_id_marca">Marca</label>
                    <div class="input-group">
                        <select id="modal_equipo_editar_select_id_marca" class="form-control custom-select">
                            <option value="0">Selecccione</option>
                        </select>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>
                <!-- FIN  -->
            </div>

            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary btn_editar_equipo" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>