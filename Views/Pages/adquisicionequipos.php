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
                        <li class="breadcrumb-item active">Asigancion de Equipos</li>
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
                    <h3 class="card-title">Formulario Adquisicion de Equipos</h3>
                </div>
                <div class="card-body">
                    <div class="form-row">

                        <div class="col">
                            <button type="button" class="btn btn-success mb-1" data-toggle="modal" data-target="#modal_adquisicion_registrar">Registrar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>


        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped dt-responsive" id="tbl_detalle_adquisicion" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>AREA</th>
                            <th>BENEFICIARIO</th>
                            <th>EQUIPOS</th>
                            <th>META</th>
                            <th>AÑO</th>
                            <th>CANTIDAD</th>
                            <th>ACCIONES</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </section>
</div>



<!-- Modal registrar Sede -->
<div id="modal_adquisicion_registrar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Adquisición de Equipo</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="area">Area</label>
                        <select id="ad_selec_area" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ad_beneficiario">Beneficiario</label>
                        <select id="ad_selec_beneficiario" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="equipo">Marca</label>
                        <select id="ad_selec_equipo" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="meta">Meta</label>
                        <select id="ad_selec_meta" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-3">
                        <label for="anioAdquisicion">Año Adquisición</label>
                        <input type="date" class="form-control" id="ad_fecha">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cantidad">Modelo</label>
                        <select id="ad_selec_equipo_modelo" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="ad_cantidad" min="1">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12 text-center">
                        <button type="button" class="btn btn-danger mr-2 btn_adq_limpiar">Limpiar</button>
                        <!-- <button type="button" class="btn btn-primary mr-2">Favorite</button>
                        <button type="button" class="btn btn-info mr-2">All Tickets</button> -->
                        <button type="submit" class="btn btn-success btn_adq_guardar">Guardar</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>





<!-- Modal Editar -->
<div id="modal_adquisicion_editar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Sede</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-row">


                    <div class="form-group col-md-3">
                        <label for="area">Area</label>
                        <input type="hidden" id="modal_id_ad">
                        <select id="modal_edit_ad_selec_area" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="ad_beneficiario">Beneficiario</label>
                        <select id="modal_edit_ad_selec_beneficiario" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="equipo">Equipo</label>
                        <select id="modal_edit_ad_selec_equipo" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="meta">Meta</label>
                        <select id="modal_edit_ad_selec_meta" class="form-control">
                            <option value="0" selected>Seleccionar</option>
                            <!-- Add more options as needed -->
                        </select>
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-3">
                        <label for="anioAdquisicion">Año Adquisición</label>
                        <input type="date" class="form-control" id="modal_edit_ad_fecha">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="cantidad">Cantidad</label>
                        <input type="number" class="form-control" id="modal_edit_ad_cantidad" min="1">
                    </div>
                </div>
                <div class="form-row justify-content-center">
                    <div class="form-group col-md-12 text-center">
                        <button type="button" class="btn btn-danger mr-2 btn_adq_limpiar">Limpiar</button>
                        <!-- <button type="button" class="btn btn-primary mr-2">Favorite</button>
                        <button type="button" class="btn btn-info mr-2">All Tickets</button> -->
                        <button type="submit" class="btn btn-success btn_adq_editar">Editar</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>