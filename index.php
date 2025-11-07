<?php
session_start();

$usuario = isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;

$datos = null;
if ($usuario) {
    $opc = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
        $consulta = $conexion->prepare("SELECT nombre, imagen_pequena FROM usuarios WHERE usuario = :u");
        $consulta->bindParam(':u', $usuario);
        $consulta->execute();
        $datos = $consulta->fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Página principal</title>
</head>
<body>
    <h1>Aplicación de gestión de usuarios e imágenes</h1>
    <hr>

    <?php if ($usuario && $datos): ?>
        <p>Bienvenido, <strong><?php echo htmlspecialchars($datos->nombre ?: $usuario); ?></strong></p>

        <?php if (!empty($datos->imagen_pequena)): ?>
            <img src="<?php echo htmlspecialchars($datos->imagen_pequena); ?>" alt="Miniatura">
        <?php endif; ?>

        <p>
            <a href="perfil.php">Ver perfil completo</a> |
            <a href="logout.php">Cerrar sesión</a>
        </p>

    <?php else: ?>
        <p>Bienvenido a la aplicación. Elige una opción:</p>
        <ul>
            <li><a href="login.php">Iniciar sesión</a></li>
            <li><a href="registro.php">Registrar nuevo usuario</a></li>
        </ul>
    <?php endif; ?>
</body>
</html>
