<?php
    session_start();
    $nuevo=$_POST['nuevo'];
    $longitud=strlen($nuevo);
    $posicion=strpos($nuevo,' ');
    $primero=substr($nuevo,0,$posicion);
    $cadena=substr($nuevo,$posicion,$longitud);
    $cantidades[0]=$primero;
    $lista=$_SESSION['lista'];
    for($i=1;$i<$_SESSION['carrito'];$i++){
        $longitud=strlen($cadena);
        $posicion=strpos($cadena,' ',1);
        $dato=substr($cadena,0,$posicion);
        $cadena=substr($cadena,$posicion,$longitud);
        $cantidades[$i]=$dato;
    }
    for($i=0;$i<$_SESSION['carrito'];$i++){
        $lista[$i]['cantidad']=$cantidades[$i];
    }
    $_SESSION['lista']=$lista;
    header("location:../carrito.php");
?>