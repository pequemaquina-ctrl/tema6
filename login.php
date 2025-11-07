<?php
session_start();
$mensaje = "";

if (isset($_POST['entrar'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $opc = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
    } catch (PDOException $e) {
        exit("Error de conexión: " . $e->getMessage());
    }

    $stmt = $conexion->prepare("SELECT * FROM usuarios WHERE usuario = :u AND contrasena = :c");
    $stmt->bindParam(':u', $usuario);
    $stmt->bindParam(':c', $contrasena);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $_SESSION['usuario'] = $usuario;
        header("Location: perfil.php");
        exit();
    } else {
        $mensaje = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Login</title>
</head>
<body>
<h1>Iniciar sesión</h1>
<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>

<form action="login.php" method="post">
    <label>Usuario:</label> <input type="text" name="usuario" required><br><br>
    <label>Contraseña:</label> <input type="password" name="contrasena" required><br><br>
    <input type="submit" name="entrar" value="Entrar">
</form>

<p><a href="registro.php">Registrar usuario</a></p>
</body>
</html>