<?php 
ini_set("display_errors","on");
require("inc/incluidos.php");
require ("hd.php");

$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 7, 'NULL');
$datos = getDatosGenerico($idUsuario);
$datosColegio = getDatosColegio($datos["rbdColegio"]);
$region = getRegion($datosColegio["idComuna"]);
//print_r($datos);
//print_r($datosColegio);
//print_r($_SESSION);


//echo @$datos["cursoActual"]; 

$cursos = @$datos["cursoActual"];
$niveles = @$datos["nivelExperienciaSingapur"];
$xpSingapur = @$datos["experienciaSingapur"];
$especializacion= @$datos["especializacion"];

function marcaCurso($cursos, $curso){
	$pos = strpos($cursos, $curso);
	if ($pos === false) {
		echo "";
	} else {
		echo " checked";
	}
}

function marcaNivel($niveles, $nivel){
	$pos = strpos($niveles, $nivel);
	if ($pos === false) {
		echo "";
	} else {
		echo " checked";
	}
}

function marcaXpSingapur($xpSingapur, $xp){
	$pos = strpos($xpSingapur, $xp);
	if ($pos === false) {
		echo "";
	} else {
		echo " checked";
	}
}


function seleccionaEspecializacion($especializacion, $espc){
	$pos = strpos($especializacion, $espc);
	if ($pos === false) {
		echo "";
	} else {
		echo " selected";
	}
}


?>


<script type="text/javascript">
	$(function() {
		$('#datepicker').datepicker({
			changeMonth: true,
			changeYear: true
		});
		
		$('#datepicker').datepicker('option', {dateFormat: "yy-mm-dd"});
		$("#datepicker").datepicker($.datepicker.regional['es']);
		$("#datepicker").datepicker({ minDate: new Date(2010, 1 - 1, 1) });
	});
	
function despliegaTabla(){
	$("#trDesplegable").show();
}

function ocultaTabla(){
	$("#trDesplegable").hide();
}

</script>

<meta charset="iso-8859-1"/>    
<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Ficha Docente*#";	
	require("_navegacion.php");
?>
	
	<div id="aka">
