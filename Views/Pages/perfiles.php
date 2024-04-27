<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CAMBIO DE EQUIPO</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">CAMBIO DE EQUIPO</li>
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
                <h3 class="card-title">CAMBIO</h3>

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
                <!--Boton para llamar al modal y registrar-->
                <input type="button" value="PERFILES" data-toggle="modal" data-target="#modal_detalle_nuevoperfil"
                    class="btn btn-secondary">
            </div>

            <!-- area tablas -->
            <div class="card ">
                <div class="row" style="margin-right: 5%; margin-left: 5%;">
                    <div class="col-lg-6 col-xs-10">
                        <label for="Datos Local">Datos Local</label>
                        <table class="table table-bordered table-striped dt-responsive " id="tablaperfillocal"
                            width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">VLAN</th>
                                    <th style="width: 5%;">MEGAS</th>
                                    <th>PERFIL</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                    <div class="col-lg-6 col-xs-10">
                        <label for="Datos Local">Datos Radius</label>
                        <table class="table table-bordered table-striped dt-responsive" id="tablaRadgroupreply"
                            width="100%">
                            <thead>
                                <tr>
                                    <th style="width: 5%;">ID</th>
                                    <th>GROUPNAME</th>
                                    <th style="width: 5%;">VALUE</th>
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
<div id="modal_detalle_nuevoperfil" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Detalle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">VLAN</label>
                    <div class="col-sm-10">
                        <input class="form-control form-control-sm" id="vlan" type="text" placeholder="VLAN">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Filial</label>
                    <div class="col-sm-10">
                        <select class="form-control" name="" id="perfiles_select">
                            <option value="">Seleccione</option>
                            <option value="1">Los Olivos</option>
                            <option value="2">Chosica</option>
                            <option value="3">Comas</option>
                            <option value="4">Huaycan</option>
                            <option value="5">Ñaña</option>
                            <option value="6">Puente Piedra</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Megas</label>
                    <div class="col-sm-10">
                        <input class="form-control form-control-sm" id="megas" type="text" placeholder="Megas">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Nombre Perfil</label>
                    <div class="col-sm-10">
                        <input class="form-control form-control-sm" id="grupo" type="text" placeholder="Nombre Perfil">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btnregistrarperfil">Save Changes</button>
            </div>
        </div>
    </div>
</div>