<?php
ini_set('display_errors', true);

require '../admin/inc/jsonwrapper_inner.php';
require '../db/pdo.php';
require '../models/PautaItem.php';

$dbOperation = $_POST["operacion"];
$idLista = $_POST["idLista"];
$fecha = $_POST["fecha"];

$alumnosJSON = $_POST["alumnos"];
$alumnos =  json_decode1($alumnosJSON);
foreach ($alumnos as $alumno) {
    $pautaItem = new PautaItem();
    $pautaItem->idLista = $idLista;
    $pautaItem->fechaRespuestaPautaItem = $fecha;
    $pautaItem->idUsuario = $alumno->id;
    $pautaItem->asistio = $alumno->asistio;
    $pautaItem->fechaConfirmada = 1;

    if ($dbOperation == 'update') {
        $pautaItem->updateAsistencia();
    } else {
        $pautaItem->insertPautaItem();
    }
}

?>
