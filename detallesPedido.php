<!DOCTYPE html>
<html lang="es">
<?php
    session_start();
    if(!isset($_SESSION['usuario'])){
        header("location:login.php");
    }
    require_once('php/detallesPedido.php');
    $codigo=$_REQUEST['codigo'];
    $datos=$pedido->mostrarPedido($conexion,$codigo);
    $pedido->cerrarConexion($conexion);
    $fecha=date("d/m/Y",strtotime($datos['fecha']));
    $detalles=json_decode($datos['detalles'],true);
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
                    <a href="cambiarDatos.php"><i class="fas fa-user"></i><span>Cambiar Datos</span></a>
                    <a href="nuevoProducto.php"><i class="fas fa-plus"></i><span>Agregar Producto</span></a>
                    <a href="inventario.php"><i class="fas fa-list"></i><span>Inventario</span></a>
                    <a class="active" href="pedidos.php"><i class="fas fa-file"></i><span>Pedidos</span></a>
                </nav>
            </div>
            <main class="main col">
                <div class="row justify-content-center align-content-center text-center">
                    <div class="columna col-lg-12">
                        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Pedido <?php echo $codigo;?></span></h2>
                        <div class="col-lg-12 mb-5">
                            <div class="contact-form bg-light p-30">
                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label>Cliente:</label>
                                        <input class="form-control" type="text" value="<?php echo $datos['cliente'];?>" readonly>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>DNI:</label>
                                        <input class="form-control" type="text" value="<?php echo $datos['dni'];?>" readonly>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>Fecha del Pedido</label>
                                        <input class="form-control" type="text" value="<?php echo $fecha;?>" readonly>
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label>Estado del Pedido</label>
                                        <input class="form-control" type="text" value="<?php echo $datos['estado'];?>" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 table-responsive mb-5">
                            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Detalles del Pedido</span></h2>
                            <table class="table table-light table-borderless table-hover text-center mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Producto</th>
                                        <th>Cantidad</th>
                                        <th>Precio</th>
                                        <th>Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody class="align-middle">
                            <?php
                                foreach ($detalles as $codigos=>$valor){
                                    $subtotal=$valor[1]*$valor[2];
                            ?>
                                    <tr>
                                        <td class="align-middle"><?php echo $codigos;?></td>
                                        <td class="align-middle"><?php echo $valor[0];?></td>
                                        <td class="align-middle"><?php echo $valor[1];?></td>
                                        <td class="align-middle"><?php echo "S/ ".number_format($valor['2'],2,'.','');?></td>
                                        <td class="align-middle"><?php echo "S/ ".number_format($subtotal,2,'.','');?></td>
                                    </tr>
                            <?php
                                }
                                if($datos['estado']=="Sin entrega"){
                            ?>
                                    <tr>
                                        <td class="align-middle">
                                            <a href="php/entregarPedido.php?codigo=<?php echo $codigo;?>" class="btn btn-primary py-2 px-4">ENTREGAR PEDIDO</a>
                                        </td>
                                        <td class="align-middle">
                                            <a href="php/eliminarPedido.php?codigo=<?php echo $codigo;?>" class="btn btn-danger py-2 px-4">ELIMINAR PEDIDO</a>
                                        </td>
                                        <td></td>
                                        <td class="align-middle bg-dark text-light">TOTAL</td>
                                        <td class="align-middle bg-dark text-light"><?php echo "S/ ".number_format($datos['total'],2,'.','');?></td>
                                    </tr>
                            <?php
                                }else{
                            ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="align-middle bg-dark text-light">TOTAL</td>
                                        <td class="align-middle bg-dark text-light"><?php echo "S/ ".number_format($datos['total'],2,'.','');?></td>
                                    </tr>
                            <?php
                                }
                            ?>
                                </tbody>
                            </table>
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