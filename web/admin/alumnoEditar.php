<?php

require("inc/config.php");
//require "inc/funcionesAdmin.php";

$datosUsuario = getDatosUsuario($_REQUEST["usuario"]);
//print_r($datosUsuario);

$alumno = getDatosAlumno($datosUsuario["rut"]);
//print_r($alumno);
$rbdColegio = $_REQUEST["rbdColegio"];

	
?> 


	<table>
<tr valign="top">
  <td>
	<table class="formulario"> 
		<tbody>
			<tr class="odd">
				<td colspan="2">SSLos campos con un  (*) son obligatorios.</td> 
			</tr> 
			<input type="hidden" class="campos" name="modo" id="modo" value="editar">  
            <input type="hidden" class="campos" name="rutAlumno" id="rutAlumno" value="<?php echo $rutAlumno; ?>">
            
			 <tr>
				<th align="right">Colegio</th> 
				<td><input type="text" name="rbdColegio" size="70" class="campos" id="rbdColegio" disabled="disabled" value="<?php echo $rbdColegio;?>">
				</td>
			</tr>   
        
            <tr>
				<th align="right">Rut</th> 
				<td><input type="text" name="rutAlumno" size="70" class="campos"  id="rutAlumno" title="Rut sin puntos y con digito verificador" disabled="disabled" value="<?php echo $datosUsuario["rut"]; ?>"></td>
			</tr> 
     	<tr>
				<th align="right">Nombre Alumno</th> 
				<td><input type="text" name="nombreAlumno" size="70" class="campos" id="nombreAlumno" value="<?php echo $alumno["nombreAlumno"];?>" /></td>
			</tr>  
             
			<tr>
			  <th align="right">Apellido Paterno</th>
			  <td><input type="text" name="apellidoPaternoAlumno" size="70" class="campos" id="apellidoPaternoAlumno" value="<?php echo $alumno["apellidoPaternoAlumno"];?>" /></td>
	    </tr>
			<tr>
			  <th align="right">Apellido Materno</th>
			  <td><input type="text" name="apellidoMaternoAlumno" size="70"   class="campos" id="apellidoMaternoAlumno" value="<?php echo $alumno["apellidoMaternoAlumno"];?>" /></td>
	    </tr>
			<tr>
			  <th align="right">Sexo</th>
			  <td><select name="sexoAlumno" id="sexoAlumno" class="campos">
			    <option value="F" <?php if ( $alumno["sexoAlumno"] == "F"){ echo 'selected="selected"';}?>>Femenino</option>
			    <option value="M" <?php if ( $alumno["sexoAlumno"] == "M"){ echo 'selected="selected"';}?> >Masculino</option>
              </select></td>
	    </tr>
			<tr>
			  <th align="right">Fecha Nacimiento</th>
			  <td><input type="text" name="fechaNacimientoAlumno" size="70" class="campos" id="datepicker" value="<?php echo $alumno["fechaNacimientoAlumno"];?>"  /></td>
	    </tr>
			<tr>
			  <th align="right">email</th>
			  <td><input type="text" name="emailAlumno" size="70" value="<?php echo $datosUsuario["emailUsuario"];?>" class="campos" id="emailAlumno"  disabled="disabled"/></td>
	    </tr>
			<tr>
			  <th align="right">tipoAlumno</th>
			  <td><select name="tipoAlumno" id="tipoAlumno" class="campos">
			    <option value="Prioritario" <?php if ( $alumno["tipoAlumno"] == "Prioritario"){ echo 'selected="selected"';}?>>Prioritario</option>
			    <option value="No Prioritario" <?php if ( $alumno["tipoAlumno"] == "No Prioritario"){ echo 'selected="selected"';}?> >No Prioritario</option>
		      </select></td>
	    </tr>
			<tr>
				<th align="right">Estado</th>  
				<td><select name="estadoAlumno" id="estadoAlumno" class="campos">
                <option value="1" <?php if ( $datosUsuario["estadoUsuario"] == "1"){ echo 'selected="selected"';}?> >Activo</option>
                <option value="0" <?php if ( $datosUsuario["estadoUsuario"] == "0"){ echo 'selected="selected"';}?>  >Desactivado</option></select></td> 
			</tr>   
		</tbody>
		<tr>
		  <td><p>Usuario y clave se
		    genera automaticamente</p>
		  el rut se ingresa sin puntos<tr>
	      <td>        
	      </table>
  </td>
  <td style="vertical-align:top;">
	<a class="button" href="javascript:save_a();"><span><div class="save">Grabar</div></span></a><br><br>
	<a class="button" href="#" onclick="javascript:cancelar()"><span><div class="delete">Cancelar</div>

	</span></a>
  </td>
</tr>
</table>
	
    
            