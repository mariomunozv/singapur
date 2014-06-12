
<?php 
require("inc/incluidos.php");

include "inc/_actividad.php";
include "inc/_pauta.php";




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
			"esAbiertaEnunciado"=> $row["esAbiertaEnunciado"],
			"tipoInputEnunciado" => $row["tipoInputEnunciado"]
			
		);
		$i++;
	}
	return($items);
	}

	

		
function getRespuestaUsuarioIdEnunciado($idEnunciado,$idUsuario){
	$sql = "SELECT * FROM respuesta WHERE idEnunciado = ".$idEnunciado." AND idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$respuesta = $row["valorSeleccionada"];
	return($respuesta);
	}


$idUsuario = $_REQUEST["idUsuario"];






	$idActividad = $_REQUEST["idActividad"];
	
	$idPauta = $_REQUEST["idPauta"];
	
	$idFormulario = getIdFormulario($_REQUEST["idPauta"]);
	
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

<script type="text/javascript">

function nuevo_comentario(){
	
	 var division = document.getElementById("comentario");
	 a = "tablaComentario=formulario"+"&idReferenciaComentario="+<?php echo $idPauta; ?>+"&idUsuarioNotificado="+<?php echo $idUsuario; ?>+"&idActividad="+<?php echo $idActividad; ?>;
	 AJAXPOST("informeActividadComentarioNuevo.php",a,division);
	
}

function listado_comentarios(){
	
	 var division = document.getElementById("listado_comentarios");
	 a = "tablaComentario=formulario"+"&idReferenciaComentario="+<?php echo $idPauta; ?>;
	 AJAXPOST("informeActividadComentarioListado.php",a,division);
	
}
</script>

<body>
<div id="principal">
<?php require("topActividad.php"); ?>
	
 
    
    
    
   
    
	<div id="columnaCentro">
     
        <p class="titulo_curso">Informe de Actividad Coordinadores Pedagógicos <br>
 <?php echo getNombreUsuario($idUsuario);?></p>
        <hr />
      

        
        
        <?php 
		
		 ?>
        	
        
                <input name="idFormulario" class="campos" id="idFormulario" type="hidden" value="<?php echo $idFormulario;?>">	
                	<?php 
					foreach ($listaItem as $item){
					//print_r($item);
					
					?>
						<?php 
                        echo $item["textoEnunciado"];
                        
                        ?>
                      	<br><br>
                      	<?php 
						$respuestaItem = getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario);
						
					  	if ($item["esAbiertaEnunciado"] == 1){
						
						
					  	?>
   							<textarea name="item<?php echo $item["idEnunciado"];?>" id="item<?php echo $item["idEnunciado"];?>"  name="nombre" cols="60" rows="5" class="campos" disabled='disabled'><?php  echo $respuestaItem; ?></textarea>
                            <br>
                		<?php 
						} 
						else{
							if($item["tipoInputEnunciado"] == "file" && $respuestaItem != ""){
								
								?>
                                
								<img border="0" src="img/ppt.gif" width="16" height="16">
                                <a href="subir/archivos_act/<?php  echo $respuestaItem; ?>"><strong>Ver archivo</strong></a>
                                <br><br>
	
                              <?php
							}
						}				
				
					} //foreach
             
			 
			
			
		
		?>
        
       
      
      
        
       	<div id="carga"></div> 
       	<br><br>
       	
        
        <div id="listado_comentarios"></div>
        
        <div id="comentario"></div>
        
		<script type="text/javascript">
		listado_comentarios();
		</script>        
        
      </div><!--columnaCentro-->
         
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->


</body>
</html>
