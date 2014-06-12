<?php
require("inc/config.php");
require("../inc/_funciones.php");

$idProyectoKlein = $_REQUEST["idProyectoKlein"];
$nombreCortoCursoCapacitacion = $_REQUEST["nombreCortoCursoCapacitacion"];
@$nombreCursoCapacitacion = $_REQUEST["nombreCursoCapacitacion"];
$estadoCursoCapacitacion = $_REQUEST["estadoCursoCapacitacion"];
$descripcionCursoCapacitacion = $_REQUEST["descripcionCursoCapacitacion"];


guardarCursoCapacitacion($idProyectoKlein, $nombreCortoCursoCapacitacion, $nombreCursoCapacitacion, $descripcionCursoCapacitacion, $estadoCursoCapacitacion);
	
?>
    
<script language="javascript">
	usuariosListado();
</script>   



<?php 

function guardarCursoCapacitacion($idProyectoKlein, $nombreCortoCursoCapacitacion, $nombreCursoCapacitacion, $descripcionCursoCapacitacion,$estadoCursoCapacitacion){
	$sql = "INSERT INTO cursoCapacitacion ( idProyectoKlein , nombreCortoCursoCapacitacion , nombreCursoCapacitacion, descripcionCursoCapacitacion , estadoCursoCapacitacion)";
	$sql.=" VALUES ( ";
    $sql.=" $idProyectoKlein, '$nombreCortoCursoCapacitacion', '$nombreCursoCapacitacion', '$descripcionCursoCapacitacion', $estadoCursoCapacitacion";
    $sql.=")";
	//echo $sql;
	$res = mysql_query($sql);
	if (!$res) {
    	info('Error en la consulta SQL: <br><b>'.$sql.'</b><br>'. mysql_error());
	}else{
		info('El curso ha sido creado.');
		$idCursoCapacitacion = mysql_insert_id();
		return ($idCursoCapacitacion);
	}
}

?>