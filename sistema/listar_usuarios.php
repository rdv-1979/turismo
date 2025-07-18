<?php
    include '../bd/conectar.php';
    include './menu.php';

    $sql_usuarios = mysqli_query($conexion, "SELECT * FROM usuarios WHERE estado=1");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar - usuarios</title>
    <link rel="stylesheet" href="../css/estilo-listar-usuarios.css">
</head>
<body>
    <div class="table-responsive bg-info">
        <table id="tabla" class="table table-striped table-hover table-dark cell-border">
            <thead>
                <th>#</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Teléfono</th>
                <th>Correo</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php while($datos = mysqli_fetch_array($sql_usuarios)){ ?>
                    <tr>
                        <td><?php echo $datos['id']; ?></td>
                        <td><?php echo $datos['usuario']; ?></td>
                        <td><?php echo $datos['nombre']; ?></td>
                        <td><?php echo $datos['direccion']; ?></td>
                        <td><?php echo $datos['telefono']; ?></td>
                        <td><?php echo $datos['correo']; ?></td>
                        <td>
                            <a href="modificar_usuario.php?id=<?php echo $datos['id']; ?>"
                               class="btn btn-primary">Modificar</a> 
                            | 
                            <a href="eliminar_usuario.php?id=<?php echo $datos['id']; ?>"
                               class="btn btn-danger">Eliminar</a> 
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        let table = new DataTable('#tabla',{

        });
    </script>
</body>
</html>