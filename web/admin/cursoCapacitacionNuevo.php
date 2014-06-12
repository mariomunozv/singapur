<?php

require("inc/config.php");

// borrar cuando se llame desde la pagina principal
require("_head.php"); 
	
?> 

<script language="javascript">

function cancelar(){
	if(confirm("Cancelar esta operacion?")){ location.href="cursosCapacitacion.php"; }  
}
function save_cursoCapacitacion(){
	
	if(val_obligatorio("idProyectoKlein") == false){ return; } // CAMPOS
	if(val_obligatorio("nombreCortoCursoCapacitacion") == false){ return; }
	
	if(confirm("Seguro de guardar este curso?")){

		var division = document.getElementById("curso_nuevo");
		var a = $(".campos").fieldSerialize();
		AJAXPOST("cursoCapacitacionGuarda.php",a,division);
	}
} 
</script>

      

<table>
<tr valign="top">
  <td>
	<table class="formulario"> 
		<tbody>
			<tr class="odd">
				<td colspan="2">Los campos con un  (*) son obligatorios.</td> 
			</tr> 
			<input type="hidden" class="campos" name="modo" id="modo" value="nuevo">  

             <tr>
				<th align="right">Proyecto(*)</th> 
				<td>
                	<select class="campos" id="idProyectoKlein" name="idProyectoKlein">
                    	<option value="1">MIE - Matematic</option>
					</select>
                </td>
			</tr>   
            <tr>
				<th align="right">Nombre Corto(*)</th> 
				<td><input type="text" name="nombreCortoCursoCapacitacion" size="70" value="" class="campos" id="nombreCortoCursoCapacitacion"></td>
			</tr> 
            
			<tr>
				<th align="right">Nombre Largo</th> 
				<td><input type="text" name="nombreCursoCapacitacion" size="70" value="" class="campos" id="nombreCursoCapacitacion"></td>
			</tr> 
             
			<tr>
				<th align="right">Estado</th>  
				<td>
                	<select name="estadoCursoCapacitacion" id="estadoCursoCapacitacion" class="campos">
                		<option selected="selected" value="1">Activado</option>
                        <option value="0" >Desactivado</option>
					</select>
				</td> 
			</tr>   
		</tbody>
		<tr>
		  <td>
		    <tr>
	      <td>        
	      </table>
  </td>
  <td style="vertical-align:top;">
	<a class="button" href="javascript:save_cursoCapacitacion();"><span><div class="save">Grabar</div></span></a><br><br>
	<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div></span></a>
  </td>
</tr>
</table>
	
    
            