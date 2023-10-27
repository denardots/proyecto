<!DOCTYPE html>
<html lang="es">
<?php
    session_start();
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito']=0;
    }
    require_once('php/categorias.php');
    require_once('php/categorias.php');
    require_once('php/productos.php');
    if(isset($_REQUEST['id'])){
        $id=$_REQUEST['id'];
        $busqueda=$producto->mostrarProductoCategoria($conexion,$id);
        $encontrado=$busqueda->fetch(PDO::FETCH_ASSOC);        $productos=$producto->mostrarProductoCategoria($conexion,$id);
    }elseif(isset($_POST['busqueda'])){
        $nombre=$_POST['busqueda'];
        $busqueda=$producto->mostrarProductoNombre($conexion,$nombre);
        $encontrado=$busqueda->fetch(PDO::FETCH_ASSOC);
        $productos=$producto->mostrarProductoNombre($conexion,$nombre);
    }else{
        $encontrado=TRUE;
        $productos=$producto->mostrarProducto($conexion);
    }
    $producto->cerrarConexion($conexion);
?>
<head>
    <meta charset="utf-8">
    <title>PRODUCTOS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <!-- Topbar Start -->
    <div class="container-fluid">
        <div style="height: 2px;">
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="index.php" class="text-decoration-none">
                    <span class="h1 text-uppercase text-light bg-danger px-2">EL</span>
                    <span class="h1 text-uppercase text-light bg-danger px-2 ml-n1">Huarangal</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="productos.php" method="post" autocomplete="off">
                    <div class="input-group">
                        <input type="text" class="form-control" name="busqueda" placeholder="Buscar productos">
                        <div class="input-group-append">
                            <input type="submit" class="form-control bg-primary text-dark" value="BUSCAR">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Servicio al Cliente</p>
                <h5 class="m-0">+012 345 6789</h5>
            </div>
        </div>
    </div>
    <!-- Topbar End -->
    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-2">
        <div class="row px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>
                        Categorías</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light" id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                <?php
                    while($fila=$categorias->fetch(PDO::FETCH_ASSOC)){
                ?>
                        <a href="productos.php?id=<?php echo $fila['id'];?>" class="nav-item nav-link"><?php echo $fila['categoria'];?></a>
                <?php
                    }
                ?>
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="index.php" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">El</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Huarangal</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link">Inicio</a>
                            <a href="productos.php" class="nav-item nav-link active">Productos</a>
                            <a href="carrito.php" class="nav-item nav-link">Carrito</a>
                            <a href="nosotros.php" class="nav-item nav-link">Nosotros</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="login.php" class="btn px-0 ml-3">
                                <i class="fas fa-solid fa-user text-primary"></i>
                            </a>
                            <a href="carrito.php" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle" style="padding-bottom: 2px;"><?php echo $_SESSION['carrito'];?></span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->
    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
<?php
    if($encontrado){
?>
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">Nuestros productos</span></h2>
<?php
    }else{
?>
        <h2 class="position-relative text-uppercase mx-xl-5 mb-4 text-center"><span class="bg-secondary pr-2">producto no encontrado</span></h2>
<?php
    }
?>
        <div class="row px-xl-5">
    <?php
        while($fila=$productos->fetch(PDO::FETCH_ASSOC)){
    ?>
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                        <img class="img-fluid w-100" src="<?php echo $fila['ruta'];?>" alt="<?php echo $fila['nombre'];?>">
                        <div class="product-action">
                            <a class="btn btn-outline-dark btn-square" href="php/agregarCarrito.php?codigo=<?php echo $fila['codigo'];?>"><i class="fa fa-shopping-cart"></i></a>
                            <a class="btn btn-outline-dark btn-square" href="detalleProducto.php?codigo=<?php echo $fila['codigo'];?>"><i class="fa fa-search"></i></a>
                        </div>
                    </div>
                    <div class="text-center py-4">
                        <a class="h6 text-decoration-none text-truncate" href="detalleProducto.php?codigo=<?php echo $fila['codigo'];?>"><?php echo $fila['nombre'];?></a>
                        <div class="d-flex align-items-center justify-content-center mt-2">
                            <h5><?php echo "S/ ".number_format($fila['precio'],2,'.','');?></h5>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    ?>
        </div>
    </div>
    <!-- Products End -->
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5 ">
        <div class="row border-top mx-xl-5 py-4" style="border-color: rgba(256, 256, 256, .1) !important;">
            <div class="col-md-6 px-xl-0">
                <p class="mb-md-0 text-center text-md-left text-secondary">
                    &copy; <a class="text-primary" href="#">El Huarangal</a>. Todos los derechos reservados Diseñado por
                    <span class="text-primary" href="https://htmlcodex.com"> HTML Codex</span>
                </p>
            </div>
        </div>
    </div>
    <!-- Footer End -->
    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>