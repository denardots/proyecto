<?php
    require_once('conexion.php');
    class Producto extends Inventario{
        public function mostrarProducto($conexion){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT * FROM productos INNER JOIN categorias ON productos.fkCategoria = categorias.id");
            $consulta->execute();
            return $consulta;
        }
    }
    $producto=new Producto;
    $conexion=$producto->crearConexion();
    $productos=$producto->mostrarProducto($conexion);
    $producto->cerrarConexion($conexion);
?>