@extends('template')

@section('content')

    <section class="content-header">
        <h1>
            Panel de Control
            <small>Inicio</small>
        </h1>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-xs-12 col-md-4">
               <div class="row">
                    @if (session()->get('perfil') == \App\Perfiles::ADMINISTRADOR_GENERAL)
                    <div class="col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Usuarios</span>
                                <span class="info-box-number">{{ $total_usuarios }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    @endif
                    
                    @if (session()->get('perfil') == \App\Perfiles::ADMINISTRADOR_GENERAL or session()->get('perfil') == \App\Perfiles::ADMINISTADOR_PROYECTOS)
                    <div class="col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="ionicons ion-ios-folder-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Proyectos</span>
                                <span class="info-box-number">{{ $total_proyectos }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <div class="box-title">Estado de Proyectos</div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                <canvas id="grafico-estados-proyectos" width="400" height="400"></canvas>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (session()->get('perfil') == \App\Perfiles::LIDER)
                    <div class="col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="ionicons ion-ios-folder-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Proyectos Asignados</span>
                                <span class="info-box-number">{{ $total_proyectos_lider }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <div class="box-title">Estado de Proyectos</div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                <canvas id="grafico-estados-proyectos" width="400" height="400"></canvas>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if (session()->get('perfil') == \App\Perfiles::COLABORADOR)
                    <div class="col-xs-12">
                        <div class="info-box">
                            <span class="info-box-icon bg-green"><i class="ionicons ion-ios-folder-outline"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Tareas Asignadas</span>
                                <span class="info-box-number">{{ $total_tareas_asignadas }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                    <div class="col-xs-12">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <div class="box-title">Estado de Tareas</div>
                            </div>
                            <div class="box-body">
                                <div class="row">
                                <canvas id="grafico-estados-proyectos" width="400" height="400"></canvas>
                            </div>
                            </div>
                        </div>
                    </div>
                    @endif


                    
               </div>
            </div>

            

            <div class="col-md-8 col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <div class="box-title">Últimos (10) eventos</div>
                    </div>
                    <div class="box-body">
                        @if ($total_eventos == 0)
                            <div class="callout callout-info">
                                <p>No existen eventos asociados a su cuenta</p>
                            </div>
                        @else
                            <table class="table table-bordered table-striped small">
                                <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($eventos_usuarios as $evento)
                                    <tr>
                                        <td>{{ \App\Helpers\Pangea\Fechas::formatearHtml($evento->fecha_eu) }}</td>
                                        <td>{{ $evento->detalle_eu }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </section>

@endsection

@section('js')
    <script src="{{ asset('public/js/vendor/nnnick/chartjs/dist/Chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('public/js/modulos/home/dashboard.js?' . uniqid() ) }}" type="text/javascript"></script>
    <script type="text/javascript">
        Dashboard.graficoProyectos(@json($grafico_proyectos), '{{ $titulo_grafico }}');
    </script>
@endsection
