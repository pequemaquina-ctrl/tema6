<?php
$mensaje = "";

if (isset($_POST['registrar'])) {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];
    $nombre = $_POST['nombre'];
    $imagen = $_FILES['imagen'];

    $opc = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'];
    try {
        $conexion = new PDO('mysql:host=localhost;dbname=discografia', 'discografia', 'discografia', $opc);
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }

    if ($imagen['error'] === UPLOAD_ERR_OK) {
        $tipo = $imagen['type'];
        if ($tipo != 'image/jpeg' && $tipo != 'image/png') {
            $mensaje = "Solo se permiten imágenes JPG o PNG.";
        } else {
            $info = getimagesize($imagen['tmp_name']);
            $ancho = $info[0];
            $alto = $info[1];

            if ($ancho > 360 || $alto > 480) {
                $mensaje = "La imagen supera las dimensiones máximas (360x480px).";
            } else {
               
                $dirUsuario = "img/users/" . $usuario;
                if (!is_dir($dirUsuario)) mkdir($dirUsuario, 0777, true);

                $ext = ($tipo == 'image/jpeg') ? 'jpg' : 'png';
                $rutaGrande = "$dirUsuario/{$usuario}_grande.$ext";
                $rutaPequena = "$dirUsuario/{$usuario}_pequena.$ext";

                move_uploaded_file($imagen['tmp_name'], $rutaGrande);

                copy($rutaGrande, $rutaPequena);

                $insert = $conexion->prepare("
                    INSERT INTO usuarios (usuario, contrasena, nombre, imagen_grande, imagen_pequena)
                    VALUES (:usuario, :contrasena, :nombre, :imgG, :imgP)
                ");
                $insert->bindParam(':usuario', $usuario);
                $insert->bindParam(':contrasena', $contrasena);
                $insert->bindParam(':nombre', $nombre);
                $insert->bindParam(':imgG', $rutaGrande);
                $insert->bindParam(':imgP', $rutaPequena);
                $insert->execute();

                $mensaje = "Usuario registrado correctamente.";
            }
        }
    } else {
        $mensaje = "Error al subir la imagen.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Registro de usuario</title>
</head>
<body>
<h1>Registro de usuario</h1>
<?php if ($mensaje) echo "<p>$mensaje</p>"; ?>

<form action="registro.php" method="post" enctype="multipart/form-data">
    <label>Usuario:</label> <input type="text" name="usuario" required><br><br>
    <label>Contraseña:</label> <input type="password" name="contrasena" required><br><br>
    <label>Nombre completo:</label> <input type="text" name="nombre"><br><br>
    <label>Imagen de perfil:</label> <input type="file" name="imagen" required><br><br>
    <input type="submit" name="registrar" value="Registrar usuario">
</form>

<p><a href="login.php">Iniciar sesión</a></p>
</body>
</html>
