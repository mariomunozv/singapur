<?php
session_start();
include "inc/conecta.php";
include "inc/funciones.php";
include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"]; 
$conecta = Conectarse_seg();


function getNombreSeccionBitacora($idSeccion){
	$sql ="SELECT * FROM seccionBitacora where idSeccionBitacora = ".$idSeccion;
	//echo "<br>".$sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["nombreSeccionBitacora"]);
}

function getIdUltimaBitacora($idUsuario){
	$sql ="SELECT * FROM bitacora where idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["idBitacora"]);
}


function insertaBitacoraProfe($idUsuario,$idSeccionBitacora,$nombreSeccionBitacora,$fechaBitacora,$tiempoBitacora,$comentarios,$tipoBitacora){

	$sql = "INSERT INTO `bitacora` ";
	$sql.= "( `idBitacora` , `idUsuario` , `idJornada` , `idSeccionBitacora` , `nombreBitacora` , `fechaBitacora` , `tiempoBitacora` , `comentariosBitacora` , `fechaCreacionBitacora` , `estadoBitacora`, `tipoBitacora` )";
	$sql.= "VALUES ( ";
	$sql.= "'','$idUsuario',NULL,'$idSeccionBitacora','$nombreSeccionBitacora','$fechaBitacora','$tiempoBitacora','$comentarios',NOW(),'1','$tipoBitacora'";
	$sql.= ");";
	$result = mysql_query($sql);
	//echo $sql;
	if (!$result) {
		// No se ejecuto correctamente el sql
	
		return $ultimo_id;
	}else{
		$ultimo_id = mysql_insert_id();
		//echo $ultimo_id."<------------------";
		return $ultimo_id;
	}
}

function insertarDetalleBitacoraNivel($idBitacora,$idNivel){
	$sql = "INSERT INTO detalleBitacoraNivel";
	$sql.= "(idBitacora,idNivel)";
	$sql.= "VALUES(";
	$sql.= "$idBitacora,$idNivel";
	$sql.= ");";
	$result = mysql_query($sql);
	//echo "<br>SSSS".$sql;
	if (!$result) {
		// No se ejecuto correctamente el sql
		return false;
	}else{
		
		return true;
	}
}

$tipoBitacora = $_REQUEST["tipoBitacora"];

switch ($tipoBitacora){
	
	case "profe":
		$idSeccionBitacora = $_REQUEST["seccion"];
		$tiempoBitacora  = $_REQUEST["tiempo"];
		$fechaInicioBitacora = $_REQUEST["fechaInicio"];
		$comentarios = $_REQUEST["comentarios"];
		$nombreSeccionBitacora = getNombreSeccionBitacora($idSeccionBitacora);
		$resultado = insertaBitacoraProfe($idUsuario,$idSeccionBitacora,$nombreSeccionBitacora,$fechaInicioBitacora,$tiempoBitacora,$comentarios,$tipoBitacora);
	break;
	
	case "utp1":
		$tiempoBitacora  = $_REQUEST["tiempo"];
		$fechaInicioBitacora = $_REQUEST["fechaClase"];
		$comentarios = $_REQUEST["comentarios"];
		$niveles = $_REQUEST["niveles"];
		
		$resultado = insertaBitacoraProfe($idUsuario,"","Reunión con profesores",$fechaInicioBitacora,$tiempoBitacora,$comentarios,$tipoBitacora);
		//$idBitacora = getIdUltimaBitacora($idUsuario);
		
		
		$cuenta = 0;

		if($resultado != 0)
		{
			foreach ($niveles as $nivel)
			{
				if(!insertarDetalleBitacoraNivel($resultado,$nivel))
				{
					$cuenta++;
					break;
				}
			}
		
		}
	break;
	
	case "utp2":
		$tiempoBitacora  = $_REQUEST["tiempo"];
		$fechaInicioBitacora = $_REQUEST["fechaClase"];
		$comentarios = $_REQUEST["comentarios"];
		
		$nivel = $_REQUEST["nivel"];
		
		$cuenta = 1;
		$resultado = insertaBitacoraProfe($idUsuario,"","Acompañamiento en Aula",$fechaInicioBitacora,$tiempoBitacora,$comentarios,$tipoBitacora);
		
		
		$idBitacora = $resultado;
			if($idBitacora != 0){
				if(insertarDetalleBitacoraNivel($idBitacora,$nivel)){
					$cuenta = 0;
					}
			}
	break;
}



if ($cuenta == 0)
{
	/* Registra Participación en un Foro */
	//registraAcceso($idUsuario, 12, $idTema);
	info("Su Bitacora se ha enviado correctamente.");
	//dirigirse_despues("bitacora.php",1000);

}
else{
	info("Ha ocurrido un error al enviar su bitacora.");
	
}
?>

<script>
		muestraBitacorasSeccion();
</script>


