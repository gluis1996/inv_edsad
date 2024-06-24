<!-- Content Wrapper. Contains page content -->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTROS DE USUARIOS Y EMPLEADOS</h1>
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

                    <!-- Column for Registro de Usuarios -->
                    <div class="col-md-3">
                        <div class="col-12 mb-2">
                            <!-- Button para abrir el modal -->
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_usuario">
                                Registrar Nuevo Usuario
                            </button>
                        </div>
                        <div class="card">
                            <div class="col">
                                <label for="Datos Local" class="d-block">Lista de Usuarios</label>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped dt-responsive mx-auto" id="tb_lista_usuario" width="100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>NOMBRE</th>
                                                <th>USER</th>
                                                <th>CONTRASEÑA</th>
                                                <th>ACCION</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Column for registro de empleado -->
                    <div class="col-md-9">
                        <div class="col-12 mb-2">
                            <!-- Button to open the modal for registering Empleado -->
                            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_empleado">
                                Registrar Empleado
                            </button>
                        </div>
                        <div class="card">
                            <div class="col">
                                <label for="Datos Local">Registro de Empleados</label>
                                <table class="table table-bordered table-striped dt-responsive" id="tb_registrar_empleados" width="100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>NOMBRE</th>
                                            <th>DNI</th>
                                            <th>NUMERO</th>
                                            <th>CORREO</th>
                                            <th>CARGO</th>
                                            <th>DIRECCION</th>
                                            <th>CONTRATO</th>
                                            <th>#</th>
                                            <th>ACCIÓN</th>
                                            <!-- donde iran los botones para cada fila eliminar Actualizar-->
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Column for other content -->
                    <div class="col-md-8">
                        <!-- Other content goes here -->
                    </div>
                </div>
            </div>

        </div>

    </section>

</div>



<!-- Modal registrar empelado -->
<div id="modal_registrar_empleado" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Empleado</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">

                <!-- formulario -->
                <form>
                    <div class='form-row'>
                        <div class="col-md-6 mb-3">
                            <label for="nombre_marca">Nombre del Empleado</label>
                            <input type="text" id="em_nombre_empleado" class="form-control">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nombre_marca">Apellido del Empleado</label>
                            <input type="text" id="em_apellido_empleado" class="form-control">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="DNI">DNI</label>
                        <input type="text" id="em_dni" class="form-control">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>


                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="nombre_marca">Numero</label>
                            <input type="text" id="em_numero" class="form-control">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="fecha">Fecha</label>
                            <input type="date" id="em_fecha" class="form-control">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="DNI">Correo Personal</label>
                        <input type="text" id="em_correo_personal" class="form-control">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="DNI">Correo Institucional</label>
                        <input type="text" id="em_correo-institucional" class="form-control">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="cargo">Cargo</label>
                            <select id="em-select-cargo" class="form-control"></select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="tipo_contrato">Tipo Contrato</label>
                            <select id="em-tipo_contrato" class="form-control"></select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <select id="em-select-direccion" class="form-control"></select>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                </form>

            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="btn_registrarEmpleado" style="background-color: #007bff; color: #fff;" disabled>Registrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal editar empelado -->
<div id="modal_editar_empleado" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title" id="em_edi_titulo">Editar Empleado</h5>
                <input type="hidden" id="em_edit_codigo">
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">

                <!-- formulario -->
                <form>
                    <div class='form-row'>
                        <div class="col-md-6 mb-3">
                            <label for="nombre_marca">Nombre del Empleado</label>
                            <input type="text" id="em_edi_nombre_empleado" class="form-control">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="nombre_marca">Apellido del Empleado</label>
                            <input type="text" id="em_edi_apellido_empleado" class="form-control">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-3">
                            <label for="DNI">DNI</label>
                            <input type="text" id="em_edi_dni" class="form-control" disabled>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-3">
                            <label for="Numero">Numero</label>
                            <input type="text" id="em_edi_numero" class="form-control">
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-2">
                            <label for="dia">Dia</label>
                            <select name="dia" id="em_edi_dia" class="form-control">
                                <option value="">SELECCIONE</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-4">
                            <label for="enero">Enero</label>
                            <select name="dia" id="em_edi_mes" class="form-control">
                                <option value="">SELECCIONE</option>
                                <option value="ENERO">ENERO</option>
                                <option value="FEBRERO">FEBRERO</option>
                                <option value="MARZO">MARZO</option>
                                <option value="ABRIL">ABRIL</option>
                                <option value="MAYO">MAYO</option>
                                <option value="JUNIO">JUNIO</option>
                                <option value="JULIO">JULIO</option>
                                <option value="AGOSTO">AGOSTO</option>
                                <option value="SEPTIEMBRE">SEPTIEMBRE</option>
                                <option value="OCTUBRE">OCTUBRE</option>
                                <option value="NOVIEMBRE">NOVIEMBRE</option>
                                <option value="DICIEMBRE">DICIEMBRE</option>
                            </select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="DNI">Correo Personal</label>
                        <input type="text" id="em_edi_correo_personal" class="form-control">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group">
                        <label for="DNI">Correo Institucional</label>
                        <input type="text" id="em_edi_correo-institucional" class="form-control">
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6">
                            <label for="cargo">Cargo</label>
                            <select id="em_edi_select_cargo" class="form-control"></select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="tipo_contrato">Tipo Contrato</label>
                            <select id="em_edi_tipo_contrato" class="form-control"></select>
                            <div class="valid-feedback"></div>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="direccion">Direccion</label>
                        <select id="em_edi_select_direccion" class="form-control"></select>
                        <div class="valid-feedback"></div>
                        <div class="invalid-feedback"></div>
                    </div>

                </form>

            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="submit" class="btn btn-primary" id="btn_editarEmpleado" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>


<!-- Modal listar empleado -->
<div id="modal_listar_empleado" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <!-- Cambiado a modal-lg para un tamaño más grande -->
        <!-- Modal content -->
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
                            <th style="width: 10%; text-align: center;">EQUIPO</th>
                            <th style="width: 10%; text-align: center;">ID ASIG</th>
                            <th style="width: 10%; text-align: center;">COD PATRI</th>
                            <th style="width: 20%; text-align: center;">SEDE</th>
                            <th style="width: 20%; text-align: center;">OFICINA</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal registrar usuario -->
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
                    <label for="nombre_marca">Contraseña</label>
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


<!-- Modal editar Usuario-->
<div id="modal_editar_usuario" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="idusuario">ID Usuario</label>
                    <input type="text" id="modal_edit_id_usuario" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombre_marca">Nombres</label>
                    <input type="text" id="modal_edit_nombre_usuario" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombre_marca">User</label>
                    <input type="text" id="modal_edit_user_usuario" class="form-control">
                </div>

                <div class="form-group">
                    <label for="nombre_marca">Contraseña</label>
                    <input type="text" id="modal_edit_user_contraseña" class="form-control">
                </div>

            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_modal_editar_usuario" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>