<?php
session_start();
include "db.php";

// Solo permite acceso a usuarios con rol "admin"
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
    echo "Acceso denegado. Esta página es solo para administradores.";
    exit();
}

$sql = "SELECT 
            c.id_cita, c.fecha, c.motivo,
            m.nombre AS nombre_mascota,
            u.nombre_usuario AS duenio
        FROM citas c
        INNER JOIN mascotas m ON c.id_mascota = m.id_mascota
        INNER JOIN usuarios u ON m.id_usuario = u.id_usuario
        ORDER BY c.fecha DESC";

$result = $conn->query($sql);
?>

<h2>Panel de administración - Citas registradas</h2>

<table border="1" cellpadding="8">
    <tr>
        <th>ID Cita</th>
        <th>Fecha</th>
        <th>Motivo</th>
        <th>Nombre de Mascota</th>
        <th>Dueño</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?= $row['id_cita'] ?></td>
        <td><?= $row['fecha'] ?></td>
        <td><?= $row['motivo'] ?></td>
        <td><?= $row['nombre_mascota'] ?></td>
        <td><?= $row['duenio'] ?></td>
    </tr>
    <?php endwhile; ?>
</table>

<p><a href="logout.php">Cerrar sesión</a></p>
