<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php");
    exit();
}

include 'conexion.php';

$usuario_id = $_SESSION['usuario_id'];

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: ver_citas.php?error=sin_id");
    exit();
}

$id_cita = intval($_GET['id']);

// Verificar que la cita pertenece al usuario logueado
$sql_check = "SELECT c.id_cita FROM citas c
              JOIN mascotas m ON c.id_mascota = m.id_mascota
              WHERE c.id_cita = ? AND m.id_usuario = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("ii", $id_cita, $usuario_id);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

if ($result_check->num_rows === 0) {
    // Cita no existe o no pertenece al usuario
    header("Location: ver_citas.php?error=sin_permiso");
    exit();
}

// Ejecutar eliminación
$sql_delete = "DELETE FROM citas WHERE id_cita = ?";
$stmt_delete = $conn->prepare($sql_delete);
$stmt_delete->bind_param("i", $id_cita);

if ($stmt_delete->execute()) {
    header("Location: ver_citas.php?success=eliminado");
    exit();
} else {
    header("Location: ver_citas.php?error=error_eliminar");
    exit();
}
?>
