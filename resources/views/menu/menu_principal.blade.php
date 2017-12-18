@if(session()->get('perfil') == App\Perfiles::ADMINISTRADOR_GENERAL)
    <li class="treeview">
        <a href="#"><i class="fa fa-square-o"></i><span>Mantenedores</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="{{ url('/MantenedorUsuarios/index') }}"><i class="fa fa-circle-o"></i> Usuarios</a>
            </li>
            <li>
                <a href="{{ url('/MantenedorUsuarios/index') }}"><i class="fa fa-circle-o"></i> Proyectos</a>
            </li>
        </ul>
    </li>
@endif

@if(session()->get('perfil') == App\Perfiles::ADMINISTADOR_PROYECTOS)
    <li class="treeview">
        <a href="#"><i class="fa fa-square-o"></i><span>Proyectos</span><span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
            <li>
                <a href="{{ url('/Proyectos/nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo Proyecto</a>
            </li>
            <li>
                <a href="{{ url('/Proyectos/index') }}"><i class="fa fa-circle-o"></i> Revisar Proyectos</a>
            </li>
        </ul>
    </li>
@endif

