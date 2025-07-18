<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    if(isset($_POST['registro'])){
        $descripcion = $_POST['descripcion'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM tipos_usuario WHERE descripcion='$descripcion'");
        $resultado = mysqli_num_rows($sql_buscar);

        if($resultado > 0){
            $mensaje = '<p class="mensaje error">El tipo de usuario ya exíste en el sistema!</p>';
        }else{
            $sql_insertar = mysqli_query($conexion, "INSERT INTO tipos_usuario(descripcion)
                                         VALUES ('$descripcion')");
            if($sql_insertar){
                $mensaje = '<p class="mensaje ok">El tipo de usuario se registró con éxito!</p>';
            }else{
                $mensaje = '<p class="mensaje error">Error al registrar el tipo de usuario!</p>';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - tipos de usuarios</title>
    <link rel="stylesheet" href="../css/estilo-ingresar-usuarios.css">
</head>
<body>
    <div class="container-md col-md-6 mt-5 shadow-lg p-3 mb-5 bg-info rounded">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Ingresar - tipos de usuario</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
            <input type="submit" value="Ingresar" name="registro" class="form-control btn btn-warning">
            <a href="listar_tipos_usuarios.php" class="form-control btn btn-success">Salir</a>
        </form>
    </div>
</body>
</html>