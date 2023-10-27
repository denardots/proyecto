<?php
    session_start();
    require_once('conexion.php');
    class Producto extends Inventario{
        public function mostrarProducto($conexion,$codigo){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT codigo,nombre,precio,ruta FROM productos WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }
    $codigo=$_REQUEST['codigo'];
    $producto=new Producto;
    $conexion=$producto->crearConexion();
    $resultado=$producto->mostrarProducto($conexion,$codigo);
    $producto->cerrarConexion($conexion);
    $repetido=FALSE;
    if(isset($_SESSION['lista'])){
        $lista=$_SESSION['lista'];
        foreach($lista as $clave=>$valor){
            if($resultado['codigo']==$valor['codigo']){
                $repetido=true;
            }
        }
        if(!$repetido){
            $lista[]=array(
                        "codigo"=>$resultado['codigo'],
                        "ruta"=>$resultado['ruta'],
                        "nombre"=>$resultado['nombre'],
                        "cantidad"=>1,
                        "precio"=>$resultado['precio']
                    );
            $_SESSION['carrito']++;
        }
    }else{
        $lista[]=array(
            "codigo"=>$resultado['codigo'],
            "ruta"=>$resultado['ruta'],
            "nombre"=>$resultado['nombre'],
            "cantidad"=>1,
            "precio"=>$resultado['precio']
        );
        $_SESSION['carrito']++;
    }
    $_SESSION['lista']=$lista;
    header('location:../carrito.php');
?>