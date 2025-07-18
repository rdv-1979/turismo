<?php
    include './bd/conectar.php';

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/estilo-index.css">
    <script src="./js/jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <div class="cabecera">
            <p>Portal Turístico</p>
            <p>Tu sitio para conocer el mundo.</p>
            <p id="tiempo"></p>
            <a href="login.php" class="btn btn-info">Login</a>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
    <script>
        function tiempo(){
            let tiempo = new Date();
            document.getElementById('tiempo').textContent = tiempo;
        }
        tiempo();
    </script>
</body>
</html>