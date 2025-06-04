<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre_mascota = $_POST['nombre_mascota'];
    $tipo = $_POST['tipo'];
    $raza = $_POST['raza'];
    $edad = $_POST['edad'];
    $fecha = $_POST['fecha'];
    $motivo = $_POST['motivo'];

    $usuario_id = $_SESSION['usuario_id'];

    // Insertar mascota
    $stmt_mascota = $conn->prepare("INSERT INTO mascotas (nombre, tipo, raza, edad, id_usuario) VALUES (?, ?, ?, ?, ?)");
    $stmt_mascota->bind_param("sssii", $nombre_mascota, $tipo, $raza, $edad, $usuario_id);

    if ($stmt_mascota->execute()) {
        $id_mascota = $stmt_mascota->insert_id;

        // Insertar cita
        $stmt_cita = $conn->prepare("INSERT INTO citas (fecha, motivo, id_mascota, id_veterinario) VALUES (?, ?, ?, NULL)");
        $stmt_cita->bind_param("ssi", $fecha, $motivo, $id_mascota);

        if ($stmt_cita->execute()) {
            $mensaje = "✅ Cita registrada correctamente.";
        } else {
            $mensaje = "❌ Error al registrar la cita: " . $stmt_cita->error;
        }
    } else {
        $mensaje = "❌ Error al registrar la mascota: " . $stmt_mascota->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Cita</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="text-center">Registrar Cita</h2>
    <?php if (isset($mensaje)) echo "<div class='alert alert-info'>$mensaje</div>"; ?>
    <form method="POST">
        <h4>Datos de la Mascota</h4>
        <div class="mb-3">
            <label for="nombre_mascota" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_mascota" name="nombre_mascota" required>
        </div>
        <div class="mb-3">
            <label for="tipo" class="form-label">Tipo</label>
            <select class="form-select" id="tipo" name="tipo" required>
                <option value="Perro">Perro</option>
                <option value="Gato">Gato</option>
                <option value="Ave">Ave</option>
                <option value="Otro">Otro</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="raza" class="form-label">Raza</label>
            <input type="text" class="form-control" id="raza" name="raza" required>
        </div>
        <div class="mb-3">
            <label for="edad" class="form-label">Edad</label>
            <input type="number" class="form-control" id="edad" name="edad" required>
        </div>

        <h4>Datos de la Cita</h4>
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" required>
        </div>
        <div class="mb-3">
            <label for="motivo" class="form-label">Motivo</label>
            <textarea class="form-control" id="motivo" name="motivo" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Registrar Cita</button>
        <a href="ver_citas.php" class="btn btn-primary">Ver Citas</a>
        <a href="login.php" class="btn btn-danger">Cerrar Sesión</a>
        <a href="index.php" class="btn btn-danger">Volver ala pagina principal</a>
    </form>
</div>
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
