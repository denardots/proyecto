<?php
    require_once('conexion.php');
    class Pedido extends Inventario{
        public function mostrarPedido($conexion){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT codigo,cliente,dni,fecha,cantidad,total,estado FROM pedidos");
            $consulta->execute();
            return $consulta;
        }
    }
    $pedido=new Pedido;
    $conexion=$pedido->crearConexion();
    $pedidos=$pedido->mostrarPedido($conexion);
    $pedido->cerrarConexion($conexion);
?>