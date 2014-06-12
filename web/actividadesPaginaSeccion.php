
<?php 
require("inc/incluidos.php");

include "inc/_actividad.php";



function getIdFormularioPagina($idPagina){
	$sql ="SELECT * FROM formulario WHERE idActividadPagina = ".$idPagina;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return($row["idFormulario"]);
	}


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

function getItemSeccion($idSeccion){
		
	$sql = "SELECT * FROM detalleSeccionEnunciado  WHERE  idSeccionFormulario  = '$idSeccion' ORDER BY idSeccionFormulario ASC";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idEnunciado"=> $row["idEnunciado"]
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
	if ($i == 0){
		$items = array();	
	} 
	return($items);
	}

function cuentaPautasFormulario($idFormulario, $idUsuario){
	$sql= "SELECT COUNT(*) AS cont
			FROM pauta
			WHERE idFormulario = $idFormulario
			AND idUsuario = $idUsuario";
			//echo $sql;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
}

function cuentaRestpuestaItem($idEnunciado, $idUsuario){
	$sql= "SELECT COUNT(*) AS cont
			FROM respuesta
			WHERE idEnunciado = $idEnunciado
			AND idUsuario = $idUsuario";
			
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	return $row["cont"];
}

	
function getDatosPaginaContenido($idPagina){
	$sql ="SELECT * FROM actividadPagina a join contenidosPagina b on a.idActividadPagina = b.idActividadPagina WHERE a.idActividadPagina = ".$idActividad." ORDER BY b.ordenContenidoPagina ASC";
	$res = mysql_query($sql);
	$i=0;
	while($row = mysql_fetch_array($res)){
			$datosContenidos[$i] = array(
			"textoContenidoPagina"=> $row["textoContenidoPagina"],
			"ordenContenidoPagina"=> $row["ordenContenidoPagina"],
			"nombreTipoContenidoPagina" => $row["nombreTipoContenidoPagina"],
			"idTipoContenidopagina" => $row["idTipoContenidopagina"],
			"estiloTipoContenidoPagina" => $row["estiloTipoContenidoPagina"]);
			
			$i++;	
	}
	if ($i == 0){
		$datosContenidos[$i] = array();	
	} 
	return($datosContenidos);
	}
		
function getRespuestaUsuarioIdEnunciado($idEnunciado,$idUsuario){
	$sql = "SELECT * FROM respuesta WHERE idEnunciado = ".$idEnunciado." AND idUsuario = ".$idUsuario;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	$respuesta = $row["valorSeleccionada"];
	return($respuesta);
	}

$idCurso = $_SESSION["sesionIdCurso"];
$idUsuario = $_SESSION["sesionIdUsuario"];
$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$paginas = $_SESSION["paginasActividad"];
$j = $_SESSION["j"];




if($paginas[$j]["tipoActividadPagina"] == "Seccion"){
	//$idFormulario = getIdFormularioPagina($paginas[$j]["idActividadPagina"]);
	$idFormulario = 7;
	$_SESSION["idFormulario"] = $idFormulario;
	$seccionFormulario = getSeccionesFormulario($idFormulario);
	$items = getItemsSeccion($paginas[$j]["nombreActividadPagina"]);
	$i=0;
	foreach ($items as $item){
			$listaItem[$i] = $item;
			$i++;
	}
	$_SESSION["listaItem"] = $listaItem;
	

}

	


require ("hd.php");?>

<body>
<div id="principal">
<?php require("topActividad.php"); ?>
	
 <?php 
 
 
 $items = getItemsSeccion($paginas[$j]["nombreActividadPagina"]);
 
 
	 
 ?>
    
    
    
   
    
	<div id="columnaCentro">
     
        <p class="titulo_curso"><?php  echo "Actividad 2"; ?></p>
        <hr />
        
	<input name="tipoActividad" class="campos" id="tipoActividad" type="hidden" value="<?php echo $paginas[$j]["tipoActividadPagina"];?>">
  
        
           <input name="idSeccion" class="campos" id="idSeccion" type="hidden" value="<?php echo $paginas[$j]["nombreActividadPagina"];?>">
        
        <?php 
		if($paginas[$j]["tipoActividadPagina"] == "Seccion"){?>
		<?php ?>
        	
        
                <input name="idFormulario" class="campos" id="idFormulario" type="hidden" value="<?php echo $idFormulario;?>">	
                <?php foreach ($items as $item){?>
                
						<?php 
						if(cuentaRestpuestaItem($item["idEnunciado"],$idUsuario)==0){
  	
								$contestada = 0;
						}else{
							$contestada = 1;
							
						}
						
						if($contestada==1 ){
                            info("Ya has enviado este item.");
                        } 
						?>
                      <?php echo $item["textoEnunciado"];?><br> 
                     
  
   <textarea name="item<?php echo $item["idEnunciado"];?>" id="item<?php echo $item["idEnunciado"];?>" name="nombre" cols="60" rows="5" class="campos" <?php if ($contestada == 1){ echo"disabled='disabled'";}?>><?php if ($contestada == 1){ echo getRespuestaUsuarioIdEnunciado($item["idEnunciado"],$idUsuario);}?></textarea>
   <br>
                <?php }
             
			 
			
			
		}
		?>
        
       
      
       <p align="right"><?php boton("Siguiente","continuar();");?></p>
        
       <div id="carga"></div> 
        
      </div><!--columnaCentro-->
           <input name="contestada" class="campos" id="contestada" type="hidden" value="<?php echo $contestada;?>">
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->

<script>
function continuar(){  
		<?php 
		
		
		foreach ($items as $item){?>
		if(val_obligatorio("item<?php echo $item["idEnunciado"];?>") == false){ return; } // CAMPOS
		<?php }?>
		
		var division = document.getElementById("carga");
		var a = $(".campos").fieldSerialize(); 
		
		AJAXPOST("actividadesPaginaSiguienteSeccion.php",a,division);  
	}

</script>
</body>
</html>
