
<?php 
session_start();
include "inc/conectav10.php";
include "inc/funciones.php";
@$idUsuario = $_SESSION["sesionIdUsuario"];
@$nombre =  $_SESSION["sesionNombreUsuario"];
Conectarse(); 

include "inc/_actividad.php";
include "inc/_pauta.php";
include "inc/_colegio.php";




function getSeccionesFormulario($idFormulario){
		
	$sql = "SELECT * FROM seccionFormulario  WHERE idFormulario = '$idFormulario' ORDER BY idSeccionFormulario ASC";
	//echo $sql;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idSeccionFormulario"=> $row["idSeccionFormulario"],
			"tituloSeccionFormulario"=> $row["tituloSeccionFormulario"]
			);
		$i++;
	}
	return($arreglo);
}





function getItemsSeccion($idSeccion){
	$sql = "SELECT * FROM detalleSeccionEnunciado a join enunciado b  on a.idEnunciado = b.idEnunciado WHERE  a.idSeccionFormulario  = ".$idSeccion;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$items[$i] = array(
			"idEnunciado"=> $row["idEnunciado"],
			"textoEnunciado"=> $row["textoEnunciado"],
			"esAbiertaEnunciado"=> $row["esAbiertaEnunciado"]
			
		);
		$i++;
	}
	return($items);
	}

function getUsuariosContestan($idFormulario){
	$sql = "SELECT DISTINCT (a.idUsuario), a.idPauta,a.idFormulario,c.nombreDirectivo,c.apellidoPaternoDirectivo,c.rbdColegio FROM pauta ";
	$sql.=" a join usuario b on a.idUsuario = b.idUsuario join directivo c on b.rutDirectivo = c.rutDirectivo ";
	
	$sql.=" WHERE a.idFormulario = 7 and b.visibleUsuario = 1 group by a.idUsuario order by c.rbdColegio ";
//	$sql = "SELECT * FROM detalleSeccionEnunciado a join enunciado b  on a.idEnunciado = b.idEnunciado WHERE  a.idSeccionFormulario  = ".$idSeccion;
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$usuarios[$i] = array(
			"idUsuario"=> $row["idUsuario"],				  
			"nombreDirectivo"=> $row["nombreDirectivo"],
			"apellidoPaternoDirectivo"=> $row["apellidoPaternoDirectivo"],
			"rbdColegio"=> $row["rbdColegio"]
			
		);
		$i++;
	}
	return($usuarios);
	}

	

		
function getRespuestaUsuarioIdEnunciado($idEnunciado,$idUsuario){
	$sql = "SELECT * FROM respuesta WHERE idEnunciado = ".$idEnunciado." AND idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$respuesta = $row["valorSeleccionada"];
	return($respuesta);
	}


$idUsuario = $_REQUEST["idUsuario"];


$usuarios = getUsuariosContestan($idFormulario);

$idActividad = $_REQUEST["idActividad"];
	
$idPauta = $_REQUEST["idPauta"];

$idFormulario = $_REQUEST["idFormulario"];

$usuarios = getUsuariosContestan($idFormulario);
	
$seccionFormulario = getSeccionesFormulario($idFormulario);
	
///////// SEGURIDAD ////////////////
// Menor que APE y idUsuario de GET es distinto a idUsuario de SESSION
if ($_SESSION["sesionPerfilUsuario"] < 5 && $_REQUEST["idUsuario"] != $_SESSION["sesionIdUsuario"]){ 
	
	alerta("No puedes acceder a esta página.");
	dirigirse_a("../home.php");
}


////// ACTUALIZACION NOTIFICACION
/* Se actualiza el estado de notificacion en caso de entrar a traves de las notificaciones */
if (isset($_REQUEST["idNotificacion"])){
	$idNotificacion = $_REQUEST["idNotificacion"];
	actualizaEstadoNotificacion($idNotificacion);
}
	
	
	$listaItem = array();
	$i=0;
	foreach ($seccionFormulario as $seccion){
		$items = getItemsSeccion($seccion["idSeccionFormulario"]);
		foreach ($items as $item){
			$listaItem[$i] = $item;
			$i++;
			}
	
		}
	
		$contestada = 1;
	

$datosActividad = getDatosActividad($_REQUEST["idActividad"]);	
	


require ("hd.php");?>

<body>


	
     
        <p class="titulo_curso">Informe de Actividad UTP
 <?php echo getNombreUsuario($idUsuario);?></p>
      
<table class="tablesorter">
<tr>
<td>&nbsp;</td>
  
    <?php foreach ($usuarios as $usuario){
		$colegio = getDatosColegio($usuario["rbdColegio"]);
		
		
		?>

                <td><?php echo $colegio["nombreColegio"];?></td>

  <?php // echo getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario); ?></textarea>
                <?php } ?>

</tr>
<tr>
	<td>&nbsp;</td>
  
    <?php foreach ($usuarios as $usuario){
		$colegio = getDatosColegio($usuario["rbdColegio"]);
		
		
		?>

                <th><?php echo getNombreUsuario($usuario["idUsuario"]);?></th>

  <?php // echo getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario); ?></textarea>
                <?php } ?>
</tr>




                <input name="idFormulario" class="campos" id="idFormulario" type="hidden" value="<?php echo $idFormulario;?>">	
                <?php foreach ($listaItem as $item){?>
                <tr>
                <td><?php echo $item["textoEnunciado"];?></td>
                
                 <?php foreach ($usuarios as $usuario){
		$colegio = getDatosColegio($usuario["rbdColegio"]);
		
		
		?>

                <td><?php echo getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$usuario["idUsuario"]); ?></td>

  <?php // echo getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario); ?></textarea>
                <?php } ?>
                
                </tr>  	
  <?php // echo getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario); ?></textarea>
                <?php } ?>


         
       <?php //  require("misCursos.php");?>
     
               
    
   
                



</body>
</html>
