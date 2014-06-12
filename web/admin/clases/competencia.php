<?php
require_once("../inc/config.php");

class Competencias
{

	function __construct()
	{
	}

	public function getAll(){
		$competencias = array();
		$sql = "SELECT idCompetencia, nombreCompetencia, descripcionCompetencia FROM competencia";
		//mysql_set_charset('utf8');
		$resultado = mysql_query($sql);
		while ($fila = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			$competencias[] = array("id" => $fila["idCompetencia"], "nombre" => htmlentities($fila["nombreCompetencia"]), "descripcion" => $fila["descripcionCompetencia"]);
		}
		return $competencias;
	}
}

?>