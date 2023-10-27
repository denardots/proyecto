<?php
    session_start();
    require_once('conexion.php');
    class Producto extends Inventario{
        public function validarCodigo($conexion){
            $valido=FALSE;
            while ($valido==FALSE){
                $codigo=rand(111111,999999);
                $consulta=$conexion->prepare("SELECT codigo FROM productos WHERE codigo=:codigo");
                $consulta->bindParam(":codigo",$codigo);
                $consulta->execute();
                $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
                if(!$resultado){
                    break;
                }
            }
            return $codigo;
        }
        public function validarProducto($conexion,$nombre){
            $valido=TRUE;
            $consulta=$conexion->prepare("SELECT nombre FROM productos WHERE nombre=:nombre");
            $consulta->bindParam(":nombre",$nombre);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            if($resultado){
                $valido=FALSE;
            }
            return $valido;
        }
        public function nuevoProducto($conexion,$codigo,$nombre,$marca,$categoria,$stock,$precio,$descripcion,$imagen,$temporal,$carpeta){
            $ruta='img/'.$imagen;
            move_uploaded_file($temporal,$carpeta.'/'.$imagen);
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("INSERT INTO productos VALUES(
                :codigo,
                :nombre,
                :marca,
                :fkCategoria,
                :stock,
                :precio,
                :descripcion,
                :ruta
            )");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->bindParam(":nombre",$nombre);
            $consulta->bindParam(":marca",$marca);
            $consulta->bindParam(":fkCategoria",$categoria);
            $consulta->bindParam(":stock",$stock);
            $consulta->bindParam(":precio",$precio);
            $consulta->bindParam(":descripcion",$descripcion);
            $consulta->bindParam(":ruta",$ruta);
            $consulta->execute();
        }
    }
    $nombre=$_POST['nombre'];
    $marca=$_POST['marca'];
    $categoria=$_POST['categoria'];
    $stock=$_POST['stock'];
    $precio=$_POST['precio'];
    $descripcion=$_POST['descripcion'];
    $imagen=$_FILES['imagen']['name'];
    $temporal=$_FILES['imagen']['tmp_name'];
    $carpeta='../img';
    $producto=new Producto;
    $conexion=$producto->crearConexion();
    $codigo=$producto->validarCodigo($conexion);
    $valido=$producto->validarProducto($conexion,$nombre);
    if($valido){
        $producto->nuevoProducto($conexion,$codigo,$nombre,$marca,$categoria,$stock,$precio,$descripcion,$imagen,$temporal,$carpeta);
        $producto->cerrarConexion($conexion);
        header('location:../inventario.php');
    }else{
        $_SESSION['error']="ERROR";
        $producto->cerrarConexion($conexion);
        header('location:../nuevoProducto.php');
    }
?>