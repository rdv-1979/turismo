<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM paquetes WHERE id_paquete='$id'");

        while($datos = mysqli_fetch_array($sql_buscar)){
            $destino = $datos['destino'];
            $descripcion = $datos['descripcion_paquete'];
            $imagen = $datos['imagen_paquete'];
            $precio = $datos['precio'];
        }
    }

    if(isset($_POST['eliminar'])){
         $id = $_REQUEST['id'];

         $sql_eliminar = mysqli_query($conexion, "UPDATE paquetes SET estado=0 WHERE id_paquete='$id'");

         if($sql_eliminar){
            $mensaje = '<p class="mensaje ok">El paquete se elimino con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al eliminar este paquete!</p>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar paquete turístico</title>
    <link rel="stylesheet" href="../css/estilo-eliminar-usuario.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Eliminar - paquete turístico</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="destino" class="form-label">Destino</label>
            <input type="text" name="destino" id="destino" class="form-control" value="<?php echo $destino; ?>" readonly>
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion; ?>" readonly>
            <label for="imagen" class="form-label">Imagen</label>
            <img src="<?php echo $imagen; ?>" alt="imagen" width="100px;" class="form-control">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" value="<?php echo $precio; ?>" readonly>
            <input type="submit" value="Eliminar" class="form-control btn btn-danger" name="eliminar"
                   onclick="return confirm('¿Desea eliminar este paquete?');">
            <a href="listar_paquetes.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html>