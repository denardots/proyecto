<?php
    require_once('conexion.php');
    class Producto extends Inventario{
        public function mostrarProducto($conexion){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT codigo,nombre,precio,ruta FROM productos WHERE stock>0");
            $consulta->execute();
            return $consulta;
        }
        public function mostrarProductoCategoria($conexion,$id){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT codigo,nombre,precio,ruta FROM productos WHERE fkCategoria=:id AND stock>0");
            $consulta->bindParam(":id",$id);
            $consulta->execute();
            return $consulta;
        }
        public function mostrarProductoNombre($conexion,$nombre){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT codigo,nombre,precio,ruta FROM productos WHERE nombre LIKE CONCAT('%',:nombre,'%') AND stock>0");
            $consulta->bindParam(":nombre",$nombre);
            $consulta->execute();
            return $consulta;
        }
    }
    $producto=new Producto;
    $conexion=$producto->crearConexion();
?>