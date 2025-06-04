<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Veterinaria</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                <li class="nav-item"><a class="nav-link" href="acerca.php">Acerca de</a></li>
                <li class="nav-item"><a class="nav-link" href="ubicacion.php">Ubicación</a></li>
                <?php if (isset($_SESSION['usuario']) && is_array($_SESSION['usuario'])): ?>
                    <li class="nav-item"><a class="nav-link" href="registrar.php">Registrar Cita</a></li>
                    <?php if (isset($_SESSION['usuario']['rol']) && $_SESSION['usuario']['rol'] == 'admin'): ?>
                        <li class="nav-item"><a class="nav-link" href="ver_citas.php">Ver Citas</a></li>
                    <?php endif; ?>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Cerrar Sesión</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar Sesión</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
