<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];

// Manejo de mensajes para mostrar alertas
$mensaje = '';
$tipo_alerta = '';

if (isset($_GET['success']) && $_GET['success'] === 'eliminado') {
    $mensaje = "La cita fue eliminada correctamente.";
    $tipo_alerta = "success";
} elseif (isset($_GET['error'])) {
    switch ($_GET['error']) {
        case 'sin_id':
            $mensaje = "ID de cita no válido.";
            break;
        case 'sin_permiso':
            $mensaje = "No tienes permiso para eliminar esta cita.";
            break;
        case 'error_eliminar':
            $mensaje = "Ocurrió un error al eliminar la cita.";
            break;
        default:
            $mensaje = "Ocurrió un error inesperado.";
            break;
    }
    $tipo_alerta = "danger";
}

$sql = "SELECT c.id_cita, c.fecha, c.motivo, m.nombre AS mascota 
        FROM citas c 
        JOIN mascotas m ON c.id_mascota = m.id_mascota
        WHERE m.id_usuario = ?
        ORDER BY c.fecha ASC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Citas</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f8f9;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        h2 {
            color: #008c5f;
        }
        .btn-custom {
            min-width: 140px;
        }
        .table thead {
            background-color: #008c5f;
            color: white;
        }
        .table tbody tr:hover {
            background-color: #f1f1f1;
        }
        .header-icons {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #008c5f;
        }
        .action-btns a {
            margin: 0 5px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fa-solid fa-calendar-check header-icons"></i>Mis Citas</h2>
        <div class="d-flex flex-wrap gap-2">
            <a href="registrar_cita.php" class="btn btn-success btn-custom">
                <i class="fa-solid fa-plus"></i> Nueva Cita
            </a>

            <a href="registrar_cita.php" class="btn btn-outline-secondary btn-custom">
                <i class="fa-solid fa-arrow-left"></i> Regresar
            </a>

            <a href="logout.php" class="btn btn-danger btn-custom">
                <i class="fa-solid fa-sign-out-alt"></i> Cerrar Sesión
            </a>
        </div>
    </div>

    <div class="alert alert-info text-center">
        Horario de atención: <strong>9:00 AM - 8:00 PM</strong>
    </div>

    <!-- Mostrar mensajes -->
    <?php if ($mensaje): ?>
        <div class="alert alert-<?= $tipo_alerta ?> text-center">
            <?= htmlspecialchars($mensaje) ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table class="table table-bordered align-middle text-center">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Motivo</th>
                    <th>Mascota</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($resultado->num_rows > 0): ?>
                    <?php while ($fila = $resultado->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars(date("d/m/Y", strtotime($fila['fecha']))) ?></td>
                            <td><?= htmlspecialchars($fila['motivo']) ?></td>
                            <td><?= htmlspecialchars($fila['mascota']) ?></td>
                            <td class="action-btns">
                                <a href="editar_cita.php?id=<?= urlencode($fila['id_cita']) ?>" class="btn btn-warning btn-sm">
                                    <i class="fa-solid fa-pen-to-square"></i> Editar
                                </a>
                                <a href="eliminar_cita.php?id=<?= urlencode($fila['id_cita']) ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('¿Estás seguro de eliminar esta cita?')">
                                    <i class="fa-solid fa-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">No tienes citas registradas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
