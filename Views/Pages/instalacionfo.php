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
                        <li class="breadcrumb-item active">Instalacion FTTH</li>
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
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- <label for="cod_pat">Código Patrimonial</label> -->

                            <label for="cod_pat">
                              
                                <i class="fa fa-id-badge" aria-hidden="true">&nbsp;Código Patrimonial</i> 
                                <!-- <i class="fa fa-id-card-o" aria-hidden="true">&nbsp;Código Patrimonial</i> -->
                            </label>

                            <input type="text" id="cod_pat" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="mt">Meta</label>
                            <input type="text" id="mt" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="vd_util">Vida útil</label>
                            <input type="text" id="vd_util" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="id_oficina">Estados</label>
                            <select class="form-control" id="estados">
                                <option value="">Seleccione</option>
                                <option value="002">002</option>
                                <option value="001">001</option>
                            </select>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="id_prod">ID Producto</label>
                            <select class="form-control" id="id_prod">
                                <option value="">Seleccione</option>
                                <option value="002">002</option>
                                <option value="001">001</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_oficina">ID Oficina</label>
                            <select class="form-control" id="id_oficina">
                                <option value="">Seleccione</option>
                                <option value="002">002</option>
                                <option value="001">001</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_usuario">ID Usuario</label>
                            <select class="form-control" id="id_usu">
                                <option value="">Seleccione</option>
                                <option value="002">002</option>
                                <option value="001">001</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="id_beneficiario">ID Benediciario</label>
                            <select class="form-control" id="id_usu">
                                <option value="">Seleccione</option>
                                <option value="002">002</option>
                                <option value="001">001</option>
                            </select>
                        </div>

                    </div>
                </div>
                <button type="button" class="btn btn-primary" name="btnRegistrar">Registrar</button>

            </div>
        </div>


        <!--Modal detalle instalacion-->
        <div id="modal_detalle_instalacion" class="modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Detalle</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Codigo</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="nodo" type="text" placeholder="Nodo">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Caja</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="caja" type="text" placeholder="Caja">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Borne</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="borne" type="text" placeholder="Borne">
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Precinto</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="precinto" type="text" placeholder="Precinto">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">MAC</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="plan" type="text" placeholder="MAC">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">Filial</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" id="filial" type="text" placeholder="Filial" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary btn_instalacion_fo_editar">Editar</button>
                    </div>
                </div>
            </div>
        </div>





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