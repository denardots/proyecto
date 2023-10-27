<?php
    session_start();
    require_once('conexion.php');
    class Login extends Inventario{
        public function validarDatos($conexion,$usuario,$clave){
            $consulta=$conexion->prepare("SELECT * FROM login WHERE usuario=:usuario AND clave=:clave");
            $consulta->bindParam(":usuario",$usuario);
            $consulta->bindParam(":clave",$clave);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }
    $login=new Login;
    $usuario=$_POST['usuario'];
    $clave=$_POST['clave'];
    $conexion=$login->crearConexion();
    $resultado=$login->validarDatos($conexion,$usuario,$clave);
    $conexion=$login->cerrarConexion($conexion);
    if($resultado){
        $_SESSION['usuario']=$usuario;
        header('location:../panel.php');
    }else{
        $_SESSION['error']="ERROR";
        header('location:../login.php');
    }
?>