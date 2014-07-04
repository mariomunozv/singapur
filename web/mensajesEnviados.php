<?php

require("inc/incluidos.php");

/* Registra Acceso a mis mensajes */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 3, 'NULL');
$idPerfil = getIdPerfilUsuario($idUsuario);
?>
<h3>Mensajes Enviados</h3>
<table width="100%" border="0" cellspacing="2" class="tablesorter">
	
	<tr class="ui-state-active" >
		<th>&nbsp;</th>
		<?php
	   if($idPerfil == 3){
	   ?>
       	<th>&nbsp;De</th>
		<?php
	   }
	   ?>
	   	<th>&nbsp;Para</th>
		<th>&nbsp;Asunto</th>
		<th>&nbsp;Fecha</th>
	</tr>
	
	
	<?php
	// Si el usuario tiene perfil de coordinador grl (idPefil=9) 
	
		$res = getMensajesEnviadosUsuario($idUsuario); 
	
	
	
	
	if (mysql_num_rows($res) > 0 ){
		while($row = mysql_fetch_array($res)){
			switch(getTipoUsuario($row["deMensaje"])){
				case "Empleado Klein":
				$datosDeUsuario = getNombreFotoUsuarioEmpleadoKlein($row["deMensaje"]);
				break;
				case "Profesor":
				$datosDeUsuario = getNombreFotoUsuarioProfesor($row["deMensaje"]);
				break;
				
				}
			switch(getTipoUsuario($row["paraMensaje"])){
				case "Empleado Klein":
				$datosParaUsuario = getNombreFotoUsuarioEmpleadoKlein($row["deMensaje"]);
				break;
				case "Profesor":
				$datosParaUsuario = getNombreFotoUsuarioProfesor($row["paraMensaje"]);
				break;
				
				}
			
			if ($row["estadoMensaje"] == 0){
				$estilo = "style8";
			}
			else{
				$estilo = "style6";	
			}
	
	?>
	<tr class="<?php echo $estilo;?>">
		<td align="center">
			<img src="<?php echo "subir/fotos_perfil/th_".$datosDeUsuario["imagenUsuario"];?>" />
		</td>
		<?php
		if($idPerfil == 9){
		?>
        <td>
			<?php
			$texto_de = $datosDeUsuario["nombre"];
			$texto_de = $texto_de." ".$datosDeUsuario["apellidoPaterno"];
			$texto_de = $texto_de." ".$datosDeUsuario["apellidoMaterno"];
			echo $texto_de;
			?> 
		</td>
		<?php
		}
		?>
		<td>
			<?php
			$texto_para = $datosParaUsuario["nombre"];
			$texto_para = $texto_para." ".$datosParaUsuario["apellidoPaterno"];
			$texto_para = $texto_para." ".$datosParaUsuario["apellidoMaterno"];
			echo $texto_para; 
			?> 
		</td>
		
		<td>
			<a href="mensaje.php?idMensaje=<?php echo $row["idMensaje"];?>">
			<?php echo $row["asuntoMensaje"]; ?></a>
		</td>
		<td>
			<?php cambiaf_a_normal($row["fechaMensaje"]); ?>
		</td>
	</tr>
	
<?php 
		}// while
	
	}
	else{ //mysql_num_rows < 0
?>
		
	<tr class="style6">
		<td colspan="5">Usted no tiene mensajes en su bandeja.</td>
	</tr>			
<?php
	}
	 
	 ?>
	 
</table>