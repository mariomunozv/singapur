<?php 

$notificaciones = getNotificaciones($_SESSION["sesionIdUsuario"]);


?>

<script type="text/javascript">

var rowVisible = true;

function toggleDisplay(tbl) {
   tbl.style.display="";
   var tblRows = tbl.rows;
   for (i = 0; i < tblRows.length; i++) {
      if (tblRows[i].className != "headerRow") {
         tblRows[i].style.display = (rowVisible) ? "none" : "";
      }
   }
   rowVisible = !rowVisible;
}

</script>

<p class="titulo_curso">Notificaciones <?php echo $_SESSION["sesionNombreUsuario"]; ?></p>
<hr />
<br />
<table id="theTable" border="0" cellspacing="2" class="tablesorter">
<?php
$class = ' class="headerRow"';
// Ejecuta el ciclo solo si hay notificaciones
if ($notificaciones[0]){
	$numNotificaciones = count($notificaciones);
	foreach ($notificaciones as $notificacion){
	
		$nombreImagen = getNombreUsuario($notificacion["idImagenNotificacion"]);
		$texto = str_ireplace("@",$notificacion["idNotificacion"],$notificacion["textoNotificacion"]);
		$link = str_ireplace("@",$notificacion["idNotificacion"],$notificacion["linkNotificacion"]);
		
		
		echo '
		<tr';
		if ($notificacion["estadoNotificacion"] == 0){ // No se ha leido
			echo $class;
		}
		else{ // Ya se leyó
			$numNotificaciones--; 
		}
		echo '>';
		echo '	<td align="center">';
		echo '		<img src="subir/fotos_perfil/th_'.$notificacion["idImagenNotificacion"].'.jpg'.'" border="0">';
		echo ' 	</td>';
		
		echo '	<td>';
		echo 		fechaConFormato($notificacion["fechaNotificacion"])."<br />".$texto;
		echo '		<a href="'.$link.'"> (Ver más...)</a>';
		echo '	</td>';

		echo '</tr>';
	
	}
	
	if ($numNotificaciones == 0){
		echo '	<tr class="headerRow">
					<td align="center"><img src="subir/fotos_perfil/th_'.$_SESSION["sesionIdUsuario"].'.jpg" border="0"></td>
					<td>Por el momento no tienes notificaciones nuevas</td>
				</tr>';		
	}
	
}
else{
	echo '
		<tr class="headerRow">
			<td align="center"><img src="subir/fotos_perfil/th_'.$_SESSION["sesionIdUsuario"].'.jpg" border="0"></td>
			<td>Por el momento no tienes notificaciones nuevas</td>
		</tr>
	';	
}

?>

</table>

<a href="#" onclick="toggleDisplay(document.getElementById('theTable'))">Ver todas las Notificaciones...</a>

