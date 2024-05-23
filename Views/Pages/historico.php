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
                    <div class="col-10">
                        <input type="text" class="form-control" id="h_id_historico" placeholder="Buscar Historico x Codigo Patrimonial">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-success mb-2 btn_buscar_historico">Buscar Historico</button>
                    </div>
                </div>

                <div class="col mt-5">
                    <label for="Datos Local">Historial de Asignacion</label>
                    <table class="table table-bordered table-striped dt-responsive" id="tb_listar_historico" width="100%">
                        <thead>
                            <tr>
                                <th style="width: 5%;  text-align: center;">ID</th>
                                <th style="width: 15%; text-align: center;">detalle_asignacion</th>
                                <th style="width: 25%; text-align: center;">SEDE</th>
                                <th style="width: 10%; text-align: center;">OFICINA</th>
                                <th style="width: 15%; text-align: center;">EQUIPO</th>
                                <th style="width: 40%; text-align: center;">USUARIO</th>
                                <th style="width: 15%; text-align: center;">EMPLEADO</th>
                                <th style="width: 40%; text-align: center;">PATRIMONIAL</th>
                                <th style="width: 15%; text-align: center;">VIDA UTIL</th>
                                <th style="width: 40%; text-align: center;">ESTADO</th>
                                <th style="width: 15%; text-align: center;">FE. ASIGNACION</th>
                                <th style="width: 40%; text-align: center;">ACCIÓN</th>
                                <th style="width: 40%; text-align: center;">FECHA</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>

    </section>

</div>