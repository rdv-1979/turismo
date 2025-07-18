<?php
    include '../bd/conectar.php';
    include './menu.php';
    $mensaje = '';

    $sql_alquiler = mysqli_query($conexion, "SELECT * FROM alquiler_auto WHERE estado=1");
    $sql_desayuno = mysqli_query($conexion, "SELECT * FROM desayuno WHERE estado=1");
    $sql_tipo_excursiones = mysqli_query($conexion, "SELECT * FROM tipo_excursiones WHERE estado=1");
    $sql_aereos = mysqli_query($conexion, "SELECT * FROM aereos WHERE estado_aereo=1");

    if(isset($_REQUEST['id'])){
        $id = $_REQUEST['id'];

        $sql = mysqli_query($conexion, "SELECT * FROM paquetes p INNER JOIN desayuno d ON p.id_tipo_des=d.id_desayuno
                                                           INNER JOIN alquiler_auto a ON a.id=p.id_alquiler_auto
                                                           INNER JOIN tipo_excursiones t ON t.id_excursiones_t=p.id_excursiones
                                                           INNER JOIN aereos s ON s.id_a=p.id_aereo_paq
                                                           WHERE p.id_paquete='$id'");
        while($datos = mysqli_fetch_array($sql)){
                $destino = $datos['destino'];
                $descripcion = $datos['descripcion_paquete'];
                $imagen = $datos['imagen_paquete']; 
                $fecha_s = $datos['fecha_salida']; 
                $fecha_ll = $datos['fecha_llegada'];
                $aereo = $datos['id_aereo_paq'];
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
        $destinop = $_POST['destino'];
        $descripcionp = $_POST['descripcion'];
        $imagenp = $_FILES['imagen']['name'];
        $fecha_sp = $_POST['fecha_s'];
        $fecha_llp = $_POST['fecha_ll'];
        $aereop = $_POST['aereo'];
        $desayunop = $_POST['desayuno'];
        $excursionp = $_POST['excursion'];
        $alquilerp = $_POST['alquiler'];
        $preciop = $_POST['precio'];

        if($aereop == ''){
            $aereop = $id_aereo;
        }

        if($desayunop == ''){
            $desayunop = $id_desayuno;
        }
        if($excursionp == ''){
            $excursionp = $id_excursion;
        }
        if($alquilerp == ''){
            $alquilerp = $id_alquiler_auto;
        }

            if($imagenp == ''){
                $imagenp = 'img-sistema/vacio.jpg';

                $sql_insertar = mysqli_query($conexion, "UPDATE paquetes SET descripcion_paquete='$descripcionp',
                                                                             imagen_paquete='$imagenp',
                                                                             fecha_salida='$fecha_sp',
                                                                             fecha_llegada='$fecha_llp',
                                                                             id_aereo_paq='$aereop',
                                                                             id_tipo_des='$desayunop',
                                                                             id_excursiones='$excursionp',
                                                                             id_alquiler_auto='$alquilerp',
                                                                             precio='$preciop'
                                                                             WHERE id_paquete='$id'");
            
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

                $sql_insertar = mysqli_query($conexion, "UPDATE paquetes SET descripcion_paquete='$descripcionp',
                                                                             imagen_paquete='$ruta',
                                                                             fecha_salida='$fecha_sp',
                                                                             fecha_llegada='$fecha_llp',
                                                                             id_aereo_paq='$aereo',
                                                                             id_tipo_des='$desayunop',
                                                                             id_excursiones='$excursionp',
                                                                             id_alquiler_auto='$alquilerp',
                                                                             precio='$preciop'
                                                                             WHERE id_paquete='$id'");
            
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
            <input type="text" name="destino" id="destino" class="form-control" 
                   value="<?php echo $destino; ?>" readonly>
            <label for="descripcion" class="form-label">Descripciòn</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" 
                   value="<?php echo $descripcion; ?>" required>
            <label for="imagen_actual" class="form-label">Imagen Actual</label>
            <img src="<?php echo $imagen; ?>" class="form-control">
            <label for="imagen" class="form-label">Imagen</label>
            <input type="file" name="imagen" id="imagen" class="form-control">
            <label for="fecha_s" class="form-label">Fecha salida</label>
            <input type="date" name="fecha_s" id="fecha_s" class="form-control" 
                   value="<?php echo $fecha_s; ?>" required>
            <label for="fecha_ll" class="form-label">Fecha llegada</label>
            <input type="date" name="fecha_ll" id="fecha_ll" class="form-control" 
                   value="<?php echo $fecha_ll; ?>" required>
            <label for="desayuno_actual" class="form-label">Desayuno actual</label>
            <input type="text" name="desayuno_actual" id="desayuno_actual" class="form-control" 
                   value="<?php echo $desayuno; ?>" readonly>

            <label for="aereo" class="form-label">Aereos</label>
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

            <label for="excursion_actual" class="form-label">Excursión actual</label>
            <input type="text" name="excursion_actual" id="excursion_actual" class="form-control" 
                   value="<?php echo $excursion; ?>" readonly>
            <label for="excursion" class="form-label">Excursion</label>
            <select name="excursion" id="excursion" class="form-control">
                <?php while($datos = mysqli_fetch_array($sql_tipo_excursiones)){ ?>
                        <option value="">Elegir opción</option>
                        <option value="<?php echo $datos['id_excursiones_t']; ?>">
                            <?php echo $datos['id_excursiones_t']; ?> | <?php echo $datos['descripcion_exc']; ?> | <?php echo $datos['precio_excursiones']; ?>
                        </option>
                <?php } ?>
            </select>

            <label for="auto_actual" class="form-label">Alquiler auto actual</label>
            <input type="text" name="auto_actual" id="auto_actual" class="form-control" 
                   value="<?php echo $auto; ?>" readonly>
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
            <input type="number" name="precio" id="precio" class="form-control" 
                   value="<?php echo $precio; ?>" required>
            <input type="submit" value="Ingresar" name="registro" class="form-control btn btn-warning">
            <a href="listar_paquetes.php" class="form-control btn btn-success">Salir</a>
        </form>
    </div>
</body>
</html>