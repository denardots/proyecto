<?php
    require_once('conexion.php');
    class Pedido extends Inventario{
        public function mostrarPedido($conexion){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT codigo,cliente,dni,fecha,cantidad,total,estado FROM pedidos");
            $consulta->execute();
            return $consulta;
        }
        public function mostrarPedidoCodigo($conexion,$codigo){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT codigo,cliente,dni,fecha,cantidad,total,estado FROM pedidos WHERE codigo LIKE CONCAT('%',:codigo,'%')");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->execute();
            return $consulta;
        }
    }
    $pedido=new Pedido;
    $conexion=$pedido->crearConexion();
?>