<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Averias</h1>
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
                <div class="card ">
                    <div class="row" style="margin-right: 5%; margin-left: 5%;">
                        <div class="col-lg-4 col-xs-10">
                            <label for="Datos Local">Instalacion EoC</label>

                            <div class="form-group row">
                                <label for="floatingTextarea" class="col-sm-2 col-form-label">Sede</label>
                                <div class="col-sm-10 area_filial"> </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">OS</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm" id="eoc_os" type="text"
                                        placeholder="OS">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">Codigo</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm" id="eoc_abonado" type="text"
                                        placeholder="Codigo">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">NODO</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm" id="eoc_nodo" type="text"
                                        placeholder="NODO">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">MAC</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm" id="eoc_mac" type="text"
                                        placeholder="MAC">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">VLAN</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm" id="eoc_vlan" type="number"
                                        placeholder="VLAN">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">SPEED</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm" id="eoc_speed" type="number"
                                        placeholder="SPEED">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-2 col-form-label">COORDENADAS</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm" id="eoc_coordenadas" type="text"
                                        placeholder="COORDENADAS">
                                </div>
                            </div>

                            <button type="button" class="btn btn-primary btn_instalarEoC">Save Changes</button>
                        </div>

                        <div class="col-lg-6 col-xs-10" style="margin-left: 10%;">
                            <label for="Datos Local">Instalacion EoC</label>
                            <table class="table table-bordered table-striped dt-responsive" id="tbl_instalacionesEoC"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th style="width: 5%;">ABONADO</th>
                                        <th style="width: 10%;">FILIAL</th>
                                        <th style="width: 10%;">FECHA</th>
                                        <th style="width: 5%;">ACCION</th>
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
<div id="modal_detalle_instalacion_EoC" class="modal fade" role="dialog">
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
                    <label for="staticEmail" class="col-sm-2 col-form-label">Plan</label>
                    <div class="col-sm-10">
                        <input class="form-control form-control-sm" id="plan" type="text" placeholder="Plan">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Filial</label>
                    <div class="col-sm-10">
                        <input class="form-control form-control-sm" id="filial" type="text" placeholder="Filial">
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