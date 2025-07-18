<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_POST['registro'])){
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM alquiler_auto WHERE descripcion='$descripcion'");
        $resultado = mysqli_num_rows($sql_buscar);

        if($resultado > 0){
            $mensaje = '<p class="mensaje error">El auto ya exíste en el sistema!</p>';
        }else{
            $sql_insertar = mysqli_query($conexion, "INSERT INTO alquiler_auto(descripcion, precio_auto)
                                         VALUES ('$descripcion', '$precio')");
            if($sql_insertar){
                $mensaje = '<p class="mensaje ok">El auto se registró con éxito!</p>';
            }else{
                $mensaje = '<p class="mensaje error">Error al registrar el auto!</p>';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - auto</title>
    <link rel="stylesheet" href="../css/estilo-ingresar-usuarios.css">
</head>
<body>
    <div class="container-md col-md-6 mt-5 shadow-lg p-3 mb-5 bg-info rounded">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Ingresar - auto</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" required>
            <input type="submit" value="Ingresar" name="registro" class="form-control btn btn-warning">
            <a href="listar_autos.php" class="form-control btn btn-success">Salir</a>
        </form>
    </div>
</body>
</html>