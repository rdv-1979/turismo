<?php
    include '../bd/conectar.php';
    include './menu.php';

    $sql_usuarios = mysqli_query($conexion, "SELECT * FROM paquetes p INNER JOIN desayuno d ON p.id_tipo_des=d.id_desayuno
                                                           INNER JOIN alquiler_auto a ON a.id=p.id_alquiler_auto
                                                           INNER JOIN tipo_excursiones t ON t.id_excursiones_t=p.id_excursiones
                                                           WHERE p.estado=1");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar - Paquetes</title>
    <link rel="stylesheet" href="../css/estilo-listar-usuarios.css">
</head>
<body>
    <div class="table-responsive bg-info">
        <table id="tabla" class="table table-striped table-hover table-dark cell-border">
            <thead>
                <th>#</th>
                <th>Destino</th>
                <th>Descripción</th>
                <th>Imagen</th>
                <th>Fecha salida</th>
                <th>Fecha llegada</th>
                <th>Desayuno</th>
                <th>Excursiones</th>
                <th>Auto</th>
                <th>Precio</th>
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php while($datos = mysqli_fetch_array($sql_usuarios)){ ?>
                    <tr>
                        <td><?php echo $datos['id_paquete']; ?></td>
                        <td><?php echo $datos['destino']; ?></td>
                        <td><?php echo $datos['descripcion_paquete']; ?></td>
                        <td><img src="<?php echo $datos['imagen_paquete']; ?>" alt="imagen" width="75px;" height="75px;"></td>
                        <td><?php echo $datos['fecha_salida']; ?></td>
                        <td><?php echo $datos['fecha_llegada']; ?></td>
                        <td><?php echo $datos['descripcion_d']; ?></td>
                        <td><?php echo $datos['descripcion_exc']; ?></td>
                        <td><?php echo $datos['descripcion']; ?></td>
                        <td><?php echo $datos['precio']; ?></td>
                        <td>
                            <a href="modificar_paquete.php?id=<?php echo $datos['id_paquete']; ?>"
                               class="btn btn-primary">Modificar</a> 
                            | 
                            <a href="eliminar_paquete.php?id=<?php echo $datos['id_paquete']; ?>"
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