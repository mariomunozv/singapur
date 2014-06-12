<?php
ini_set('display_errors','On');
require("inc/incluidos.php");
require("hd.php");
//include "inc/funciones.php";
include "inc/_pauta.php";


$idFormulario = $_SESSION["idFormulario"];
$idUsuario = $_SESSION["sesionIdUsuario"];

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


$frm = getNombreFormulario($idFormulario);
if(!existePauta($idUsuario, $idFormulario))
{
?>

<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<style>
p
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:12px;
}

.margenTabla
{
	padding-left:2em;
	padding-right:2em;
}
a
{
	font-size:36px;
}
</style>
<form name="frmInicio" id="frmInicio" action="cuestionarioEvaluacion.php" method="post">
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
			        <input type="hidden" name="idFormulario" id="idFormulario" value="<?php echo $idFormulario ?>"/>
					<p align="center"><input type="submit" value="Comenzar"/></p>
                </tr>
				<tr>
					<td>
					</td>
				</tr>
              </table>
              </td>
            </tr> 
</table>
<?php } else {?>
<table width="100%">
	<tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
	</tr>
    <tr>
        <td>&nbsp;</td>
        <td><span class="style4">Usted ya contestó la encuesta<br/><br/></td>
	</tr>
	<tr>
        <td>&nbsp;</td>
		<td><input type="button" name="volver" id="volver" value="volver" onClick="location.href='home.php'"/></td>
	</tr>
	<tr><td><br/><br/><br/><br/></td></tr>
</table>
<?php } ?>
