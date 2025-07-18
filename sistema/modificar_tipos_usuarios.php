<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM tipos_usuario WHERE id_tipo='$id'");

        while($datos = mysqli_fetch_array($sql_buscar)){
            $descripcion = $datos['descripcion'];
        }
    }

    if(isset($_POST['modificar'])){
         $id = $_REQUEST['id'];
         $descripcion = $_POST['descripcion'];

         $sql_actualizar = mysqli_query($conexion, "UPDATE tipos_usuario SET descripcion='$descripcion'
                                                                      WHERE id_tipo='$id'");

         if($sql_actualizar){
            $mensaje = '<p class="mensaje ok">El tipo dusuario se actualizo con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al actualizar el tipo de usuario!</p>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar tipos de excursión</title>
    <link rel="stylesheet" href="../css/estilo-eliminar-usuario.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Modificar - tipos de usuarios</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion; ?>" required>
            <input type="submit" value="Modificar" name="modificar" class="form-control btn btn-danger"
                   onclick="return confirm('¿Desea modificar este tipo de excursión?');">
            <a href="listar_tipos_usuarios.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html>