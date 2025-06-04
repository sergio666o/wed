<?php
session_start();
include 'conexion.php';

$estado = null;
$error = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_compra = intval($_POST['id_compra']);

    if ($id_compra > 0) {
        $sql = "SELECT producto, nombre, estado FROM compras WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_compra);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $estado = $result->fetch_assoc();
        } else {
            $error = "No se encontró un pedido con ese número.";
        }
    } else {
        $error = "Número de pedido inválido.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <title>Seguimiento de Compra</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container" style="max-width: 600px; margin: 50px auto;">
  <h2>Consultar Estado del Pedido</h2>
  <form method="post" action="">
    <label for="id_compra">Número de Seguimiento</label>
    <input type="number" name="id_compra" id="id_compra" required class="form-control" />
    <button type="submit" class="btn btn-primary mt-3">Consultar</button>
  </form>

  <?php if ($estado): ?>
    <div class="alert alert-success mt-4">
      <p><strong>Producto:</strong> <?= htmlspecialchars($estado['producto']) ?></p>
      <p><strong>Cliente:</strong> <?= htmlspecialchars($estado['nombre']) ?></p>
      <p><strong>Estado del pedido:</strong> <?= htmlspecialchars($estado['estado']) ?></p>
    </div>
  <?php elseif ($error): ?>
    <div class="alert alert-danger mt-4"><?= htmlspecialchars($error) ?></div>
  <?php endif; ?>

  <a href="index.php" class="btn btn-secondary mt-3">Volver al inicio</a>
</div>
</body>
</html>
