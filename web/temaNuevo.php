<?php
require("inc/incluidos.php");
//require ("hd.php");
Conectarse_seg();
$idCategoria = $_REQUEST["categoria"];
?>

<script language="javascript">
$(function() {
$( "#datepicker" ).datepicker();
});


function temaGuarda(){  
	if(val_obligatorio("tituloTema") == false){ return; } // CAMPOS
	if(val_obligatorio("datepicker") == false){ return; }
	if(val_obligatorio("mensajeForo") == false){ return; }
	var division = document.getElementById("nuevoTema");
	var a = $(".campos").fieldSerialize(); 
	AJAXPOST("temaGuarda.php",a,division);  
}
</script>




<br />

<table width="100%" border="0" align="center" class="tablesorter">
    <tr >
        <th>Titulo del Tema</th>
		<th>Fecha de Termino</th>
        </tr>
 
    <tr>
        <td align="center">
			<input type="text" name="tituloTema" id="tituloTema" size="60px" class="campos"/>
			<input type="hidden" name="idCategoria" id="idCategoria" value="<?php echo $idCategoria;?>" class="campos"/>
        </td>
		<td align="center">
			<input type="text" name="fecha_termino" id="datepicker" class="campos" size="10px" value=""/>
		</td>
   </tr>
    
	<tr>
    	<th colspan="3" align="left">Desarrolle el tema: </th>
	</tr>
    
	<tr >
    	<td colspan="3" align="center"><textarea name="mensajeForo" id="mensajeForo" cols="62" rows="8" class="campos"></textarea></td>
    </tr>
    
    <tr>
        <td colspan="3">
	        <?php boton("Crear Tema","temaGuarda()"); ?>
        </td>
    </tr>
</table>

