<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM aereos WHERE id_a='$id'");

        while($datos = mysqli_fetch_array($sql_buscar)){
            $destino_a = $datos['destino_aereo'];
            $precio = $datos['precio_aereo'];
        }
    }

    if(isset($_POST['eliminar'])){
         $id = $_REQUEST['id'];

         $sql_eliminar = mysqli_query($conexion, "UPDATE aereos SET estado_aereo=0 WHERE id_a='$id'");

         if($sql_eliminar){
            $mensaje = '<p class="mensaje ok">El aereo se elimino con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al eliminar este aereo!</p>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar aereo</title>
    <link rel="stylesheet" href="../css/estilo-eliminar-usuario.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Eliminar - aereo</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="destino_aereo" class="form-label">Destino</label>
            <input type="text" name="destino_aereo" id="destino_aereo" class="form-control" value="<?php echo $destino_a; ?>" readonly>
            <label for="precio" class="form-label">Precio</label>
            <input type="text" name="precio" id="precio" class="form-control" value="<?php echo $precio; ?>" readonly>
            <input type="submit" value="Eliminar" class="form-control btn btn-danger" name="eliminar"
                   onclick="return confirm('¿Desea eliminar este aereo?');">
            <a href="listar_aereos.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html>