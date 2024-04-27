<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buscar Abonado</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buscar Abonado</li>
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
                <h3 class="card-title">Busque por Codigo, Mac, Nodo</h3>

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

                    <div class="row">

                        <div class="col-lg-2">
                            <div class="form-floating">
                                <textarea class="form-control" placeholder="Leave a comment here" id="ba_abonado" style="height: 200px;"></textarea>
                                <label for="floatingTextarea">Buscar por Abonado</label>
                                <button type="button" class="btn_ba_abonado">Buscar</button>
                            </div>
                            <div class="form-floating mt-2">
                                <textarea class="form-control" placeholder="Leave a comment here" id="ba_mac" style="height: 200px;"></textarea>
                                <label for="floatingTextarea">Buscar por Mac</label>
                                <button type="button" class="btn_ba_mac">Buscar</button>
                            </div>
                            <div class="form-floating mt-2">
                                <textarea class="form-control" placeholder="Leave a comment here" id="ba_nodo" style="height: 200px;"></textarea>
                                <label for="floatingTextarea">Buscar por Nodo</label>
                                <button type="button" class="btn_ba_nodo">Buscar</button>
                                <div class='form-check form-switch'><input class='form-check-input' type='checkbox'  id='flexSwitchCheckDefault' ><label class='form-check-label' for='flexSwitchCheckDefault'>OLT</label></div>
                            </div>
                        </div>


                        <div class="col-lg-10">
                            <label for="Datos Local">Busqueda Usuario en radius</label>
                            <table class="table table-bordered table-striped dt-responsive" id="tbl_ba_resultado" width="100%">
                                <thead>
                                    <tr>
                                    <th style="width: 2%;">ID</th>
                                        <th style="width: 15%;">USERNAME</th>
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
<div id="modal_detalle_cambioEquipo" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl modal-dialog-centered ">
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
                        <label for="Datos Radius">Datos Radius</label>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" id="Mac" placeholder="Username" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Mac</label>
                            <div class="col-sm-8">
                                <input type="text" id="Mac" placeholder="Mac" class="form-control">
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

                        <button type="button" class="btn btn-warning btn_actualizar_radius">Actualizar</button>


                    </div>

                    <div class="col">
                        <label for="Datos Radius">Datos Radius</label>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" id="Mac" placeholder="Username" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Mac</label>
                            <div class="col-sm-8">
                                <input type="text" id="Mac" placeholder="Mac" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Grupo</label>
                            <div class="col-sm-8">
                                <input type="text" id="Mac" placeholder="Grupo" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>


                    </div>

                    <div class="col">
                        <label for="Datos Radius">Datos Radius</label>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" id="Mac" placeholder="Username" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Mac</label>
                            <div class="col-sm-8">
                                <input type="text" id="Mac" placeholder="Mac" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="floatingTextarea" class="col-sm-3 col-form-label">Grupo</label>
                            <div class="col-sm-8">
                                <input type="text" id="Mac" placeholder="Grupo" class="form-control">
                            </div>
                            <div id="loading-icon" style="display: none;">
                                <i class="fas fa-spinner fa-spin"></i>...
                            </div>
                        </div>

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