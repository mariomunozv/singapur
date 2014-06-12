<?php
session_start();
//include "inc/conecta.php";
require("inc/incluidos.php");
//include "inc/funciones.php";
//include "sesion/sesion.php";
$idUsuario = $_SESSION["sesionIdUsuario"];
$nombre =  $_SESSION["sesionNombreUsuario"];
?>
<script language="javascript">

$(function() {
		   
	$("#tabla").tablesorter({ 
		headers: {  
			4: { sorter: false }
			 // Esto es para inabilitar el filtro en una columna
		},
	});  
}); 



</script>

<?php

echo("Agrega destinatarios haciendo clic en los íconos de la derecha.");
?>
<table id="tabla" class="tablesorter">

    <tr class="ui-state-active" align="center">
        <th width="90">N&deg;</th>
        <th width="470">Participante</th>
        <th width="287">Rol </th>
        <th width="255">Enviar mensaje</th>
    </tr>
  

	<?php 
    $alumnosCurso = getAlumnosCurso($_SESSION["sesionIdCurso"]);
	
    
    ordenar($alumnosCurso,array("idPerfil"=>"DESC","apellidoPaterno"=>"ASC"));
    
    $_SESSION["alumnosCurso"] = $alumnosCurso;
                
    //print_r($alumnosCurso);
    $color = ' bgcolor ="#FFFFFF"';
    $flag = 0;
    $num = 0;
    
    
    foreach ($alumnosCurso as $i => $value) { 
		$num = $num+1;
		if ($flag == 0){
			$flag = 1;
			$color = "";
		}
		else{
			$flag = 0;
			$color = ' bgcolor ="#FFFFFF"';
		}

		?>
		<tr <?php echo $color;?>>
			<td valign="center">
				<?php echo $num;?>
			</td>
		<?php
		// Si no existen alumnos
		if(empty($alumnosCurso[0])){
			echo '<td colspan="6">No hay alumnos inscritos en el curso</td>';
		}
		else{
			?>
			<td valign="center">
				<div align="left">
					<strong><?php echo $value["nombreCompleto"]; ?></strong>
				</div>
			</td>
			
			<td valign="center">
				<div align="center">
					<?php echo getNombrePerfil($value["idPerfil"]); ?>
				</div>
			</td>
			
			<td>
				<div align="center">
					<img src="img/mail.png" width="16" height="16" style="cursor:pointer" 
					onclick="nuevoMensaje(<?php echo $value["idUsuario"];?>)" title="Agregar Destinatario"/>
				</div>
			</td>
			
			
		</tr>
		
	<?php 	
		} // else (existen alumnos)
		
	} //foreach


	?>
       
</table>
