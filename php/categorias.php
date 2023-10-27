<?php
    require_once('conexion.php');
    class Categoria extends Inventario{
        public function mostrarCategoria($conexion){
            $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $consulta=$conexion->prepare("SELECT * FROM categorias");
            $consulta->execute();
            return $consulta;
        }
    }
    $categoria=new Categoria;
    $conexion=$categoria->crearConexion();
    $categorias=$categoria->mostrarCategoria($conexion);
    $categoria->cerrarConexion($conexion);
?>