<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombre_usuario = ? AND contrasena = ?");
    $stmt->bind_param("ss", $nombre_usuario, $contrasena);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $_SESSION['usuario_id'] = $usuario['id_usuario'];
        $_SESSION['rol'] = $usuario['rol'];
        header("Location: registrar_cita.php");
        exit();
    } else {
        $mensaje = "❌ Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center">Iniciar Sesión</h2>
    <?php if (isset($mensaje)) echo "<div class='alert alert-danger'>$mensaje</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-primary">Ingresar</button>
        <a href="index.php" class="btn btn-danger">Volver ala pagian principal</a>
        <a href="registrar.php" class="btn btn-danger">Crear cuenta</a>
    </form>
</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
