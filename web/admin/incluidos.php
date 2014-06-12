<?php
session_start();
include "conecta.php";
include "funciones.php";
//include "../sesion/sesion.php";
@$idUsuario = $_SESSION["sesionIdUsuario"];
@$nombre =  $_SESSION["sesionNombreUsuario"];
Conectarse_seg(); 
?>