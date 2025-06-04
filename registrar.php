<?php
include 'conexion.php';

if  
    ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_usuario = $_POST['nombre_usuario'];
    $contrasena = $_POST['contrasena'];

    $rol = "usuario"; // Todos los registros nuevos serán usuarios normales

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre_usuario, contrasena, rol) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre_usuario, $contrasena, $rol);

    if ($stmt->execute()) {
        $mensaje = "✅ Usuario registrado correctamente.";
    } else {
        $mensaje = "❌ Error al registrar: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, inicial-escale=1">
    <title>Registrar Usuario</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center">Registrar Usuario</h2>
    <?php if (isset($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>
    <form method="POST">
        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre de usuario</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" required>
        </div>
        <div class="mb-3">
            <label for="contrasena" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="contrasena" name="contrasena" required>
        </div>
        <button type="submit" class="btn btn-success">Registrar</button>
        <a href="index.php" class="btn btn-danger">Volver ala pagian principal</a>
        <a href="login.php" class="btn btn-danger">Volver a Iniciar Sesión</a>

    </form>
</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
