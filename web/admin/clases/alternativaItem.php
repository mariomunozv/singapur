<?php

require_once("../inc/config.php");

class AlternativaItem
{

	function __construct()
	{
		$this->attributes = array(
			"idAlternativaItem" => null,
			"idItem" => "",
			"nombreAlternativaItem" => "",
			"esCorrectaAlternativaItem" => 0,
			"funcionEvaluadora" => null,
			"tipoCampo" => "",
			"puntaje" => "",
			"entero" => "",
			"entero2" => "",
			"numerador" => "",
			"numerador2" => "",
			"denominador" => "",
			"denominador2" => "",
		);
	}

	public function create($data) {
		foreach ($this->attributes as $key => $value) {
			if (isset($data[$key])) {
				$this->attributes[$key] = $data[$key];
			}
		}
		print_r($this->attributes);
	}


	public function notEmpty($nameAttribute) {
		if ($this->attributes[$nameAttribute] == null || $this->attributes[$nameAttribute] == "") {
			return false;
		}
		return true;
	}


	public function validate() {
		$this->errors = array();
		$return = true;
		$notEmpty = array();

		foreach ($notEmpty as $value) {
			if (!$this->notEmpty($value)) {
				$return = false;
				$this->errors[$value] = "No puede ser vacio";
			}
		}

		return $return;
	}


	public function save() {
		if ($this->validate()) {
			$sql = "INSERT INTO alternativaItem(idItem,nombreAlternativaItem,esCorrectaAlternativaItem,funcionEvaluadora,puntaje,tipoCampo)";
			$sql .= " VALUES(".$this->attributes['idItem'].", '".utf8_decode($this->attributes['nombreAlternativaItem'])."', ".$this->attributes['esCorrectaAlternativaItem'].", '".utf8_decode($this->attributes['funcionEvaluadora'])."', '".$this->attributes['puntaje']."', '".$this->attributes['tipoCampo']."')";
			$res = mysql_query($sql);
			echo $sql;
			$row = mysql_affected_rows();
			$this->attributes["idAlternativaItem"] = mysql_insert_id();
			if($row > 0) {
				return true;
			}
		}
		return false;
	}


	public function saveOpenQuestion() {
		if ($this->validate()) {
			$sql = "INSERT INTO alternativaItem(idItem,nombreAlternativaItem,funcionEvaluadora,puntaje,tipoCampo, entero, entero2, numerador, numerador2, denominador, denominador2)";
			$sql .= " VALUES(".$this->attributes['idItem'].", '".utf8_decode($this->attributes['nombreAlternativaItem'])."', '".utf8_decode($this->attributes['funcionEvaluadora'])."', '".$this->attributes['puntaje']."', '".$this->attributes['tipoCampo']."', '".utf8_decode($this->attributes['entero'])."', '".utf8_decode($this->attributes['entero2'])."', '".$this->attributes['numerador']."', '".$this->attributes['numerador2']."', '".$this->attributes['denominador']."', '".$this->attributes['denominador2']."')";
			$res = mysql_query($sql);
			echo "<br>".$sql;
			$row = mysql_affected_rows();
			$this->attributes["idAlternativaItem"] = mysql_insert_id();
			if($row > 0)
			{
				return true;
			}
		}
		return false;
	}



	public function getError() {
		return $this->errors;
	}

	public function deleteByIdItem($idItem) {
		$sql = "DELETE FROM alternativaItem WHERE idItem = ".$idItem;
		$res = mysql_query($sql);
		return true;
	}


	public function getByIdItem($idItem) {
		$sql = "SELECT idAlternativaItem, idItem, nombreAlternativaItem, esCorrectaAlternativaItem, imagenAlternativaItem, esImagenAlternativaItem, funcionEvaluadora, entero, puntaje, tipoCampo, entero2, numerador, denominador, numerador2, denominador2 FROM alternativaItem WHERE idItem = ".$idItem;
		$resultado = mysql_query($sql);
		$alternativas = array();

		while ($fila = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			$alternativas[] = array(
				"idAlternativaItem" => $fila["idAlternativaItem"],
				"idItem" => $fila["idItem"],
				"nombreAlternativaItem" => htmlentities($fila["nombreAlternativaItem"]),
				"esCorrectaAlternativaItem" => $fila["esCorrectaAlternativaItem"],
				"imagenAlternativaItem" => $fila["imagenAlternativaItem"],
				"esImagenAlternativaItem" => $fila["esImagenAlternativaItem"],
				"funcionEvaluadora" => $fila["funcionEvaluadora"],
				"entero" => $fila["entero"],
				"puntaje" => $fila["puntaje"],
				"tipoCampo" => $fila["tipoCampo"],
				"entero2" => $fila["entero2"],
				"numerador" => $fila["numerador"],
				"denominador" => $fila["denominador"],
				"numerador2" => $fila["numerador2"],
				"denominador2" => $fila["denominador2"]
			);
		}
		return $alternativas;		
	}


}


class AlternativasItem
{

	function __construct()
	{
	}

	public function saveAlternativas($names, $correct, $idItem) {
		foreach ($names as $key => $value) {
			$datos = array();
			$datos["idItem"] = $idItem;
			$datos["nombreAlternativaItem"] = $value;
			if ($correct[0] == $key) {
				$datos["esCorrectaAlternativaItem"] = 1;
			}
			$alternativa = new AlternativaItem();
			$alternativa->create($datos);
			$alternativa->save();
		}
		return true;
	}

	public function saveRespuestasAbiertas($parametros, $idItem) {
		print_r($parametros);
		foreach ($parametros as $key => $data) {
			$data["idItem"] = $idItem;
			echo '<pre>';
			print_r($data);
			echo '</pre>';


			$alternativa = new AlternativaItem();
			$alternativa->create($data);
			echo $alternativa->saveOpenQuestion();
		}
		return true;
	}


}

 ?>