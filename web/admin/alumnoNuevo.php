<?php

require("inc/config.php");
//require "inc/funcionesAdmin.php";

$rbdColegio = $_REQUEST["rbdColegio"];
$idNivel = $_REQUEST["idNivel"];
$anoCursoColegio = $_REQUEST["anoCursoColegio"];
$letraCursoColegio = $_REQUEST["letraCursoColegio"];

	
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
	if(confirm("Cancelar esta operación?")){ location.href="cursoDetalle.php?rbdColegio=<?php echo $rbdColegio;?>&idNivel=<?php echo $idNivel;?>&anoCursoColegio=<?php echo $anoCursoColegio;?>&letraCursoColegio=<?php echo $letraCursoColegio;?>"; }  
}

function valida_rut(rut){
	 if(val_obligatorio("rutAlumno") == false){ return; }
	if (Valida_Rut(document.fomulario.rutAlumno)){
	save_alumno();
	}
	}

function save_alumno(){
	

	 // CAMPOS
	 if(val_obligatorio("nombreAlumno") == false){ return; }
	  if(val_obligatorio("apellidoPaternoAlumno") == false){ return; }
	 if(val_obligatorio("apellidoMaternoAlumno") == false){ return; }
	 if(val_obligatorio("sexoAlumno") == false){ return; }

	 if(val_obligatorio("datepicker") == false){ return; }
	 	 
	 if(val_obligatorio("emailAlumno") == false){ return; }
	 if(val_obligatorio("tipoAlumno") == false){ return; }
	 if(val_obligatorio("estadoAlumno") == false){ return; }
	 
	
    if(confirm("¿Seguro de guardar este alumno?")){

 var division = document.getElementById("lugar_de_carga");
 var a = $(".campos").fieldSerialize();
 
 AJAXPOST("alumnoGuarda.php",a,division);
 }
} 
</script>

<form id="fomulario" name="fomulario">
<table>
<tr valign="top">
  <td>
	<table class="formulario"> 
		<tbody>
			<tr class="odd">
				<td colspan="2">Los campos con un  (*) son obligatorios.</td> 
			</tr> 
			<input type="hidden" class="campos" name="modo" id="modo" value="nuevo">  
            <input type="hidden" class="campos" name="anoCursoColegio" id="anoCursoColegio" value="<?php echo $anoCursoColegio; ?>">
            <input type="hidden" class="campos" name="letraCursoColegio" id="letraCursoColegio" value="<?php echo $letraCursoColegio; ?>">
            <input type="hidden" class="campos" name="idNivel" id="idNivel" value="<?php echo $idNivel; ?>">
            <input type="hidden" class="campos" name="rbdColegio" id="rbdColegio" value="<?php echo $rbdColegio; ?>">
            <input type="hidden" class="campos" name="tipoUsuario" id="tipoUsuario" value="Alumno">
			 <tr>
				<th align="right">Colegio</th> 
				<td><input type="text" name="rbdColegio" size="70" class="campos" id="rbdColegio" disabled="disabled" value="<?php echo $rbdColegio;?>">
				</td>
			</tr>   
             <tr>
				<th align="right">Curso</th> 
				<td><?php ?></td>

                
			</tr>   
            <tr>
				<th align="right">Rut</th> 
				<td><input type="text" name="rutAlumno" size="70" value="" class="campos" id="rutAlumno" title="Rut sin puntos y con digito verificador"></td>
			</tr> 
     	<tr>
				<th align="right">Nombre Alumno</th> 
				<td><input type="text" name="nombreAlumno" size="70" value="" class="campos" id="nombreAlumno" /></td>
			</tr>  
             
			<tr>
			  <th align="right">Apellido Paterno</th>
			  <td><input type="text" name="apellidoPaternoAlumno" size="70" value="" class="campos" id="apellidoPaternoAlumno" /></td>
	    </tr>
			<tr>
			  <th align="right">Apellido Materno</th>
			  <td><input type="text" name="apellidoMaternoAlumno" size="70" value="" class="campos" id="apellidoMaternoAlumno" /></td>
	    </tr>
			<tr>
			  <th align="right">Sexo</th>
			  <td><select name="sexoAlumno" id="sexoAlumno" class="campos">
			    <option value="F">Femenino</option>
			    <option value="M">Masculino</option>
              </select></td>
	    </tr>
			<tr>
			  <th align="right">Fecha Nacimiento</th>
			  <td><input type="text" name="fechaNacimientoAlumno" size="70" value="" class="campos" id="datepicker"/></td>
	    </tr>
			<tr>
			  <th align="right">email</th>
			  <td><input type="text" name="emailAlumno" size="70" value="" class="campos" id="emailAlumno" /></td>
	    </tr>
			<tr>
			  <th align="right">tipoAlumno</th>
			  <td><select name="tipoAlumno" id="tipoAlumno" class="campos">
			    <option value="Prioritario">Prioritario</option>
			    <option value="No Prioritario" >No Prioritario</option>
		      </select></td>
	    </tr>
			<tr>
				<th align="right">Estado</th>  
				<td><select name="estadoAlumno" id="estadoAlumno" class="campos"><option value="1">Activo</option><option value="0" >Desactivado</option></select></td> 
			</tr>   
		</tbody>
		<tr>
		  <td><p>Usuario y clave se
		    genera automaticamente</p>
		  el rut se ingresa sin puntos<tr>
	      <td>        
	      </table>
		  </form>
  </td>
  <td style="vertical-align:top;">
	<a class="button" href="javascript:valida_rut();"><span><div class="save">Grabar</div></span></a><br><br>
	<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div>
	</span></a>
  </td>
</tr>
</table>
	
    
            