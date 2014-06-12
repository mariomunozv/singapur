<?php 
ini_set("display_errors","On");
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
$apoyoTecnico = @$datos["apoyoTecnico"];
$titulo = @$datos["titulo"];
$obtEspecializacion = @$datos["obtEspecializacion"];
$cursoCapacitacion = @$datos["cursoCapacitacion"];
$cursosImplementa = @$datos["cursosImplementa"];
$tiempoCapacitando = @$datos["tiempoCapacitando"];
$otroSingapur = @$datos["otroSingapur"];
$cursosCapacitando = @$datos["cursosCapacitando"];


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

function seleccionaApoyo($apoyoTecnico, $ap){
	$pos = strpos($apoyoTecnico, $ap);
	if ($pos === false) {
		echo "";
	} else {
		echo " selected";
	}
}

function seleccionaobtEspecializacion($obtEspecializacion,$obt){
	$pos = strpos($obtEspecializacion, $obt);
	if ($pos === false) {
		echo "";
	} else {
		echo " selected";
	}
}

function seleccionaTitulo($titulo, $tit){
	$pos = strpos($titulo, $tit);
	if ($pos === false) {
		echo "";
	} else {
		echo " selected";
	}
}

function seleccionaCursoCapacitacion($cursoCapacitacion, $cCap){
	$pos = strpos($cursoCapacitacion, $cCap);
	if ($pos === false) {
		echo "";
	} else {
		echo " selected";
	}
}


function seleccionaCursoImplementa($cursosImplementa, $cImp){
	$pos = strpos($cursosImplementa, $cImp);
	if ($pos === false) {
		echo "";
	} else {
		echo " checked";
	}
}

function seleccionatiempoCapacitando($tiempoCapacitando, $tiempo){
	$pos = strpos($tiempoCapacitando, $tiempo);
	if ($pos === false) {
		echo "";
	} else {
		echo " checked";
	}
}

function seleccionaotroSingapur($otroSingapur,$otro){
	$pos = strpos($otroSingapur, $otro);
	if ($pos === false) {
		echo "";
	} else {
		echo " selected";
	}
}


