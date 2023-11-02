<?php
    require_once('conexion.php');
    class Pedido extends Inventario{
        public function modificarPedido($conexion,$codigo,$estado){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("UPDATE pedidos SET
                estado=:estado
            WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->bindParam(":estado",$estado);
            $consulta->execute();
        }
    }
    $codigo=$_REQUEST['codigo'];
    $estado="Entregado";
    $pedido=new Pedido;
    $conexion=$pedido->crearConexion();
    $pedido->modificarPedido($conexion,$codigo,$estado);
    $pedido->cerrarConexion($conexion);
    header('location:../pedidos.php');
?>