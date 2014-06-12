<?php
ini_set('display_errors','On');
require("inc/config.php");
require("inc/funcionesAdmin.php");



$rbdColegio = $_REQUEST["rbdColegio"];
$profesores = getProfesoresColegio($rbdColegio);
$niveles = getNiveles();

	
?> 

<script language="javascript">

function cancelar(){
	if(confirm("Cancelar esta operación?")){ location.href="escuelaDetalle.php?rbdColegio=<?php echo $rbdColegio;?>"; }  
}
function save_curso(){
	
	 if(val_obligatorio("rbdColegio") == false){ return; } // CAMPOS
	 if(val_obligatorio("idNivel") == false){ return; }
	  if(val_obligatorio("letraCursoColegio") == false){ return; }
	 if(val_obligatorio("anoCursoColegio") == false){ return; }
	 if(val_obligatorio("rutProfesor") == false){ return; }
	 if(val_obligatorio("estadoCursoColegio") == false){ return; }
	
		  	
 	if(confirm("¿Seguro de guardar este curso?")){

 var division = document.getElementById("lugar_de_cargaCurso");
 var a = $(".campos").fieldSerialize();
 
 AJAXPOST("cursoGuarda.php",a,division);
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
				<th align="right">Colegio</th> 
				<td><input type="text" name="rbdColegio" size="70" value="<?php echo $rbdColegio;?>" class="campos" id="rbdColegio">
				</td>
			</tr>   
             <tr>
				<th align="right">Nivel</th> 
				<td><select class="campos" id="idNivel" name="idNivel">
                <?php foreach ($niveles as $nivel){ ?> 
				<option value="<?php echo $nivel["idNivel"];?>"><?php echo $nivel["nombreNivel"];?></option>
				
				<?php }?>
				</select></td>
			</tr>   
            <tr>
				<th align="right">Letra(*)</th> 
				<td><input type="text" name="letraCursoColegio" size="70" value="" class="campos" id="letraCursoColegio"></td>
			</tr> 
            
			<tr>
				<th align="right">Año(*)</th> 
				<td><input type="text" name="anoCursoColegio" size="70" value="" class="campos" id="anoCursoColegio"></td>
			</tr> 
           
		<tr>
				<th align="right">Profesor</th> 
				<td><select class="campos" id="rutProfesor" name="rutProfesor">
                <?php foreach ($profesores as $profesor){ ?> 
				<option value="<?php echo $profesor["rutProfesor"];?>"><?php echo $profesor["nombreProfesor"]." ".$profesor["apellidoPaternoProfesor"];?></option>
				
				<?php }?>
				</select></td>
			</tr>  
             
			<tr>
				<th align="right">Estado</th>  
				<td><select name="estadoCursoColegio" id="estadoCursoColegio" class="campos"><option value="1">Activo</option><option value="0" >Desactivado</option></select></td> 
			</tr>   
		</tbody>
		<tr>
		  <td>
		    <tr>
	      <td>        
	      </table>
  </td>
  <td style="vertical-align:top;">
	<a class="button" href="javascript:save_curso();"><span><div class="save">Grabar</div></span></a><br><br>
	<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div></span></a>
  </td>
</tr>
</table>
	
    
            