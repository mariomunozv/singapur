<?php

require("inc/config.php");

// borrar cuando se llame desde la pagina principal
require("_head.php"); 
	
?> 

<?php
require("../inc/_evaluacion.php");
require("../inc/_nivel.php");
?>


<script language="javascript">
function cancelar(){
	if(confirm("Cancelar esta operación?")){ location.href="evaluaciones.php"; }  
}

function cambio_nuevo_grupo(){
	if ($('#checkNuevo').is(":checked")){
		$('#viejo_nombre').css("display", "none");
		$('#nuevo_nombre').css("display", "");
	}else{
		$('#viejo_nombre').css("display", "");
		$('#nuevo_nombre').css("display", "none");
	}
}

</script>      
<form action="evaluacionGuarda.php" method="POST" enctype="multipart/form-data">
<table>
<tr valign="top">
  <td>
	<table class="formulario"> 
		<tbody>
			<tr class="odd">
				<td colspan="2">Los campos con un  (*) son obligatorios.</td> 
			</tr> 
			<tr>
				<th align="right">Grupo(*)</th> 
				<td id="viejo_nombre">
                	<select class="campos" id="idGrupoEvaluacion" name="idGrupoEvaluacion">
                		<?php $grupos = getGruposEvaluaciones(); 
                			  foreach ($grupos as $grupo) {
                			   	echo "<option value='".$grupo['idGrupoEvaluacion']."'>".$grupo['nombreGrupoEvaluacion']."</option>";
                			   } ?>
					</select>
                </td>
                <td id="nuevo_nombre" style="display:none;"><input class="campos"  name="nombreNuevoGrupo" type="text"></td>
                <td><input class="campos" name="check_nuevo" type="checkbox" id="checkNuevo" onchange="cambio_nuevo_grupo()"> Nuevo Grupo </td>
			</tr>
			<tr>
				<th align="right">Nivel(*)</th> 
				<td>
                	<select class="campos" id="idNivel" name="idNivel">
                		<?php $niveles = getNiveles(); 
                			  foreach ($niveles as $nivel) {
                			   	echo "<option value='".$nivel['idNivel']."'>".$nivel['nombreNivel']."</option>";
                			   } ?>
					</select>
                </td>
			</tr>
            

			<tr>
				<th align="right">A&ntilde;o(*)</th> 
				<td><input type="number" name="anoEvaluacion" value="2014" class="campos" id="anoEvaluacion"></td>
			</tr>
			<tr>
				<th align="right">Nombre(*)</th> 
				<td><input type="text" name="nombreEvaluacion" value="" class="campos" id="nombreEvaluacion"></td>
			</tr>  
			<tr>
				<th align="right">URL(*)</th> 
				<td><input name="urlEvaluacion" id="urlEvaluacion" type="file" class="campos"></td>
			</tr>  
			<tr>
				<th align="right">Estado(*)</th> 
				<td>
					<select name="estadoEvaluacion" class="campos">
						<option value="1">Activo</option>
						<option value="0">Inactivo</option>
					</select>
				</td>
			</tr>  
			<tr>
				<th align="right">Tipo(*)</th> 
				<td>
					<select name="tipoEvaluacion" class="campos">
						<option value="Prueba">Prueba</option>
						<option value="Pauta">Pauta</option>
						<option value="Protocolo">Protocolo</option>
					</select>
				</td>
			</tr>  
		</tbody>
		<tr>
			<th></th>
			<td style="vertical-align:top;">
			  	<br />
				<input name="Enviar" type="submit" value="Guardar"/>
				<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div></span></a>
			</td>
		</tr>		

</tr>
</table>
</form>	
    
            