<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Comprar Producto</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f8f8f8;
      padding: 20px;
    }

    .container {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }

    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    button {
      margin-top: 25px;
      padding: 12px 20px;
      width: 100%;
      background-color: #008c5f;
      color: white;
      border: none;
      font-size: 18px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    button:hover {
      background-color: #006f4b;
    }

    .back-link {
      display: block;
      text-align: center;
      margin-top: 20px;
      text-decoration: none;
      color: #008c5f;
    }

    .back-link:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Formulario de Compra</h2>

  <form action="procesar_compra.php" method="post">
    <label for="producto">Producto</label>
    <select name="producto" id="producto" required>
      <option value="">Seleccione un producto</option>
      <option value="Alimento Premium Perros">Alimento Premium Perros - $45.00</option>
      <option value="Juguete Ratón de Tela">Juguete Ratón de Tela - $7.50</option>
      <option value="Champú Hipoalergénico">Champú Hipoalergénico - $12.00</option>
    </select>

    <label for="nombre">Nombre completo</label>
    <input type="text" id="nombre" name="nombre" required>

    <label for="direccion">Dirección de envío</label>
    <textarea id="direccion" name="direccion" rows="3" required></textarea>

    <label for="email">Correo electrónico</label>
    <input type="email" id="email" name="email" required>

    <label for="telefono">Teléfono</label>
    <input type="tel" id="telefono" name="telefono" required>

    <label for="metodo_pago">Método de pago</label>
    <select id="metodo_pago" name="metodo_pago" required>
      <option value="">Seleccione un método</option>
      <option value="Tarjeta de crédito">Tarjeta de crédito</option>
      <option value="Transferencia bancaria">Transferencia bancaria</option>
      <option value="Pago contra entrega">Pago contra entrega</option>
    </select>

    <button type="submit">Confirmar Compra</button>
  </form>

  <a href="index.php" class="back-link">← Volver al Inicio</a>
</div>

</body>
</html>
