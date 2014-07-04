<?php
require("inc/incluidos.php");
$idUsuarioPerfil = $_REQUEST["idUsuario"];
$datos =getDatosProfesor($idUsuarioPerfil);
$datosColegio = getDatosColegio($datos["rbdColegio"]);
$region = getRegion($datosColegio["idComuna"]);
$cursos = @$datos["cursoActual"];
$niveles = @$datos["nivelExperienciaSingapur"];
$xpSingapur = @$datos["experienciaSingapur"];
$especializacion= @$datos["especializacion"];
?>

<html>
<body>
	<table id="tbGeneral" style="width:100%;" border="1">
	<tr>
    	<th colspan="2" style="text-align:center; width:100%"><h1>Ficha Docente</h1></th>
    </tr>
	<tr>
        <th style="width:25%"> Nombre:</th>
		<td style="width:75%"><label style="font-size:14px"><?php echo $datos["nombreProfesor"]."<br/>"; ?></label></td>
	</tr>
	<tr>
        <th style="width:25%"> Apellido Paterno:</th>
		<td style="width:75%"><label style="font-size:14px"><?php echo $datos["apellidoPaternoProfesor"]; ?></label></td>
	</tr>
	<tr>
        <th style="width:25%">Apellido Materno:</th>
		<td style="width:75%"><label style="font-size:14px"><?php echo $datos["apellidoMaternoProfesor"]; ?></label></td>
	</tr>
	<tr>
		<th style="width:25%">Nombre del establecimiento:</th>
		<td style="width:75%"><label style="font-size:14px"><?php echo $datosColegio["nombreColegio"]; ?></label></td>        
    </tr>
    <tr>
        <th style="width:25%">RBD:</th>
		<td style="width:75%"><label style="font-size:14px"><?php echo $datos["rbdColegio"]; ?></label></td>        
	</tr>
  	<tr>
        <th style="width:25%">Region/Departamento: </th>
		<td style="width:75%"><label style="font-size:14px"><?php echo $region; ?></label></td>        
	</tr>
  	<tr>
        <th style="width:25%">Comuna/Ciudad: </th>
		<td style="width:75%"><label style="font-size:14px"><?php echo $datosColegio["nombreComuna"]; ?></label></td>        
	</tr>
	<tr>
        <th style="width:25%">Acerca de mi:</th>
		<td style="width:75%">
		<label style="font-size:14px"><?php echo $datos["acercaDeUsuario"]?></label>
        </td>
 	</tr>
    <tr>
        <th style="width:25%">Rut/Cédula:</th>
		<td style="width:75%">
	    <label><?php echo $datos["rutProfesor"]; ?></label>
        </td>
 	</tr>
<tr>
        <th style="width:25%">Fecha de Nacimiento:</th>
	    <td style="width:75%">
        	<label><?php echo $datos["fechaNacimientoProfesor"]?></label>
		</td>
	</tr>
	<tr>
    	<th style="width:25%">Correo Electrónico:</th>
	    <td style="width:75%"><label><?php echo $datos["emailProfesor"]?></label></td>
  	</tr>
	<tr>
    	<th style="width:25%">Teléfono del Establecimiento:</th>
	    <td style="width:75%"><label><?php echo $datosColegio["telefonoColegio"]?></label></td>
	</tr>
	<tr>
        <th style="width:25%">Teléfono Móvil</th>
		<td style="width:75%"><label><?php echo $datos["telefonoProfesor"]?></label></td>
	</tr>
	<tr>
    	<th style="width:25%">Años de Docencia</th>
	    <td style="width:75%"><label><?php echo @$datos["anosExperienciaProfesor"]; ?></label></td>
	</tr>
	<tr>
		<th style="width:25%">Años de Docencia en Establecimiento actual:</th>
	    <td style="width:75%"><label><?php echo @$datos["anosExperienciaEnColegio"]?></label></td>
	</tr>
	<tr>
    	<th style="width:25%">Curso(s) en que hace clases de matemática durante el 2013:</th>
        <td style="width:75%"><label><?php echo $cursos;?></label></td>
	</tr>

	<tr>
        <th style="width:25%">¿Tiene especialización en matemáticas?:</th>
		<td style="width:75%">
        	<label><?php echo $especializacion ?></label>
        </td>
	</tr>
	<tr>
    	<th style="width:25%">¿Cuánto tiempo ha trabajado con los textos del Método Singapur Implementando en aula la propuesta?</th>
        <td style="width:75%">
			<label><?php echo $xpSingapur; ?></label>
        </td>
	</tr>
    
    <tr id="trDesplegable">
    	<th style="width:25%">¿En qué Nivel(es)?:</th>
		<td style="width:75%">
			<label><?php echo $niveles ?></label>
		</td>
	</tr>
    </table>
</body>
</html>