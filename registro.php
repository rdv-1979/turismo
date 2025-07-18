<?php
    include './bd/conectar.php';
    $mensaje = '';

    if(isset($_POST['registro'])){
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $nombre = $_POST['nombre'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'");

        $resultado = mysqli_num_rows($sql_buscar);

        if($resultado > 0){
            $mensaje = '<p class="mensaje error">El usuario ya exíste en el sistema!</p>';
        }else{
            $sql_insertar = mysqli_query($conexion, "INSERT INTO usuarios(usuario, clave, nombre, direccion, telefono, correo, id_tipo_u)
                                         VALUES ('$usuario', '$clave', '$nombre', '$direccion', '$telefono', '$correo', 2)");
            if($sql_insertar){
                $mensaje = '<p class="mensaje ok">El usuario se registró con éxito!</p>';
            }else{
                $mensaje = '<p class="mensaje error">Error al registrar el usuario!</p>';
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo-registro.css">
</head>
<body>
    <div class="container-md col-md-6 mt-5 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Registro - usuario</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" required>
            <label for="clave" class="form-label">Clave</label>
            <input type="password" name="clave" id="clave" class="form-control" required>
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required>
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" name="direccion" id="direccion" class="form-control" required>
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" name="telefono" id="telefono" class="form-control" required>
            <label for="correo" class="form-label">Correo</label>
            <input type="text" name="correo" id="correo" class="form-control" required>
            <input type="submit" value="Registro" name="registro" class="form-control btn btn-info">
            <a href="login.php" class="form-control btn btn-success">Regresar a Login!</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>