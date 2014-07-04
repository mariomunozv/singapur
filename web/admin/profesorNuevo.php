<?php

require("inc/config.php");
//require "inc/funcionesAdmin.php";

$rbdColegio = $_REQUEST["rbdColegio"];


	
?> 
<script type="text/javascript" src="js/valida-rut-js/validarut.js"></script>

<script language="javascript">
function Valida_Rut( Objeto ) 
{
	var tmpstr = "";
	var intlargo = Objeto.value
	if (intlargo.length> 0)
	{
		crut = Objeto.value
		largo = crut.length;
		if ( largo <2 )
		{
			alert('rut inválido')
			Objeto.focus()
			return false;
		}
		for ( i=0; i <crut.length ; i++ )
		if ( crut.charAt(i) != ' ' && crut.charAt(i) != '.' && crut.charAt(i) != '-' )
		{
			tmpstr = tmpstr + crut.charAt(i);
		}
		rut = tmpstr;
		crut=tmpstr;
		largo = crut.length;
	
		if ( largo> 2 )
			rut = crut.substring(0, largo - 1);
		else
			rut = crut.charAt(0);
	
		dv = crut.charAt(largo-1);
	
		if ( rut == null || dv == null )
		return 0;
	
		var dvr = '0';
		suma = 0;
		mul  = 2;
	
		for (i= rut.length-1 ; i>= 0; i--)
		{
			suma = suma + rut.charAt(i) * mul;
			if (mul == 7)
				mul = 2;
			else
				mul++;
		}
	
		res = suma % 11;
		if (res==1)
			dvr = 'k';
		else if (res==0)
			dvr = '0';
		else
		{
			dvi = 11-res;
			dvr = dvi + "";
		}
	
		if ( dvr != dv.toLowerCase() )
		{
			alert('El Rut Ingreso es Invalido')
			$("#rutAlumno").addClass("alertar");
			Objeto.focus()
			return false;
		}
		//alert('El Rut Ingresado es Correcto!')
		return true;
	}
}


	$(function() {
		$( "#datepicker" ).datepicker();
		$('#datepicker').datepicker('option', {dateFormat: 'yy-mm-dd'});

	});



function cancelar(){
	if(confirm("Cancelar esta operación?")){ location.href="escuelaDetalle.php?rbdColegio=<?php echo $rbdColegio;?>"; }  
}

function valida_rut(rut){
	if(val_obligatorio("rutProfesor") == false){ return; }
	if (Valida_Rut(document.form.rutProfesor)){
	save_profesor();
	}
	}

function save_profesor(){
	

	  // CAMPOS
	 if(val_obligatorio("nombreProfesor") == false){ return; }
	  if(val_obligatorio("apellidoPaternoProfesor") == false){ return; }
	 if(val_obligatorio("apellidoMaternoProfesor") == false){ return; }
	 if(val_obligatorio("sexoProfesor") == false){ return; }
	 if(val_obligatorio("datepicker") == false){ return; }
	 if(val_obligatorio("emailProfesor") == false){ return; }
	 if(val_obligatorio("estadoProfesor") == false){ return; }
	 if(confirm("¿Seguro de guardar este Profesor?")){

 var division = document.getElementById("lugar_de_cargaProfesor");
 var a = $(".campos").fieldSerialize();

 AJAXPOST("profesorGuarda.php",a,division);
  //alert(a);
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
			<input type="hidden" class="campos" name="modo" id="modo" value="">  
         
            <input type="hidden" class="campos" name="rbdColegio" id="rbdColegio" value="<?php echo $rbdColegio; ?>">
            <input type="hidden" class="campos" name="tipoUsuario" id="tipoUsuario" value="Profesor">
			 <tr>
				<th align="right">Colegio</th> 
				<td><input type="text" name="rbdColegio" size="70" class="campos" id="rbdColegio" disabled="disabled" value="<?php echo $rbdColegio;?>">
				</td>
			</tr>   
            <tr>
				<th align="right">Rut</th> 
				<td><input type="text" name="rutProfesor" size="70" value="" class="campos" id="rutProfesor" title="Rut sin puntos y con digito verificador"></td>
			</tr> 
     	<tr>
				<th align="right">Nombre Profesor</th> 
				<td><input type="text" name="nombreProfesor" size="70" value="" class="campos" id="nombreProfesor" /></td>
			</tr>  
             
			<tr>
			  <th align="right">Apellido Paterno</th>
			  <td><input type="text" name="apellidoPaternoProfesor" size="70" value="" class="campos" id="apellidoPaternoProfesor" /></td>
	    </tr>
			<tr>
			  <th align="right">Apellido Materno</th>
			  <td><input type="text" name="apellidoMaternoProfesor" size="70" value="" class="campos" id="apellidoMaternoProfesor" /></td>
	    </tr>
			<tr>
			  <th align="right">Sexo</th>
			  <td><select name="sexoProfesor" id="sexoProfesor" class="campos">
			    <option value="F">Femenino</option>
			    <option value="M">Masculino</option>
              </select></td>
	    </tr>
			<tr>
			  <th align="right">Fecha Nacimiento</th>
			  <td><input type="text" name="fechaNacimientoProfesor" size="70" value="" class="campos" id="datepicker"/></td>
	    </tr>
			<tr>
			  <th align="right">email</th>
			  <td><input type="text" name="emailProfesor" size="70" value="" class="campos" id="emailProfesor" /></td>
	    </tr>
		
			<tr>
				<th align="right">Estado</th>  
				<td><select name="estadoProfesor" id="estadoProfesor" class="campos"><option value="1">Activo</option><option value="0" >Desactivado</option></select></td> 
			</tr>   
		</tbody>
		<tr>
		  <td>
	      <tr>
	      <td>        
	      </table>
  </td>
  <td style="vertical-align:top;">
	<a class="button" href="javascript:valida_rut();"><span><div class="save">Grabar</div></span></a><br><br>
	<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div>
	</span></a>
  </td>
</tr>
</table>
	
    
            