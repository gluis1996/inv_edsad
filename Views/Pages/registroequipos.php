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

                <div class="row">
                    <div class="col-2">
                        <!-- Button trigger modal -->
                        <!-- Button registrar equipo -->
                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                            Registrar Equipo
                        </button>
                    </div>

                    <div class="col-2">
                        <!-- Button para abrir el modal -->
                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_marca">
                            Registrar Marca
                        </button>
                    </div>

                    <!-- <div class="col-2">
                        Button trigger modal 
                        Button registrar modelo 
                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modal_registrar_modelo">
                            Registrar Modelo
                        </button>
                    </div> -->
                </div>


                <div class="col mt-5">
                    <label for="Datos Local">Equipos registrados</label>
                    <table class="table table-bordered table-striped dt-responsive" id="registrar_equipos" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 5%; text-align: center;">ID EQUIPOS</th>
                                <th style="width: 15%; text-align: center;">MODELO</th>
                                <th style="width: 25%; text-align: center;">DESCRIPCIÓN</th>
                                <th style="width: 10%; text-align: center;">FECHA DE REGISTRO</th>
                                <th style="width: 15%; text-align: center;">MARCA</th>

                                <th style="width: 40%; text-align: center;">ACCIÓN</th>
                                <!-- donde iran los botones para cada fila eliminar Actualizar-->
                            </tr>
                        </thead>
                    </table>

                </div>

            </div>
        </div>

    </section>

</div>




<!-- Modal registrar equipos-->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Equipos Informáticos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <!-- INICIO -->
                <div class="form-group">
                    <label for="cod_patrimonial">Modelo</label>
                    <input type="text" id="modelo" class="form-control">
                </div>

                <div class="form-group">
                    <label for="cod_patrimonial">Descripcion</label>
                    <input type="text" id="descripcion" class="form-control">
                </div>

                <div class="form-group">
                    <label for="fecha">Fecha de Registro</label>
                    <input type="date" id="fecha" class="form-control">
                </div>

                <div class="form-group">
                    <label for="id_marca">Marca</label>
                    <div class="input-group">
                        <select id="id_marca" class="form-control custom-select">
                            <option value="1">Selecccione</option>
                            <option value="2">Marca 1</option>
                            <option value="3">Marca 2</option>

                        </select>
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-eye"></i></span>
                        </div>
                    </div>
                </div>
                <!-- FIN  -->
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>
</div>
</div>


<!-- Modal registrar marca -->
<div id="modal_registrar_marca" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">

        <!-- Modal content -->
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title">Registrar Marca</h5>
                <button type="button" class="close" data-dismiss="modal" style="color: #fff;">&times;</button>
            </div>
            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_marca">Nombre de la Marca</label>
                    <input type="text" id="nombre_marca" class="form-control">
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div>



<!-- Modal registrar modelo -->
<!-- <div class="modal fade" id="modal_registrar_modelo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 10px;">
            <div class="modal-header" style="background-color: #343a40; color: #fff; border-bottom: none;">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Modelo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: #fff;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body" style="padding: 20px;">
                <div class="form-group">
                    <label for="nombre_modelo">Nombre del Modelo</label>
                    <input type="text" id="nombre_modelo" class="form-control">
                </div>

                <div class="form-group">
                    <label for="descripcion">Descripción del Equipo</label>
                    <input type="text" id="descripcion" class="form-control">
                </div>

                <div class="form-group">
                    <label for="id_marca">ID Marca</label>
                    <select class="form-control" id="id_marca">
                        <option value="">Seleccione</option>
                        <option value="002">002</option>
                        <option value="001">001</option>
                    </select>
                </div>
            </div>

            <div class="modal-footer" style="border-top: none; padding: 10px 20px;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="background-color: #6c757d; color: #fff;">Cerrar</button>
                <button type="button" class="btn btn-primary" style="background-color: #007bff; color: #fff;">Registrar</button>
            </div>
        </div>
    </div>
</div> -->