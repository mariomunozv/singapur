<?php
/**
*
*/
class SeccionBitacora
{
	function __construct()
	{

	}

	public function getCapitulosByNivel($idNivel){
		$capitulos = array();
		$sql = "SELECT *
			FROM seccionBitacora
			WHERE idNivelCursoSeccionBitacora = $idNivel
			AND idPadreSeccionBitacora IS NULL and estadoSeccionBitacora = 1";
		//mysql_set_charset('utf8');
		$res = mysql_query($sql);
		while($row = mysql_fetch_array($res)){
			$capitulos[]=array(
				"id"=> $row["idSeccionBitacora"],
				"parteLibro" => $row["parteLibro"],
				"idPadreSeccionBitacora" => $row["idPadreSeccionBitacora"],
				"idNivelCursoSeccionBitacora" => $row["idNivelCursoSeccionBitacora"],
				"nombreSeccionBitacora" => htmlentities($row["nombreSeccionBitacora"]),
				"tiempoEstimadoSeccionBitacora" => $row["tiempoEstimadoSeccionBitacora"],
				"estadoSeccionBitacora" => $row["estadoSeccionBitacora"]
			);
		}
		return $capitulos;
	}

	public function getApartadosByCapitulo($idCapitulo){
		$capitulos = array();
		$sql = "SELECT *
			FROM seccionBitacora
			WHERE idPadreSeccionBitacora = $idCapitulo";
		//mysql_set_charset('utf8');
		$res = mysql_query($sql);
		while($row = mysql_fetch_array($res)){
			$capitulos[]=array(
				"id"=> $row["idSeccionBitacora"],
				"parteLibro" => $row["parteLibro"],
				"idPadreSeccionBitacora" => $row["idPadreSeccionBitacora"],
				"idNivelCursoSeccionBitacora" => $row["idNivelCursoSeccionBitacora"],
				"nombreSeccionBitacora" => htmlentities($row["nombreSeccionBitacora"]),
				"tiempoEstimadoSeccionBitacora" => $row["tiempoEstimadoSeccionBitacora"],
				"estadoSeccionBitacora" => $row["estadoSeccionBitacora"]
			);
		}
		return $capitulos;
	}

}

 ?>