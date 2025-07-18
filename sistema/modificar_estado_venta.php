<?php
    include './menu.php';
    include '../bd/conectar.php';

    $mensaje = '';

    $id = $_REQUEST['id_venta'];

    $sql_buscar = mysqli_query($conexion, "SELECT * FROM ventas v INNER JOIN usuarios u ON v.id_usuario_venta=u.id
                                                           INNER JOIN paquetes p ON v.id_paquete_venta=p.id_paquete
                                                           WHERE v.id_venta='$id'");
    while($datos = mysqli_fetch_array($sql_buscar)){
        $id_venta = $datos['id_venta'];
        $usuario = $datos['usuario'];
        $correo = $datos['correo_usuario'];
        $destino = $datos['destino'];
        $fecha_venta = $datos['fecha_venta'];
        $total_clientes = $datos['total_clientes'];
        $total_venta = $datos['total_venta'];
        $estado = $datos['estado_v'];
    }

    if(isset($_POST['modificar'])){
        $pagar = $_POST['pago'];

        $id = $_REQUEST['id_venta'];

        $sql_actualizar_estado = mysqli_query($conexion, "UPDATE ventas SET estado_v=1 WHERE id_venta='$id'");

        if($sql_actualizar_estado){
            $mensaje = '<p class="mensaje ok">La venta fue abonada con éxito!</p>';
        }else{
            $mensaje = '<p class="mensaje error">Error al abonar esta venta!</p>';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar estado de venta</title>
    <link rel="stylesheet" href="../css/estilo-listar-usuarios.css">
</head>
<body>
    <div class="container-md col-md-6 bg-info">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Modificar - estado de venta</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="id_venta" class="form-label">ID</label>
            <input type="text" name="id_venta" id="id_venta" class="form-control" value="<?php echo $id_venta; ?>" readonly>
            <label for="usuario" class="form-label">Usuario</label>
            <input type="text" name="usuario" id="usuario" class="form-control" value="<?php echo $usuario; ?>" readonly>
            <label for="correo" class="form-label">Correo</label>
            <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $correo; ?>" readonly>
            <label for="destino" class="form-label">Destino</label>
            <input type="text" name="destino" id="destino" class="form-control" value="<?php echo $destino; ?>" readonly>
            <label for="fecha_venta" class="form-label">Correo</label>
            <input type="text" name="fecha_venta" id="fecha_venta" class="form-control" value="<?php echo $fecha_venta; ?>" readonly>
            <label for="total_clientes" class="form-label">Total clientes</label>
            <input type="text" name="total_clientes" id="total_clientes" class="form-control" value="<?php echo $total_clientes; ?>" readonly>
            <label for="total_venta" class="form-label">Total venta</label>
            <input type="text" name="total_venta" id="total_venta" class="form-control" value="<?php echo $total_venta; ?>" readonly>
            <select name="pago" id="pago" class="form-control" required>
                <option value="">Ingresar Estado</option>
                <option value="pagar">Pagar</option>
            </select>
            <input type="submit" value="Modificar" name="modificar" class="form-control btn btn-danger"
                   onclick="return confirm('¿Desea modificar esta venta?');">
            <a href="index_usuario.php" class="form-control btn btn-warning">Salir</a>
        </form>
    </div>
</body>
</html>