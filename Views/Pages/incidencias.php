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
            <div class="card">
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
                        </div>
                    </div>

                    <div class="col mt-5">
                        <div class="row row-cols-1 row-cols-md-4" id="contenedor_tarjetas">

                        </div>
                    </div>
                </div>
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
                        <input type="text" class="form-control" id="h_id_historico" placeholder="Buscar equipo x Codigo Patrimonial" value="303030303030CD">
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-success mb-2 btn_buscar_historico">Buscar</button>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col mt-6">
                        <label for="nombre">Empleado</label> <br>
                        <label for="nombre">Luis Miguel Gonzalo Valdez</label>
                    </div>
                    <div class="col mt-6">
                        <label for="nombre">Area</label> <br>
                        <label for="nombre">JEFATURA DE LA CARRERA PROFESIONAL DE FRMACIÓN ARTÍSTICA ,
                            ESPECIALIDAD TEATRO MENCIÓN DISEÑO ESCENOGRÁFICO</label>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col mt-6">
                        <label for="nombre">Equipo</label> <br>
                        <label for="nombre">GWN7610 PUNTO DE ACCESO INALAMBRICO - ACCESS POINT WIRELESS GRANDSTREAM</label>
                    </div>
                    <div class="col mt-6">
                        <label for="fechas">Fechas</label>
                        <div class="form-row">
                            <div class="col">
                                <label for="incio">Inicio</label>
                                <input type="date" class="form-control" name="" id="">
                            </div>
                        </div>
                    </div>
                </div>



                <div class="col mt-5">
                    <label for="Datos Local">Detalle</label>
                    <div class="form-group">
                        <label for="incidencia_detalle">Detalle</label>
                        <textarea id="incidencia_detalle" class="form-control" name="" rows="3"></textarea>

                        <button type="button" class="form-control btn btn-success btn_registrar_incidencias">Registrar</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btn_registrar_incidencia">Registrar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal detalle incidencia -->
<div class="modal fade" id="modal_detalle_incidencia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Detalle incidencia Ticket #123 </h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body">
                <div id="detalles_ticket">
                    <!-- <p><strong>Título:</strong> Problema con el monitor</p>
                    <p><strong>Descripción:</strong> El monitor parpadea al encenderlo.</p>
                    <p><strong>Categoría:</strong> Hardware</p>
                    <p><strong>Prioridad:</strong> Alta</p>
                    <p><strong>Asignado a:</strong> Juan Pérez</p>
                    <p><strong>Creado por:</strong> María López</p>
                    <p><strong>Estado:</strong> En Proceso</p>

                    <div class="card-comments" style="font-size: 11px;">
                        <h5>Comentarios</h5>
                        <ul class="list-unstyled">
                            <li class="media">
                                <label for="fecha" class="mr-2">2020-02-20</label>
                                <div class="media-body">
                                    <p>All my girls vintage Chanel baby. So you can have your cake. Tonight, tonight, tonight.</p>
                                </div>
                            </li>
                            <li class="media">
                                <label for="fecha" class="mr-2">2020-02-20</label>
                                <div class="media-body">
                                    <p>Maybe a reason why all the doors are closed. Cause once you’re mine, once you’re mine.</p>
                                </div>
                            </li>
                            <li class="media">
                                <label for="fecha" class="mr-2">2020-02-20</label>
                                <div class="media-body">
                                    <p>Are you brave enough to let me see your peacock? There’s no going back.</p>
                                </div>
                            </li>
                            <li class="media">
                                <label for="fecha" class="mr-2">2020-02-20</label>
                                <div class="media-body">
                                    <p>All my girls vintage Chanel baby. So you can have your cake. Tonight, tonight, tonight.</p>
                                </div>
                            </li>
                            <li class="media">
                                <label for="fecha" class="mr-2">2020-02-20</label>
                                <div class="media-body">
                                    <p>Maybe a reason why all the doors are closed. Cause once you’re mine, once you’re mine.</p>
                                </div>
                            </li>
                            <li class="media">
                                <label for="fecha" class="mr-2">2020-02-20</label>
                                <div class="media-body">
                                    <p>Are you brave enough to let me see your peacock? There’s no going back.</p>
                                </div>
                            </li>
                        </ul>

                        <form class="form-inline">
                            <textarea name="comentario" class="form-group mr-2" required></textarea>
                            <button type="submit" class="btn btn-primary mb-2 btn-sm">Añadir Comentario</button>
                        </form>
                    </div> -->
                </div>
            </div>
            
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary btn-sm" id="####">Registrar</button>
            </div>
        </div>
    </div>
</div>
