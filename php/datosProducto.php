<?php
    require_once('conexion.php');
    class Producto extends Inventario{
        public function mostrarProducto($conexion,$codigo){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT * FROM productos WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }
    $producto=new Producto;
    $conexion=$producto->crearConexion();
?>