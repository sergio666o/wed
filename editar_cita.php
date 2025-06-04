<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

require_once 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];
$id_cita = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id_cita <= 0) {
    echo "ID de cita no válido.";
    exit();
}

// Obtener cita
$sql = "SELECT c.id_cita, c.fecha, c.motivo, c.id_mascota
        FROM citas c
        JOIN mascotas m ON c.id_mascota = m.id_mascota
        WHERE c.id_cita = ? AND m.id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $id_cita, $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
$cita = $resultado->fetch_assoc();

if (!$cita) {
    echo "Cita no encontrada o no tienes permiso para editarla.";
    exit();
}

// Obtener mascotas del usuario
$sql_mascotas = "SELECT id_mascota, nombre FROM mascotas WHERE id_usuario = ?";
$stmt_mascotas = $conn->prepare($sql_mascotas);
$stmt_mascotas->bind_param("i", $usuario_id);
$stmt_mascotas->execute();
$mascotas = $stmt_mascotas->get_result();

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $fecha = $_POST['fecha'] ?? '';
    $motivo = trim($_POST['motivo'] ?? '');
    $id_mascota = $_POST['id_mascota'] ?? '';

    if ($fecha && $motivo && $id_mascota) {
        $update = $conn->prepare("UPDATE citas SET fecha = ?, motivo = ?, id_mascota = ? WHERE id_cita = ?");
        $update->bind_param("ssii", $fecha, $motivo, $id_mascota, $id_cita);
        $update->execute();
        header("Location: ver_citas.php");
        exit();
    } else {
        $error = "Todos los campos son obligatorios.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f8f9;
        }
        .card {
            max-width: 600px;
            margin: 50px auto;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #00a887;
            color: white;
        }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0"><i class="fa-solid fa-pen-to-square"></i> Editar Cita</h5>
    </div>
    <div class="card-body">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" required value="<?= htmlspecialchars($cita['fecha']) ?>">
            </div>

            <div class="mb-3">
                <label for="motivo" class="form-label">Motivo</label>
                <input type="text" name="motivo" id="motivo" class="form-control" required value="<?= htmlspecialchars($cita['motivo']) ?>">
            </div>

            <div class="mb-3">
                <label for="id_mascota" class="form-label">Mascota</label>
                <select name="id_mascota" id="id_mascota" class="form-select" required>
                    <?php while ($m = $mascotas->fetch_assoc()): ?>
                        <option value="<?= $m['id_mascota'] ?>" <?= $m['id_mascota'] == $cita['id_mascota'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($m['nombre']) ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <a href="ver_citas.php" class="btn btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Volver
                </a>
                <button  type="submit" class="btn btn-success">
                    <i  class="fa-solid fa-check"></i> Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a2e5b1f6f8.js" crossorigin="anonymous"></script>
</body>
</html>
