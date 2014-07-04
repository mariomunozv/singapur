<?php 
session_start();
include("../metodosingapur/inc/funciones.php");
include "../metodosingapur/inc/conecta.php";
include ("sesion/sesion.php");
Conectarse_seg(); 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<link href="css/custom-theme/jquery-ui-1.8rc3.custom.css" type="text/css" rel="stylesheet" />	
<link href="css/botones.css" rel="stylesheet" type="text/css" />
<link href="css/tabla.css" rel="stylesheet" type="text/css" />
<link href="css/estilos.css" rel="stylesheet" type="text/css" />
 
<script type="text/javascript" src="js/jquery-ui-1.8rc3.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>  
<script type="text/javascript" src="js/main.js"></script> 
<script type="text/javascript" src="js/pngfix.js"></script>   
<script type="text/javascript" src="js/tag.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>    
<script type="text/javascript" src="js/validarut.js"></script>


<title>Pensar sin L&iacute;mites</title> 
</head>

<script language="javascript">
$(function() {
	<?php /* Asi inicializas tablesorter */ ?>	   
	$("#tabla").tablesorter({ 
		headers: {  
			6: { sorter: false },
			6: { sorter: false }  // Esto es para inabilitar el filtro en una columna
		},
		widthFixed: true,
		widgets: ['zebra']}).tablesorterPager({
			container: $("#pager"),
			positionFixed: false,
			size:20 //Numero de registros tb
			});  
}); 
</script>

<body>
<div id="principal">
	<?php require("menu.php");?>
	<?php 
		  function getAccesos(){
			  	$sql = "SELECT * FROM `accesoRecurso` a left join tipoRecursoObservado b on a.idTipoRecursoObservado = b.idTipoRecursoObservado ORDER BY fechaAccesoRecurso DESC";
				//echo $sql;
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
							$datosUsuario = getNombreFotoUsuarioProfesor($value["idUsuario"]);
							?>
                             
                            <td ><?php echo $datosUsuario["nombreProfesor"]." ".$datosUsuario["apellidoPaternoProfesor"]; ?></td>  
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
	<div id="pie">Avda. Schatchtebeck Nº 4 (Zócalo Biblioteca Central) • Estación Central • Santiago • Chile • Teléfono (562) 718 20 84 • www.grupoklein.cl</div>
</div>
</body>
</html>
