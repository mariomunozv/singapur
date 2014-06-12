<?php

require("../inc/_funciones.php");

?> 

<script language="javascript">

function cancelar(){
	if(confirm("Cancelar esta operacion?")){ location.href="aspectosDidacticos.php"; }  
}
function save_tarea(){
	if(val_obligatorio("nombreTareaMatematica") == false){ return; }
 	if(confirm("Seguro de insertar tarea?")){

 var division = document.getElementById("lugar_de_carga");
 var a = $(".campos").fieldSerialize();
 AJAXPOST("tareaMatematicaGuarda.php",a,division);
 }
}


</script>

        

<table>
<tr valign="top">
  <td>
	<table class="formulario"> 
		<tbody>
			<!--<tr class="odd">
				<td colspan="2">Los campos con un  (*) son obligatorios.</td> 
			</tr> -->
			<input type="hidden" class="campos" name="modo" id="modo" value="nuevo">  
			
 
			
            <tr>
                <th align="right">Campo</th> 
                <td>
                    <select name="idCampo" id="idCampo" class="campos">
					<?php 
                    $arreglo = getIdNombreTabla("Campo");
                    armaSelect($arreglo,"Campo"); 
                    ?>
                    </select>
                
                </td>
            </tr> 

            <tr>
				<th align="right">Nombre Tarea</th> 
				<td><input type="text" name="nombreTareaMatematica" value="" size="65" class="campos" id="nombreTareaMatematica"></td>
			</tr>
            
		</tbody>
		<tr>
		  <td>
		    <tr>
	      <td>        
	      </table>
  </td>
  
  <td style="vertical-align:top;">
	<a class="button" href="javascript:save_tarea();"><span><div class="save">Insertar</div></span></a><br><br>
	<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div></span></a>
  </td>
</tr>



</table>
	
    
            