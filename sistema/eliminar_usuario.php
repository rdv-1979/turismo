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

    if(isset($_POST['eliminar'])){
         $id = $_REQUEST['id'];

         $sql_eliminar = mysqli_query($conexion, "UPDATE usuarios SET estado=0 WHERE id='$id'");

         if($sql_eliminar){
            $mensaje = '<p class="mensaje ok">El usuario se elimino con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al eliminar este usuario!</p>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar usuario</title>
    <link rel="stylesheet" href="../css/estilo-eliminar-usuario.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Eliminar - usuario</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario; ?>" readonly>
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" value="<?php echo $nombre; ?>" readonly>
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direccion; ?>" readonly>
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $telefono; ?>" readonly>
            <label for="direccion" class="form-label">Dirección</label>
            <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $direccion; ?>" readonly>
            <label for="correo" class="form-label">Correo</label>
            <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correo; ?>" readonly>
            <input type="submit" value="Eliminar" class="form-control btn btn-danger" name="eliminar"
                   onclick="return confirm('¿Desea eliminar este usuario?');">
            <a href="listar_usuarios.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html>