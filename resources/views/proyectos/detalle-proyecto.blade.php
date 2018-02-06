@extends('template')

@section('content')
    <section class="content-header">
        <h1>
            {{ $proyecto->nombre_proyecto }}
            <small>Detalle del proyecto</small>
        </h1>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-4">

                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#informacion" role="tab" data-toggle="tab" >Información</a></li>
                        <li><a href="#roles" role="tab" data-toggle="tab">Roles</a></li>
                        <li><a href="#equipo" role="tab" data-toggle="tab">Equipo</a></li>
                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active in fade" id="informacion">
                            <div class="well well-sm">
                                {{ $proyecto->descripcion_proyecto }}
                            </div>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Responsable</b> <a class="pull-right">{{ $proyecto->liderProyecto->nombres_usuario }} {{ $proyecto->liderProyecto->apellidos_usuario }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Fecha de Inicio</b> <a class="pull-right">{{ Fechas::formatearHtml($proyecto->fecha_inicio_proyecto) }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Estado</b> <a class="pull-right">{{ $proyecto->estadoProyecto->nombre_ep }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>% Avance</b> <a class="pull-right">{{ \App\Helpers\Pangea\Proyecto::avance($proyecto->id_proyecto) }} %</a>
                                </li>
                                <li class="list-group-item">
                                    <b>% Avance Prioridad</b> <a class="pull-right">{{ \App\Helpers\Pangea\Proyecto::avancePuntual($proyecto->id_proyecto) }} %</a>
                                </li>
                            </ul>
                            <div class="text-right">
                                <a href="{{ url('/Proyectos/reportePdf/' . $proyecto->id_proyecto) }}" target="_blank" class="btn btn-flat btn-primary"><i class="fa fa-file-pdf-o"></i></i> Reporte PDF</a>
                                @if (($proyecto->estado_fk_proyecto != \App\EstadosProyectos::PROYECTO_CERRADO) and (\App\Helpers\Pangea\Proyecto::totalTareas($proyecto->id_proyecto) == \App\Helpers\Pangea\Proyecto::totalTareasAprobadas($proyecto->id_proyecto)))
                                <button type="button" class="btn btn-primary btn-flat" onclick="BootModal.open('{{ url('/ProyectosLider/cerrar/' . $proyecto->id_proyecto) }}','Cerrar Proyecto');">Cerrar Proyecto</button>
                                @endif
                            </div>
                        </div>

                        <div class="tab-pane fade" id="roles">
                            <a href="#" class="btn btn-primary btn-block btn-flat" onclick="BootModal.open('{{ url('/ProyectosLider/nuevoRol/' . $proyecto->id_proyecto) }}','Nuevo Rol Proyecto');"><b>Agregar Rol a Proyecto</b></a>

                            <h5>Roles del Proyecto</h5>
                            <ul class="list-group list-group-unbordered" id="contenedor-listado-roles">
                                @if (count($proyecto->rolesProyecto) > 0)
                                    @foreach ($proyecto->rolesProyecto as $rol)
                                        <li class="list-group-item">
                                            <b>{{ $rol->nombre_rp }}</b>
                                            <a class="pull-right btn-xs" href="javascript:void(0);" onclick="RolesProyecto.eliminarRolProyecto({{ $rol->proyecto_fk_rp }},{{ $rol->id_rp }})"><i class="fa fa-trash-o"></i></a>
                                            <a class="pull-right btn-xs" href="javascript:void(0);" onclick="RolesProyecto.editarRolProyecto({{ $rol->proyecto_fk_rp }},{{ $rol->id_rp }})"><i class="fa fa-edit"></i></a>
                                            <span class="help-block">{{ $rol->descripcion_rp }}</span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="list-group-item">
                                        <b>No se han registrado roles</b>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <div class="tab-pane fade" id="equipo">
                            <div class="row">
                                <div class="col-xs-12 text-right">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-flat btn-success" onclick="BootModal.open('{{ url('/UsuariosProyecto/nuevoUsuario/' . $proyecto->id_proyecto) }}','Nuevo Integrante');"><i class="fa fa-user-plus"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="post">
                                        <div class="user-block">
                                            <img class="img-circle img-bordered-sm" src="{{ asset(\App\Helpers\Pangea\Usuario::getImagenUsuario(session()->get('id')))}}" alt="user image">
                                            <span class="username">
                                            <a href="#">{{ $proyecto->liderProyecto->nombres_usuario }} {{ $proyecto->liderProyecto->apellidos_usuario }}</a>
                                                {{--<a href="#" class="pull-right btn-box-tool"><i class="fa fa-times"></i></a>--}}
                                        </span>
                                            <span class="description">Líder de Proyecto</span>
                                        </div>
                                    </div>
                                    <div id="contenedor-integrantes">

                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>

            </div>

            <div class="col-xs-12 col-md-8">
                <div class="nav-tabs-custom">
                    <!-- TAB NAVIGATION -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active" onclick="Proyectos.cargarCalendarioProyecto({{ $proyecto->id_proyecto }});"><a href="#tab3" role="tab" data-toggle="tab" >Calendario</a></li>
                        <li><a href="#tab2" role="tab" data-toggle="tab">Planificación</a></li>
                        <li><a href="#tab4" role="tab" data-toggle="tab">Muro</a></li>
                    </ul>
                    <!-- TAB CONTENT -->
                    <div class="tab-content">
                        
                        <!-- Actividades -->
                        <div class="tab-pane fade" id="tab2">
                            <div id="contenedor-hitos"></div>
                        </div>
                        <!-- fin Actividades -->
						
						<!-- Calendario -->
                        <div class="tab-pane fade active in" id="tab3">
                            <div class="box box-solid">
								<div class="box-body no-padding">
								    <div id="calendario" class="calendario"></div>
								</div>
							  </div>
						</div>
						<!-- fin Calendario -->
						
						<!-- Muro -->
                        <div class="tab-pane fade" id="tab4">
                            <div class="box box-widget">
                                
                                <div class="box-footer box-comments" id="contenedor-comentarios-proyecto">
                                  
                                  
                                </div>
                                <!-- /.box-footer -->
                                <div class="box-footer">
                                    <input type="hidden" name="comentario_proyecto" id="comentario_proyecto" value="{{ $proyecto->id_proyecto}}" />
                                    <img class="img-responsive img-circle img-sm" src="{{ asset(Usuario::getImagenUsuario(session()->get('id'))) }}" alt="Alt Text">
                                    <!-- .img-push is used to add margin to elements next to floating images -->
                                    <div class="img-push">
                                        <input type="text" class="form-control input-sm" name="texto_comentario" id="texto_comentario" placeholder="Presiona ENTER para registrar comentario" onkeypress="ComentariosProyecto.registrarComentario(event)" />
                                    </div>
                                </div>
                                <!-- /.box-footer -->
                              </div>
						</div>
						<!-- fin Muro -->
                    </div>

                </div>
            </div>

        </div>
    </section>
@endsection

@section('js')
	
    <script type="text/javascript" src="{{ asset('public/js/plugins/calendario.js?' . uniqid()) }}"></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/proyectos/Proyectos.js?' . uniqid()) }}" ></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/proyectos/RolesProyecto.js?' . uniqid()) }}" ></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/proyectos/UsuariosProyecto.js?' . uniqid()) }}" ></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/proyectos/HitosProyecto.js?' . uniqid()) }}" ></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/proyectos/TareasProyecto.js?' . uniqid()) }}" ></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/proyectos/ComentariosProyecto.js?' . uniqid()) }}" ></script>
    <script type="text/javascript" src="{{ asset('public/js/modulos/tareas/Tareas.js?' . uniqid()) }}" ></script>
    <script>
        Proyectos.cargarCalendarioProyecto({{ $proyecto->id_proyecto}});
        UsuariosProyecto.listadoUsuariosProyecto({{ $proyecto->id_proyecto }});
        HitosProyecto.hitosProyecto({{ $proyecto->id_proyecto }});
        ComentariosProyecto.listadoComentariosProyecto({{ $proyecto->id_proyecto}});
    </script>
@endsection