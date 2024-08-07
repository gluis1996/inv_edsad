<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Incidencias</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Historico Equipos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="form-row">
            <div class="card" style="width: 100%;">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Lista de Incidencias</h3>
                </div>

                <div class="card-body">
                    <div class="form-row">
                        <div class="col">
                            <input type="text" class="form-control form-control-sm" id="h_id_historico" placeholder="Buscar equipo x Codigo Patrimonial">
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-success btn-sm mb-2 btn_buscar_historico">Buscar</button>
                            <button type="button" class="btn btn-success btn-sm mb-2 btn_buscar_historico" data-toggle="modal" data-target="#modal_registrar_incidencia">+</button>
                            <button type="button" class="btn btn-primary btn-sm mb-2 btn_listar_ticket_abiertos">abierto</button>
                            <button type="button" class="btn btn-danger btn-sm mb-2 btn_listar_ticket_en_proceso">en proceso</button>
                            <button type="button" class="btn btn-success btn-sm mb-2 btn_listar_ticket_cerrados">cerrado</button>
                        </div>
                    </div>

                    <!-- <div class="col mt-5">
                        <div class="row row-cols-1 row-cols-md-4" id="contenedor_tarjetas">

                        </div>
                    </div> -->
                </div>
            </div>


        </div>

        <div class="card">
            <div class="card-body">
                
                
                    <table class="table table-bordered table-striped dt-responsive" style="width:100%; font-size: 12px;" id="tablaticket">
                        <thead>
                            <tr>
                                <th style="text-align: center;">ID</th>
                                <th style="text-align: center;">TITULO</th>
                                <th style="text-align: center;">DESCRIPCION</th>
                                <th style="text-align: center;">ESTADO</th>
                                <th style="text-align: center;">PRIORIDAD</th>
                                <th style="text-align: center;">CREADO POR</th>
                                <th style="text-align: center;">ASGINADO A</th>
                                <th style="text-align: center;">EQUIPO</th>
                                <th style="text-align: center;">F. CREADO</th>
                                <th style="text-align: center;">F. ACTUALIZADO</th>
                                <th style="text-align: center;">ACCIONES</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                
            </div>
        </div>

    </section>

</div>



<!-- Modal registrar incidencia -->
<div id="modal_registrar_incidencia" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Cargo</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-row">
                    <div class="col">
                        <input type="text" class="form-control" id="codigo_patrimonial_buscar" placeholder="Buscar equipo x Codigo Patrimonial">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-success mb-2 btn_buscar_equipo_asigando">Buscar</button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text">Empleado</span>
                        <input type="text" aria-label="Sizing example input" id="ticket_nombre_empleado" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text">Cod. Patri.</span>
                        <input type="text" aria-label="Sizing example input" id="ticket_cod_patrimonial" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text">Equipo</span>
                        <input type="text" aria-label="Sizing example input" id="ticket_nombre_equipo" class="form-control">
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text">Fecha</span>
                        <input type="date" class="form-control" id="ticket_fecha">
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text">Titulo</span>
                        <input type="text" class="form-control" id="ticket_titulo">
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text">Descripcion</span>
                        <input type="text" class="form-control" id="ticket_descripcion">
                    </div>
                    <div class="input-group input-group-sm mb-1">
                        <span class="input-group-text">Asignar</span>
                        <select class="form-control" name="" id="ticket_asignacion">
                            <option value="" selected>seleccione</option>
                            <option value="a">seleccion a</option>
                            <option value="b">seleccion a</option>
                            <option value="c">seleccion a</option>
                            <option value="d">seleccion a</option>
                        </select>
                    </div>
                </div>

                <!-- <div class="col mt-5">
                    <div class="form-group">
                        <label for="incidencia_detalle">Detalle</label>
                        <textarea id="incidencia_detalle" class="form-control" name="" rows="3"></textarea>

                        <button type="button" class="form-control btn btn-success btn_registrar_incidencias">Registrar</button>
                    </div>
                </div> -->
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_registrar_ticket">Registrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal detalle incidencia -->
<div class="modal fade" id="modal_detalle_incidencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTicketModalLabel">Editar Ticket de Atención</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="asunto">Asunto</label>
                                <input type="text" class="form-control" id="asunto" value="12-018" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="codigoAbonado">Código del abonado</label>
                                <input type="text" class="form-control" id="codigoAbonado">
                            </div>
                            <div class="form-group col-md-4">
                                <label for="horaInicio">Hora de Inicio</label>
                                <input type="text" class="form-control" id="horaInicio" value="11:03">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="area">Área <span class="text-danger">*</span></label>
                                <select id="area" class="form-control">
                                    <option selected>PE</option>
                                    <!-- Otras opciones -->
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="motivo">Motivo <span class="text-danger">*</span></label>
                                <select id="motivo" class="form-control">
                                    <option selected>Avería</option>
                                    <!-- Otras opciones -->
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="fecha">Fecha</label>
                                <input type="text" class="form-control" id="fecha" value="02/08/2024">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="submotivo">Submotivo <span class="text-danger">*</span></label>
                                <select id="submotivo" class="form-control">
                                    <option selected>Caída de servicio</option>
                                    <!-- Otras opciones -->
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="estado">Estado <span class="text-danger">*</span></label>
                                <select id="estado" class="form-control">
                                    <option selected>Pendiente</option>
                                    <!-- Otras opciones -->
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="solicitante">Solicitante</label>
                                <input type="text" class="form-control" id="solicitante">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="servicio">Servicio <span class="text-danger">*</span></label>
                                <select id="servicio" class="form-control">
                                    <option selected>EoC</option>
                                    <!-- Otras opciones -->
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="operador">Operador</label>
                                <input type="text" class="form-control" id="operador" value="Luis Gonzalo" disabled>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="lugar">Lugar <span class="text-danger">*</span></label>
                                <select id="lugar" class="form-control">
                                    <option selected>Chosica</option>
                                    <!-- Otras opciones -->
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label for="detalle">Detalle <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="detalle" rows="3">Detalle del trabajo</textarea>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label>Mensajes anteriores</label>
                                <p>Carlos Sánchez dijo: CAIDA MASTER 12-018</p>
                                <small>Escrito el 2024-08-02 11:03:56</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">EDITAR</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </div>
        </div>
</div>

<!-- Modal historial incidencia -->
<div class="modal fade" id="modal_activity_incidencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title" id="detalle_title">ACtividad incidencia</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-activity" style="font-size: 12px;">
                    <!-- ------- -->
                </div>
            </div>

            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal asignar incidencia -->
<div class="modal fade" id="modal_asignacion_incidencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title" id="detalle_title">Asignar a un personal</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body">
                <div class="card-activity" style="font-size: 12px;">
                    <div class="form-group">
                        <label for="my-select">Seleccione a un encargado</label>
                        <select id="ticket_asignacion_empleado" class="form-control" name=""> </select>
                        <input type="hidden" id="id_oculto_canbio">
                    </div>
                </div>
            </div>

            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm" id="btn_tiket_asignar">Asignar</button>
            </div>
        </div>
    </div>
</div>