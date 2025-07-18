<?php
    include '../bd/conectar.php';
    include './menu.php';

    $sql_autos = mysqli_query($conexion, "SELECT * FROM alquiler_auto WHERE estado=1");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar - autos</title>
    <link rel="stylesheet" href="../css/estilo-listar-usuarios.css">
</head>
<body>
    <div class="table-responsive bg-info">
        <table id="tabla" class="table table-striped table-hover table-dark cell-border">
            <thead>
                <th>#</th>
                <th>Descripción</th>
                <th>Precio</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php while($datos = mysqli_fetch_array($sql_autos)){ ?>
                    <tr>
                        <td><?php echo $datos['id']; ?></td>
                        <td><?php echo $datos['descripcion']; ?></td>
                        <td><?php echo $datos['precio_auto']; ?></td>
                        <td>
                            <a href="modificar_auto.php?id=<?php echo $datos['id']; ?>"
                               class="btn btn-primary">Modificar</a> 
                            | 
                            <a href="eliminar_auto.php?id=<?php echo $datos['id']; ?>"
                               class="btn btn-danger">Eliminar</a> 
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <script>
        let table = new DataTable('#tabla');
    </script>
</body>
</html>