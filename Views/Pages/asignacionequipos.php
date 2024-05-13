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
                <h3 class="card-title">Formulario Equipos</h3>
            </div>

            <div class="card-body" style="background-color: #f8f9fa; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <div class="row">
                    <!-- ASIGNACION DE EQUIPOS -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_oficina">ID Oficina</label>
                            <select class="form-control" id="id_oficina">
                                <option value="">Seleccione</option>
                                <option value="002">002</option>
                                <option value="001">001</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_empleado">ID Empleados</label>
                            <select class="form-control" id="id_empleado">
                                <option value="">Seleccione</option>
                                <option value="002">002</option>
                                <option value="001">001</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_equipos">ID Equipos</label>
                            <select class="form-control" id="id_equipos">
                                <option value="">Seleccione</option>
                                <option value="002">002</option>
                                <option value="001">001</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_usuario">ID usuario</label>
                            <select class="form-control" id="id_usuario">
                                <option value="">Seleccione</option>
                                <option value="002">002</option>
                                <option value="001">001</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha de Asignación</label>
                            <input type="date" id="fecha" name="fecha" class="form-control">
                        </div>
                    </div>

                    <div class="col mt-5" style="background-color: #fff; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <label for="Datos Local" style="font-weight: bold; font-size: 18px;">Asignación de los Equipos</label>
                        <table class="table table-bordered table-striped dt-responsive" id="asignacion_equipos" width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 15%; text-align: center;">ID OFICINA</th>
                                    <th style="width: 15%; text-align: center;">ID EMPLEADO</th>
                                    <th style="width: 15%; text-align: center;">ID EQUIPOS</th>
                                    <th style="width: 15%; text-align: center;">ID USUARIO</th>
                                    <th style="width: 15%; text-align: center;">FECHA DE ASIGNACIÓN</th>
                                    <th style="width: 25%; text-align: center;">ACCION</th>
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