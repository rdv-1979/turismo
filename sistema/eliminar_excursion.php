<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM tipo_excursiones WHERE id_excursiones_t='$id'");

        while($datos = mysqli_fetch_array($sql_buscar)){
            $descripcion = $datos['descripcion_exc'];
            $precio = $datos['precio_excursiones'];
        }
    }

    if(isset($_POST['eliminar'])){
         $id = $_REQUEST['id'];

         $sql_eliminar = mysqli_query($conexion, "UPDATE tipo_excursiones SET estado=0 WHERE id_excursiones_t='$id'");

         if($sql_eliminar){
            $mensaje = '<p class="mensaje ok">La excursión se elimino con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al eliminar esta excursión!</p>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar desayuno</title>
    <link rel="stylesheet" href="../css/estilo-eliminar-usuario.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Eliminar - desayuno</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion; ?>" readonly>
            <label for="precio" class="form-label">Precio</label>
            <input type="text" name="precio" id="precio" class="form-control" value="<?php echo $precio; ?>" readonly>
            <input type="submit" value="Eliminar" class="form-control btn btn-danger" name="eliminar"
                   onclick="return confirm('¿Desea eliminar esta excursión?');">
            <a href="listar_desayunos.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html>