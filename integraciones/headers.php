<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Viuda Negra</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <label class="form-control-dark w-100 bg-dark text-white text-center"> En Linea <span class="text-success"><strong><?php echo ($_SESSION['usuario']); ?></strong></span></label>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" onclick="cerrarSesion()">Cerrar sesión</a>
        </div>
    </div>
</header>

<script src="../js/cerrar_sesion.js"></script>