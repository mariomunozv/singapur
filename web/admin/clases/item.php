<?php

require_once("../inc/config.php");
require_once("alternativaItem.php");

class Item
{
	public $attributes;
	public $errors;

	function __construct()
	{
		$this->attributes = array(
				"id" => null,
				"tema" => "",
				"nivel" => "",
				"capitulo" => "",
				"apartado" => "",
				"idCompetencia" => "",
				"enunciado" => "",
				"tipoRespuesta" => "",
				"alternativa" => "",
				"altCheck" => "",
				"correct" => "",
				"puntaje" => 1,
				"estado" => 1,
				"esAbierto" => 0,
				"foto" => "../fondos/00001.jpg",
				"funcionEvaluadora" => array(),
				"parametro" => array(),
				"tipoCampo" => array(),
				"puntajeRespuesta" => "",
				"idActividad" => ""
			);
	}

	public function create($data) {
		foreach ($this->attributes as $key => $value) {
			if (isset($data[$key])) {
				$this->attributes[$key] = $data[$key];
			}
		}

		if ($this->attributes['tipoRespuesta'] == 'respuestaAbierta') {
			$i = 0;
			foreach ($data['numerador'] as $key => $value) {
				$this->attributes['parametro'][$i] = array(
					'numerador' => $data['numerador'][$i],
					'numerador2' => $data['numerador2'][$i],
					'denominador' => $data['denominador'][$i],
					'denominador2' => $data['denominador2'][$i],
					'entero' => $data['entero'][$i],
					'entero2' => $data['entero2'][$i],
					'nombreAlternativaItem' => $data['alternativa'][$i],
					'funcionEvaluadora' => $data['funcionEvaluadora'][$i],
					'tipoCampo' => $data['tipoCampo'][$i],
					'puntaje' => $data['puntajeRespuesta'][$i]
				);
				$i++;
			}
		}

		$this->attributes["foto"] = "../fondos/".$this->attributes["foto"];

		echo '<pre>';
		print_r($data);
		echo '</pre>';
		echo '<pre>';
		print_r($this->attributes);
		echo '</pre>';
	}


	public function validate() {
		$this->errors = array();
		$return = true;
		$notEmpty = array("tema", "nivel", "capitulo", "apartado", "enunciado", "idActividad");

		foreach ($notEmpty as $value) {
			if (!$this->notEmpty($value)) {
				$return = false;
				$this->errors[$value] = "No puede ser vacio";
			}
		}

		return $return;
	}

	public function notEmpty($nameAttribute) {
		if ($this->attributes[$nameAttribute] == null || $this->attributes[$nameAttribute] == "") {
			return false;
		}
		return true;
	}


	public function update() {
		$sql = "UPDATE item SET idCompetencia =".$this->attributes['idCompetencia'].", idSeccionBitacora=".$this->attributes['apartado'].", enunciadoItem='".utf8_decode($this->attributes['enunciado'])."', fondoItem='".utf8_decode($this->attributes['foto'])."', puntajeItem=".$this->attributes['puntaje'].", estadoItem = ".$this->attributes['estado'].", tema='".$this->attributes['tema']."', esAbiertoItem='".$this->attributes['esAbierto']."' WHERE idItem =".$this->attributes['id'].";";
		echo $sql."<br>";
		$res = mysql_query($sql);

		$alternativa = new AlternativaItem();
		$alternativa->deleteByIdItem($this->attributes['id']);	
		$sql = "DELETE FROM lista_Item WHERE idItem = ".$this->attributes['id'];
		$res = mysql_query($sql);

		if ($this->saveRespuestas()) {
			return true;
		}
	}


	public function save() {

		if ($this->validate()) {

			$sql = "INSERT INTO item(idTareaMatematica,idCompetencia,idNivelDeComplejidad,idSeccionBitacora,enunciadoItem,fondoItem,puntajeItem,estadoItem,tema,esAbiertoItem)";
			$sql .= " VALUES(1,".$this->attributes['idCompetencia'].", '3', ".$this->attributes['apartado'].", '".utf8_decode($this->attributes['enunciado'])."', '".utf8_decode($this->attributes['foto'])."', ".$this->attributes['puntaje'].", ".$this->attributes['estado'].", '".$this->attributes['tema']."', '".$this->attributes['esAbierto']."')";
			echo $sql;
			$res = mysql_query($sql);
			$row = mysql_affected_rows();
			$this->attributes["id"] = mysql_insert_id();
			if($row > 0)
			{
				if ($this->saveRespuestas()) {
					return true;
				}
			}
		}
		return false;
	}

	public function edit() {
		if ($this->validate()) {

		}
		return false;
	}