function seleccionaCursoCapacitando($cursosCapacitando, $cctn){
	$pos = strpos($cursosCapacitando, $cctn);
	if ($pos === false) {
		echo "";
	} else {
		echo " checked";
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
<form id="form1" name="form1" method="post" action="miPerfilGuardaCl.php" enctype="multipart/form-data">
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
    	<th>Correo Electr�nico:</th>
	    <td colspan="3"><input size="30" type="text" name="email" id="email" value="<?php echo $datos["emailProfesor"]?>" size="100"/></td>
  	</tr>
	<tr>
    	<th align="left">Tel�fono del Establecimiento:</th>
	    <td style="vertical-align:middle"><input size="10" type="text" name="telefonoColegio" id="telefonoColegio" value="<?php echo $datosColegio["telefonoColegio"]?>" readonly/></td>
        <th>Tel�fono M�vil</th>
		<td style="vertical-align:middle"><input size="10" type="text" name="telefono" id="telefono" value="<?php echo $datos["telefonoProfesor"]?>"/></td>
	</tr>
	<tr>
    	<th>A�os de Docencia</th>
	    <td colspan="3"><input type="text" name="experiencia" id="experiencia" value="<?php echo @$datos["anosExperienciaProfesor"]; ?>" size="100"/></td>
	</tr>
	<tr>
    	<th>A�os de Docencia en Establecimiento actual:</th>
	    <td style="vertical-align:middle" colspan="3"><input type="text" name="experienciaColegioActual" id="experienciaColegioActual" size="100" value="<?php echo @$datos["anosExperienciaEnColegio"]?>"/></td>
	</tr>
	<tr>
    	<th>Curso(s) en que hace clases de matem�tica durante el 2013:
        <p style="font-size:9px">Puede Seleccionar m�s de una opci�n</p></th>
        <td colspan="3">
        	<table width="100%">
            
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="1" <?php marcaCurso($cursos,"1"); ?>/>1� B�sico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="5" <?php marcaCurso($cursos,"5"); ?>/>5� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="2" <?php marcaCurso($cursos,"2"); ?>/>2� B�sico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="6" <?php marcaCurso($cursos,"6"); ?>/>6� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="3" <?php marcaCurso($cursos,"3"); ?>/>3� B�sico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="7" <?php marcaCurso($cursos,"7"); ?>/>7� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="4" <?php marcaCurso($cursos,"4"); ?>/>4� B�sico</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="8" <?php marcaCurso($cursos,"8"); ?>/>8� B�sico</td>
                </tr>
                <tr>
					<td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="Otro" <?php marcaCurso($cursos,"Otro"); ?>/>Otro</td>
                    <td><input type="checkbox" name="cursoActual[]" id="cursoActual" value="Ninguno" <?php marcaCurso($cursos,"Ninguno"); ?>/>Ninguno</td>
                </tr>
			</table>
		</td>
	</tr>
	<tr>
        <th align="left">Realiza labores de apoyo T�cnico en el establecimiento:</th>
        <td colspan="3" style="vertical-align:middle">
        	<select name="apoyoTecnico" id="apoyoTecnico">
	            <option value="">Seleccionar</option>
	            <option value="Si" <?php seleccionaApoyo($apoyoTecnico, "Si");?> >Si</option>
	            <option value="No" <?php seleccionaApoyo($apoyoTecnico, "No");?>>No</option>                
            </select>
        </td>
	</tr>
    <tr>
        <th align="left">Indique el t�tulo que posee:</th>
        <td colspan="3" style="vertical-align:middle">
        	<select name="titulo" id="titulo">
	            <option value="">Seleccionar</option>
	            <option value="Profesor de Educaci�n B�sica" <?php seleccionaTitulo($titulo, "Profesor de Educaci�n B�sica");?> >Profesor de Educaci�n B�sica</option>
	            <option value="Profesor de Educaci�n Media" <?php seleccionaTitulo($titulo, "Profesor de Educaci�n Media");?> >Profesor de Educaci�n Media</option>
	            <option value="Educador de P�rvulo" <?php seleccionaTitulo($titulo, "Educador de P�rvulo");?> >Educador de P�rvulo</option>
	            <option value="Educador Diferencial" <?php seleccionaTitulo($titulo, "Educador Diferencial");?> >Educador Diferencial</option>
	            <option value="Otro" <?php seleccionaTitulo($titulo, "Otro");?> >Otro</option>
            </select>
        </td>
	</tr>
	<tr>
        <th align="left">�Tiene especializaci�n en matem�ticas?:
        <p style="font-size:9px" align="left">(Menci�n en matem�tica)</p></th>
        <td colspan="3" style="vertical-align:middle">
        	<select name="especializacion" id="espcializacion">
	            <option value="">Seleccionar</option>
	            <option value="Si" <?php seleccionaEspecializacion($especializacion, "Si");?> >Si</option>
	            <option value="No" <?php seleccionaEspecializacion($especializacion, "No");?>>No</option>                
            </select>
        </td>
	</tr>
    <tr>
        <th align="left">�C�mo obtuvo la especializaci�n?:</th>
        <td colspan="3" style="vertical-align:middle">
        	<select name="obtEspecializacion" id="obtEspecializacion">
	            <option value="">Seleccionar</option>
	            <option value="Durante la formaci�n de Pregrado" <?php seleccionaobtEspecializacion($obtEspecializacion, "Durante la formaci�n de Pregrado");?> >Durante la formaci�n de Pregrado</option>
	            <option value="A trav�s de un Post�tulo" <?php seleccionaobtEspecializacion($obtEspecializacion, "A trav�s de un Post�tulo");?>>A trav�s de un Post�tulo</option>                
	            <option value="Otro" <?php seleccionaobtEspecializacion($obtEspecializacion, "Otro");?>>Otro</option>                
            </select>
        </td>
	</tr>
    <tr>
        <th align="left">�En qu� instituci�n obtuvo la especializaci�n?:</th>
        <td colspan="3" style="vertical-align:middle">
		<input type="text" name="uEspecializacion" size="100" id="uEspecializacion" value="<?php echo $datos["uEspecialiazcion"]; ?>"/>
        </td>
	</tr>
	<tr>
        <th align="left">Indique otro perfeccionamiento que posea a nivel de Post�tulo o Postgrado:</th>
        <td colspan="3" style="vertical-align:middle">
		<input type="text" name="otroPerfeccionamiento" size="100" id="otroPerfeccionamiento" value="<?php echo $datos["otroPerfeccionamiento"]; ?>"/>
        </td>
	</tr>
	<tr>
    	<th align="left">�Cu�nto tiempo ha trabajado con los textos del M�todo Singapur Implementando en aula la propuesta?</th>
        <td colspan="3">
        	<table width="100%">
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="1" <?php marcaXpSingapur($xpSingapur,"1"); ?> onClick="despliegaTabla();"/>1 a�o</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="2" <?php marcaXpSingapur($xpSingapur,"2"); ?> onClick="despliegaTabla();"/>2 a�os</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="3" <?php marcaXpSingapur($xpSingapur,"3"); ?> onClick="despliegaTabla();"/>3 a�os</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="4" <?php marcaXpSingapur($xpSingapur,"4"); ?> onClick="despliegaTabla();"/>4 a�os</td>
                </tr>
                <tr>
                    <td><input type="radio" name="experienciaSingapur" id="experienciaSingapur" value="Nunca" <?php marcaXpSingapur($xpSingapur,"Nunca"); ?> onClick="ocultaTabla();"/>Nunca</td>
                </tr>
			</table>
		</td>
	</tr>
    
    <tr id="trDesplegable">
    	<th>�En qu� Nivel(es)?:
        <p style="font-size:9px">Puede Seleccionar m�s de una opci�n</p></th>
        <td colspan="3">
        	<table width="100%" id="tablaDesplegable">
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="1" <?php marcaCurso($niveles,"1"); ?>/>1� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="2" <?php marcaCurso($niveles,"2"); ?>/>2� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="3" <?php marcaCurso($niveles,"3"); ?>/>3� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="nivelExperiencia[]" id="nivelExperiencia" value="4" <?php marcaCurso($niveles,"4"); ?>/>4� B�sico</td>
                </tr>
			</table>
		</td>
	</tr>
    <tr>
    	<th colspan="4" align="left">
			Capacitaci�n en el Centro Felix Klein
		</th>
  	</tr>
    <tr>
        <th align="left">Indique curso en el cual se capacita actualmente:</th>
        <td colspan="3" style="vertical-align:middle">
        	<select name="cursoCapacitacion" id="cursoCapacitacion">
	            <option value="">Seleccionar</option>
	            <option value="1" <?php seleccionaCursoCapacitacion($cursoCapacitacion, "1");?>>Curso 1� b�sico</option>
	            <option value="2" <?php seleccionaCursoCapacitacion($cursoCapacitacion, "2");?>>Curso 2� b�sico</option>                
	            <option value="3" <?php seleccionaCursoCapacitacion($cursoCapacitacion, "3");?>>Curso 3� b�sico</option>                
	            <option value="4" <?php seleccionaCursoCapacitacion($cursoCapacitacion, "4");?>>Curso 4� b�sico</option>                
	            <option value="5" <?php seleccionaCursoCapacitacion($cursoCapacitacion, "5");?>>Curso 5� b�sico</option>                
            </select>
        </td>
	</tr>
    <tr>
    	<th>Indique curso(s) en que implementar� en aula la propuesta del M�todo Singapur en el 2013:
        <p style="font-size:9px">(Puede seleccionar m�s de uno)</p></th>
        <td colspan="3">
        	<table width="100%">
                <tr>
                    <td><input type="checkbox" name="cursosImplementa[]" id="cursosImplementa" value="1" <?php seleccionaCursoImplementa($cursosImplementa,"1"); ?>/>1� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursosImplementa[]" id="cursosImplementa" value="2" <?php seleccionaCursoImplementa($cursosImplementa,"2"); ?>/>2� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursosImplementa[]" id="cursosImplementa" value="3" <?php seleccionaCursoImplementa($cursosImplementa,"3"); ?>/>3� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursosImplementa[]" id="cursosImplementa" value="4" <?php seleccionaCursoImplementa($cursosImplementa,"4"); ?>/>4� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursosImplementa[]" id="cursosImplementa" value="5" <?php seleccionaCursoImplementa($cursosImplementa,"5"); ?>/>5� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursosImplementa[]" id="cursosImplementa" value="Nunca" <?php seleccionaCursoImplementa($cursosImplementa,"Nunca"); ?>/>Ninguno</td>
                </tr>
			</table>
		</td>
	</tr>
    <tr>
    	<th align="left">�Cu�nto tiempo se ha capacitado en el M�todo Singapur con el Centro Felix Klein?:</th>
        <td colspan="3">
        	<table width="100%">
                <tr>
                    <td><input type="radio" name="tiempoCapacitando" id="tiempoCapacitando" value="1" <?php seleccionatiempoCapacitando($tiempoCapacitando,"1"); ?> />1 a�o</td>
                </tr>
                <tr>
                    <td><input type="radio" name="tiempoCapacitando" id="tiempoCapacitando" value="2" <?php seleccionatiempoCapacitando($tiempoCapacitando,"2"); ?> />2 a�os</td>
                </tr>
                <tr>
                    <td><input type="radio" name="tiempoCapacitando" id="tiempoCapacitando" value="3" <?php seleccionatiempoCapacitando($tiempoCapacitando,"3"); ?> />3 a�os</td>
                </tr>
                <tr>
                    <td><input type="radio" name="tiempoCapacitando" id="tiempoCapacitando" value="4" <?php seleccionatiempoCapacitando($tiempoCapacitando,"4"); ?> />4 a�os</td>
                </tr>
                <tr>
                    <td><input type="radio" name="tiempoCapacitando" id="tiempoCapacitando" value="Nunca" <?php seleccionatiempoCapacitando($tiempoCapacitando,"Nunca"); ?> />Nunca</td>
                </tr>
			</table>
		</td>
	</tr>
	<tr>
    	<th>�En qu� Curso(s)?:
        <p style="font-size:9px">Puede Seleccionar m�s de una opci�n</p></th>
        <td colspan="3">
        	<table width="100%">
                <tr>
                    <td><input type="checkbox" name="cursosCapacitando[]" id="cursosCapacitando" value="1" <?php seleccionaCursoCapacitando($cursosCapacitando,"1"); ?>/>1� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursosCapacitando[]" id="cursosCapacitando" value="2" <?php seleccionaCursoCapacitando($cursosCapacitando,"2"); ?>/>2� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursosCapacitando[]" id="cursosCapacitando" value="3" <?php seleccionaCursoCapacitando($cursosCapacitando,"3"); ?>/>3� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursosCapacitando[]" id="cursosCapacitando" value="4" <?php seleccionaCursoCapacitando($cursosCapacitando,"4"); ?>/>4� B�sico</td>
                </tr>
                <tr>
                    <td><input type="checkbox" name="cursosCapacitando[]" id="cursosCapacitando" value="5" <?php seleccionaCursoCapacitando($cursosCapacitando,"5"); ?>/>5� B�sico</td>
                </tr>
			</table>
		</td>
	</tr>
    <tr>
    	<th colspan="4" align="left">
			Capacitaci�n en el Centro Felix Klein
		</th>
  	</tr>
	<tr>
        <th align="left">�Se ha capacitado en el M�todo Singapur con otra instituci�n?:</th>
        <td colspan="3" style="vertical-align:middle">
        	<select name="otroSingapur" id="otroSingapur">
	            <option value="">Seleccionar</option>
	            <option value="Si" <?php seleccionaOtroSingapur($otroSingapur, "Si");?> >Si</option>
	            <option value="No" <?php seleccionaOtroSingapur($otroSingapur, "No");?>>No</option>                
            </select>
        </td>
	</tr>
	<tr>
        <th align="left">Indique en qu� instituci�n:</th>
        <td colspan="3" style="vertical-align:middle">
		<input type="text" name="otraInsSingapur" size="100" id="otraInsSingapur" value="<?php echo $datos["otraInsSingapur"]; ?>"/>
        </td>
	</tr>
	<tr>
        <th align="left">Indique el tipo de capacitaci�n recibida:
        <p style="font-size:9px">(Capacitaci�n por nivel, curso general, etc.)</p></th>
        <td colspan="3" style="vertical-align:middle">
		<input type="text" name="otroTipoCapacitacion" size="100" id="otroTipoCapacitacion" value="<?php echo $datos["otroTipoCapacitacion"]; ?>"/>
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