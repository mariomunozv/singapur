<?php
ini_set("Display_Errors","On");
//require("inc/_profesor.php");
require("inc/_pauta.php");
require("inc/_formulario.php");
require("hd.php");
require("inc/incluidos.php");
$idFormulario = $_REQUEST['formulario'];

function getDatosEncuesta($idFomulario)
{
	$sql = "SELECT r.idUsuario, COUNT( r.idEnunciado ) AS total, c.nombrecolegio";
	$sql .= " FROM respuesta r, colegio c, usuario u";
	$sql .= " WHERE r.idFormulario =".$idFomulario;
	$sql .= " AND r.idUsuario = u.idUsuario";
	$sql .= " AND u.loginUsuario = c.rbdColegio";
	$sql .= " GROUP BY r.idUsuario ";
	echo $sql;
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$colegios[$i] = array( "nombrecolegio" => $row["nombrecolegio"],
						   "total" => $row["total"]
						);	
	$i++;
	}
	if ($i==0){
		return(NULL);
	}
	//print_r($idListas);
	return($colegios);

}

if($idFormulario == 26)
{
	$datos = getProfesoresParticipante();
}

$form = getDatosFormulario($idFormulario);


switch($idFormulario)
{
	case 26: // Cuestionario Módulo 6to 2
	?>

	<table border="1" class="tablesorter" align="left">
		<tr>
        	<th colspan="3"><?php echo $form["descripcionFormulario"] ?></th>
		</tr>
        <tr>
        	<th>Colegio</th>
            <th>Profesor</th>
            <th>Estado</th>
        </tr>
		<?php foreach($datos as $dato) {
			if($idFormulario == 26){ ?>
		<tr>
			<td align="left"><?php echo $dato['nombreColegio'];?></td>
            <td align="left"><?php echo $dato['nombreProfesor']." ".$dato['apellidoPaternoProfesor']." ".$dato['apellidoMaternoProfesor'];?></td>
            <?php if(existePauta($dato["idUsuario"], $idFormulario)){
            	echo "<td bgcolor='#0f0'>Contest&oacute;</td>";
			}else {
				echo "<td>No Contest&oacute;</td>"; }?>
		</tr>
		<?php }} ?>
	</table>
    <?php break;
	
	
	default:
		echo "Sin Informaci&oacute;n";
	break;
	 
}