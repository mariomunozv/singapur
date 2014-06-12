<?php
function crearFormulario($idActividadPagina,$nombreFormulario,$descripcionFormulario)
{
	if($idActividadPagina == '')
	{
		$idActividadPagina = "NULL";
	}
	
	$sql = "INSERT INTO `formulario` ( `idActividadPagina` , `nombreFormulario` , `descripcionFormulario`)
							VALUES ( $idActividadPagina, '$nombreFormulario', '$descripcionFormulario')";
	echo "<br>la actividad de página es :".$idActividadPagina."<br>";
	echo $sql;
	$res = mysql_query($sql);
	return $res;

}


function getDatosFormulario($idFormulario){
	$sql = "SELECT * FROM formulario  where idFormulario= ".$idFormulario;
	//echo $sql;
	$res = mysql_query($sql);
	while ($row = mysql_fetch_array($res)) {
		$datosFormulario = array(
				"idFormulario" => $row["idFormulario"],
				"idActividadPagina" => $row["idActividadPagina"],
				"nombreFormulario" => $row["nombreFormulario"],
				"descripcionFormulario" => $row["descripcionFormulario"],
				"estadoFormulario" => $row["estadoFormulario"]
			
		);
	}
	return($datosFormulario);
}

function getFormularios(){
	$sql = "SELECT * FROM formulario order by idFormulario DESC"; //WHERE idActividadPagina is null
	echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($res))
	{
		$formulario[$i] = array(
				"idFormulario" => $row["idFormulario"],
				"idActividadPagina" => $row["idActividadPagina"],
				"nombreFormulario" => $row["nombreFormulario"],
				"descripcionFormulario" => $row["descripcionFormulario"],
				"estadoFormulario" => $row["estadoFormulario"]);
				$i++;
	}
	return ($formulario);
}

function getEncuestas()
{
	$sql = "SELECT * FROM formulario WHERE estadoFormulario = 1 AND idActividadPagina is NULL";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$formularios[$i] = array(
				"idFormulario" => $row["idFormulario"],
				"idActividadPagina" => $row["idActividadPagina"],
				"nombreFormulario" => $row["nombreFormulario"],
				"descripcionFormulario" => $row["descripcionFormulario"],
				"estadoFormulario" => $row["estadoFormulario"]);
		$i++;
	}
	return($formularios);
}


?> 