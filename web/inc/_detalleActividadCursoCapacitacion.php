<?php 

function asignaActividadCurso( $idCursoCapacitacion, $idActividad){
	$sql_ = "INSERT INTO detalleActividadCursoCapacitacion ( idCursoCapacitacion , idActividad ";
	$sql_.=" ) VALUES ( ";
    $sql_.=" $idCursoCapacitacion, $idActividad ";
    $sql_.=" )";
	 $res = mysql_query($sql_);
	//echo $sql_;
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql_.'</b><br>'. mysql_error());
	}else{
		echo "<br>Se ha asignado la actividad al curso ";
		}
}

?>