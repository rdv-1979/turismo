<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    $id = $_REQUEST['id'];

    $sql = mysqli_query($conexion, "SELECT * FROM ventas v INNER JOIN usuarios u ON v.id_usuario_venta=u.id
                                                           INNER JOIN paquetes p ON v.id_paquete_venta=p.id_paquete
                                                           WHERE v.id_usuario_venta='$id'");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ventas</title>
    <link rel="stylesheet" href="../css/estilo-listar-usuarios.css">
</head>
<body>
    <div class="table-responsive bg-info">
            <table id="tabla" class="table table-hover table-striped table-dark">
                <thead>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Destino</th>
                    <th>Correo</th>
                    <th>Fecha venta</th>
                    <th>Total clientes</th>
                    <th>Total venta</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </thead>
                <tbody>
                    <?php while($datos = mysqli_fetch_array($sql)){ ?>
                        <tr>
                            <td><?php echo $datos['id_venta']; ?></td>
                            <td><?php echo $datos['usuario']; ?></td>
                            <td><?php echo $datos['destino']; ?></td>
                            <td><?php echo $datos['correo_usuario']; ?></td>
                            <td><?php echo $datos['fecha_venta']; ?></td>
                            <td><?php echo $datos['total_clientes']; ?></td>
                            <td><?php echo $datos['total_venta']; ?></td>
                                <?php if ($datos['estado_v'] == 0){ ?>
                                            <td><p style="color:red;font-size:18px; font-family:monospace;">Pendiente</p></td>
                                            <td>
                                                <a href="modificar_estado_venta.php?id_venta=<?php echo $datos['id_venta']; ?>" class="btn btn-primary"
                                                onclick="return confirm('¿Desea modificar el estado de la venta?');">Modificar</a>
                                            </td>
                                <?php } else {?>
                                            <td><p style="color:green;font-size:18px; font-family:monospace;">Pagado</p></td>
                                            <td>
                                                <a href="#" class="btn btn-success">Historial</a>
                                            </td>
                                <?php } ?>
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