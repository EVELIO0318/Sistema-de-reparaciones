<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <!-- Navbar Search -->
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle btn btn-light bg-light"  id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Administrador
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="salir" data-toggle="modal" data-target="#modalAcercade"><i class="fas fa-info-circle" id="salir"></i> Acerca de</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt" id="salir"></i> Cerrar sesión</a>
            </div>
        </li>
    </ul>
</nav>

<div class="modal fade" id="modalAcercade">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header" style="background: #3c8dbc; color: white;">
            <h4 class="modal-title"><i class="fas fa-info-circle"></i> Acerca de</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body text-center">
            <p>Desarrollado por el Ing. Evelio Escobar<br>
                <b>TODOS LOS DERECHOS RESERVADOS</b></p>
        </div>
        <div class="modal-footer justify-content-end">
            <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fas fa-thumbs-up"></i> Entendido</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>