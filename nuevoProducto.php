<!DOCTYPE html>
<html lang="es">
<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:login.php");
    }
    require_once('php/categorias.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AGREGAR PRODUCTO</title>
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
                    <a href="panel.php"><i class="fas fa-home"></i><span>Administrador</span></a>
                    <a class="active" href="nuevoProducto.php"><i class="fas fa-plus"></i><span>Agregar Producto</span></a>
                    <a href="inventario.php"><i class="fas fa-list"></i><span>Inventario</span></a>
                    <a href="pedidos.php"><i class="fas fa-file"></i><span>Pedidos</span></a>
                </nav>
            </div>
            <main class="main col">
                <div class="row justify-content-center align-content-center text-center">
                    <div class="columna col-lg-6">
                        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Ingresar nuevo Producto</span></h3>
                        <div class="contact-form bg-light p-30">
                            <div id="success"></div>
                            <form action="php/nuevoProducto.php" method="post" autocomplete="off" enctype="multipart/form-data">
                                <div class="control-group">
                                    <label>Ingrese nombre del producto:</label>
                                    <input type="text" class="form-control" name="nombre" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Ingrese marca del producto:</label>
                                    <input type="text" class="form-control" name="marca" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Seleccione categoría:</label>
                                    <select class="custom-select" name="categoria">
                                <?php
                                    while($fila=$categorias->fetch(PDO::FETCH_ASSOC)){
                                ?>
                                        <option value="<?php echo $fila['id'];?>">
                                            <?php echo $fila['categoria']; ?>
                                        </option>
                                <?php
                                    }
                                ?>
                                    </select>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Ingrese stock del producto:</label>
                                    <input type="number" class="form-control" name="stock" min="1" pattern="^[0-9]+" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Ingrese precio del producto: S/</label>
                                    <input type="number" class="form-control" name="precio" step="0.01" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Ingrese descripción del producto:</label>
                                    <textarea class="form-control" rows="3" name="descripcion" required></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Elija imagen del producto:</label>
                                    <input type="file" class="form-control" accept="image/*" name="imagen" required>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div>
                                    <h4 class="help-block text-danger" id="mensaje"></h2>
                                    <input type="submit" class="btn btn-primary py-2 px-4" value="AGREGAR PRODUCTO">
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
                echo $_SESSION['error'];
                echo "<script>
                        const mensaje=document.getElementById(`mensaje`);
                        const limpiar=document.getElementById(`limpiar`);
                        mensaje.textContent=`¡EL PRODUCTO YA EXISTE!`;
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