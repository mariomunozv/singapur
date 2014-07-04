<?php
ini_set("display_errors","On");
//include "inc/conectav10.php";
//include "inc/funciones.php";
require("inc/incluidos.php"); 

$rutUsuario = $_SESSION["sesionRutUsuario"];
$idUsuario = $_SESSION["sesionIdUsuario"];
$idFormulario = $_SESSION["idFormulario"];
$usuario = getDatosUsuarioPorId($idUsuario);
//print_r($usuario);

function getNombreFormulario($idFormulario)
{
	$sql = "SELECT * FROM formulario where idFormulario = ".$idFormulario;
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$datos[$i] = array(
			"nombreFormulario"=> $row["nombreFormulario"],
			"descripcionFormulario" => $row["descripcionFormulario"]
			);
		$i++;
	}
	return($datos);
}

function getDatosInicialesEncuesta($rutUsuario)
{	
	$sql = "SELECT c.nombreColegio, p.nombreProfesor, p.apellidoPaternoProfesor, p.apellidoMaternoProfesor, p.rbdColegio, cu.nombreCortoCursoCapacitacion"; 
	$sql .= " FROM profesor p, usuario u, colegio c, inscripcionCursoCapacitacion i, cursoCapacitacion cu";	
	$sql .= " WHERE u.rutProfesor = p.rutProfesor";
	$sql .= " AND p.rbdColegio = c.rbdColegio";
	$sql .= " AND u.rutProfesor = '".$rutUsuario."'";
	$sql .= " AND i.idUsuario = u.idUsuario";
	$sql .= " AND i.idCursoCapacitacion = cu.idCursoCapacitacion";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$datos[$i] = array(
			"nombreColegio"=> $row["nombreColegio"],
			"rbdColegio"=> $row["rbdColegio"],
			"nombreProfesor" => $row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"] ,
			"nombreCortoCursoCapacitacion" => $row["nombreCortoCursoCapacitacion"]
			);
		$i++;
	}
	return($datos[0]);
}

function getNombreColegio($rbd)
{
	$sql = "SELECT nombreColegio FROM colegio WHERE rbdColegio = ".$rbd;
	//echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)) {
		$datos[$i] = array(
			"nombreColegio"=> $row["nombreColegio"]
			);
		$i++;
	}
	return($datos);
}


$frm = getNombreFormulario($idFormulario);
$datosIniciales = getDatosInicialesEncuesta($usuario['rut']);
$colegio = getNombreColegio($usuario['rbdColegio']);
?>
<script language="javascript">

	function valida()
	{
		if(document.form.colegio.value == "")
		{
			alert("Falta el nombre del colegio");
			document.form.colegio.focus();
		}
		else if(document.form.curso.value == "")
		{
			alert("Falta el nombre del curso");	
			document.form.curso.focus();
		}
		else if(document.form.relator.value == "")
		{
			alert("Debe seleccionar un relator");	
			document.form.relator.focus();
		}
		else if(document.form.xp.value == "")
		{
			alert("Mencione años de experiencia.");	
			document.form.relator.focus();
		}
		else if(document.form.nombre.value == "")
		{
			alert("Error #03478 comuníquese con el encargado");	
		}
		else
		{
			document.form.action = "guardaDatosIncialesEncuesta.php";
			document.form.submit();
		}
	}
		
</script>
<table border="0" cellpadding="2" cellspacing="6" bgcolor="#FFFFFF" width="600">
	<tr>
		<td colspan="2" align="center" valign="top">
			<p class="style4">
				<?php
				  echo $frm[0]['nombreFormulario'];
				?>
			<br/></p><hr color="#339900"/>
            	<?php
				  echo "<h3 style='color:'>".$frm[0]['descripcionFormulario']."</h3>";
				?>
            
		</td>
	</tr>
    <tr>
		<td width="412" align="left" valign="top" bgcolor="#B9CAAC">
			<table width="78%" align="center" border="0" cellpadding="4" cellspacing="4">
            	<tr>
                	<td class="style10">Colegio:</td>
					<td class="style10">
                    	<input type="text" name="colegio" id="colegio" size="30" value="<?php echo $datosIniciales['nombreColegio'] ?>" readonly="true"/>
                  	</td>
              	</tr>
                <tr>
                	<td class="style10">Curso:</td>
                  	<td class="style10" colspan="2">
                  		<input type="text" name="curso" id="curso" size="30" value="<?php echo $datosIniciales['nombreCortoCursoCapacitacion']?>" readonly="true"/>
                  		<input type="hidden" name="nombre" id="nombre" value="<?php echo $datosIniciales['nombreProfesor']?>"/>
                  	</td>
                </tr>
                <tr>
                  	<td class="style10">Relator:</td>
                  	<td class="style10" colspan="2">
                    	<select id="relator" name="relator">
                            <option value="">Seleccione relator</option>
                            <option value="Antonio">Antonio Cofré</option>
                            <option value="Lorena">Lorena Inostroza</option>                        
                            <option value="Enrique">Enrique González</option>                        
                            <option value="Dinko">Dinko Mitrovich</option>
                            <option value="Paula">Paula Olguín</option>
                            <option value="Roxana">Roxana Rosales</option>
                            <option value="Natalia">Natalia Solís</option>
                        </select>
                  	</td>
                </tr>
				<tr>
					<td class="style10">Años que lleva aplicando el método singapur: </td>
					<td class="style10">
                  		<input type="text" required="required" name="xp" id="xp" size="30"/>
					</td>
				</tr>
				<tr>
                <td colspan="2" align="justify"><p><i>El siguiente instrumento se ha diseñado con la finalidad de recoger su opinión y apreciación 
                sobre la formación recibida por parte del equipo ejecutor del proyecto en los talleres de capacitación 
                durante el primer semestre del presente año. Solicitamos responder las preguntas que aparecen a 
                continuación y entregar las sugerencias que estime necesarias para mejorar los procesos de planificación 
                en los talleres de capacitación del segundo semestre.</i></p></td>
                </tr>
				<tr>
				<td colspan="2" align="justify">
					<b>Instrucciones:</b>
                    <ul>
                        <li>El cuestionario consta de 3 secciones: i) de los talleres de capacitación, ii) de la implementación del 
                        MS en el aula y iii) de la plataforma virtual. Cada una de estas secciones contiene respuestas cerradas y 
                        respuestas abiertas.</li>
						<li>Para las preguntas de respuesta cerrada, utilice la escala: <b>1=muy en desacuerdo, 2=en desacuerdo, 3=de 
                        acuerdo, 4=muy de acuerdo.</b></li> 
                        <li>En caso que frente a un indicador no tenga información para realizar la evaluación, deje en blanco los 
                        tramos de la escala correspondiente. También este instrumento contiene algunas preguntas abiertas de respuesta 
                        corta, utilice el espacio correspondiente para registrar su opinión.</li>
                    </ul>
				</td>
				</tr>
                <tr>
                  <td class="style10" colspan="2" align="center">
  				  	<input type="hidden" name="tipoCuestionario" id="tipoCuestionario" value="docente"/>
				  	<input name="Entrar" type="button" class="style10" id="Entrar" value="Comenzar" onclick="valida();"/></td>
                </tr>
				<tr>
					<td>
					</td>
				</tr>
              </table>
              </td>
            </tr> 
</table>
<br/>