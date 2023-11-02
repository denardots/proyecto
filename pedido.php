<!DOCTYPE html>
<html lang="es">
<?php
    session_start();
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito']=0;
    }
    require_once('php/categorias.php');
?>
<head>
    <meta charset="utf-8">
    <title>PEDIDO</title>
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
                            <a href="productos.php" class="nav-item nav-link">Productos</a>
                            <a href="carrito.php" class="nav-item nav-link active">Carrito</a>
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
    <!-- Checkout Start -->
    <div class="container-fluid pt-5 pb-3">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Datos del Cliente</span></h5>
                <form class="bg-light p-30 mb-5" action="php/realizarPedido.php" method="post" id="formulario" autocomplete="off">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>Ingrese su Nombre:</label>
                            <input class="form-control" type="text" name="nombre" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]{5,50}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ingrese sus Apellidos:</label>
                            <input class="form-control" type="text" name="apellido" pattern="^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]{5,50}" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ingrese su DNI</label>
                            <input class="form-control" type="text" name="dni" minlength="8" maxlength="8" pattern="^[0-9]+" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Ingrese su Teléfono:</label>
                            <input class="form-control" type="text" name="telefono" minlength="9" maxlength="9" pattern="^[0-9]+" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Orden de Productos</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Productos</h6>
                <?php
                    $total=0;
                    $lista=$_SESSION['lista'];
                    foreach ($lista as $orden=>$valor){
                        $subtotal=$valor['precio']*$valor['cantidad'];
                ?>
                        <div class="d-flex justify-content-between">
                            <p><?php echo $valor['nombre'];?></p>
                            <p><?php echo "S/ ".number_format($subtotal,2,'.','');?></p>
                        </div>
                <?php
                        $total=$total+$subtotal;
                    }
                ?>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5><?php echo "S/ ".number_format($total,2,'.','');?></h5>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-block btn-primary font-weight-bold py-3" value="Realizar Pedido" form="formulario">
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-secondary mt-5" style="position:absolute; bottom:0;">
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
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>