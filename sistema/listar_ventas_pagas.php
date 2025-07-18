<?php
    include './menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    $id = $_SESSION['Id'];
    
    $sql_ventas_pagadas = mysqli_query($conexion, "SELECT * FROM ventas WHERE estado_v=1 and id_usuario_venta='$id'");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial</title>
    <link rel="stylesheet" href="../css/estilo-listar-usuarios.css">
</head>
<body>
    <div class="table-responsive bg-info">
        <table id="tabla" class="table table-striped table-hover table-dark cell-border">
            <thead>
                <th>#</th>
                <th>Correo usuario</th>
                <th>Fecha venta</th>
                <th>Total clientes</th>
                <th>Total venta</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php while($datos = mysqli_fetch_array($sql_ventas_pagadas)){ ?>
                    <tr>
                        <td><?php echo $datos['id_venta']; ?></td>
                        <td><?php echo $datos['correo_usuario']; ?></td>
                        <td><?php echo $datos['fecha_venta']; ?></td>
                        <td><?php echo $datos['total_clientes']; ?></td>
                        <td><?php echo $datos['total_venta']; ?></td>
                        <td>
                            <a href="imprimir_venta.php?id=<?php echo $datos['id_venta']; ?>"
                               class="btn btn-info" target="_blank">Imprimir</a> 
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