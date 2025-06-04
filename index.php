<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Veterinaria - Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Estilos externos -->
    <link rel="stylesheet" href="awesome/css/all.css">
    <style>
        body 
        {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f8ff;
            color: #333;
        }

        /* Navbar */
        nav 
        {
            background-color: #2c3e50;
            padding: 15px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        }

        nav ul
        {
            list-style: none;
            display: flex;
            justify-content: center;
            gap: 30px;
            margin: 0;
            padding: 0;
        }

        nav ul li a 
        {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background 0.3s;
        }

        nav ul li a:hover {
            background-color: #1abc9c;
        }

        .hero {
            background: url('img1.jpeg') center/cover no-repeat;
            height: 300px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .hero h1 
        {
            font-size: 2.5em;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }

        .container h2 
        {
            text-align: center;
            color: #2c3e50;
        }

        .container p 
        {
            font-size: 1.1em;
            line-height: 1.6;
            text-align: center;
        }
    </style>
</head>
<body>


<nav>
    <ul>
        <li><a href="index.php"><i class="fas fa-home"></i> Inicio</a></li>
        <li><a href="login.php"><i class="fas fa-user"></i> Iniciar Sesión</a></li>
        <li><a href="productos.html"><i class="fas fa-box-open"></i> Productos</a></li>
        <li><a href="acerca.php"><i class="fas fa-info-circle"></i> Acerca de</a></li>
        <li><a href="ubicacion.php"><i class="fas fa-map-marker-alt"></i> Ubicación</a></li>
        <?php if (isset($_SESSION['usuario'])): ?>
            <li><a href="cerrar_sesion.php"><i class="fas fa-sign-out-alt"></i> Cerrar Sesión</a></li>
        <?php endif; ?>
    </ul>
</nav>

<!-- HERO/BANNER -->
<section class="hero">
    <h1>Bienvenido a Nuestra Veterinaria</h1>
</section>

<!-- CONTENIDO PRINCIPAL -->
<div class="container">
    <h2>Sobre Nosotros</h2>
    <p>
        Ofrecemos servicios 100% seguros y confiables para tus mascotas.
        Contamos con una amplia experiencia en el cuidado y sanación, siempre brindando el trato que merecen.
    </p>
    <p>
        También ofrecemos medicamentos, alimentos y productos de calidad para su bienestar.
    </p>
</div>

</body>
</html>
