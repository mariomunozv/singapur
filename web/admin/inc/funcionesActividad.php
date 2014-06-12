<?php
require_once 'jsonwrapper_inner.php';
require("../clases/actividad.php");

if (isset($_POST["action"] ) ) {
	switch ($_POST["action"]) {
		case 'add':
			echo guardarActividad($_POST);
			break;
		case 'edit':
			echo editarActividad($_POST);
			break;
		case 'getAll':
			echo getAllActividad($_POST);
			break;
		case 'removeActividad':
			echo removeActividad($_POST["id"]);
			break;
		case 'getActividad':
			echo getActividad($_POST["id"]);
			break;
	}
}

function guardarActividad($datos) {
	$actividad = new Actividad();
	$actividad->create($datos);
	if ($actividad->save()) {
		return "Guardado Correcto";
	}else{
		$retorno = array('result' => false, 'errors' => $actividad->getError());
		return json_encode1($actividad->getError());
	}
}

function editarActividad($datos) {
	echo 'DATOS iso:<pre>';
	print_r($datos);
	echo '</pre>';
	$actividad = new Actividad();
	$actividad->create($datos);
	if ($actividad->edit()) {
		return "Editado Correcto";
	}else{
		$retorno = array('result' => false, 'errors' => $actividad->getError());
		return json_encode1($actividad->getError());
	}
}

function getAllActividad() {
	$actividades = new Actividades();
	$data = array('result' => true, 'data' => $actividades->getAll());
	return json_encode1($data);
}

function removeActividad($id) {
	$actividad = new Actividad();
	return $actividad->deleteById($id);
}

function getActividad($id) {
	$actividad = new Actividad();
	return json_encode1($actividad->getById($id));
}

?>