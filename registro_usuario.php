<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Nuevo usuario tiene rol normal
    $rol = 'usuario';

    $sql = "INSERT INTO usuarios (nombre_usuario, contrasena, rol)
            VALUES ('$usuario', '$contrasena', '$rol')";

    if ($conn->query($sql)) {
        $nuevo_id = $conn->insert_id;
        echo "✅ Usuario registrado con éxito. Tu ID de usuario es: $nuevo_id<br>";
        echo '<a href="login.php">Iniciar sesión</a>';
    } else {
        echo "❌ Error al registrar usuario: " . $conn->error;
    }
}
?>

<h2>Registro de Usuario</h2>
<form method="post">
    Usuario: <input type="text" name="usuario" required><br>
    Contraseña: <input type="password" name="contrasena" required><br>
    <input type="submit" value="Registrarse">
</form>
