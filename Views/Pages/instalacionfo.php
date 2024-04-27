<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Instalacion FTTH</h1>
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

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <!-- <h3 class="card-title">OLT : </h3> -->

                <div class="contenedor_tarjetas" id="dashboard">
                </div>


                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="card">
                    <div class="row" style="padding-top: 1%;">
                        <div class="col-lg-4 col-xs-5" style="margin-right: 5%; margin-left: 5%;">
                            <label for="Datos Local">Formulario FTTH</label>

                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-3 col-form-label">Sede</label>
                                <div class="col-sm-4 area_filial">
                                    <select class="form-control  slfilial" id="FL" ></select>
                                </div>
                                <div class="col-sm-3 ">
                                    <select class="form-control " id="sl_tipoont" >
                                        <option value="">Seleccione</option>
                                        <option value="CATV1">CATV1</option>
                                        <option value="CABLEPERU">CABLEPERU</option>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-3 col-form-label">Orden Trabajo</label>
                                <div class="col-sm-8">
                                    <input type="text" name="" id="os" class="form-control">
                                </div>

                            </div>




                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-3 col-form-label">Abonado</label>
                                <div class="col-sm-8">
                                    <input type="text" name="" id="codAbonado" placeholder="codigo abonado"
                                        class="form-control">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-3 col-form-label">Codigo</label>
                                <div class="col-sm-8">
                                    <input type="text" name="" id="codAcceso" placeholder="Codigo Acceso"
                                        class="form-control" readonly=true>
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-3 col-form-label">Caja</label>
                                <div class="col-sm-8">
                                    <input type="text" name="" id="Caja" placeholder="Caja" class="form-control">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-3 col-form-label">Borne</label>
                                <div class="col-sm-8">
                                    <input type="text" name="" id="Borne" placeholder="Borne" class="form-control">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-3 col-form-label">Precinto</label>
                                <div class="col-sm-8">
                                    <input type="text" name="" id="Precinto" placeholder="Precinto"
                                        class="form-control">
                                </div>
                            </div>



                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-3 col-form-label">Mac</label>
                                <div class="col-sm-8">
                                    <input type="text" id="Mac" placeholder="Mac" class="form-control">
                                </div>
                                <div class="col" id="loading-icon" style="display: none;">
                                    <i class="fas fa-spinner fa-spin"></i>...
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-3 col-form-label">Vlan</label>
                                <div class="col-sm-8">
                                    <input type="Number" name="" id="Vlan" placeholder="Vlan" class="form-control">
                                </div>
                            </div>


                            <div class="form-group row">
                                <label for="Speed" class="col-sm-3 col-form-label">Speed</label>
                                
                                <div class="col">
                                    <input type="Number" name="Speed" id="Speed" placeholder="Speed"
                                        class="form-control">
                                </div>
                                <div class="col" style="margin-left: 10px;">
                                    <input type="checkbox" class="form-check-input" name="CATV" id="CATV"
                                        value="CATV">
                                    <label for="CATV">CATV</label>
                                </div>
                                
                            </div>

                            <div class="form-group row " id="mostrar_resultado">
                            </div>

                            <div class="form-group row" id="mostrar_datos_seleccionado">
                            </div>

                            <div class="form-group">
                                <button type="button" class="guardar btn btn-primary" id="btnenviar" disabled>Save
                                    changes</button>
                                <div id="loading-icon-sv" style="display: none;">
                                    <i class="fas fa-spinner fa-spin"></i>
                                </div>
                            </div>


                        </div>

                        <div class="col-lg-5 col-xs-5">
                            <label for="Datos Local">Lista Instalaciones</label>
                            <table id="tb_instalaciones" class="table table-bordered table-striped dt-responsive"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width: 10%;">Abonado</th>
                                        <th>Filial</th>
                                        <th>Fecha</th>
                                        <th style="width: 50px;">Accion</th>
                                    </tr>
                                </thead>
                            </table>

                        </div>
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
