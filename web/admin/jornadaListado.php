<?php
require("inc/config.php");

$visible = $_REQUEST["visible"];
$jornada = $_REQUEST["idJornada"];

function visibleJornada($idJornada, $visible)
{
	$sql = "UPDATE jornada ";
	if($visible == 1) {	
	$sql .= " SET visibleJornada = 0";
	} else {
	$sql .= " SET visibleJornada = 1";
	}
	$sql .= " WHERE idJornada = $idJornada";
	//echo $sql;
	mysql_query($sql);
	$filas = mysql_affected_rows();
	if($filas > 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}

if(isset($visible))
{
	if(visibleJornada($jornada, $visible))
	{
		echo "jornada actualizada";
	}
	else
	{
		echo "no se pudo actualizar la jornada";
	}
}



/** Función que trae todos los cursos activos, que tengan una jornada asignada **/
function getCursosConJornadas()
{
$sql = "SELECT Distinct(c.idCursoCapacitacion),nombreCortoCursoCapacitacion";
$sql .= " FROM jornada j, cursoCapacitacion c";
$sql .= " WHERE j.idCursoCapacitacion = c.idCursoCapacitacion";
$sql .= " AND c.estadoCursoCapacitacion = 1";
//echo $sql;
$res = mysql_query($sql);
$i=0;
while ($row = mysql_fetch_array($res)){
	$cursos[$i] = array( 
		"idCursoCapacitacion" => $row["idCursoCapacitacion"],
		"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"]
		);	
	$i++;
}

return($cursos);
}

$cursosConJornada = getCursosConJornadas();
?>

<script language="javascript">
function lista_jornadas(){
	var division = document.getElementById("listaJornadas");
	AJAXPOST("jornadaListar.php","",division);
}

function lista_jornada_Curso(idCursoCapacitacion){
	var division = document.getElementById("listaJornadas");
	a = "idCursoCapacitacion="+idCursoCapacitacion;
	AJAXPOST("jornadaListar.php",a,division);
}
</script>


<table>
<tr>
	<td>Filtro por curso: </td>
	<td>
	<select name="curso" id="curso" onChange="javascript:lista_jornada_Curso(this.value)">
   	<option value="">Seleccione un curso</option>
	<option value="">Todos los Cursos</option>
	<?php
	foreach($cursosConJornada as $curso) 
	{
		echo "<option value=".$curso["idCursoCapacitacion"].">".$curso["nombreCortoCursoCapacitacion"]."</option>";
	}
	?>
	</td>
	</select>
</tr>
</table>


<div id="listaJornadas"></div>
<script language="javascript">lista_jornadas()</script>



