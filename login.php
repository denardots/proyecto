<!DOCTYPE html>
<html lang="es">
<?php
    session_start();
    if(isset($_SESSION['usuario'])){
        header("location:panel.php");
    }
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/login.css">
    <title>LOGIN</title>
</head>
<body>
    <form class="login-form" action="php/login.php" method="post" autocomplete="off">
        <h1 class="login-form__title">INICIAR SESIÓN</h1>
        <input class="login-form__input" type="text" name="usuario" pattern="[A-Za-z0-9]{1,15}" placeholder="Ingrese su nombre de usuario" required>
        <input class="login-form__input" type="password" name="clave" pattern="[A-Za-z0-9]{1,15}" placeholder="Ingrese su contraseña" required>
        <input class="login-form__button submit" type="submit" value="INICIAR SESIÓN">
        <input class="login-form__button reset" id="limpiar" type="reset" value="LIMPIAR">
        <a class="login-form__link" href="index.php">VOLVER AL INICIO</a>
        <p class="login-form__message" id="mensaje"></p>
    </form>
</body>
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
</html>