<?php
    include '../bd/conectar.php';
    session_start();

    $usuario = $_SESSION['User'];
    $nombre = $_SESSION['nombre'];
    $tipo = $_SESSION['tipo_u'];
    $correo = $_SESSION['correo'];

    if(!isset($usuario)){
        header('Location: ../login.php');
    }

    if(isset($_GET['valor'])){
        unset($usuario);
        session_destroy();
        header('Location: ../login.php');
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - opciones</title>
    <script src="../js/jquery-3.7.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link href='https://cdn.boxicons.com/fonts/basic/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <script src="//cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <link href='https://cdn.boxicons.com/fonts/transformations.min.css' rel='stylesheet'>
</head>
<body>
    <div class="container-md">
        <?php if($tipo == 1){ ?>
        <nav class="navbar navbar-expand-lg bg-body-tertiary ver-menu">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index_usuario.php"><i class='bx  bx-home-alt'  style='color:#37837f'></i> Home</a>
                    </li>
                    
                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx  bx-user'  style='color:#2e26a9'></i> Usuarios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ingresar_usuario.php"><i class='bx  bx-user-plus'  style='color:#30812d'></i> Ingresar usuario</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="listar_usuarios.php"><i class='bx  bx-list-ul-square'  style='color:#b3a832'></i> Listar usuarios</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx  bx-cylinder'  style='color:#a61a92'></i>  Tipos de usuarios
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ingresar_tipos_usuarios.php"><i class='bx  bx-user-plus'  style='color:#25e618'></i>  Ingresar tipos de usuario</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="listar_tipos_usuarios.php"><i class='bx  bx-list-ul-square'  style='color:#b3a832'></i> Listar tipos de usuarios</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx  bx-plane-alt'  style='color:#68a993'></i>   Aereos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ingresar_aereos.php"><i class='bx  bx-plane'  style='color:#e0b321'></i>   Ingresar aereos</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="listar_aereos.php"><i class='bx  bx-list-ul-square'  style='color:#4dd748'></i>   Listar aereos</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx  bx-milk-bottle'  style='color:#ebda1c'></i>  Desayunos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ingresar_desayuno.php"><i class='bx  bx-coffee-cup'  style='color:#9a4f22'></i>  Ingresar desayuno</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="listar_desayunos.php"><i class='bx  bx-list-ul-square'  style='color:#1ed523'></i>  Listar desayunos</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx  bx-car'  style='color:#b9462a'></i>   Alquiler autos
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ingresar_auto.php"><i class='bx  bx-plus-circle'  style='color:#169a19'></i>   Ingresar auto</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="listar_autos.php"><i class='bx  bx-list-ul-square'  style='color:#030303'></i>   Listar autos</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx  bx-camera-alt'  style='color:#1ea6c7'></i>   Excursiones
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ingresar_excursion.php"><i class='bx  bx-footsteps'  style='color:#9a19a8'></i>    Ingresar excursión</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="listar_excursiones.php"><i class='bx  bx-list-ul-square'  style='color:#2821e0'></i>    Listar excursiones</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx  bx-package'  style='color:#25e618'></i>  Paquetes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="ingresar_paquete.php"><i class='bx  bx-location-plus'  style='color:#bb112d'></i>     Ingresar paquetes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="listar_paquetes.php"><i class='bx  bx-list-ul-square'  style='color:#2855e0'></i>    Listar paquetes</a></li>
                    </ul>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx  bx-wrist-watch'  style='color:#2d21d2'></i>   Historial
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="listar_ventas_pagas_totales.php"><i class='bx  bx-list-ul-square'  style='color:#36a312'></i>     Listar ventas pagas</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="listar_estado_ventas_totales.php"><i class='bx  bx-list-ul-square'  style='color:#a6167c'></i>     Listar estado de ventas</a></li>
                    </ul>
                    </li>                    

                    <li class="nav-item">
                        <a href="menu.php?valor=<?php echo $usuario?>" class="nav-link" onclick="return confirm('¿Desea salir?');">Salir</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    <?php } ?>
    <?php if($tipo == 2){ ?>
        <nav class="navbar navbar-expand-lg bg-body-tertiary ver-menu">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="./index_usuario.php"><i class='bx  bx-home-alt'  style='color:#37837f'></i> Home</a>
                    </li>

                    <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class='bx  bx-wrist-watch'  style='color:#2d21d2'></i>   Historial
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="listar_ventas_pagas.php"><i class='bx  bx-list-ul-square'  style='color:#36a312'></i>     Listar ventas pagadas</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="listar_ventas_nopagadas.php"><i class='bx  bx-clipboard-x'  style='color:#d72b3d'></i>      Listar ventas No pagadas</a></li>
                    </ul>
                    </li>                    

                    <li class="nav-item">
                        <a href="menu.php?valor=<?php echo $usuario?>" class="nav-link" onclick="return confirm('¿Desea salir?');">Salir</a>
                    </li>
                </ul>
                </div>
            </div>
        </nav>
    <?php } ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>