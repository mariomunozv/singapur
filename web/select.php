<?php
session_start();
//ini_set("display_errors","on");
include "inc/conecta.php";
include "inc/_bitacora.php";
include "inc/_seccionBitacora.php";
include "sesion/sesion.php";
Conectarse_seg();
$idPadre = $_REQUEST["idPadre"];
$idUsuario =  $_REQUEST["profesor"];
$curso = $_REQUEST["curso"];
echo "EL CUUUUUUUUUUUUUUUUURSO ES: ".$idCurso;
$bitacoras = getBitacorasCompletadasUsuarioCapitulo($idUsuario,$idPadre,$curso);
$secciones = getSeccionBitacoraCapitulo($idPadre);
$i=0;
if(count($bitacoras)>0){//Se busca crear un arreglo solo con ID de Secciones, sin llamar a la BDD
foreach($bitacoras as $bitacora){ 
	$arrSeccionesCompletadas[$i] = $bitacora['idSeccionBitacora'];
	$i++;
	}
}
echo "<option value=''>Seleccione Apartado</option>";
if(count($secciones>0)){
	foreach($secciones as $seccion) {
		if(!in_array($seccion["idSeccionBitacora"],$arrSeccionesCompletadas)){
			echo "<option value=".$seccion["idSeccionBitacora"].">".$seccion["nombreSeccionBitacora"]."</option>";
		}
	}
}
?>