<?php 

$host_base_datos	= "localhost";
$usuario_base_datos = "epunto_gar";
$clave_base_datos	= "den";
$nombre_base_datos	= "epunto_garden";

$host_base_datos	= "localhost";
$usuario_base_datos = "root";
$clave_base_datos	= "";
$nombre_base_datos	= "garden";    

$conexion = mysql_connect ($host_base_datos, $usuario_base_datos, $clave_base_datos) or die ('I cannot connect to the database because: ' . mysql_error());
mysql_select_db ($nombre_base_datos,$conexion);  
?>