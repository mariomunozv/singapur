<?php
ini_set("display_errors","on");
require("inc/_mensaje.php");
include "inc/conecta.php";
Conectarse_seg(); 
$idDe = $_REQUEST["idDe"];
$idPara = $_REQUEST["idPara"];
$asunto = $_REQUEST["asunto"];
$mensaje = $_REQUEST["mensaje"];
$respuesta = NULL;

if(guardaMensaje($idDe, $idPara, $asunto, $mensaje, $respuesta)>0){
	echo "<script>confirmaMensaje()</script>";
}else{
	echo "no se pudo enviar el mensaje";
}
