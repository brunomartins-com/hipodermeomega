@extends('template.admin')

@section('content')
<div id="page-container">

    @yield('sidebar')

    <!-- Header -->
    <header id="header-navbar" class="content-mini content-mini-full">
        <!-- Logo no sidebar -->
        <h1 id="logoNoSidebar" class="logo">Concurso Bebê Hipoderme - 12ª Edição</h1>

        <!-- Header Navigation Right -->
        <ul class="nav-header pull-right">
            <li>
                <div class="btn-group">
                    <button class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
                        {{ Auth::getUser()->name }}
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-right">

                        <li class="dropdown-header"><span>Opções</span></li>

                        <li>
                            <a href="{{ route('profile') }}" title="Meus Dados">
                                <i class="si si-user"></i>
                                <span>&nbsp;Meus Dados</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('websiteSettings') }}" title="Dados do Site">
                                <i class="si si-wrench"></i>
                                <span>&nbsp;Dados do Site</span>
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="../" target="_blank" title="Ir para o site">
                                <i class="si si-screen-desktop"></i>
                                <span>&nbsp;Ir para o site</span>
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="{{ route('logout') }}" title="Sair">
                                <i class="si si-logout"></i>
                                <span>&nbsp;Sair</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- END Header Navigation Right -->
        <!-- Header Navigation Left -->
        <ul id="hidden-show-sidebar" class="nav-header pull-left hide">
            <li class="hidden-md hidden-lg">
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                    <i class="fa fa-navicon"></i>
                </button>
            </li>
            <li class="hidden-xs hidden-sm">
                <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                    <i class="fa fa-ellipsis-v"></i>
                </button>
            </li>
        </ul>
        <!-- END Header Navigation Left -->
    </header>
    <!-- END Header -->

    @yield('page-content')

    <!-- Footer -->
    <footer id="page-footer" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix">
        <div class="pull-right">
            <span class="font-w600">Bruno Martins - Web Developer</span> &copy; <span class="js-year-copy"></span>
        </div>
    </footer>
    <!-- END Footer -->

</div>
@stop
