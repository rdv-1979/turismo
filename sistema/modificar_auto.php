<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM alquiler_auto WHERE id='$id'");

        while($datos = mysqli_fetch_array($sql_buscar)){
            $descripcion = $datos['descripcion'];
            $precio = $datos['precio_auto'];
        }
    }

    if(isset($_POST['modificar'])){
         $id = $_REQUEST['id'];
         $precio = $_POST['precio'];

         $sql_actualizar = mysqli_query($conexion, "UPDATE alquiler_auto SET precio_auto='$precio'
                                                                      WHERE id='$id'");

         if($sql_actualizar){
            $mensaje = '<p class="mensaje ok">El auto se actualizo con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al actualizar este auto!</p>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar auto</title>
    <link rel="stylesheet" href="../css/estilo-eliminar-usuario.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Modificar - auto</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion; ?>" readonly>
            <label for="precio" class="form-label">Precio</label>
            <input type="text" name="precio" id="precio" class="form-control" value="<?php echo $precio; ?>" required>
            <input type="submit" value="Modificar" name="modificar" class="form-control btn btn-danger"
                   onclick="return confirm('¿Desea modificar este auto?');">
            <a href="listar_autos.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html><?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM alquiler_auto WHERE id='$id'");

        while($datos = mysqli_fetch_array($sql_buscar)){
            $descripcion = $datos['descripcion'];
            $precio = $datos['precio_auto'];
        }
    }

    if(isset($_POST['modificar'])){
         $id = $_REQUEST['id'];
         $precio = $_POST['precio'];

         $sql_actualizar = mysqli_query($conexion, "UPDATE alquiler_auto SET precio_auto='$precio'
                                                                      WHERE id='$id'");

         if($sql_actualizar){
            $mensaje = '<p class="mensaje ok">El auto se actualizo con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al actualizar este auto!</p>';
         }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar auto</title>
    <link rel="stylesheet" href="../css/estilo-eliminar-usuario.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Modificar - auto</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="<?php echo $descripcion; ?>" readonly>
            <label for="precio" class="form-label">Precio</label>
            <input type="text" name="precio" id="precio" class="form-control" value="<?php echo $precio; ?>" required>
            <input type="submit" value="Modificar" name="modificar" class="form-control btn btn-danger"
                   onclick="return confirm('¿Desea modificar este auto?');">
            <a href="listar_autos.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html>