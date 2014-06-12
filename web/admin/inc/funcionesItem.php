<?php
require_once 'jsonwrapper_inner.php';
require("../clases/nivel.php");
require("../clases/seccionBitacora.php");
require("../clases/competencia.php");
require("../clases/item.php");
// require("../clases/alternativaItem.php");
if (isset($_POST["action"] ) ) {
	switch ($_POST["action"]) {
		case 'getNiveles':
			echo getNiveles();
			break;
		case 'getCapitulosByNivel':
			echo getCapitulosByNivel($_POST["idNivel"]);
			break;
		case 'getApartadosByCapitulo':
			echo getApartadosByCapitulo($_POST["idCapitulo"]);
			break;
		case 'getCompetencias':
			echo getCompetencias();
			break;
		case 'guardarItem':
			echo guardarItem($_POST);
			break;
		case 'getAllByIdActividad':
			echo getAllByIdActividad($_POST['idActividad']);
			break;
		case 'removeItem':
			echo removeItem($_POST['idItem']);
			break;
		case 'getItem':
			echo getItem($_POST['idItem']);
			break;
		case 'edit':
			echo edit($_POST);
			break;
	}
}

function getCompetencias() {
	$competencias = new Competencias();
	return json_encode1($competencias->getAll());
}

function getNiveles() {
	$nivel = new Nivel();
	return json_encode1($nivel->getAll());
}

function getCapitulosByNivel($idNivel) {
	$seccionBitacora = new SeccionBitacora();
	return json_encode1($seccionBitacora->getCapitulosByNivel($idNivel));
}

function getApartadosByCapitulo($idCapitulo) {
	$seccionBitacora = new SeccionBitacora();
	return json_encode1($seccionBitacora->getApartadosByCapitulo($idCapitulo));
}

function guardarItem($datos){
	$item = new Item();
	$item->create($datos);
	if ($item->save()) {
		return "Guardado Correcto";
	}else{
		$retorno = array('result' => false, 'errors' => $item->getError());
		return json_encode1($item->getError());
	}
}

function getAllByIdActividad($idActividad){
	$items = new Items();
	return json_encode1($items->getAllByIdActividad($idActividad));
}

function removeItem($idItem){
	$item = new Item();
	return $item->deleteById($idItem);
}

function getItem($idItem){
	$item = new Item();
	return json_encode1($item->getById($idItem));
}

function edit($datos){
	$item = new Item();
	$item->create($datos);
	if ($item->update()) {
		return "Guardado Correcto";
	}else{
		$retorno = array('result' => false, 'errors' => $item->getError());
		return json_encode1($item->getError());
	}
	// return json_encode1($item->getById($idItem));
}


 ?>