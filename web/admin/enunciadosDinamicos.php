<?php
$cantidad = $_POST["txtCantidad"];
?>

<script language="javascript">

function guardaEnunciado()
{
	if(val_obligatorio("enunciados") == false){ return; }
	var division = document.getElementById("preguntas");
    var a = $(".campos").fieldSerialize();
	AJAXPOST("enunciadoGuardar.php",a,division);
}
</script>

<table class="tablesorter">
<tr>
<th colspan="2">Enunciados</th>
<th>Respuesta</th>
<th>Abierto</th>
<th>Tipo</th>
</tr>



<?php
for($i=0; $i < $cantidad; $i++)
{
	$num = $i+1;
	?>
	<tr>
		<td valign='top'>Enunciado N° <?php echo $num ?></td>
		<td><textarea name='enunciados[]' rows='2' cols='50' id='enunciados' class='campos'></textarea></td>
        <td><input name="respuestaCorrectaEnunciado_<?php echo $i; ?>" type="text" class="campos"/></td>
		<td align='left' valign='top'>
        <select class="campos" id="abiertos_<?php echo $i; ?>" name="abiertos_<?php echo $i; ?>">
          
          <option value="0">Cerrado</option>
          <option value="1">Abierto</option>

        </select>
		<?php
			//print("<input type='radio'  id='tipo' name='abiertos_$i' value='0' class='campos' checked='true'/>Escala de 1 a 4<br>");
			//print("<input type='radio'  id='tipo' name='abiertos_$i' value='2' class='campos' checked='true'/>Escala de N/A a 3<br>");
			//print("<input type='radio' id='tipo' name='abiertos_$i' value='1' class='campos'/>Es abierto<br>");
		?>
		</td>
        <td>
        <select class="campos" id="tipoInputEnunciado_<?php echo $i; ?>" name="tipoInputEnunciado_<?php echo $i; ?>">
          <option value=""></option>
          <option value="hidden_flash">Flash dinamico</option>
          <option value="fraccion">Fraccion</option>
          <option value="mixto">Numero Mixto</option>
          <option value="input_3">Ingreso valor</option>
          <option value="textArea">Texto normal</option>
          <option value="editor">Texto con editor</option>
          <option value="Radio">Radio</option>
		  <option value="Check">Check</option>
        </select>
        </td> 
	</tr>
	<?php
}
?>
<tr>
<td colspan="5" align="right"><input type="button" value="Guardar" name="btnGuardar" id="btnGuardar" onClick="guardaEnunciado()"></td>
<input type="hidden" name="cantidad" value="<?php echo $cantidad ?>" class="campos">
</tr>
</table>
