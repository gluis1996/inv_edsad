<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Historico Equipos</h1>
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

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="card-title">Formulario de registro equipos</h3>
            </div>

            <div class="card-body">

                <div class="row">
                    <div class="col-2">
                        <!-- Button trigger modal -->
                        <!-- Button registrar equipo -->
                        <button type="button" class="btn btn-primary mb-2 btn_modal_registrar">
                            Registrar Equipo
                        </button>
                    </div>

                    <div class="col-2">
                        <!-- Button para abrir el modal -->
                        <button type="button" class="btn btn-primary mb-2 btn_equipo_rgistrar_marca">
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
                    <table class="table table-bordered table-striped dt-responsive" id="tb_listar_equipos" width="100%">
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

