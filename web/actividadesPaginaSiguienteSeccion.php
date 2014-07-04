<?php 
require("inc/incluidos.php");

include "inc/_actividad.php";

function creaPauta($idFormulario,$idUsuario){
	$sql_insert = "INSERT INTO `pauta` ( `idFormulario` , `idUsuario` , `idPauta` , `fechaRespuestaPauta`  )";
	$sql_insert .=" VALUES (";
   	$sql_insert .=" '$idFormulario', '$idUsuario', '',NOW( )";
	$sql_insert .=" )";					   
//	echo $sql_insert;
	$res_insert = mysql_query($sql_insert);
	$idPauta = mysql_insert_id();
	return ($idPauta);
}


function setRespuesta($idEnunciado,$idFormulario,$idUsuario,$idPauta,$opcionSeleccionada,$valorSeleccionada){
	
	$sql_insert = "INSERT INTO `respuesta` ( `idEnunciado` , `idFormulario` , `idUsuario` , `idPauta` , `idRespuesta` ,  `opcionSeleccionada` ,`valorSeleccionada`   )";
	$sql_insert .= " VALUES ( '$idEnunciado', '$idFormulario', '$idUsuario', '$idPauta','','$opcionSeleccionada', '$valorSeleccionada')";
	$res = mysql_query($sql_insert);
	//echo $sql_insert;
}

function cuentaPautasFormulario($idFormulario, $idUsuario){
	$sql= "SELECT COUNT(*) AS cont
			FROM pauta
			WHERE idFormulario = $idFormulario
			AND idUsuario = $idUsuario";
			//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
}



function getPautaUsuarioFormulario($idFormulario, $idUsuario){
	$sql= "SELECT * FROM pauta WHERE idFormulario = $idFormulario AND idUsuario = $idUsuario";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["idPauta"];
}

$j = $_SESSION["j"];
$j++;
$_SESSION["j"]=$j;

$tipoActividad = $_REQUEST["tipoActividad"];

if ($tipoActividad == "Seccion"){
	
	$idSeccion = $_REQUEST["idSeccion"];
	$idFormulario = $_SESSION["idFormulario"];
	$idUsuario = $_SESSION["sesionIdUsuario"];
	$listaItem = $_SESSION["listaItem"];
	$contestada= $_REQUEST["contestada"];
	if ($contestada ==0){
		
		if (cuentaPautasFormulario($idFormulario, $idUsuario) == 0){
			$idPauta = creaPauta($idFormulario,$idUsuario);
		}else{
			$idPauta = getPautaUsuarioFormulario($idFormulario,$idUsuario);
			}
		
		foreach ($listaItem as $item){
			
			if($item["esAbiertaEnunciado"] == 1){
				
				$respuesta = @$_REQUEST["item".$item["idEnunciado"]];
				
				//echo $respuesta."<-------------RESPUESTA".@$_REQUEST["item".$item["idEnunciado"]];
				$opcionSeleccionada = $respuesta;
				$valorSeleccionada = $respuesta;
				
				}else{
					
			}
			
			if ($contestada ==0){
				setRespuesta($item["idEnunciado"],$idFormulario,$idUsuario,$idPauta,$opcionSeleccionada,$valorSeleccionada);
			}
			
	 	}
	}
		
}



if(count($_SESSION["paginasActividad"])<=$j){
	dirigirse_a("actividadesPaginaFin.php");		
	}else{
		//echo "<a href='actividadesPaginaSeccion.php'>OTRO</a>";
dirigirse_a("actividadesPaginaSeccion.php");	
		}





?>