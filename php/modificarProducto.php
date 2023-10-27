<?php
    require_once('conexion.php');
    class Producto extends Inventario{
        public function modificarProducto($conexion,$codigo,$nombre,$marca,$stock,$precio,$descripcion){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("UPDATE productos SET
                nombre=:nombre,
                marca=:marca,
                stock=:stock,
                precio=:precio,
                descripcion=:descripcion
            WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->bindParam(":nombre",$nombre);
            $consulta->bindParam(":marca",$marca);
            $consulta->bindParam(":stock",$stock);
            $consulta->bindParam(":precio",$precio);
            $consulta->bindParam(":descripcion",$descripcion);
            $consulta->execute();
        }
    }
    $codigo=$_POST['codigo'];
    $nombre=$_POST['nombre'];
    $marca=$_POST['marca'];
    $stock=$_POST['stock'];
    $precio=$_POST['precio'];
    $descripcion=$_POST['descripcion'];
    $producto=new Producto;
    $conexion=$producto->crearConexion();
    $producto->modificarProducto($conexion,$codigo,$nombre,$marca,$stock,$precio,$descripcion);
    $producto->cerrarConexion($conexion);
    header('location:../inventario.php');
?>