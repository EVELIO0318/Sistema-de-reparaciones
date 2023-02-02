<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
    <img src="{{asset('adminlte/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">SoftPINARES</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            {{-- con auth podemos hacer las vistas para usuarios autenticados con el plugin --}}
            @auth
                <a href="#" class="d-block">Usuario {{auth()->user()->username}}</a>
            @endauth
            {{-- con guest podemos hacer vistas para usuarios no autenticados --}}
            @guest
                <a href="#" class="d-block">Invitado</a>
            @endguest
        </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
            with font-awesome or any other icon font library -->
            <li class="nav-item active">
                <a href="/" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>
                        Inicio
                    </p>
                </a>
            </li>
            <li class="nav-item active">
                <a href="/user" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        Usuarios
                    </p>
                </a>
            </li>
            <li class="nav-item active">
                <a href="/customers" class="nav-link">
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Clientes
                    </p>
                </a>
            </li>
            <li class="nav-item active">
                <a href="/orders" class="nav-link">
                    <i class="fas fa-laptop"></i>
                    <p>
                        Gestión de Ordenes
                    </p>
                </a>
            </li>
            <li class="nav-item active">
                <a href="/ordersReady" class="nav-link">
                    <i class="fas fa-check-square"></i>
                    <p>
                        Ordenes Completadas
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>