<div class="olo" align="center">
<form id="form1" name="form1" method="post" action="miPerfilGuarda.php" enctype="multipart/form-data">
<table border="0" class="tablesorter" style="width:400px;" id="tbGeneral">
	<tr>
    	<th colspan="4" align="center"><h1>Ficha Docente</h1></th>
    </tr>
	<tr> 
    	<th>Actualizar Imagen:</th>
	    <td align="center" colspan="3">
	    <img src="<?php echo "subir/fotos_perfil/orig_".$_SESSION["sesionImagenUsuario"]; ?>"  border="1"/><br/><br/>
        <p><input type="file" name="file" id="file" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"  width="20px" /></span>
        Tama&ntilde;o M&aacute;ximo 1MB, Formato JPG</p></td>
 	</tr>
	<tr>
        <th>Nombre:</th>
        <td colspan="3"><input type="text" name="nombre" id="nombre" size="100" value="<?php echo $datos["nombreProfesor"]; ?>"/></td>  </tr>
	<tr>
        <th> Apellido Paterno:</th>
        <td colspan="3"><input type="text" name="apellidoPaterno" size="100" id="apellidoPaterno" value="<?php echo $datos["apellidoPaternoProfesor"];?>"/></td>
	</tr>
	<tr>
        <th>Apellido Materno:</th>
        <td colspan="3"><input type="text" name="apellidoMaterno" size="100" id="apellidoMaterno" value="<?php echo $datos["apellidoMaternoProfesor"]; ?>"/></td>
	</tr>
	<tr>
		<th align="left">Nombre del establecimiento:</th>
		<td style="vertical-align:middle"><input type="text" name="colegio" id="colegio" value="<?php echo $datosColegio["nombreColegio"]; ?>" readonly/></td>
        <th>RBD:</th>
        <td style="vertical-align:middle"><input type="text" name="rbd" id="rbd" value="<?php echo $datos["rbdColegio"]; ?>" readonly/></td>
	</tr>
  	<tr>
		<th>Region/Departamento: </th>
        <td colspan="3"><input type="text" name="region" size="100" id="region" value="<?php echo $region; ?>" readonly/></td>
	</tr>
  	<tr>
      	<th>Comuna/Ciudad: </th>
		<td colspan="3"><input type="text" name="comuna" size="100" id="comuna" value="<?php echo $datosColegio["nombreComuna"]; ?>" readonly/></td>
	</tr>
	<tr>
    	<th>Acerca de mi:
        <p style="font-size:9px" align="left">(Describa los aspectos que quiera compartir con otros docentes que interact&uacute;an en la plataforma virtual, tales como experiencia profesional, intereses personales, entre otros)</p></th>
	    <td colspan="3" style="vertical-align:middle"><textarea name="acercaDeUsuario" cols="75" rows="7"><?php echo $datos["acercaDeUsuario"]?></textarea></td>
 	</tr>
	<tr>
    	<th>Rut/C&eacute;dula:</th>
	    <td colspan="3">
	      <input name="rut" value="<?php echo $datos["rutProfesor"]; ?>" readonly size="100"/>
         </td>
	</tr>
	<tr>
    	<th>Fecha de Nacimiento:<br>Actualizar:</th>
	    <td colspan="3" style="vertical-align:middle"><?php echo $datos["fechaNacimientoProfesor"]?><br>
    	  <input size="100" type="text" name="fechaNacimiento" id="datepicker"/>
	      <input name="fechaNacimiento_h" type="hidden" value="<?php echo $datos["fechaNacimientoProfesor"]?>"  /></td>
	</tr>
	<tr>
    	<th>Correo Electrónico:</th>
	    <td colspan="3"><input size="30" type="text" name="email" id="email" value="<?php echo $datos["emailProfesor"]?>" size="100"/></td>
  	</tr>
	<tr>
    	<th align="left">Teléfono del Establecimiento:</th>
	    <td style="vertical-align:middle"><input size="10" type="text" name="telefonoColegio" id="telefonoColegio" value="<?php echo $datosColegio["telefonoColegio"]?>" readonly/></td>
        <th>Teléfono Móvil</th>
		<td style="vertical-align:middle"><input size="10" type="text" name="telefono" id="telefono" value="<?php echo $datos["telefonoProfesor"]?>"/></td>
	</tr>
	<tr>
    	<th>Años de Docencia</th>
	    <td colspan="3"><input type="text" name="experiencia" id="experiencia" value="<?php echo @$datos["anosExperienciaProfesor"]; ?>" size="100"/></td>
	</tr>
	<tr>
    	<th>Años de Docencia en Establecimiento actual:</th>
	    <td style="vertical-align:middle" colspan="3"><input type="text" name="experienciaColegioActual" id="experienciaColegioActual" size="100" value="<?php echo @$datos["anosExperienciaEnColegio"]?>"/></td>
	</tr>
	<tr>
    	<th>Curso(s) en que hace clases de matemática durante el 2013:
        <p style="font-size:9px">Puede Seleccionar más de una opción</p></th>
        <td colspan="3">
        	<table width="100%">
            
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="1" <?php marcaCurso($cursos,"1"); ?>/>1º Básico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="5" <?php marcaCurso($cursos,"5"); ?>/>5º Básico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="2" <?php marcaCurso($cursos,"2"); ?>/>2º Básico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="6" <?php marcaCurso($cursos,"6"); ?>/>6º Básico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="3" <?php marcaCurso($cursos,"3"); ?>/>3º Básico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="7" <?php marcaCurso($cursos,"7"); ?>/>7º Básico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="4" <?php marcaCurso($cursos,"4"); ?>/>4º Básico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="8" <?php marcaCurso($cursos,"8"); ?>/>8º Básico</td>
                </tr>
                <tr>
					<td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="Otro" <?php marcaCurso($cursos,"Otro"); ?>/>Otro</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="Ninguno" <?php marcaCurso($cursos,"Ninguno"); ?>/>Ninguno</td>
                </tr>
			</table>
		</td>
	</tr>

	<tr>
        <th align="left">¿Tiene especialización en matemáticas?:</th>
        <td colspan="3" style="vertical-align:middle">
        	<select name="especializacion" id="espcializacion">
	            <option value="">Seleccionar</option>
	            <option value="Si" <?php seleccionaEspecializacion($especializacion, "Si");?> >Si</option>
	            <option value="No" <?php seleccionaEspecializacion($especializacion, "No");?>>No</option>                
            </select>
        </td>
	</tr>
	<tr>
    	<th align="left">¿Cuánto tiempo ha trabajado con los textos del Método Singapur Implementando en aula la propuesta?</th>
        <td colspan="3">
        	<table width="100%">
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="1" <?php marcaXpSingapur($xpSingapur,"1"); ?> onClick="despliegaTabla();"/>1 año</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="2" <?php marcaXpSingapur($xpSingapur,"2"); ?> onClick="despliegaTabla();"/>2 años</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="3" <?php marcaXpSingapur($xpSingapur,"3"); ?> onClick="despliegaTabla();"/>3 años</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="4" <?php marcaXpSingapur($xpSingapur,"4"); ?> onClick="despliegaTabla();"/>4 años</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="Nunca" <?php marcaXpSingapur($xpSingapur,"Nunca"); ?> onClick="ocultaTabla();"/>Nunca</td>
                </tr>
			</table>
		</td>
	</tr>
    
    <tr id="trDesplegable">
    	<th>¿En qué Nivel(es)?:
        <p style="font-size:9px">Puede Seleccionar más de una opción</p></th>
        <td colspan="3">
        	<table width="100%" id="tablaDesplegable">
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="1" <?php marcaCurso($niveles,"1"); ?>/>1º Básico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="2" <?php marcaCurso($niveles,"2"); ?>/>2º Básico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="3" <?php marcaCurso($niveles,"3"); ?>/>3º Básico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="4" <?php marcaCurso($niveles,"4"); ?>/>4º Básico</td>
                </tr>
			</table>
		</td>
	</tr>
	<tr>
    	<td colspan="4" align="right">
			<p align="right"><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"  onclick="document.form1.submit()"><span class="ui-button-text">Actualizar Datos</span></button></p>
		</td>
  	</tr>
</table>
</form>

      </div> <!--demo-->
	
    </div> <!--columnaCentro-->

     <?php 
    	if($xpSingapur == "Nunca"){
			echo "<script language='javascript'>ocultaTabla();</script>";
		}
		require("pie.php");
		
    ?> 
</div> 
   
</body>
</html>