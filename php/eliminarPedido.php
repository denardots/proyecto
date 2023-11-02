<?php
    session_start();
    require_once('conexion.php');
    class Pedido extends Inventario{
        public function mostrarPedido($conexion,$codigo){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT detalles FROM pedidos WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }
        public function obtenerStock($conexion,$codigos){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT stock FROM productos WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigos);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }
        public function actualizarStock($conexion,$codigos,$stock){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("UPDATE productos SET
                stock=:stock
            WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigos);
            $consulta->bindParam(":stock",$stock);
            $consulta->execute();
        }
        public function eliminarPedido($conexion,$codigo){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("DELETE FROM pedidos WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->execute();
        }
    }
    $codigo=$_REQUEST['codigo'];
    $pedido=new Pedido;
    $conexion=$pedido->crearConexion();
    $datos=$pedido->mostrarPedido($conexion,$codigo);
    $detalles=json_decode($datos['detalles'],true);
    foreach($detalles as $codigos=>$valor){
        $stock=$pedido->obtenerStock($conexion,$codigos);
        $stock=$stock['stock'];
        $stock=$stock + intval($valor[1]);
        $pedido->actualizarStock($conexion,$codigos,$stock);
    }
    $pedido->eliminarPedido($conexion,$codigo);
    $pedido->cerrarConexion($conexion);
    header("location:../pedidos.php");
?>