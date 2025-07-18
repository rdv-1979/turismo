<?php
    include '../bd/conectar.php';
    include './menu.php';

    $sql_desayunos = mysqli_query($conexion, "SELECT * FROM desayuno WHERE estado=1");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar - desayunos</title>
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
                <?php while($datos = mysqli_fetch_array($sql_desayunos)){ ?>
                    <tr>
                        <td><?php echo $datos['id_desayuno']; ?></td>
                        <td><?php echo $datos['descripcion_d']; ?></td>
                        <td><?php echo $datos['precio_desayuno']; ?></td>
                        <td>
                            <a href="modificar_desayuno.php?id=<?php echo $datos['id_desayuno']; ?>"
                               class="btn btn-primary">Modificar</a> 
                            | 
                            <a href="eliminar_desayuno.php?id=<?php echo $datos['id_desayuno']; ?>"
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