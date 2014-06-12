<?php
require_once("../inc/config.php");
require_once("item.php");

class Lista
{
	public $attributes;
	public $errors;

	function __construct()
	{
		$this->attributes = array(
				"id" => "",
				"idActividad" => "",
				"anteriorLista" => "",
				"nombreLista" => "SERIE X",
				"dificultadLista" => 1,
				"tipoLista" => "Serie",
				"porcentajeLogroLista" => 1,
				"itemsMinimosLista" => 10,
				"itemsMaximosLista" => 10,
				"textoTransicionLista" => 0,
				"puntajeTotalLista" => 0
			);
	}

	public function create($data) {
		foreach ($this->attributes as $key => $value) {
			if (isset($data[$key])) {
				$this->attributes[$key] = $data[$key];
			}
		}
	}

	public function validate() {
		$this->errors = array();
		$return = true;
		$notEmpty = array("idActividad", "porcentajeLogroLista", "itemsMinimosLista");

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

	public function save() {
		if ($this->validate()) {
			$sql = "INSERT INTO lista(idActividad,nombreLista,dificultadLista,tipoLista,porcentajeLogroLista,itemsMinimosLista,itemsMaximosLista)";
			$sql .= " VALUES(".$this->attributes['idActividad'].", '".$this->attributes['nombreLista']."', ".$this->attributes['dificultadLista'].", '".$this->attributes['tipoLista']."', ".$this->attributes['porcentajeLogroLista'].", ".$this->attributes['itemsMinimosLista'].", ".$this->attributes['itemsMaximosLista'].")";
			echo $sql;
			$res = mysql_query($sql);
			$row = mysql_affected_rows();
			$this->attributes["id"] = mysql_insert_id();
			if($row > 0) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	public function edit() {
		if ($this->validate()) {
			$sql = "UPDATE lista SET porcentajeLogroLista='".$this->attributes['porcentajeLogroLista']."', itemsMinimosLista=".$this->attributes['itemsMinimosLista'].", itemsMaximosLista=".$this->attributes['itemsMaximosLista']." WHERE idActividad =".$this->attributes['idActividad'];
			$res = mysql_query($sql);
			$row = mysql_affected_rows();
			if($row > 0) {
				return true;
			}
		}
		return false;
	}

	public function deleteByIdActividad($idActividad) {
		$items = new Items();
		$items->deleteByIdActividad($idActividad);
		$sql = "DELETE FROM lista WHERE idActividad = ".$idActividad;
		$res = mysql_query($sql);
		return true;
	}
}