<?php 
//session_start();
require("inc/config.php");
require("../inc/_detalleColegioProyecto.php");
require("../inc/_usuario.php");
require("../inc/_profesor.php");
require("../inc/_empleadoKlein.php");




require("_head.php");
$menu = "ini";
require("_menu.php"); 
$navegacion = "Inicio*inicio.php";
require("_navegacion.php");
 


/*if($_REQUEST["modo"] == "aceptar"){
	$sql = "update evaluacion set eva_decision = 'A', eva_recepcionado = '".date("Y-m-d")."' where eva_id = '".$_REQUEST["eva"]."' ";
	$res = mysql_query($sql);
}
if($_REQUEST["modo"] == "rechazar"){
	$sql = "update evaluacion set eva_decision = 'R', eva_recepcionado = '".date("Y-m-d")."' where eva_id = '".$_REQUEST["eva"]."' ";
	$res = mysql_query($sql);
}*/
?>
<script language="javascript">


class_activo('boton_accesos','activo');

</script>
<span class="titulo_form">Adminitracion Sistema</span>
<?php
 function getAccesos(){
			  	$sql = "SELECT * FROM `accesoRecurso` a left join tipoRecursoObservado b on a.idTipoRecursoObservado = b.idTipoRecursoObservado ORDER BY fechaAccesoRecurso DESC";
				echo $sql;
				$res = mysql_query($sql);
				$i =0;
					while ($row = mysql_fetch_array($res)) {
						if ($row["idLinkAccesoRecurso"] != ""){
							if ($row["idTipoRecursoObservado"] == 9){ // RECURSO
								$nombreRecurso = getNombreRecurso($row["idLinkAccesoRecurso"]);
								}
							if (($row["idTipoRecursoObservado"] == 11) || ($row["idTipoRecursoObservado"] == 12)){ // LECTURA ENVIO FORO
							  $nombreRecurso = getNombreForo($row["idLinkAccesoRecurso"]);
								}
								
							
							}else{
							$nombreRecurso = "";	
						}
						$acceso[$i] = array(
						"idAccesoRecurso" => $row["idAccesoRecurso"],
						"idUsuario" => $row["idUsuario"],
						"idTipoRecursoObservado" => $row["idTipoRecursoObservado"],
						"fechaAccesoRecurso" => $row["fechaAccesoRecurso"],
						"nombreRecursoObservado" => $row["nombreRecursoObservado"],
						"categoriaRecursoObservado" => $row["categoriaRecursoObservado"],
						"nombreRecurso" => $nombreRecurso
						);	
					$i++;
					}
					
					return($acceso);
		 }
			  
			  function getNombreRecurso($idRecurso){
					  $sql = "SELECT * FROM recurso WHERE idRecurso = ".$idRecurso;
					  //echo $sql;
					  $res = mysql_query($sql);
					  $row = mysql_fetch_array($res);
					  $nombre = $row["nombreRecurso"];
					  return ($nombre);
				  }
			 function getNombreForo($idTema){
					  $sql = "SELECT * FROM tema WHERE idTema = ".$idTema;
					  //echo $sql;
					  $res = mysql_query($sql);
					  $row = mysql_fetch_array($res);
					  $nombre = $row["tituloTema"];
					  return ($nombre);
				  }
				  
	      $acceso = getAccesos();
		 // print_r($acceso);
		// echo $acceso[0]["idAccesoRecurso"]."<--";		  
		  ?>
                
                <table id="tabla" class="tablesorter"> 
                <thead> 
                    <tr> 
                    <th>ID</th> 
                    <th>Usuario</th>  
                    <th>Fecha</th> 
                    <th>Categoria</th>
        
                    <th>Tipo Acceso</th>
                    <th>Detalle</th>  
                    <th colspan="2">Opciones</th> 
                    </tr> 
                </thead> 
                <tbody> 
                <?php $i=0;
				   foreach ($acceso as $value){
					  
					   ?> 
                        <tr valign="top"> 
                            <td ><?php echo $value["idAccesoRecurso"]; ?></td>
                            <?php 
							$datosUsuario = getNombreUsuario($value["idUsuario"]);
							?>
                             
                            <td ><?php echo $datosUsuario["nombre"]." ".$datosUsuario["apellidoPaterno"]; ?></td>  
                            <td ><?php echo $value["fechaAccesoRecurso"]; ?></td> 
                            <td ><?php echo $value["nombreRecursoObservado"]; ?></td> 
                            <td ><?php echo $value["categoriaRecursoObservado"]; ?></td> 
                            <td ><?php echo $value["nombreRecurso"]; ?></td>  		
                            <td width="50"><a href="prv_editar.php?id=<?php echo $value["idAccesoRecurso"]; ?>"><img src="css/btn/editar.gif" border="0"></a></td>
                
                            <td width="70"><a href="javascript:eliminar(<?php echo $value["idAccesoRecurso"]; ?>);"><img src="css/btn/cancelar.gif" border="0"></a></td> 
                        </tr>
                <?php $i++;
				}?>    
                    </tbody> 
                </table> 
                <div id="pager" class="pager">
                    <form>
                        <img src="css/tabla/first.png" class="first"/>
                        <img src="css/tabla/prev.png" class="prev"/>
                        <input type="text" class="pagedisplay"/>
                        <img src="css/tabla/next.png" class="next"/>
            
                        <img src="css/tabla/last.png" class="last"/>
                        <input type="hidden" class="pagesize" value="20"><?php /* Registros por paginas */ ?> 
                    </form>
                </div>

                
                
		</td>
    
        
      
      </tr>
    </table>  


<?php require("_pie.php"); ?>
