<?php 
require("inc/incluidos.php");
require ("hd.php");

$idUsuarioPerfil = $_REQUEST["idUsuario"];

$datos =getDatosProfesor($idUsuarioPerfil);
$datosColegio = getDatosColegio($datos["rbdColegio"]);
$region = getRegion($datosColegio["idComuna"]);
?>

<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Perfil*#";	
	require("_navegacion.php");

?>
	
    <div id="lateralIzq">
    <?php require("menuleft.php");	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
    <?php require("menuright.php");	?>
    </div><!--lateralDer-->
    
    
    
	<div id="columnaCentro">
     	<p class="titulo_curso"><?php echo getNombreUsuario($idUsuarioPerfil); ?></p>
        <hr />
    <table border="0" class="tablesorter" style="width:100%;" id="tbGeneral">
	<tr>
    	<th colspan="4" align="center"><h1>Ficha Docente</h1></th>
    </tr>
	<tr> 
	    <td align="center" colspan="4">
	    <img src="<?php echo "subir/fotos_perfil/orig_$idUsuarioPerfil.jpg"; ?>"  border="1" onerror="this.src='img/nophoto.jpg'"/><br/><br/>
        </td>
 	</tr>
	<tr>
        <th>Nombre:</th>
        <td colspan="3"><label style="font-size:14px"><?php echo $datos["nombreProfesor"]; ?></label></td>
	</tr>
	<tr>
        <th> Apellido Paterno:</th>
        <td colspan="3"><label style="font-size:14px"><?php echo $datos["apellidoPaternoProfesor"]; ?></label></td>
	</tr>
	<tr>
        <th>Apellido Materno:</th>
        <td colspan="3"><label style="font-size:14px"><?php echo $datos["apellidoMaternoProfesor"]; ?></label></td>
	</tr>
	<tr>
		<th align="left">Nombre del establecimiento:</th>
        <td colspan="3"><label style="font-size:14px"><?php echo $datosColegio["nombreColegio"]; ?></label></td>        
    </tr>
  	<tr>
		<th>Region/Departamento: </th>
		<td colspan="3"><label style="font-size:14px"><?php echo $region; ?></label></td>        
	</tr>
  	<tr>
      	<th>Comuna/Ciudad: </th>
		<td colspan="3"><label style="font-size:14px"><?php echo $datosColegio["nombreComuna"]; ?></label></td>        
	</tr>
	<tr>
    	<th width="30%">Acerca de mi:</th>
	    <td colspan="3" style="vertical-align:middle">
		<label style="font-size:14px"><?php echo $datos["acercaDeUsuario"]?></label>
        </td>
 	</tr>
    </table>
  
	<p align="right">
		<?php boton("Volver","history.go(-1)");?>
	</p>
</div> <!--columnaCentro-->

	<?php 
    	
		require("pie.php");
		
    ?> 
   </div>
</body>
</html>
