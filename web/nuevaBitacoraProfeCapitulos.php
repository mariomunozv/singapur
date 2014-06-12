<?php
ini_set("display_errors","on");
include "inc/conecta.php";
include("inc/_seccionBitacora.php");
include("inc/_bitacora.php");
Conectarse_seg();
$parteLibro = $_REQUEST['parte'];
$idUsuario = $_REQUEST['idUsuario'];
$idCurso = $_REQUEST['idCurso'];
$capitulos = getSeccionPadreBitacora($parteLibro);
$bitacoras = getBitacorasCompletadasUsuario($idUsuario,$idCurso);
print_r($bitacoras);
foreach($capitulos as $lCap) //Hasta aquí se tienen todos los capitulos del libro
{
	$seccinoes = getSeccionBitacoraCapitulo($lCap["idSeccionBitacora"]);
	$bandera = false;
	$libera = 0;
	foreach($seccinoes as $seccion){ //Aquí se separa cada capítulo por sus secciones.
		foreach($bitacoras as $bitacora){
 			if($seccion["idSeccionBitacora"] == $bitacora["idSeccionBitacora"]){
				unset($seccinoes[$libera]);
				break;
			} //fin if
		} //fin foreach($bitacoras as $bitacora)
		$libera++;
	} //fin foreach($seccinoes as $seccion)
	if(count($seccinoes)==0){
		$capCompletos[] = $lCap;
	}
	/* //Estas líneas muestran en pantalla que capitulos están completos
	echo "Cap: ".$cap." = ";
	echo $bandera."<br>";
	$cap++;
	*/
}

echo "<option value=''>Selecciona un Cap&iacute;tulo</option>";
if(isset($capCompletos) && count($capCompletos)>0)
{	
	foreach($capitulos as $capitulo){
		$esta = false; //Variable que comprobará si la sección está en el arreglo de capítulos completos
		foreach($capCompletos as $cc){
			if($capitulo["idSeccionBitacora"] == $cc["idSeccionBitacora"]){
				$esta = true;
			}
		}
		if(!$esta){ //Si no se encontró, entonces muestra.
			echo "<option value='".$capitulo["idSeccionBitacora"]."'>".$capitulo["nombreSeccionBitacora"]."</option>";
		}
	}
}else{
	foreach($capitulos as $capitulo){
		echo "<option value='".$capitulo["idSeccionBitacora"]."'>".$capitulo["nombreSeccionBitacora"]."</option>";
	}
}
?>
