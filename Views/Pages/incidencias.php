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
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-dark text-white">
                        <h1 class="card-title">Registrar Incidencias</h1>
                    </div>

                    <div class="card-body">

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
                </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h3 class="card-title">Lista de Incidencias</h3>
                    </div>

                    <div class="card-body">
                        <div class="form-row">
                            <div class="col">
                                <input type="text" class="form-control" id="h_id_historico" placeholder="Buscar equipo x Codigo Patrimonial">
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-success mb-2 btn_buscar_historico">Buscar</button>
                            </div>
                        </div>

                        <div class="col mt-5">
                            <div class="form-row" id="contenedor_tarjetas">
                                                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

</div>