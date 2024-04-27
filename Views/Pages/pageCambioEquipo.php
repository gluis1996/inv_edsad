<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>GESTION</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">GESTION</li>
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
                <div class="contenedor_tarjetas" id="dashboard_cambioequipo"></div>

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
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Ingrese el Codigo de Abonado"
                        aria-label="Ingrese el Codigo de Abonado" aria-describedby="basic-addon2" id="codAbonado">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-primary mb-2 btn_buscar_abonado">Buscar</button>
                        <button type="button" class="btn btn-success mb-2 btn_c_registrar_nuevo" data-toggle='modal' data-target='#modal_c_rigistro' ><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                    </div>
                </div>

                <div class="card">

                    <div class="row" style="margin-right: 5%; margin-left: 5%;">

                        <div class="col">
                            <label for="Datos Local">Busqueda Usuario en radius</label>
                            <table class="table table-bordered table-striped dt-responsive" id="tbl_radcheck"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 2%;">ID</th>
                                        <th style="width: 20%;">USERNAME</th>
                                        <th style="width: 10%;">VAUE</th>
                                        <th style="width: 20%;">PLAN</th>
                                        <th style="width: 5%;">ESTADO</th>
                                        <th style="width: 5%;">OLT</th>
                                        <th style="width: 5%;">NIVELES</th>
                                        <th style="width: 5%;">VLAN</th>
                                        <th style="width: 5%;">CATV</th>
                                        <th style="width: 600px;">ACCIONES</th>
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








<!--Modal Cambio de equipo-->
<div id="modal_detalle_cambioEquipo" data-backdrop="static" class="modal fade" role="dialog">
    <div class="modal-dialog modal-x modal-dialog-centered ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cambio de Equipo</h5>
                <button type="button" class="close cerrarmodal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="Datos Radius">Datos Radius</label>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">ID</label>
                            <div class="col-sm-8">
                                <input type="text" id="c_iduser" placeholder="ID" class="form-control" readonly>
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" id="c_username" placeholder="Username" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Mac</label>
                            <div class="col-sm-8">
                                <input type="text" id="c_mac" placeholder="Mac" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Grupo</label>
                            <div class="col-sm-8">
                                <select class="form-control" style="width: 100%; height: 100%;" id="ce_select"></select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">SN:</label>
                            <div class="col-sm-6">
                                    <input type="text" id="c_sn" placeholder="Mac" class="form-control">
                            </div>
                            <div class="col-sm-3">
                                <button type="button" class="btn btn-warning btn_actualizar_sn"><i class="fa fa-retweet" aria-hidden="true"></i></button>
                            </div>
                        </div>

                </div>                 

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrarmodal" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning btn_actualizar_radius">Actualizar</button>
            </div>
        </div>
    </div>
</div>


<!--Modal Listado consumo-->
<div id="modal_listado_consumo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cambio de Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="Datos Local">Consumo de Abonado</label>
                        <table class="table table-bordered table-striped dt-responsive" id="tbl_raddact" width="100%">
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


<!--Modal Registro de ATC-->
<div id="modal_registrar_atc" data-backdrop="static" class="modal fade" role="dialog">
    <div class="modal-dialog modal-s modal-dialog-centered ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Registro ATC</h5>
                <button type="button" class="close  cerrarmodalatc" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" >×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="Datos Radius">Datos Radius</label>
                        <label for="Datos Radius" id="abonado" > </label>
                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">OS</label>
                            <div class="col-sm-8">
                                <input type="text" id="atc_os" placeholder="os" class="form-control">
                                <input type="hidden" id="" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Tipo Orden</label>
                            <div class="col-sm-8" id="selecciondeaveria">
                                <select class="form-control" style="width: 100%; height: 100%;" id="atc_select2"></select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Area</label>
                            <div class="col-sm-8">
                                <select class="form-control" style="width: 100%; height: 100%;" id="atc_area">
                                    <option value="CALL">Call</option>
                                    <option value="Tecnico">Tecnico</option>
                                </select>
                            </div>
                        </div>

                    </div>

                    
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="atc_registrar_averia">Save Changes</button>
            </div>
        </div>
    </div>
</div>


<!--Modal Cambio de equipo-->
<div id="modal_c_rigistro" data-backdrop="static" class="modal fade" role="dialog">
    <div class="modal-dialog modal-x modal-dialog-centered ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cambio de Equipo</h5>
                <button type="button" class="close cerrarmodal" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col">
                        <label for="Datos Radius">Registrar Nuevamente</label>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">USERNAME</label>
                            <div class="col-sm-8">
                                <input type="text" id="c_iduser" placeholder="ID" class="form-control" readonly>
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label"></label>
                            <div class="col-sm-8">
                                <input type="text" id="c_username" placeholder="Username" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Mac</label>
                            <div class="col-sm-8">
                                <input type="text" id="c_mac" placeholder="Mac" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Grupo</label>
                            <div class="col-sm-8">
                                <select class="form-control" style="width: 100%; height: 100%;" id="ce_select"></select>
                            </div>
                        </div>

                </div>                 

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cerrarmodal" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-warning btn_actualizar_radius">Actualizar</button>
            </div>
        </div>
    </div>
</div>