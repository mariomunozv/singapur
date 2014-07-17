<?php

require("inc/config.php");

// borrar cuando se llame desde la pagina principal
require("_head.php"); 
	
?> 

<?php
require("../inc/_profesor.php");
require("../inc/_colegio.php");
require("../inc/_empleadoKlein.php");
//$profesores = getRutProfesores();
//$empleados = getRutEmpleados();
?>


<script language="javascript">

function cancelar(){
	if(confirm("Cancelar esta operacion?")){ location.href="usuarios.php"; }  
}
function save_usuario(){
	
	//if(val_obligatorio("idProyectoKlein") == false){ return; } // CAMPOS
	//if(val_obligatorio("nombreCortoCursoCapacitacion") == false){ return; }
	
	if(confirm("Seguro que desea crear este usuario?")){

		var division = document.getElementById("usuario_nuevo");
		var a = $(".campos").fieldSerialize();
		AJAXPOST("usuarioGuarda.php",a,division);
	}
} 
</script>
<script language="javascript">
function cambio_tipo_usuario(){
	$('.removido').val("");
	var x=document.getElementById("tipoUsuario");
	if(x.value =="UTP"){
		$('.campo_nuevo_utp').css("display", "");
	}else{
		$('.campo_nuevo_utp').css("display", "none");
	}
	if(x.value == "Profesor" || x.value=="UTP" || x.value=="Directivo"){
		$('.campo-empleadoklein').css("display", "none");
		$('.campo-profesor').css("display", "");
	}else{
		$('.campo-empleadoklein').css("display", "");
		$('.campo-profesor').css("display", "none");
	}

}

$('.removido').change(function(){
	if( $(this).val() == "" ){
		if($("#tipoUsuario").val()=="Profesor" || $("#tipoUsuario").val()=="UTP" || $("#tipoUsuario").val()=="Directivo" ){
			$('.input_nuevo').css('display', "");
		}
		$(".input_nuevo:not('[id^=trColegio]')").css('display', "");
	}else{
		$(".input_nuevo").css('display', "none");
	}
});

</script>
      

<table>
<tr valign="top">
  <td>
	<table class="formulario"> 
		<tbody>
			<tr class="odd">
				<td colspan="2">Los campos con un  (*) son obligatorios.</td> 
			</tr> 
			<tr>
				<th align="right">Tipo usuario(*)</th> 
				<td>
                	<select class="campos" id="tipoUsuario" name="tipoUsuario" onchange="cambio_tipo_usuario()">
                    	<option value="Profesor">Profesor</option>
                    	<option value="UTP">UTP</option>
                    	<option value="Directivo">Directivo</option>
                    	<!--<option value="Visitante">Visitante</option>-->
                    	<option value="Relator/Tutor">Relator/Tutor</option>
                    	<option value="Asesor">Asesor</option>
                    	<option value="Empleado Klein">Administrativo Klein</option>
                    	<option value="Coordinador General">Coordinador General</option>
					</select>
                </td>
			</tr> 
			<input type="hidden" class="campos" name="modo" id="modo" value="nuevo">  

            <tr class="campo-profesor">
				<th align="right">Rut profesor</th> 
				<td>
                	<select class="campos removido" id="rutProfesor" name="rutProfesor">
                    	<option value="">----</option>
                    	<?php 
						    $profesores = getRutProfesores();
						    if (count($profesores) > 0){
						      foreach ($profesores as $profesor){
						      	echo "<option value='".$profesor['rut']."'>".$profesor["nombreParaMostrar"]."</option>";
						      }
						    }
						?>
					</select>
                </td>
			</tr>   
            <tr class="campo-empleadoklein" style="display:none;">
				<th align="right">Rut empleado Klein</th> 
				<td>
					<select name="rutEmpleadoKlein" class="campos removido" id="rutEmpleadoKlein">
                    	<option value="">----</option>
                    	<?php 
						    $empleados = getRutEmpleados();
						    if (count($empleados) > 0){
						      foreach ($empleados as $empleado){
						      	echo "<option value='".$empleado['rut']."'>".$empleado["nombreParaMostrar"]."</option>";
						      }
						    }
						?>
					</select>
                </td>
			</tr>
			<!--#inicio campos para nuevo-->
			<tr class="input_nuevo campo-profesor"id="trColegio">
				<th align="right">Colegio (*)</th> 
				<td>
					<select name="rbdColegio" class="campos" id="colegio">
                    	<option value="">----</option>
                    	<?php 
						    $colegios = getColegiosNuevo();
						    if (count($colegios) > 0){
						      foreach ($colegios as $colegio){
						      	echo "<option value='".$colegio['idColegio']."'>".$colegio["nombreColegio"]."</option>";
						      }
						    }
						?>
					</select>
                </td>
			</tr>
			<tr class="input_nuevo">
				<th align="right">Rut(*)</th> 
				<td><input type="text" name="nuevo_rut" size="70" value="" class="campos" id="nuevo_rut"></td>
			</tr>
			<tr class="input_nuevo">
				<th align="right">Nombre(*)</th> 
				<td><input type="text" name="nuevo_nombre" size="70" value="" class="campos" id="nuevo_nombre"></td>
			</tr>
			<tr class="input_nuevo">
				<th align="right">Apellido paterno(*)</th> 
				<td><input type="text" name="nuevo_paterno" size="70" value="" class="campos" id="nuevo_paterno"></td>
			</tr> 
			<tr class="input_nuevo">
				<th align="right">Apellido materno</th> 
				<td><input type="text" name="nuevo_materno" size="70" value="" class="campos" id="nuevo_materno"></td>
			</tr>

			<!--#fin campos para nuevo-->
			<!--campos para nuevo utp-->
			<!--<tr class="campo_nuevo_utp" style="display:none;">
				<th align="right">Curso directivo</th> 
				<td>
					<select name="cursoDirectivo" class="campos" id="cursoDirectivo"></select>
                </td>
			</tr>-->
			<!--fin campos para nuevo utp-->


			<tr>
				<th align="right">Email usuario</th> 
				<td><input type="text" name="emailUsuario" size="70" value="" class="campos" id="emailUsuario"></td>
			</tr> 
			<tr>
				<th align="right">Login usuario(*)</th> 
				<td><input type="text" name="loginUsuario" size="70" value="" class="campos" id="loginUsuario"></td>
			</tr> 
			<tr>
				<th align="right">Password usuario(*)</th> 
				<td><input type="password" name="passwordUsuario" size="70" value="" class="campos" id="passwordUsuario"></td>
			</tr> 
			
            <tr>
				<th align="right">Acerca de usuario</th> 
				<td><input type="text" name="acercaDeUsuario" size="70" value="" class="campos" id="acercaDeUsuario"></td>
			</tr> 
			<tr>
				<th align="right">Intereses usuario</th> 
				<td><input type="text" name="interesesUsuario" size="70" value="" class="campos" id="interesesUsuario"></td>
			</tr>
		</tbody>
		<tr>
			<th></th>
			<td style="vertical-align:top;">
			  	<br />
				<a class="button" href="javascript:save_usuario();"><span><div class="save">Grabar</div></span></a>
				<a class="button" href="javascript:cancelar();"><span><div class="delete">Cancelar</div></span></a>
			</td>
		</tr>		

</tr>
</table>
	
    
            