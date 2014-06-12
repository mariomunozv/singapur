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
	
		  function getNombreFormulario($idFormulario){
			  $sql = "SELECT * FROM formulario WHERE idFormulario = ".$idFormulario;
			  $res = mysql_query($sql);
			  $row = mysql_fetch_array($res);
			 
			  return ($row["nombreFormulario"]);
			  
			 }
	
		  function getPautasUsuario($idUsuario){
			  
		
			 // echo $idUsuario."<--------------------";
			  	$sql = "SELECT * from pauta WHERE idUsuario = ".$idUsuario;
				
				//echo $sql;
				$res = mysql_query($sql);
				$i =0;
					while ($row = mysql_fetch_array($res)) {
						
						$nombreFormulario = getNombreFormulario($row["idFormulario"]);
						$respuestaPauta[$i] = array(
						"nombreFormulario" => $nombreFormulario,							
						"idFormulario" => $row["idFormulario"],
						"idPauta" => $row["idPauta"],
						"fechaRespuestaPauta" => $row["fechaRespuestaPauta"]
						);	
					$i++;
					}

					return(@$respuestaPauta);
		 }
$idUsuario = $_REQUEST["idUsuario"];			  
$datosUsuario = getNombreFotoUsuarioProfesor($idUsuario);	


		   

		// echo $acceso[0]["idAccesoRecurso"]."<--";		  
		  ?>
               <img src="<?php echo "../metodosingapur/".$datosUsuario["imagenUsuario"];?>"  align="left" width="50" height="46"/><h1><?php echo $datosUsuario["nombre"]." ".$datosUsuario["apellidoPaterno"]; ?></h1>
                <table id="tabla" class="tablesorter"> 
                <thead> 
                    <tr> 
                    <th>IDFORM</th> 
                    <th>PAUTA</th>  
                    <th>NOMBRE FORM</th> 
                    <th>FECHA</th>
        
                    <th>Tipo Acceso</th>
                    <th>Detalle</th>  
                    </tr> 
                </thead> 
                <tbody> 
                <?php 
				
				$pautaUsuario = getPautasUsuario($idUsuario);
				if ($pautaUsuario == ""){
					echo "<tr  valign='middle' height='50'><td colspan='7' align='center'><strong>ESTE USUARIO NO POSEE REGISTROS</strong></td></tr>";
			   }else{	  
	   			   
			   
				
				$i=0;
				   foreach ($pautaUsuario as $value){
					  
					   ?> 
                        <tr valign="top"> 
                            <td ><?php echo $value["idFormulario"]; ?></td>
                            <?php 
							
							?>
                             
                            <td ><?php echo $value["idPauta"]; ?></td>  
                            <td ><?php echo $value["nombreFormulario"]; ?></td> 
                            <td ><?php echo $value["fechaRespuestaPauta"]; ?></td> 
                                                       <td colspan="2"><?php echo "Ver detalle"; ?></td>  		
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
                <?php }?> 

                
                
</td>
    
        
      
      </tr>
    </table>  

<?php require("_pie.php"); ?>
