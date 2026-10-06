<?php
include("../../clases/BaseDatos.php");
/*
$servidor="localhost";
$puerto=3306;
$usuario="root";
$clave="";
$nombreBaseDatos="sau";
*/


$servidor="localhost";
$puerto=3306;
$usuario="id18605824_sau";
$clave="Usuario123*";
$nombreBaseDatos="id18605824_sau";


$sgbd = new BaseDatos($servidor, $puerto, $usuario, $clave, $nombreBaseDatos );
if (!$sgbd->conectar()){
echo "No se pudo conectar";
exit();
}

$sgbd->ejecutarConsulta("SET NAMES 'utf8'");
?>