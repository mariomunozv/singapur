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
$apoyoTecnico = @$datos["apoyoTecnico"];
$titulo = @$datos["titulo"];
$obtEspecializacion = @$datos["obtEspecializacion"];
$cursoCapacitacion = @$datos["cursoCapacitacion"];
$cursosImplementa = @$datos["cursosImplementa"];
$tiempoCapacitando = @$datos["tiempoCapacitando"];
$otroSingapur = @$datos["otroSingapur"];
?>


<script type="text/javascript">
function creaPDF(idUsuario)
{
	window.location.href = "creaPDF.php?idUsuario="+idUsuario;
}

function editaPerfil()
{
	window.location.href = "fichaDocenteClEdita.php";
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
	
	<div>
<div align="center">
<br/>
<p align="right" style="width:800px"><button name="pdf" id="pdf" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"  onclick="creaPDF(<?php echo $idUsuario; ?>)"><span class="ui-button-text">Exportar a PDF</span></button> &nbsp; <button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only"  onclick="editaPerfil()"><span class="ui-button-text">Editar Perfil</span></button></p>
<table border="0" class="tablesorter" style="width:800px;" id="tbGeneral">
	<tr>
    	<th colspan="4" align="center"><h1>Ficha Docente</h1></th>
    </tr>
	<tr> 
    	<th width="20%">Actualizar Imagen:</th>
	    <td align="center" colspan="3">
	    <img src="<?php echo "subir/fotos_perfil/orig_".$_SESSION["sesionImagenUsuario"]; ?>"  border="1" onerror="this.src='img/nophoto.jpg'" width="250px"/><br/><br/>
		</td>
 	</tr>
	<tr>
        <th>Nombre:</th>
        <td colspan="3"><label><?php echo $datos["nombreProfesor"]; ?></label></td>  
	</tr>
	<tr>
        <th> Apellido Paterno:</th>
        <td colspan="3"><label><?php echo $datos["apellidoPaternoProfesor"];?></label></td>
	</tr>
	<tr>
        <th>Apellido Materno:</th>
        <td colspan="3"><label><?php echo $datos["apellidoMaternoProfesor"]; ?></label></td>
	</tr>
	<tr>
		<th align="left">Nombre del establecimiento:</th>
		<td style="vertical-align:middle" width="30%"><label><?php echo $datosColegio["nombreColegio"];?></label></td>
        <th>RBD:</th>
        <td style="vertical-align:middle"><label><?php echo $datos["rbdColegio"]; ?></label></td>
	</tr>
  	<tr>
		<th>Region/Departamento: </th>
        <td colspan="3"><label><?php echo $region; ?></label></td>
	</tr>
  	<tr>
      	<th>Comuna/Ciudad: </th>
		<td colspan="3"><label><?php echo $datosColegio["nombreComuna"]; ?></label></td>
	</tr>
	<tr>
    	<th>Acerca de mi:</th>
	    <td colspan="3" style="vertical-align:middle"><label style="border:thin"><?php echo $datos["acercaDeUsuario"]?></label></td>
 	</tr>
	<tr>
    	<th>Rut/C&eacute;dula:</th>
	    <td colspan="3">
	      <label><?php echo $datos["rutProfesor"]; ?></label>
		</td>
	</tr>
	<tr>
    	<th>Fecha de Nacimiento:</th>
	    <td colspan="3" style="vertical-align:middle">
        	<label><?php echo $datos["fechaNacimientoProfesor"]?></label>
		</td>
	</tr>
	<tr>
    	<th>Correo Electr�nico:</th>
	    <td colspan="3"><label><?php echo $datos["emailProfesor"]?></label></td>
  	</tr>
	<tr>
    	<th align="left">Tel�fono del Establecimiento:</th>
	    <td style="vertical-align:middle"><label><?php echo $datosColegio["telefonoColegio"]?></label></td>
        <th width="15%">Tel�fono M�vil</th>
		<td style="vertical-align:middle"><label><?php echo $datos["telefonoProfesor"]?></label></td>
	</tr>
	<tr>
    	<th>A�os de Docencia</th>
	    <td colspan="3"><label><?php echo @$datos["anosExperienciaProfesor"]; ?></label></td>
	</tr>
	<tr>
    	<th align="left">A�os de Docencia en Establecimiento actual:</th>
	    <td style="vertical-align:middle" colspan="3"><label><?php echo @$datos["anosExperienciaEnColegio"]?></label></td>
	</tr>
	<tr>
    	<th align="left">Curso(s) en que hace clases de matem�tica durante el 2013:</th>
        <td colspan="3" style="vertical-align:middle">
        <label><?php echo $cursos;?></label>
	</tr>
	<tr>
    	<th align="left">Realiza labores de apoyo T�cnico en el establecimiento:</th>
        <td colspan="3" style="vertical-align:middle">
	        <label><?php echo $datos['apoyoTecnico']; ?></label>
         </td>
	</tr>
	<tr>
    	<th>Indique qu� t�tulo posee:</th>
        <td colspan="3" style="vertical-align:middle">
	        <label><?php echo $datos['titulo']; ?></label>
        </td>
	</tr>
	<tr>
        <th align="left">�Tiene especializaci�n en matem�ticas?:</th>
        <td colspan="3" style="vertical-align:middle">
        	<label><?php echo $especializacion ?></label>
        </td>
	</tr>
	<tr>
        <th align="left">�C�mo obtuvo la especializaci�n?:</th>
        <td colspan="3" style="vertical-align:middle">
	        <label><?php echo $datos['obtEspecializacion']; ?></label>
        </td>
	</tr>
	<tr>
        <th align="left">�En qu� instituci�n obtuvo la especializaci�n?:</th>
        <td colspan="3" style="vertical-align:middle">
	        <label><?php echo $datos['uEspecialiazcion']; ?></label>
        </td>
	</tr>
	<tr>
        <th align="left">�Indique otro perfeccionamiento que posea a nivel de Post�tulo o Postgrado:</th>
        <td colspan="3" style="vertical-align:middle">
	        <label><?php echo $datos['otroPerfeccionamiento']; ?></label>
        </td>
	</tr>
	<tr>
    	<th align="left">�Cu�nto tiempo ha trabajado con los textos del M�todo Singapur Implementando en aula la propuesta?</th>
        <td colspan="3">
			<label><?php echo $xpSingapur; ?></label>
        </td>
	</tr>
    
    <tr id="trDesplegable">
    	<th>�En qu� Nivel(es)?:</th>
        <td colspan="3">
			<label><?php echo $niveles ?></label>
		</td>
	</tr>
    <tr>
	    <th colspan="4">Capacitaci�n en el Centro Felix Klein</th>
    </tr>
	<tr>
	    <th>Indique curso en el cual se capacita actualmente:</th>
        <td colspan="3">
	        <label><?php echo $datos['cursoCapacitacion']; ?></label>
		</td>
    </tr>
    <tr>
	    <th align="left">Indique curso(s) en que implementar� en aula la propuesta del M�todo Singapur en el 2013:</th>
        <td colspan="3">
	        <label><?php echo $datos['cursosImplementa']; ?></label>
		</td>
    </tr>
	<tr>
	    <th align="left">�Cu�nto tiempo se ha capacitado en el M�todo Singapur con el Centro Felix Klein?:</th>
        <td colspan="3">
	        <label><?php echo $datos['tiempoCapacitando']; ?></label>
		</td>
    </tr>
	<tr>
	    <th>�En qu� curso(s)?:</th>
        <td colspan="3">
	        <label><?php echo $datos['cursosCapacitando']; ?></label>
		</td>
    </tr>
    <tr>
	    <th colspan="4">Capacitaci�n con otra Instituci�n</th>
    </tr>
    <tr>
	    <th>�Se ha capacitado en el M�todo Singapur con otra instituci�n?:</th>
        <td colspan="3">
	        <label><?php echo $datos['otroSingapur']; ?></label>
		</td>
    </tr>
    <tr>
	    <th>Indique en qu� instituci�n:</th>
        <td colspan="3">
	        <label><?php echo $datos['otraInsSingapur']; ?></label>
		</td>
    </tr>
    <tr>
	    <th align="left">Indique el tipo de capacitaci�n recibida:</th>
        <td colspan="3">
	        <label><?php echo $datos['otroTipoCapacitacion']; ?></label>
		</td>
    </tr>
</table>
      </div> <!--demo-->
	</div> <!--columnaCentro-->
</div> 
   
</body>
</html>