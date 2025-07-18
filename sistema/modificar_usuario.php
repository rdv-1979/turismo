<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE id='$id'");

        while($datos = mysqli_fetch_array($sql_buscar)){
            $usuario = $datos['usuario'];
            $nombre = $datos['nombre'];
            $direccion = $datos['direccion'];
            $telefono = $datos['telefono'];
            $correo = $datos['correo'];
        }
    }

    if(isset($_POST['modificar'])){
         $id = $_REQUEST['id'];
         $direccion = $_POST['direccion'];
         $telefono = $_POST['telefono'];
         $correo = $_POST['correo'];

         $sql_actualizar = mysqli_query($conexion, "UPDATE usuarios SET direccion='$direccion',
                                                                      telefono='$telefono',
                                                                      correo='$correo'
                                                                      WHERE id='$id'");

         if($sql_actualizar){
            $mensaje = '<p class="mensaje ok">El usuario se actualizo con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al actualizar este usuario!</p>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar usuario</title>
    <link rel="stylesheet" href="../css/estilo-eliminar-usuario.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Modificar - usuario</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario; ?>" readonly>
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" readonly>
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direccion; ?>" required>
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $telefono; ?>" required>
            <label for="correo" class="form-label">Correo</label>
            <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correo; ?>" required>
            <input type="submit" value="Modificar" name="modificar" class="form-control btn btn-danger"
                   onclick="return confirm('¿Desea modificar este usuario?');">
            <a href="listar_usuarios.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html>