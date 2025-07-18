<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_POST['registro'])){
        $destino_a = $_POST['destino_aereo'];
        $precio = $_POST['precio'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM aereos WHERE destino_aereo='$destino_a'");
        $resultado = mysqli_num_rows($sql_buscar);

        if($resultado > 0){
            $mensaje = '<p class="mensaje error">El destino aereo ya exíste en el sistema!</p>';
        }else{
            $sql_insertar = mysqli_query($conexion, "INSERT INTO aereos(destino_aereo, precio_aereo)
                                         VALUES ('$destino_a', '$precio')");
            if($sql_insertar){
                $mensaje = '<p class="mensaje ok">El destino aereo se registró con éxito!</p>';
            }else{
                $mensaje = '<p class="mensaje error">Error al registrar el destino aereo!</p>';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - aereos</title>
    <link rel="stylesheet" href="../css/estilo-ingresar-usuarios.css">
</head>
<body>
    <div class="container-md col-md-6 mt-5 shadow-lg p-3 mb-5 bg-info rounded">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Ingresar - aereos</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="destino_aereo" class="form-label">Destino</label>
            <input type="text" name="destino_aereo" id="destino_aereo" class="form-control" required>
            <label for="precio" class="form-label">Precio</label>
            <input type="number" name="precio" id="precio" class="form-control" required>
            <input type="submit" value="Ingresar" name="registro" class="form-control btn btn-warning">
            <a href="listar_aereos.php" class="form-control btn btn-success">Salir</a>
        </form>
    </div>
</body>
</html>