	public function saveRespuestas () {
		$alternativas = new AlternativasItem();
		switch ($this->attributes["tipoRespuesta"]) {
			case 'seleccionUnica':
				echo 'Entre seleccion unica';
				if ($alternativas->saveAlternativas($this->attributes["alternativa"], $this->attributes["correct"], $this->attributes["id"])) {
					if($this->addListaItem()){
						return true;
					}
				}
				break;
			case 'respuestaAbierta':
				echo 'respuesta abierta';
				if ($alternativas->saveRespuestasAbiertas($this->attributes['parametro'], $this->attributes["id"])) {
					if($this->addListaItem()){
						return true;
					}
				}
				break;		
		}
		return false;		
	}

	public function addListaItem() {
		$sql = "SELECT idLista FROM  lista where idActividad = ".$this->attributes['idActividad'];
		$resultado = mysql_query($sql);
		$idLista = 0;
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
			$idLista = $fila[0];
		}


		$sql = "INSERT INTO lista_Item(idLista, idItem)";
		$sql .= " VALUES(".$idLista.", ".$this->attributes["id"].")";
		$res = mysql_query($sql);
		$row = mysql_affected_rows();
		echo $sql;
		$this->attributes["id"] = mysql_insert_id();
		if($row > 0)
		{
			return true;
		}
		return false;
	}

	public function getError() {
		return $this->errors;
	}

	public function getById($id) {
		$sql = "SELECT idItem, idCompetencia, idNivelDeComplejidad, item.idSeccionBitacora, idTareaMatematica, enunciadoItem, fondoItem, esAbiertoItem, respuestaCorrectaItem, cantidadRespuestasItem, puntajeItem, estadoItem, tema, sb.idPadreSeccionBitacora, sbP.idNivelCursoSeccionBitacora FROM  item JOIN seccionBitacora as sb on item.idSeccionBitacora = sb.idSeccionBitacora JOIN seccionBitacora as sbP on sb.idPadreSeccionBitacora = sbP.idSeccionBitacora where idItem = $id";
		$resultado = mysql_query($sql);

		$item = array();

		while ($fila = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			$item = array(
				"id" => $fila["idItem"],
				"idCompetencia" => $fila["idCompetencia"],
				"idNivelDeComplejidad" => $fila["idNivelDeComplejidad"],
				"idSeccionBitacora" => $fila["idSeccionBitacora"],
				"enunciadoItem" => htmlentities($fila["enunciadoItem"]),
				"fondoItem" => htmlentities($fila["fondoItem"]),
				"esAbiertoItem" => $fila["esAbiertoItem"],
				"cantidadRespuestasItem" => $fila["cantidadRespuestasItem"],
				"puntajeItem" => $fila["puntajeItem"],
				"tema" => $fila["tema"],
				"idPadreSeccionBitacora" => $fila["idPadreSeccionBitacora"],
				"nivel" => $fila["idNivelCursoSeccionBitacora"],
				"estadoItem" => $fila["estadoItem"]
			);
		}

		if (isset($item["id"])) {
			$Alternativa = new AlternativaItem();
			$alternativas = $Alternativa->getByIdItem($id);
			$item["alternativas"] = $alternativas;
			return $item;
		} else {
			return null;
		}
	}

	public function deleteById($idItem) {		
		$alternativa = new AlternativaItem();
		$alternativa->deleteByIdItem($idItem);	
		$sql = "DELETE FROM lista_Item WHERE idItem = ".$idItem;
		$res = mysql_query($sql);
		$sql = "DELETE FROM item WHERE idItem = ".$idItem;
		$res = mysql_query($sql);
		return true;
	}
}

class Items
{

	function __construct()
	{
	}

	public function getAllByIdActividad($idActividad){
		$sql = "SELECT idLista FROM  lista where idActividad = $idActividad";
		$resultado = mysql_query($sql);
		$idLista = 0;
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
			$idLista = $fila[0];
		}

		$sql = "SELECT idItem FROM  lista_Item where idLista = $idLista";
		$resultado = mysql_query($sql);
		$items = array();
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
			$item = new Item();
			$items[] = $item->getById($fila[0]);
		}
		return $items;
	}

	public function deleteByIdActividad($idActividad) {
		$sql = "SELECT idLista FROM  lista where idActividad = $idActividad";
		$resultado = mysql_query($sql);
		$idLista = 0;
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
			$idLista = $fila[0];
		}

		$sql = "SELECT idItem FROM  lista_Item where idLista = $idLista";
		$resultado = mysql_query($sql);
		$items = array();
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
			$item = new Item();
			$item->deleteById($fila[0]);
		}
		return true;
	}
}

 ?>