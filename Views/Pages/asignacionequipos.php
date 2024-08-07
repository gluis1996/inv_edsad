<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Equipos informáticos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Asigancion de Equipos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Formulario Asignación de Equipos</h3>
            </div>

            <div class="card-body" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <!-- ASIGNACION DE EQUIPOS -->
                <button type="button" class="btn btn-primary btn_modal_asignacion_mostrar" style="margin-top: 20px;">Registrar</button>

                <div class="row">
                    <div class="col mt-5" style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <label for="Datos Local" style="font-weight: bold; font-size: 18px;">Asignación de los Equipos</label>
                        <table class="table table-bordered table-striped dt-responsive" id="tb_asignacion_equipos" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">ID</th>
                                    <th style="width: 5%; text-align: center;">SEDES</th>
                                    <th style="width: 15%; text-align: center;">OFICINAS</th>
                                    <th style="width: 15%; text-align: center;">EQUIPOS</th>
                                    <th style="width: 10%; text-align: center;">USUARIOS</th>
                                    <th style="width: 10%; text-align: center;">EMPLEADOS</th>
                                    <th style="width: 5%; text-align: center;">COD P.</th>
                                    <th style="width: 5%; text-align: center;">VIDA UTÍL</th>
                                    <th style="width: 10%; text-align: center;">ESTADOS</th>
                                    <th style="width: 10%; text-align: center;">FECHA</th>
                                    <th style="width: 10%; text-align: center;">ACCION</th>
                                </tr>
                            </thead>
                            <!-- Contenido de la tabla -->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>



<div class="modal fade" id="modal_asignacion_editar" tabindex="-1" role="dialog" aria-labelledby="modal_asignacion_editar_Label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_asignacion_editar_Label">Editar Asignación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="modal_text_asig_id" readonly>
                        </div>
                        <div class="form-group">
                            <label for="sede">Sede</label>
                            <select id="modal_select_asig_sede" class="form-control custom-select">
                                <option value="0">Seleccionar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="oficina">Oficina</label>
                            <select id="modal_select_asig_oficina" class="form-control custom-select">
                                <option value="0">Seleccionar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="equipo">Equipo</label>
                            <input type="text" class="form-control" id="modal_text_asig_equipo" readonly>
                        </div>
                        <div class="form-group">
                            <label for="usuario">Usuario</label>
                            <input type="text" class="form-control" id="modal_text_asig_usuario" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="empleado">Empleado</label>
                            <select id="modal_select_asig_empleado" class="form-control custom-select">
                                <option value="0">Seleccionar</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="cod_patrimonial">COD Patrimonial</label>
                            <input type="text" class="form-control" id="modal_text_asig_cod_patrimonial" readonly>
                        </div>
                        <div class="form-group">
                            <label for="vida_util">Vida Útil</label>
                            <input type="text" class="form-control" id="modal_text_asig_vida_util">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select id="modal_select_asig_estado" class="form-control custom-select">
                                <option value="0">Seleccione</option>
                                <option value="OPERATIVO">OPERATIVO</option>
                                <option value="INOPERATIVO">INOPERATIVO</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fecha">Fecha</label>
                            <input type="date" class="form-control" id="modal_text_asig_fecha">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary modal_btn_editar_detalle" form="form_editar_asignacion">Guardar cambios</button>
            </div>
        </div>
    </div>
</div>

///modal registrar
<div class="modal fade" id="modal_asignacion_registrar" tabindex="-1" role="dialog" aria-labelledby="modal_asignacion_editar_Label" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_asignacion_editar_Label">Editar Asignación</h5>
                <button type="button" class="close" data-dismiss="modal" id aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <!-- Primera columna -->
                    <div class="col-md-6">
                        <!-- Sedes -->
                        <div class="form-group">
                            <label for="id_sede">Sedes</label>
                            <div class="input-group">
                                <select id="id_sede" class="form-control custom-select">
                                    <option value="0">Seleccionar</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                </div>
                            </div>
                        </div>

                        <!-- Equipos -->
                        <div class="form-group">
                            <label for="id_equipo">Equipos</label>
                            <div class="d-flex">
                                <div class="input-group mr-2">
                                    <select id="id_equipo_marca" class="form-control custom-select">
                                        <option value="0">Seleccione una Marca</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <select id="id_equipo" class="form-control custom-select">
                                        <option value="0">Seleccione un equipo</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Empleados -->
                        <div class="form-group">
                            <label for="id_empleado">Empleados</label>
                            <div class="input-group">
                                <select id="id_empleado" class="form-control custom-select">
                                    <option value="0">Seleccione</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                </div>
                            </div>
                        </div>

                        <!-- COD Patrimonial -->
                        <div class="form-group">
                            <label for="cod_patrimonial">COD Patrimonial</label>
                            <input type="text" id="cod_patrimonial" class="form-control">
                        </div>

                        
                    </div>

                    <!-- Segunda columna -->
                    <div class="col-md-6">
                        <!-- Oficinas -->
                        <div class="form-group">
                            <label for="id_oficina">Oficinas</label>
                            <div class="input-group">
                                <select id="id_oficina" class="form-control custom-select">
                                    <option value="0">Seleccionar</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                </div>
                            </div>
                        </div>

                        <!-- Estados -->
                        <div class="form-group">
                            <label for="id_estado">Estados</label>
                            <div class="input-group">
                                <select id="id_estado" class="form-control custom-select">
                                    <option value="0">Seleccione</option>
                                    <option value="OPERATIVO">OPERATIVO</option>
                                    <option value="INOPERATIVO">INOPERATIVO</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                </div>
                            </div>
                        </div>

                        <!-- Vida Útil -->
                        <div class="form-group">
                            <label for="vid_util">Vida Útil</label>
                            <input type="text" id="vid_util" class="form-control">
                        </div>

                        <!-- Fecha de Asignación -->
                        <div class="form-group">
                            <label for="fecha">Fecha de Asignación</label>
                            <input type="date" id="fecha" name="fecha" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary btnRegistrar_asignacion" style="margin-top: 20px;">Registrar</button>
            </div>
        </div>
    </div>
</div>