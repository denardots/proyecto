<!DOCTYPE html>
<html lang="es">
<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:login.php");
    }
    require_once('php/datosProducto.php');
    $codigo=$_REQUEST['codigo'];
    $productos=$producto->mostrarProducto($conexion,$codigo);
    $producto->cerrarConexion($conexion);
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MODIFICAR PRODUCTO</title>
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
                    <a href="nuevoProducto.php"><i class="fas fa-plus"></i><span>Agregar Producto</span></a>
                    <a class="active" href="inventario.php"><i class="fas fa-list"></i><span>Inventario</span></a>
                    <a href="pedidos.php"><i class="fas fa-file"></i><span>Pedidos</span></a>
                </nav>
            </div>
            <main class="main col">
                <div class="row justify-content-center align-content-center text-center">
                    <div class="columna col-lg-6">
                        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Modificar Producto</span></h2>
                        <div class="contact-form bg-light p-30">
                            <div id="success"></div>
                            <form action="php/modificarProducto.php" method="post" autocomplete="off">
                                <input type="hidden" name="codigo" value="<?php echo $productos['codigo'];?>">
                                <div class="control-group">
                                    <label>Nombre del producto:</label>
                                    <input type="text" class="form-control" required name="nombre" value="<?php echo $productos['nombre'];?>">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Marca del producto:</label>
                                    <input type="text" class="form-control" required name="marca" value="<?php echo $productos['marca'];?>">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Stock del producto:</label>
                                    <input type="number" class="form-control" name="stock" min="1" pattern="^[0-9]+" required value="<?php echo $productos['stock'];?>">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Precio del producto: S/</label>
                                    <input type="number" class="form-control" name="precio" step="0.01" required value="<?php echo number_format($productos['precio'],2,'.','');?>">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="control-group">
                                    <label>Ingrese descripción del producto:</label>
                                    <textarea class="form-control" rows="3" name="descripcion" required><?php echo $productos['descripcion'];?>
                                    </textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div>
                                    <input type="submit" class="btn btn-primary py-2 px-4" value="GUARDAR CAMBIOS">
                                    <input type="reset" class="btn btn-danger py-2 px-4" value="QUITAR CAMBIOS" id="limpiar">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/646c794df3.js"></script>
</body>
</html>