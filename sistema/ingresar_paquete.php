<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    $sql_alquiler = mysqli_query($conexion, "SELECT * FROM alquiler_auto WHERE estado=1");
    $sql_desayuno = mysqli_query($conexion, "SELECT * FROM desayuno WHERE estado=1");
    $sql_tipo_excursiones = mysqli_query($conexion, "SELECT * FROM tipo_excursiones WHERE estado=1");
    $sql_aereos = mysqli_query($conexion, "SELECT * FROM aereos WHERE estado_aereo=1");

    if(isset($_POST['registro'])){
        $destino = $_POST['destino'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_FILES['imagen']['name'];
        $fecha_s = $_POST['fecha_s'];
        $fecha_ll = $_POST['fecha_ll'];
        $aereo = $_POST['aereo'];
        $desayuno = $_POST['desayuno'];
        $excursion = $_POST['excursion'];
        $alquiler = $_POST['alquiler'];
        $precio = $_POST['precio'];

        $sql_buscar = mysqli_query($conexion, "SELECT * FROM paquetes WHERE destino='$destino'");

        $resultado = mysqli_num_rows($sql_buscar);

        if($resultado > 0){
            $mensaje = '<p class="mensaje error">El paquete ya exíste en el sistema!</p>';
        }else{

            if($imagen == ''){
                $imagen = 'img-sistema/vacio.jpg';
                $ruta = $imagen;

                $sql_insertar = mysqli_query($conexion, "INSERT INTO paquetes(destino, descripcion_paquete, imagen_paquete, fecha_salida, fecha_llegada, id_aereo_paq, id_tipo_des, id_excursiones, id_alquiler_auto, precio) 
                                                         VALUES ('$destino', '$descripcion', '$ruta', '$fecha_s', '$fecha_ll', '$aereo', '$desayuno', '$excursion', '$alquiler', '$precio')");
            
                if($sql_insertar){
                    $mensaje = '<p class="mensaje ok">El paquete se registró con éxito!</p>';
                }else{
                    $mensaje = '<p class="mensaje error">Error al registrar el paquete!</p>';
                }
            }
            else{
                $tiempo = time();
                $imagen_copia = $_FILES['imagen']['tmp_name'];
                $ruta = 'uploads/'.$tiempo.$_FILES['imagen']['name'];
                move_uploaded_file($imagen_copia, $ruta);

                $sql_insertar = mysqli_query($conexion, "INSERT INTO paquetes(destino, descripcion_paquete, imagen_paquete, fecha_salida, fecha_llegada, id_aereo_paq, id_tipo_des, id_excursiones, id_alquiler_auto, precio) 
                                                         VALUES ('$destino', '$descripcion', '$ruta', '$fecha_s', '$fecha_ll', '$aereo', '$desayuno', '$excursion', '$alquiler', '$precio')");
            
                if($sql_insertar){
                    $mensaje = '<p class="mensaje ok">El paquete se registró con éxito!</p>';
                }else{
                    $mensaje = '<p class="mensaje error">Error al registrar el paquete!</p>';
                }
            }
            $sql_resultado = mysqli_query($conexion, "SELECT * FROM paquetes p INNER JOIN desayuno d ON p.id_tipo_des=d.id_desayuno
                                                           INNER JOIN alquiler_auto a ON a.id=p.id_alquiler_auto
                                                           INNER JOIN tipo_excursiones t ON t.id_excursiones_t=p.id_excursiones
                                                           INNER JOIN aereos s ON s.id_a=p.id_aereo_paq
                                                           WHERE id_paquete='$id'");

            while($datos = mysqli_fetch_array($sql_resultado)){
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
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar - paquete</title>
    <link rel="stylesheet" href="../css/estilo-ingresar-usuarios.css">
</head>
<body>
    <div class="container-md col-md-6 mt-5 shadow-lg p-3 mb-5 bg-info rounded">
        <form action="" method="post" class="d-grid gap-2" enctype="multipart/form-data">
            <h2 class="form-label text-center">Ingresar - paquete</h2>
            <span class="mensaje"><?php echo isset($mensaje)?$mensaje:''; ?></span>
            <label for="destino" class="form-label">Destino</label>
            <input type="text" name="destino" id="destino" class="form-control" required>
            <label for="descripcion" class="form-label">Descripciòn</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
            <label for="fecha_s" class="form-label">Fecha salida</label>
            <input type="date" name="fecha_s" id="fecha_s" class="form-control" required>
            <label for="fecha_ll" class="form-label">Fecha llegada</label>
            <input type="date" name="fecha_ll" id="fecha_ll" class="form-control" required>

            <label for="aereo" class="form-label">Aereo</label>
            <select name="aereo" id="aereo" class="form-control">
                <?php while($datos = mysqli_fetch_array($sql_aereos)){ ?>
                        <option value="">Elegir opción</option>
                        <option value="<?php echo $datos['id_a']; ?>">
                            <?php echo $datos['id_a']; ?> | <?php echo $datos['destino_aereo']; ?> | <?php echo $datos['precio_aereo']; ?>
                        </option>
                <?php } ?>
            </select>
            
            <label for="desayuno" class="form-label">Desayuno</label>
            <select name="desayuno" id="desayuno" class="form-control">
                <?php while($datos = mysqli_fetch_array($sql_desayuno)){ ?>
                        <option value="">Elegir opción</option>
                        <option value="<?php echo $datos['id_desayuno']; ?>">
                            <?php echo $datos['id_desayuno']; ?> | <?php echo $datos['descripcion_d']; ?> | <?php echo $datos['precio_desayuno']; ?>
                        </option>
                <?php } ?>
            </select>
            <label for="excursion" class="form-label">Excursion</label>
            <select name="excursion" id="excursion" class="form-control">
                <?php while($datos = mysqli_fetch_array($sql_tipo_excursiones)){ ?>
                        <option value="">Elegir opción</option>
                        <option value="<?php echo $datos['id_excursiones_t']; ?>">
                            <?php echo $datos['id_excursiones_t']; ?> | <?php echo $datos['descripcion_exc']; ?> | <?php echo $datos['precio_excursiones']; ?>
                        </option>
                <?php } ?>
            </select>
            <label for="alquiler" class="form-label">Alquiler auto</label>
            <select name="alquiler" id="alquiler" class="form-control">
                <?php while($datos = mysqli_fetch_array($sql_alquiler)){ ?>
                        <option value="">Elegir opción</option>
                        <option value="<?php echo $datos['id']; ?>">
                            <?php echo $datos['id']; ?> | <?php echo $datos['descripcion']; ?> | <?php echo $datos['precio_auto']; ?>
                        </option>
                <?php } ?>
            </select>

            <label for="precio" class="form-label">Precio</label>
            <input type="text" name="precio" id="precio" class="form-control" required>
            <input type="submit" value="Ingresar" name="registro" class="form-control btn btn-warning">
            <a href="listar_paquetes.php" class="form-control btn btn-success">Salir</a>
        </form>
    </div>
</body>
</html>