<?php
    require_once('conexion.php');
    class Producto extends Inventario{
        public function eliminarImagen($conexion,$codigo){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT ruta FROM productos WHERE codigo= :codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            $ruta="../".$resultado['ruta'];
            unlink($ruta);
        }
        public function eliminarProducto($conexion,$codigo){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("DELETE FROM productos WHERE codigo= :codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->execute();
        }
    }
    $codigo=$_REQUEST['codigo'];
    $producto=new Producto;
    $conexion=$producto->crearConexion();
    $producto->eliminarImagen($conexion,$codigo);
    $producto->eliminarProducto($conexion,$codigo);
    $producto->cerrarConexion($conexion);
    header('location:../inventario.php');
?>