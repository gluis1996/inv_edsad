<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Registro de equipos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Registro de equipos</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Formulario de registro equipos</h3>
            </div>
            <div class="card-body">
                <div class="col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Registrar Equipo
                    </button>
                </div>

                <div class="col mt-5">
                    <label for="Datos Local">Instalacion EoC</label>
                    <table class="table table-bordered table-striped dt-responsive" id="xxxxxx" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 5%;">ABONADO</th>
                                <th style="width: 25%;">FILIAL</th>
                                <th style="width: 25%;">FECHA</th>
                                <th style="width: 45%;">ACCION</th>
                                <!-- donde iran los botones para cad fila eliminar Actualizar-->
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>

    </section>

</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="text" class="form-control">

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
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>