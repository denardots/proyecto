<!DOCTYPE html>
<html lang="es">
<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:login.php");
    }
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PANEL DE ADMINISTRACIÓN</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/panel.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center align-content-center">
            <div class="col-8 barra">
                <h4 class="text-light">Logo</h4>
            </div>
            <div class="col-4 text-right barra">
                <ul class="navbar-nav mr-auto">
                    <li>
                        <a href="#" class="px-3 text-light perfil dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle user"></i></a>
                        <div class="dropdown-menu" aria-labelledby="navbar-dropdown">
                            <a class="dropdown-item menuperfil cerrar" href="php/cerrarSesion.php"><i class="fas fa-sign-out-alt m-1"></i>Salir</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="barra-lateral col-12 col-sm-auto">
                <nav class="menu d-flex d-sm-block justify-content-center flex-wrap">
                    <a class="active" href="panel.php"><i class="fas fa-home"></i><span>Administrador</span></a>
                    <a href="nuevoProducto.php"><i class="fas fa-plus"></i><span>Agregar Producto</span></a>
                    <a href="inventario.php"><i class="fas fa-list"></i><span>Inventario</span></a>
                    <a href="pedidos.php"><i class="fas fa-file"></i><span>Pedidos</span></a>
                </nav>
            </div>
            <main class="main col">
                <div class="row justify-content-center align-content-center text-center">
                    <div class="columna col-lg-10">
                        <h1 class="h1 position-relative text-uppercase mx-xl-5 mb-5"><span class="bg-secondary pr-3">Bienvenido Administrador</span></h1>
                        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">¿Desea cambiar sus datos?</span></h2>
                        <div class="contact-form bg-light p-30">
                            <div id="success"></div>
                            <form action="php/cambiarDatos.php" method="post" autocomplete="off">
                                <div class="control-group">
                                    <label>Ingrese usuario actual:</label>
                                    <input type="text" class="form-control" name="usuario" pattern="[A-Za-z0-9]{1,15}" placeholder="Solo letras y dígitos" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Ingrese contraseña actual:</label>
                                    <input type="password" class="form-control" name="clave" pattern="[A-Za-z0-9]{1,15}" placeholder="Solo letras y dígitos" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <hr>
                                <div class="control-group">
                                    <label>Ingrese nuevo usuario:</label>
                                    <input type="text" class="form-control" name="nuevoUsuario" pattern="[A-Za-z0-9]{1,15}" placeholder="Solo letras y dígitos" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Ingrese nueva contraseña:</label>
                                    <input type="password" class="form-control" name="nuevoClave" pattern="[A-Za-z0-9]{1,15}" placeholder="Solo letras y dígitos" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div>
                                    <h4 class="help-block text-danger" id="mensaje"></h2>
                                    <input type="submit" class="btn btn-primary py-2 px-4" value="CAMBIAR DATOS">
                                    <input type="reset" class="btn btn-danger py-2 px-4" value="LIMPIAR DATOS" id="limpiar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php
        if(isset($_SESSION['error'])){
            if($_SESSION['error']=="ERROR"){
                echo "<script>
                        const mensaje=document.getElementById(`mensaje`);
                        const limpiar=document.getElementById(`limpiar`);
                        mensaje.textContent=`¡DATOS INCORRECTOS!`;
                        limpiar.addEventListener(`click`,()=>mensaje.textContent=``);
                    </script>";
                $_SESSION['error']="";
            }
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/646c794df3.js"></script>
</body>
</html>