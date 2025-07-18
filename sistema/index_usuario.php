<?php
    include '../bd/conectar.php';
    include './menu.php';

    $id = $_SESSION['Id'];

    $sql_paquetes = mysqli_query($conexion, "SELECT * FROM paquetes WHERE estado=1");

    $resultado = mysqli_num_rows($sql_paquetes);

    $contador = 0;

    if($resultado <= 0){
        echo "No hay paquetes!";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal turístico</title>
    <link rel="stylesheet" href="../css/estilo-index.css">
    <script src="../js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="cabecera">
            <p>Portal Turístico</p>
            <p>Tu sitio para conocer el mundo.</p>
            <p id="tiempo"></p>
            <a href="ventas_paquetes.php?id=<?php echo $id; ?>" class="btn btn-outline-warning"><i class='bx  bx-cart-plus bx-md'  style='color:#2d21d2'></i> Mis viajes</a>
        </div>
        <div class="table-responsive">
            <table class="table table-dark">
              <tbody>
                <?php while($datos = mysqli_fetch_array($sql_paquetes)){ ?>
                    <?php if($contador % 2 == 0){ ?>
                        <tr>
                    <?php } ?>
                    <td class="col-6 p-1 cuerpo">
                        <div class="card">
                            <h5 class="card-header"><?php echo $datos['destino']; ?></h5>
                            <div class="card-body">
                                <h5 class="card-title">Fecha Salida: <?php echo $datos['fecha_salida']; ?> | Fecha llegada: <?php echo $datos['fecha_llegada'] ?></h5>
                                <p class="card-text"><?php echo $datos['descripcion_paquete']; ?></p>
                                <a href="comprar_paquete.php?id_paquete=<?php echo $datos['id_paquete']; ?>" class="btn btn-info"><i class='bx  bx-cart-plus bx-sm'  style='color:#2b9f23'></i> Comprar</a>
                            </div>
                        </div>
                    </td>
                    <?php $contador++; ?>
                    <?php if($contador % 2 == 0){ ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
    <script>
        function tiempo(){
            let tiempo = new Date();
            document.getElementById('tiempo').textContent = tiempo;
        }
        tiempo();
    </script>
</body>
</html>