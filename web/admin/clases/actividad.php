<?php
require_once("../inc/config.php");
require_once("lista.php");

class Actividad
{
	public $attributes;
	public $errors;


	function __construct()
	{
		$this->attributes = array(
				"id" => null,
				"titulo" => "",
				"bienvenida" => "",
				"limiteIntentos" => "",
				"cantidadPreguntas" => "",
				"porcentajeAprobacion" => "",
				"estado" => 1,
				"link" => "series/listaItemsNew.php"
			);
	}

	public function create($data) {
		foreach ($this->attributes as $key => $value) {
			if (isset($data[$key])) {
				$this->attributes[$key] = $data[$key];
			}
		}
		echo '<pre>';
		print_r($this->attributes);
		echo '</pre>';
	}

	public function validate() {
		$this->errors = array();
		$return = true;
		$notEmpty = array("titulo", "bienvenida", "limiteIntentos", "cantidadPreguntas", "porcentajeAprobacion");

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
			$sql = "INSERT INTO actividad(tituloActividad,estadoActividad,bienvenidaActividad,linkActividad,limiteVecesActividad)";
			$sql .= " VALUES('".utf8_decode($this->attributes['titulo'])."', ".$this->attributes['estado'].", '".utf8_decode($this->attributes['bienvenida'])."', '".$this->attributes['link']."', ".$this->attributes['limiteIntentos'].")";
			$res = mysql_query($sql);
			$row = mysql_affected_rows();
			$this->attributes["id"] = mysql_insert_id();
			if($row > 0)
			{
				if ($this->saveLista()) {
					return true;
				}
			}
		}
		return false;
	}

	public function edit() {
		if ($this->validate()) {
			$sql = "UPDATE actividad SET tituloActividad = '".utf8_decode($this->attributes['titulo'])."', estadoActividad='".$this->attributes['estado']."', bienvenidaActividad='".utf8_decode($this->attributes['bienvenida'])."', linkActividad='".$this->attributes['link']."', limiteVecesActividad=".$this->attributes['limiteIntentos']." WHERE idActividad =".$this->attributes['id'];
			echo $sql;
			$res = mysql_query($sql);
			$row = mysql_affected_rows();
			if($row > 0)
			{
				if ($this->editLista()) {
					return true;
				}
			}
		}
		return false;
	}

	public function getError() {
		return $this->errors;
	}

	public function saveLista() {
		$dataLista = array(
				"idActividad" => $this->attributes['id'],
				"porcentajeLogroLista" => $this->attributes['porcentajeAprobacion'],
				"itemsMinimosLista" => $this->attributes['cantidadPreguntas'],
				"itemsMaximosLista" => $this->attributes['cantidadPreguntas']
			);

		$lista = new Lista();
		$lista->create($dataLista);
		if ($lista->save()) {
			return true;
		} else {
			return false;
		}
	}

	public function editLista() {
		$dataLista = array(
			"idActividad" => $this->attributes['id'],
			"porcentajeLogroLista" => $this->attributes['porcentajeAprobacion'],
			"itemsMinimosLista" => $this->attributes['cantidadPreguntas'],
			"itemsMaximosLista" => $this->attributes['cantidadPreguntas']
		);
		$lista = new Lista();
		$lista->create($dataLista);
		if ($lista->edit()) {
			return true;
		} else {
			return false;
		}
	}

	public function getById($id) {
		$sql = "SELECT actividad.idActividad,tituloActividad,estadoActividad,bienvenidaActividad,linkActividad,limiteVecesActividad,l.itemsMaximosLista as itemsMaximosLista, l.porcentajeLogroLista as porcentajeAprobacion FROM  actividad join lista as l on actividad.idActividad = l.idActividad where actividad.idActividad = $id";
		$resultado = mysql_query($sql);

		while ($fila = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
			return array(
				"id" => $fila["idActividad"],
				"titulo" => htmlentities($fila["tituloActividad"]),
				"bienvenida" => htmlentities($fila["bienvenidaActividad"]),
				"limiteIntentos" => $fila["limiteVecesActividad"],
				"estado" => $fila["estadoActividad"],
				"link" => $fila["linkActividad"],
				"cantidadPreguntas" => $fila["itemsMaximosLista"],
				"porcentajeAprobacion" => $fila["porcentajeAprobacion"]
			);
		}

		return null;
	}

	public function deleteById($id) {				
		$lista = new Lista();
		$lista->deleteByIdActividad($id);	
		$sql = "DELETE FROM actividad WHERE idActividad = ".$id;
		$res = mysql_query($sql);
		return true;
	}
}



class Actividades
{
	public $actividades;
	function __construct()
	{
		$actividades = array();
	}

	public function getAll() {
		$sql = "SELECT DISTINCT (idActividad) FROM  lista where idActividad != 'NULL'";
		$resultado = mysql_query($sql);
		while ($fila = mysql_fetch_array($resultado, MYSQL_NUM)) {
			$actividad = new Actividad();
			$actividades[] = $actividad->getById($fila[0]);
		}
		return $actividades;
	}
}


// $acts = new Actividades();
// $acts->getAll();
// $act = new Actividad();
// $act->getById(10);
// $act = new Actividad();
// echo $act->create(array(
//     "titulo" => "asd",
//     "bienvenida" => "asd",
//     "limiteIntentos" => 5,
//     "cantidadPreguntas" => 5,
//     "porcentajeAprobacion" => 5
// ));

// $act->save();

?>