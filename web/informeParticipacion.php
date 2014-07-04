<?php 
ini_set("display_errors","OFF");
require("inc/incluidos.php");
require ("hd.php");

function getDatosProfesorParaSeguimiento($idCurso,$idNivel)
{
	$sql = "SELECT c.rbdColegio, c.nombreColegio, p.nombreProfesor, p.apellidoPaternoProfesor, cc.idNivel, cc.letraCursoColegio";
	$sql .= " FROM inscripcionCursoCapacitacion i, usuario u, profesor p, colegio c, cursoColegio cc";
	$sql .= " WHERE i.idUsuario = u.idUsuario";
	$sql .= " AND u.rutProfesor = p.rutProfesor";
	$sql .= " AND u.rutProfesor = cc.rutProfesor";
	$sql .= " AND p.rbdColegio = c.rbdColegio";
	$sql .= " AND cc.anoCursoColegio = YEAR(NOW())";
	$sql .= " AND i.idCursoCapacitacion = ".$idCurso;
	$sql .= " AND cc.idNivel = ".$idNivel;
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while($row = mysql_fetch_array($res))
	{
		$profesores[$i] = array(
			"nombreColegio" => $row["nombreColegio"],
			"nombreProfesor" => $row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"],
			"idNivel" => $row["idNivel"],
			"letraCursoColegio" => $row["letraCursoColegio"],
			"rbdColegio" => $row["rbdColegio"]
						);
		$i++;
	}
	return($profesores);
	
}

/*Trae eL ID de los alumnos de un curso*/
function getTotalAlumnosCursoColegio($rbdColegio,$idNivel,$letraCursoColegio){
	$sql = "SELECT u.idUsuario FROM matricula m, usuario u";
	$sql .= " WHERE m.rbdColegio = ".$rbdColegio;
	$sql .= " AND m.idNivel = ".$idNivel;
	$sql .= " AND m.letraCursoColegio = '".$letraCursoColegio."'";
	$sql .= " AND m.anoCursoColegio = YEAR(NOW()) AND m.rutAlumno = u.rutAlumno";
	//echo $sql."<br>";
	$res = mysql_query($sql);
	$i = 0;
	$alumnos = array();
	while($row = mysql_fetch_row($res))
	{
		$alumnos[$i] = array("idUsuario" => $row[0]);
		$i++;
	}
	return($alumnos);
}

/*Obtiene el porcentaje de logro de un alumno en una prueba*/
function getPorcentajeLogroCurso($idUsuario, $listaItem){
	$sql = "SELECT porcentajeLogroPautaItem FROM pautaItem"; 
	$sql .= " WHERE idUsuario = ".$idUsuario;
	$sql .= " AND idLista = ".$listaItem;
	$sql .= " AND porcentajeLogroPautaItem IS NOT NULL";
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return($row[0]);
}

function accedioRecursoUsuario($idUsuario,$idRecurso){
	$sql = "SELECT COUNT( * ) AS veces FROM accesoRecurso WHERE idUsuario = ".$idUsuario." AND idTipoRecursoObservado = 9 AND idLinkAccesoRecurso = ".$idRecurso;
	//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if ($row["veces"] > 0){
		$entro = $row["veces"];
		}else{
		$entro = "-";
		}
	return($entro);
}

function getParticipantes($rbdColegio,$idNivel,$letraCursoColegio, $idLista)
{
	$sql = "SELECT count(*)";
	$sql .= " FROM pautaItem p, matricula m, usuario u";
	$sql .= " WHERE m.rbdColegio = ".$rbdColegio;
	$sql .= " AND m.idNivel = ".$idNivel;
	$sql .= " AND m.letraCursoColegio = '".$letraCursoColegio."'";
	$sql .= " AND m.anoCursoColegio = YEAR(NOW())";
	$sql .= " AND m.rutAlumno = u.rutAlumno";
	$sql .= " AND p.idUsuario = u.idUsuario";
	$sql .= " AND p.idLista = ".$idLista;
	$sql .= " AND p.porcentajeLogroPautaItem is not null";
	//echo $sql."<br>";
	$res = mysql_query($sql);
	$row = mysql_fetch_row($res);
	return($row[0]);
}

require ("hd.php");
?>

<script>

$(document).ready(function() {
	// call the tablesorter plugin
	$("#orden1").tablesorter({
		// pass the headers argument and assing a object
		headers: {
			0: {sorter: false},
			1: {sorter: false},
			2: {sorter: false},
			3: {sorter: false},
			4: {sorter: false},
			5: {sorter: false},
			6: {sorter: false},
			
			10: {sorter: false},
			11: {sorter: false},
			12: {sorter: false},
			13: {sorter: false},
			14: {sorter: false},
			15: {sorter: false},
			16: {sorter: false},
			17: {sorter: false},
			18: {sorter: false},
			19: {sorter: false},
			20: {sorter: false},
			21: {sorter: false},
			22: {sorter: false},
			23: {sorter: false},
			24: {sorter: false},
			25: {sorter: false},			
			26: {sorter: false},
			27: {sorter: false},
			28: {sorter: false},
			29: {sorter: false},
			
			30: {sorter: false}
		}
	});
});


