<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_POST['registro'])){
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM tipo_excursiones WHERE descripcion_exc='$descripcion'");
        $resultado = mysqli_num_rows($sql_buscar);

        if($resultado > 0){
            $mensaje = '<p class="mensaje error">La excursión ya exíste en el sistema!</p>';
        }else{
            $sql_insertar = mysqli_query($conexion, "INSERT INTO tipo_excursiones(descripcion_exc, precio_excursiones)
                                         VALUES ('$descripcion', '$precio')");
            if($sql_insertar){
                $mensaje = '<p class="mensaje ok">La excursión se registró con éxito!</p>';
            }else{
                $mensaje = '<p class="mensaje error">Error al registrar la excursión!</p>';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - excursión</title>
    <link rel="stylesheet" href="../css/estilo-ingresar-usuarios.css">
</head>
<body>
    <div class="container-md col-md-6 mt-5 shadow-lg p-3 mb-5 bg-info rounded">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Ingresar - excursión</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" required>
            <input type="submit" value="Ingresar" name="registro" class="form-control btn btn-warning">
            <a href="listar_excursiones.php" class="form-control btn btn-success">Salir</a>
        </form>
    </div>
</body>
</html>