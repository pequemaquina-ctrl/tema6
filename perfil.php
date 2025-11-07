<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

$usuario = $_SESSION['usuario'];

$opc = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
try {
    $conexion = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}

$stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = :u");
$stmt->bindParam(':u', $usuario);
$stmt->execute();
$datos = $stmt->fetch(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Perfil de <?php echo htmlspecialchars($usuario); ?></title>
</head>
<body>
<h1>Perfil de <?php echo htmlspecialchars($usuario); ?></h1>
<p><a href="logout.php">Cerrar sesión</a></p>

<?php if ($datos): ?>
    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($datos->nombre); ?></p>
    <p><strong>Usuario:</strong> <?php echo htmlspecialchars($datos->usuario); ?></p>

    <h3>Foto de perfil</h3>
    <img src="<?php echo htmlspecialchars($datos->imagen_grande); ?>" alt="Imagen grande"><br>
    <small>Miniatura:</small><br>
    <img src="<?php echo htmlspecialchars($datos->imagen_pequena); ?>" alt="Imagen pequeña" width="72" height="96">
<?php endif; ?>
</body>
</html>
