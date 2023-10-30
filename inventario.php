<!DOCTYPE html>
<html lang="es">
<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:login.php");
    }
    require_once('php/inventario.php');
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INVENTARIO</title>
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
                    <div class="columna col-lg-12">
                        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Inventario de Productos</span></h2>
                        <div class="col-lg-12 table-responsive mb-5">
                            <table class="table table-light table-borderless table-hover text-center mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Producto</th>
                                        <th>Marca</th>
                                        <th>Categoria</th>
                                        <th>Precio</th>
                                        <th>Stock</th>
                                        <th colspan="2">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                            <?php
                                while($fila=$productos->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $fila['nombre'];?></td>
                                        <td class="align-middle"><?php echo $fila['marca'];?></td>
                                        <td class="align-middle"><?php echo $fila['categoria'];?></td>
                                        <td class="align-middle"><?php echo "S/ ".number_format($fila['precio'],2,'.','');?></td>
                                        <td class="align-middle"><?php echo $fila['stock'];?></td>
                                        <td class="align-middle">
                                            <a class="btn btn-sm btn-primary" href="modificarProducto.php?codigo=<?php echo $fila['codigo'];?>"><i class="fa fa-pen"></i></button>
                                        </td>
                                        <td class="align-middle">
                                            <button class="btn btn-sm btn-danger botones" name="<?php echo $fila['codigo'];?>" value="<?php echo $fila['nombre'];?>"><i class="fa fa-times"></i></button>
                                        </td>
                                    </tr>
                            <?php
                                }
                            ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="flotante" id="mensaje">
                        <h2 class="section-title text-uppercase mx-xl-5 mb-4">ELIMINAR PRODUCTO</h2>
                        <p id="datos"></p>
                        <div>
                            <a class="btn btn-danger py-2 px-4 eliminar" id="confirmar">ELIMINAR</a>
                            <a class="btn btn-primary py-2 px-4" href="inventario.php">CANCELAR</a>
                        </div>
                    </div>
                    <script src="js/inventario.js"></script>
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