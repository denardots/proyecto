<?php
	$conexion=null;
    class Inventario{
        private $servidor="localhost";
        private $baseDatos="proyecto";
        private $usuario="root";
        private $clave="";
        public function crearConexion(){
            try{
                $conexion=new PDO("mysql:host=".$this->servidor.";dbname=".$this->baseDatos,$this->usuario,$this->clave);
                return $conexion;
            }catch(Exception $e){
                echo 'Excepción capturada: '.  $e->getMessage();
            }
        }
        public function cerrarConexion($conexion){
            $conexion=null;
        }
    }
?>