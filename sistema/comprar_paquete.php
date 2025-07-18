<?php
    include './menu.php';
    include '../bd/conectar.php';
    $mensaje = '';

    $id_usuario = $_SESSION['Id']; 
    $usuario = $_SESSION['User'];
    $nombre = $_SESSION['nombre'];
    $tipo = $_SESSION['tipo_u'];
    $correo = $_SESSION['correo'];

    $sql_alquiler = mysqli_query($conexion, "SELECT * FROM alquiler_auto WHERE estado=1");
    $sql_desayuno = mysqli_query($conexion, "SELECT * FROM desayuno WHERE estado=1");
    $sql_tipo_excursiones = mysqli_query($conexion, "SELECT * FROM tipo_excursiones WHERE estado=1");
    $sql_aereos = mysqli_query($conexion, "SELECT * FROM aereos WHERE estado_aereo=1");

    if(isset($_REQUEST['id_paquete'])){
        $id = $_REQUEST['id_paquete'];

        $sql = mysqli_query($conexion, "SELECT * FROM paquetes p INNER JOIN desayuno d ON p.id_tipo_des=d.id_desayuno
                                                           INNER JOIN alquiler_auto a ON a.id=p.id_alquiler_auto
                                                           INNER JOIN tipo_excursiones t ON t.id_excursiones_t=p.id_excursiones
                                                           INNER JOIN aereos s ON p.id_aereo_paq=s.id_a
                                                           WHERE p.id_paquete='$id'");
        while($datos = mysqli_fetch_array($sql)){
                $destino = $datos['destino'];
                $descripcion = $datos['descripcion_paquete'];
                $imagen = $datos['imagen_paquete']; 
                $fecha_s = $datos['fecha_salida']; 
                $fecha_ll = $datos['fecha_llegada'];
                $aereo = $datos['destino_aereo']; 
                $desayuno = $datos['descripcion_d']; 
                $excursion = $datos['descripcion_exc']; 
                $auto = $datos['descripcion']; 
                $precio = $datos['precio'];
                $id_desayuno = $datos['id_desayuno'];
                $id_excursion = $datos['id_excursiones_t'];
                $id_alquiler_auto = $datos['id_alquiler_auto'];
                $id_aereo = $datos['id_aereo_paq'];
        }
    }

    if(isset($_POST['registro'])){
        $aereop = $_POST['aereo'];
        $desayunop = $_POST['desayuno'];
        $excursionp = $_POST['excursion'];
        $alquilerp = $_POST['alquiler'];
        $cantpersonas = $_POST['personas'];

        $sql_aereo_venta = mysqli_query($conexion, "SELECT * FROM aereos WHERE id_a='$aereop'");
        $datos = mysqli_fetch_array($sql_aereo_venta);
        $precioaereo = $datos['precio_aereo'];

        $sql_desayuno_venta = mysqli_query($conexion, "SELECT * FROM desayuno WHERE id_desayuno='$desayunop'");
        $datos = mysqli_fetch_array($sql_desayuno_venta);
        $preciodesayuno = $datos['precio_desayuno']; 

        $sql_auto_venta = mysqli_query($conexion, "SELECT * FROM alquiler_auto WHERE id='$alquilerp'");
        $datos = mysqli_fetch_array($sql_auto_venta);
        $precioauto = $datos['precio_auto'];

        $sql_excursiones = mysqli_query($conexion, "SELECT * FROM tipo_excursiones WHERE id_excursiones_t='$excursionp'");
        $datos = mysqli_fetch_array($sql_excursiones);
        $precioexcursiones = $datos['precio_excursiones'];
        
        $preciofinal = ($precio + $precioaereo + $precioauto + $preciodesayuno + $precioexcursiones) * $cantpersonas;
        
        $sql_reservar = mysqli_query($conexion, "INSERT INTO ventas(id_usuario_venta, id_paquete_venta, correo_usuario, total_clientes, total_venta) 
                                                 VALUES ('$id_usuario', '$id', '$correo', '$cantpersonas', '$preciofinal')");
        if($sql_reservar){
            $mensaje = '<p class="mensaje ok">El paquete se reservo con éxito!</p>';
         }else{
            $mensaje = '<p class="mensaje error">Error al reservar este paquete!</p>';
         }
        
    }
    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprar paquete turístico</title>
    <link rel="stylesheet" href="../css/estilo-ingresar-usuarios.css">
    <style>
        .ver-menu {
            display: none;
        }
    </style>
</head>
<body>
    <div class="container-md col-md-6 mt-5 shadow-lg p-3 mb-5 bg-info rounded">
        <form action="" method="post" class="d-grid gap-2">
            <h2 class="form-label text-center">Comprar - paquete</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="destino" class="form-label">Destino</label>
            <input type="text" name="destino" id="destino" class="form-control" 
                   value="<?php echo $destino; ?>" readonly>
            <label for="descripcion" class="form-label">Descripciòn</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" 
                   value="<?php echo $descripcion; ?>" readonly>
            <label for="imagen" class="form-label">Imagen</label>
            <img src="<?php echo $imagen; ?>" alt="imagen" class="form-control">
            <label for="fecha_s" class="form-label">Fecha salida</label>
            <input type="date" name="fecha_s" id="fecha_s" class="form-control" 
                   value="<?php echo $fecha_s; ?>" readonly>
            <label for="fecha_ll" class="form-label">Fecha llegada</label>
            <input type="date" name="fecha_ll" id="fecha_ll" class="form-control" 
                   value="<?php echo $fecha_ll; ?>" readonly>

            <label for="aereo" class="form-label">Aereos</label>
            <select name="aereo" id="aereo" class="form-control" required>
                <?php while($datos = mysqli_fetch_array($sql_aereos)){ ?>
                        <option value="">Elegir opción</option>
                        <option value="<?php echo $datos['id_a']; ?>">
                            <?php echo $datos['id_a']; ?> | <?php echo $datos['destino_aereo']; ?> | <?php echo $datos['precio_aereo']; ?>
                        </option>
                <?php } ?>
            </select>

            <label for="desayuno" class="form-label">Desayuno</label>
            <select name="desayuno" id="desayuno" class="form-control" required>
                <?php while($datos = mysqli_fetch_array($sql_desayuno)){ ?>
                        <option value="">Elegir opción</option>
                        <option value="<?php echo $datos['id_desayuno']; ?>">
                            <?php echo $datos['id_desayuno']; ?> | <?php echo $datos['descripcion_d']; ?> | <?php echo $datos['precio_desayuno']; ?>
                        </option>
                <?php } ?>
            </select>
            <label for="excursion" class="form-label">Excursion</label>
            <select name="excursion" id="excursion" class="form-control" required>
                <?php while($datos = mysqli_fetch_array($sql_tipo_excursiones)){ ?>
                        <option value="">Elegir opción</option>
                        <option value="<?php echo $datos['id_excursiones_t']; ?>">
                            <?php echo $datos['id_excursiones_t']; ?> | <?php echo $datos['descripcion_exc']; ?> | <?php echo $datos['precio_excursiones']; ?>
                        </option>
                <?php } ?>
            </select>
            <label for="alquiler" class="form-label">Alquiler auto</label>
            <select name="alquiler" id="alquiler" class="form-control" required>
                <?php while($datos = mysqli_fetch_array($sql_alquiler)){ ?>
                        <option value="">Elegir opción</option>
                        <option value="<?php echo $datos['id']; ?>">
                            <?php echo $datos['id']; ?> | <?php echo $datos['descripcion']; ?> | <?php echo $datos['precio_auto']; ?>
                        </option>
                <?php } ?>
            </select>

            <label for="personas" class="form-label">Cant. personas</label>
            <input type="number" name="personas" id="personas" min=1 max=200 value=1 class="form-control" required>

            <label for="precio" class="form-label">Precio</label>
            <input type="text" name="precio" id="precio" class="form-control" 
                   value="<?php echo $precio; ?>" readonly>
            <input type="submit" value="Ingresar" name="registro" class="form-control btn btn-warning">
            <a href="index_usuario.php" class="form-control btn btn-success">Salir</a>
        </form>
    </div>
</body>
</html>