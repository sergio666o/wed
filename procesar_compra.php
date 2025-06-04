<?php
session_start();
include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto = trim($_POST['producto']);
    $nombre = trim($_POST['nombre']);
    $direccion = trim($_POST['direccion']);
    $email = trim($_POST['email']);
    $telefono = trim($_POST['telefono']);
    $metodo_pago = trim($_POST['metodo_pago']);

    if (empty($producto) || empty($nombre) || empty($direccion) || empty($email) || empty($telefono) || empty($metodo_pago)) {
        die("Por favor complete todos los campos.");
    }

    $sql = "INSERT INTO compras (producto, nombre, direccion, email, telefono, metodo_pago) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $producto, $nombre, $direccion, $email, $telefono, $metodo_pago);

    if ($stmt->execute()) {
        $id_compra = $stmt->insert_id;

        // HTML con Bootstrap y estilo mejorado
        echo <<<HTML
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Compra Confirmada</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f8f8;
      font-family: 'Arial', sans-serif;
    }
    .confirmation-box {
      max-width: 600px;
      margin: 60px auto;
      background: #fff;
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      text-align: center;
    }
    .confirmation-box h2 {
      color: #008c5f;
      margin-bottom: 25px;
    }
    .confirmation-box p {
      font-size: 18px;
      margin: 10px 0;
    }
    .tracking {
      font-size: 20px;
      font-weight: bold;
      color: #006f4b;
      margin: 20px 0;
    }
    .btn-custom {
      background-color: #008c5f;
      color: white;
      font-size: 16px;
      padding: 12px 25px;
      text-decoration: none;
      border-radius: 5px;
      display: inline-block;
      margin-top: 20px;
    }
    .btn-custom:hover {
      background-color: #006f4b;
    }
  </style>
</head>
<body>

<div class="confirmation-box">
  <h2>✅ Compra Confirmada</h2>
  <p>Gracias, <strong>{$nombre}</strong>, por su compra.</p>
  <p><strong>Producto:</strong> {$producto}</p>
  <p><strong>Método de pago:</strong> {$metodo_pago}</p>
  <div class="tracking">Número de seguimiento: #{$id_compra}</div>
  <a href="index.php" class="btn-custom">← Volver al inicio</a>
</div>

</body>
</html>
HTML;

    } else {
        echo "<p style='color:red; text-align:center; margin-top: 50px;'>❌ Error al procesar la compra. Inténtelo de nuevo.</p>";
    }

} else {
    header("Location: comprar.php");
    exit();
}
?>
