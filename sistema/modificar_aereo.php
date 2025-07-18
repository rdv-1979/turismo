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

    if(isset($_POST['modificar'])){
         $id = $_REQUEST['id'];
         $precio = $_POST['precio'];

         $sql_actualizar = mysqli_query($conexion, "UPDATE aereos SET precio_aereo='$precio'
                                                                      WHERE id_a='$id'");

         if($sql_actualizar){
            $mensaje = '<p class="mensaje ok">El aereo se actualizo con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al actualizar este aereo!</p>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar aereo</title>
    <link rel="stylesheet" href="../css/estilo-eliminar-usuario.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Modificar - aereo</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="destino_aereo" class="form-label">Destino</label>
            <input type="text" name="destino_aereo" id="destino_aereo" class="form-control" value="<?php echo $destino_a; ?>" readonly>
            <label for="precio" class="form-label">Precio</label>
            <input type="text" name="precio" id="precio" class="form-control" value="<?php echo $precio; ?>" required>
            <input type="submit" value="Modificar" name="modificar" class="form-control btn btn-danger"
                   onclick="return confirm('¿Desea modificar este aereo?');">
            <a href="listar_aereos.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html>