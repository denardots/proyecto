<?php
    session_start();
    require_once('conexion.php');
    class Admin extends Inventario{
        public function validarDatos($conexion,$usuario,$clave){
            $consulta=$conexion->prepare("SELECT * FROM login WHERE usuario=:usuario AND clave=:clave");
            $consulta->bindParam(":usuario",$usuario);
            $consulta->bindParam(":clave",$clave);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }
        public function cambiarDatos($conexion,$usuario,$nuevoUsuario,$nuevoClave){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("UPDATE login SET
                usuario= :nuevoUsuario,
                clave= :nuevoClave
            WHERE usuario= :usuario");
            $consulta->bindParam(":nuevoUsuario",$nuevoUsuario);
            $consulta->bindParam(":nuevoClave",$nuevoClave);
            $consulta->bindParam(":usuario",$usuario);
            $consulta->execute();
        }
    }
    $admin=new Admin;
    $usuario=$_POST['usuario'];
    $clave=$_POST['clave'];
    $nuevoUsuario=$_POST['nuevoUsuario'];
    $nuevoClave=$_POST['nuevoClave'];
    $conexion=$admin->crearConexion();
    $resultado=$admin->validarDatos($conexion,$usuario,$clave);
    if($resultado){
        $admin->cambiarDatos($conexion,$usuario,$nuevoUsuario,$nuevoClave);
        $conexion=$admin->cerrarConexion($conexion);
        header('location:cerrarSesion.php');
    }else{
        $conexion=$admin->cerrarConexion($conexion);
        $_SESSION['error']="ERROR";
        header('location:../panel.php');
    }
?>