function actualizaCurso(){
	
	cursoListado(document.getElementById("idCurso").value);
	
} 
function cursoListado(curso){
	
	location.href="informeParticipacion.php?idCurso="+curso;
} 
function volver(){
	
	location.href="home.php";
} 
</script>

<body>

<div id="principal">
<?php require("topMenu.php"); ?>
	
	<!-- <div id="columnaCentro"> -->
	<div id="completo">
	<?php 
	 	$idCurso = @$_REQUEST["idCurso"];
		$cursosCapacitacion = getCursosCapacitacion();
	?>   

    <table class="tablesorter" style="width:250px;margin-left:5px;">
		<tr> 
        	<th>Selecciona curso de capacitacion</th>
		</tr>
        <tr>
        	<td><label><select name="idCurso" id="idCurso" onChange="actualizaCurso()">
                <option value=""><?php echo "Seleccione un Curso";?></option>
                <?php foreach ($cursosCapacitacion as $curso){
					if($curso["idCursoCapacitacion"] != 17){?>
                <option value="<?php echo $curso["idCursoCapacitacion"];?>" <?php if (@$idCurso == $curso["idCursoCapacitacion"]){echo 'selected="selected"';}?>><?php echo $curso["nombreCortoCursoCapacitacion"];?></option>
                <?php }}?>
                </select></label>
			</td>
		</tr>
	</table>
    
	<?php 
	if($idCurso >=10 and $idCurso <=17)
	{



switch($idCurso)
{
	case 10:
	case 11:
		$idLista = array(13,17,21,25);
	break;
	
	case 12:
	case 13:
		$idLista = array(14,18,22,26);
	break;
	
	case 14:
	case 15:
		$idLista = array(15,19,23,27);
	break;
	
	case 16:
		$idLista = array(16,20,24,28);
	break;
}

/*
$idLista = array();
$j = 13;
for($i = 0; $i<=11; $i++)
{
	//echo $i."<br>";
	//echo $j."<br><br>";
	$idLista[$i] = $j;
	$j++;
}
print_r($idLista);
*/	
?>

<table class="tablesorter">
<tr>
<th rowspan="2">Colegio</th>
<th rowspan="2">Profesor</th>
<th rowspan="2">Curso</th>
<?php 
$cuenta = 1;
foreach($idLista as $lista){?>
	<th colspan="2">Prueba <?php echo $cuenta ?></th>
<?php $cuenta++; } ?>
</tr>
<tr>
<?php 
$cuenta = 1;
foreach($idLista as $lista){
	switch($lista)
	{
		case 13:
		case 17:
		case 21:
		case 25:
			$idNivel = 1;
		break;
			
		case 14:
		case 18:
		case 22:
		case 26:
			$idNivel = 2;
		break;
			
		case 15:
		case 19:
		case 23:
		case 27:
			$idNivel = 3;
		break;
			
		case 16:
		case 20:
		case 24:
		case 28:
			$idNivel = 4;
		break;
	}
	$profesores = getDatosProfesorParaSeguimiento($idCurso, $idNivel);
?>



<th>%logro</th>
<th>%particip</th>
<?php $cuenta++; } ?>
</tr>
<?php foreach($profesores as $profe) { ?>
<tr>
	<td><?php echo $profe["nombreColegio"] ?></td>
	<td><?php echo $profe["nombreProfesor"] ?></td>
	<td><?php echo $profe["idNivel"]."".$profe["letraCursoColegio"] ?></td>
    <?php 
	$alumnosCurso = getTotalAlumnosCursoColegio($profe["rbdColegio"],$profe["idNivel"],$profe["letraCursoColegio"]);
	if(count($alumnosCurso) == 0){	echo $profe["rbdColegio"]; }
	foreach($idLista as $lista){
		$participantes = getParticipantes($profe["rbdColegio"],$profe["idNivel"],$profe["letraCursoColegio"],$lista);
		$porcentajeTotal = 0;
		foreach($alumnosCurso as $alumno)
		{
			$porcentaje = getPorcentajeLogroCurso($alumno["idUsuario"], $lista);
			$porcentajeTotal = $porcentajeTotal + $porcentaje;
		}
		$porcentajeTotal = $porcentajeTotal/count($alumnosCurso);
		echo "<td>". round($porcentajeTotal)."%</td>";
		echo "<td>".(round($participantes*100/count($alumnosCurso)))."%</td>";
	}
	?>
</tr>
<?php } ?>
</table>

<?php
}else{
	echo " Debe seleccionar un curso";
	}?>
<?php /////////////////////////////////TEMAS CURSO?>

           
	<?php 
    
    	require("pie.php");

    ?>      
	</div> <!--DiV columna centro -->
</div> <!-- DIV principal -->
</body>
</html>
