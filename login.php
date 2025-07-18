<?php
    include './bd/conectar.php';
    session_start();
    $mensaje = '';

    if(isset($_POST['login'])){
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario' AND clave='$clave'");

        $resultado = mysqli_num_rows($sql_buscar);

        if($resultado > 0){
            while($datos = mysqli_fetch_array($sql_buscar)){
                $id = $datos['id'];
                $nombre = $datos['nombre'];
                $tipo = $datos['id_tipo_u'];
                $correo = $datos['correo'];
            }
            $_SESSION['User'] = $usuario;
            $_SESSION['nombre'] = $nombre;
            $_SESSION['tipo_u'] = $tipo;
            $_SESSION['correo'] = $correo;
            $_SESSION['Id'] = $id;
            header('Location: ./sistema/menu.php');
        }else{
            $mensaje = '<p class="mensaje error">El usuario o contraseña son incorrectos!</p>';
        }
    }


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema - Portal turístico</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo-login.css">
</head>
<body>
    <div class="container-md col-md-6 mt-5 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Login - usuario</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" required>
            <label for="clave" class="form-label">Clave</label>
            <input type="text" name="clave" id="clave" class="form-control" required>
            <input type="submit" value="Login" name="login" class="form-control btn btn-info">
            <label for="registro" class="form-label text-danger">¿No estás registrado?</label>
            <a href="registro.php" class="form-control btn btn-warning">Registrarse!</a>
            <label for="index" class="form-label text-danger">Salir a index.</label>
            <a href="index.php" class="form-control btn btn-dark">Salir</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>