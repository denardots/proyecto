<?php
    require_once('conexion.php');
    class Pedido extends Inventario{
        public function mostrarPedido($conexion,$codigo){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT codigo,cliente,dni,fecha,total,detalles,estado FROM pedidos WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }
    $pedido=new Pedido;
    $conexion=$pedido->crearConexion();
?>