<?php
    session_start();
    require_once('conexion.php');
    class Pedido extends Inventario{
        public function validarCodigo($conexion){
            $valido=FALSE;
            while ($valido==FALSE){
                $codigo=rand(111111,999999);
                $consulta=$conexion->prepare("SELECT codigo FROM pedidos WHERE codigo=:codigo");
                $consulta->bindParam(":codigo",$codigo);
                $consulta->execute();
                $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
                if(!$resultado){
                    break;
                }
            }
            return $codigo;
        }
        public function obtenerStock($conexion,$codigo){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT stock FROM productos WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->execute();
            $resultado=$consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }
        public function actualizarStock($conexion,$codigo,$stock){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("UPDATE productos SET
                stock=:stock
            WHERE codigo=:codigo");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->bindParam(":stock",$stock);
            $consulta->execute();
        }
        public function nuevoPedido($conexion,$codigo,$cliente,$dni,$telefono,$fecha,$cantidad,$total,$objeto,$estado){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("INSERT INTO pedidos VALUES(
                :codigo,
                :cliente,
                :dni,
                :telefono,
                :fecha,
                :cantidad,
                :total,
                :objeto,
                :estado
            )");
            $consulta->bindParam(":codigo",$codigo);
            $consulta->bindParam(":cliente",$cliente);
            $consulta->bindParam(":dni",$dni);
            $consulta->bindParam(":telefono",$telefono);
            $consulta->bindParam(":fecha",$fecha);
            $consulta->bindParam(":cantidad",$cantidad);
            $consulta->bindParam(":total",$total);
            $consulta->bindParam(":objeto",$objeto);
            $consulta->bindParam(":estado",$estado);
            $consulta->execute();
        }
    }
    $pedido=new Pedido;
    $conexion=$pedido->crearConexion();
    $codigo=$pedido->validarCodigo($conexion);
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $cliente=$nombre." ".$apellido;
    $dni=$_POST['dni'];
    $telefono=$_POST['telefono'];
    date_default_timezone_set('America/Mexico_City');
	$fecha=date("Y-m-d");
    $lista=$_SESSION['lista'];
    $cantidad=0;
    $total=0;
    foreach ($lista as $orden=>$valor){
        $cantidad=$cantidad+$valor['cantidad'];
        $subtotal=$valor['precio']*$valor['cantidad'];
        $total=$total+$subtotal;
        $detalles[$valor['codigo']]=[$valor['nombre'],$valor['cantidad'],$valor['precio']];
        $stock=$pedido->obtenerStock($conexion,$valor['codigo']);
        $stock=$stock['stock'];
        $stock=$stock-intval($valor['cantidad']);
        $pedido->actualizarStock($conexion,$valor['codigo'],$stock);
    }
    $objeto=json_encode($detalles);
    $estado="Sin entrega";
    $pedido->actualizarStock($conexion,$valor['codigo'],$stock);
    $pedido->nuevoPedido($conexion,$codigo,$cliente,$dni,$telefono,$fecha,$cantidad,$total,$objeto,$estado);
    unset($_SESSION['lista']);
    $_SESSION['carrito']=0;
    header("location:../pago.php");
?>