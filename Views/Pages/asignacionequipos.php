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
                <div class="row">
                    <!-- ASIGNACION DE EQUIPOS -->
                    <div class="row">
                        <!-- Primera columna -->
                        <div class="col-md-6">
                            <!-- Contenido de la primera columna -->
                            <!-- Sedes -->
                            <div class="form-group">
                                <label for="id_sede">Sedes</label>
                                <div class="input-group">
                                    <select id="id_sede" class="form-control custom-select">
                                        <option value="1">Seleccione</option>
                                        <option value="2">Sede 1</option>
                                        <option value="3">Sede 2</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Equipos -->
                            <div class="form-group">
                                <label for="id_equipo">Equipos</label>
                                <div class="input-group">
                                    <select id="id_equipo" class="form-control custom-select">
                                        <option value="1">Seleccione</option>
                                        <option value="2">Equipo 1</option>
                                        <option value="3">Equipo 2</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Empleados -->
                            <div class="form-group">
                                <label for="id_empleado">Empleados</label>
                                <div class="input-group">
                                    <select id="id_empleado" class="form-control custom-select">
                                        <option value="1">Seleccione</option>
                                        <option value="2">Empleado 1</option>
                                        <option value="3">Empleado 2</option>
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
                            
                            <!-- Fecha de Asignación -->
                            <div class="form-group">
                                <label for="fecha">Fecha de Asignación</label>
                                <input type="date" id="fecha" name="fecha" class="form-control">
                            </div>
                            
                        </div>

                        <!-- Segunda columna -->
                        <div class="col-md-6">
                            <!-- Contenido de la segunda columna -->
                            <!-- Oficinas -->
                            <div class="form-group">
                                <label for="id_oficina">Oficinas</label>
                                <div class="input-group">
                                    <select id="id_oficina" class="form-control custom-select">
                                        <option value="1">Seleccione</option>
                                        <option value="2">Oficina 1</option>
                                        <option value="3">Oficina 2</option>
                                    </select>
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-eye"></i></span>
                                    </div>
                                </div>
                            </div>

                            <!-- Usuarios -->
                            <div class="form-group">
                                <label for="id_usuario">Usuarios</label>
                                <div class="input-group">
                                    <select id="id_usuario" class="form-control custom-select">
                                        <option value="1">Seleccione</option>
                                        <option value="2">Usuario 1</option>
                                        <option value="3">Usuario 2</option>
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
                                        <option value="1">Seleccione</option>
                                        <option value="2">Estado 1</option>
                                        <option value="3">Estado 2</option>
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

                        </div>
                    </div>


                    <div class="col mt-5" style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <label for="Datos Local" style="font-weight: bold; font-size: 18px;">Asignación de los Equipos</label>
                        <table class="table table-bordered table-striped dt-responsive" id="asignacion_equipos" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%; text-align: center;">ID DETALLE</th>
                                    <th style="width: 10%; text-align: center;">SEDES</th>
                                    <th style="width: 10%; text-align: center;">OFICINAS</th>
                                    <th style="width: 10%; text-align: center;">EQUIPOS</th>
                                    <th style="width: 10%; text-align: center;">USUARIOS</th>
                                    <th style="width: 10%; text-align: center;">EMPLEADOS</th>
                                    <th style="width: 5%; text-align: center;">COD PATRIMONIAL</th>
                                    <th style="width: 5%; text-align: center;">VIDA UTÍL</th>
                                    <th style="width: 10%; text-align: center;">ESTADOS</th>
                                    <th style="width: 30%; text-align: center;">ACCION</th>
                                </tr>
                            </thead>
                            <!-- Contenido de la tabla -->
                        </table>
                    </div>
                </div>

                <button type="button" class="btn btn-primary" name="btnRegistrar" style="margin-top: 20px;">Registrar</button>
            </div>



        </div>
    </section>






    <!--Modal Listado consumo-->
    <div id="modal_estado_instalacion" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Estado</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            <label for="Datos Local">Consumo de Abonado</label>
                            <table class="table table-bordered table-striped dt-responsive" id="tbl_raddact_estado_instalacion" width="100%">
                                <thead>
                                    <tr>
                                        <th>IP Address</th>
                                        <th>Start Time</th>
                                        <th>Stop Time</th>
                                        <th>Total Time</th>
                                        <th>Upload (Bytes)</th>
                                        <th>Download (Bytes)</th>
                                        <th>Termination</th>
                                        <th>NAS IP Address</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>