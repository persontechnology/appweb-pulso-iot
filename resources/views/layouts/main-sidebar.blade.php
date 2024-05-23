<div class="sidebar sidebar-dark sidebar-main sidebar-expand-lg">

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- Sidebar header -->
        <div class="sidebar-section">
            <div class="sidebar-section-body d-flex justify-content-center">
                <h5 class="sidebar-resize-hide flex-grow-1 my-auto">Navegación</h5>

                <div>
                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-control sidebar-main-resize d-none d-lg-inline-flex">
                        <i class="ph-arrows-left-right"></i>
                    </button>

                    <button type="button" class="btn btn-flat-white btn-icon btn-sm rounded-pill border-transparent sidebar-mobile-main-toggle d-lg-none">
                        <i class="ph-x"></i>
                    </button>
                </div>
            </div>
        </div>
        <!-- /sidebar header -->


        <!-- Main navigation -->
        <div class="sidebar-section">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                {{-- ROLE: ADMINISTRADOR --}}


                <li class="nav-item-header pt-0">
                    <div class="text-uppercase fs-sm lh-sm opacity-50 sidebar-resize-hide">Menu</div>
                    <i class="ph-dots-three sidebar-resize-show"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ Route::is('dashboard')?'active':'' }}">
                        <i class="ph-house"></i>
                        <span>
                            Dashboard
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('clientes.index') }}" class="nav-link {{ Route::is('clientes.*')?'active':'' }}">
                        <i class="ph ph-users"></i>
                        <span>
                            Clientes
                        </span>
                    </a>
                </li>
                
                <li class="nav-item">
                    <a href="{{ route('dispositivos.index') }}" class="nav-link {{ Route::is('dispositivos.*')?'active':'' }}">
                        <i class="ph ph-device-mobile"></i>
                        <span>
                            Dispositivos
                        </span>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="{{ route('lecturas.index') }}" class="nav-link {{ Route::is('lecturas.*')?'active':'' }}">
                        <i class="ph ph-file-text"></i>
                        <span>
                            Lecturas
                        </span>
                    </a>
                </li>


            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->
    
</div>