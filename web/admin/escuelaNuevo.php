<?php

require("inc/config.php");
//require "inc/funcionesAdmin.php";




function getComunas(){
	$sql = "SELECT * FROM comuna ORDER BY nombreComuna ASC";
	$res = mysql_query($sql);
	$i = 0;
	while ($row = mysql_fetch_array($res)){
	$comunas[$i]= array( "idComuna" =>$row["idComuna"],
					  "nombreComuna" => $row["nombreComuna"]);	
	$i++;
	}
	return($comunas);
	
	}	
	
$comunas = getComunas();	
?> 

<script language="javascript">

function guardar(){
	if(val_obligatorio("nombre") == false){ return; }  
	if(confirm("Guardar este registro?")){
		document.form1.submit();
	}  
}
function cancelar(){
	if(confirm("Cancelar esta operación?")){ location.href="inicio.php"; }  
}
function save_escuela(){
	 if(val_obligatorio("rbdColegio") == false){ return; } // CAMPOS
	 if(val_obligatorio("nombreColegio") == false){ return; }
	 if(val_obligatorio("direccionColegio") == false){ return; }
	 if(val_obligatorio("idComuna") == false){ return; }
	 if(val_obligatorio("telefonoColegio") == false){ return; }
	 if(val_obligatorio("emailColegio") == false){ return; }
	 if(val_obligatorio("paginaWebColegio") == false){ return; }
	 if(val_obligatorio("matriculaColegio") == false){ return; }
	 if(val_obligatorio("estadoColegio") == false){ return; }
		  	
 	if(confirm("¿Seguro de guardar esta escuela?")){

 var division = document.getElementById("lugar_de_carga");
 var a = $(".campos").fieldSerialize();
 AJAXPOST("escuelaGuarda.php",a,division);
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
				<th align="right">RBD(*)</th> 
				<td><input type="text" name="rbdColegio" size="70" value="" class="campos" id="rbdColegio"></td>
			</tr>    
			<tr>
				<th align="right">Nombre(*)</th> 
				<td><input type="text" name="nombreColegio" size="70" value="" class="campos" id="nombreColegio"></td>
			</tr>  
			<tr>
				<th align="right">Direccion(*)</th> 
				<td><input type="text" name="direccionColegio" size="70" value="" class="campos" id="direccionColegio"></td>
			</tr> 
            <tr>
				<th align="right">Comuna</th> 
				<td><select class="campos" id="idComuna" name="idComuna">
                <?php foreach ($comunas as $comuna){ ?> 
				<option value="<?php echo $comuna["idComuna"];?>"><?php echo $comuna["nombreComuna"];?></option>
				
				<?php }?>
				</select></td>
			</tr>   
			<tr>
				<th align="right">Telefono </th> 
				<td><input type="text" name="telefonoColegio" size="10" value="" class="campos" id="telefonoColegio"></td>
			</tr> 
            <tr>
				<th align="right">Email </th> 
				<td><input type="text" name="emailColegio" size="30" value="" class="campos" id="emailColegio"></td>
			</tr> 
             <tr>
				<th align="right">Sitio Web </th> 
				<td><input type="text" name="paginaWebColegio" size="30" value="" class="campos" id="paginaWebColegio"></td>
			</tr>  
              <tr>
				<th align="right">Matricula</th> 
				<td><input type="text" name="matriculaColegio" size="30" value="" class="campos" id="matriculaColegio"></td>
			</tr>      
			<tr>
				<th align="right">Estado</th>  
				<td><select name="estadColegioo" id="estadoColegio" class="campos"><option value="1">Activo</option><option value="0" >Desactivado</option></select></td> 
			</tr>   
		</tbody>
		<tr>
		  <td>
		    <tr>
	      <td>        
	      </table>
  </td>
  <td style="vertical-align:top;">
	<a class="button" href="javascript:save_escuela();"><span><div class="save">Grabar</div></span></a><br><br>
	<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div></span></a>
  </td>
</tr>
</table>
	
    
            