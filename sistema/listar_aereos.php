<?php
    include '../bd/conectar.php';
    include './menu.php';

    $sql_aereos = mysqli_query($conexion, "SELECT * FROM aereos WHERE estado_aereo=1");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar - aereos</title>
    <link rel="stylesheet" href="../css/estilo-listar-usuarios.css">
</head>
<body>
    <div class="table-responsive bg-info">
        <table id="tabla" class="table table-striped table-hover table-dark cell-border">
            <thead>
                <th>#</th>
                <th>Destino</th>
                <th>Precio</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php while($datos = mysqli_fetch_array($sql_aereos)){ ?>
                    <tr>
                        <td><?php echo $datos['id_a']; ?></td>
                        <td><?php echo $datos['destino_aereo']; ?></td>
                        <td><?php echo $datos['precio_aereo']; ?></td>
                        <td>
                            <a href="modificar_aereo.php?id=<?php echo $datos['id_a']; ?>"
                               class="btn btn-primary">Modificar</a> 
                            | 
                            <a href="eliminar_aereo.php?id=<?php echo $datos['id_a']; ?>"
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