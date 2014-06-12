<?php 
ini_set("display_errors","on");
require("inc/incluidos.php");

$idCurso = $_SESSION["sesionIdCurso"];


$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$jornadas = getJornadasCurso($idCurso);



$idRecurso = $_REQUEST["idRecurso"];
$datosRecurso = getRecurso($idRecurso);



/* Registro de acceso a un recurso */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 9, $idRecurso);


require ("hd.php");?>
<script>
function registraMuestra(link,idRecurso){
	
	//alert(link+"--"+idRecurso);
	location.target="n";
	
	
	location.href='recurso.php?idRecurso='+idRecurso;
	
	}	
</script>

<body>
<div id="principal">
<?php require("topMenu.php"); ?>
<?php
$nombreCurso = getNombreCortoCurso($_SESSION["sesionIdCurso"]);
$navegacion = "Home*home.php,".$nombreCurso."*curso.php?idCurso=".$_SESSION["sesionIdCurso"].",".$datosRecurso["nombreRecurso"]."*#";
require("_navegacion.php");
?>
	<div id="lateralIzq">
	    <?php require("menuleft.php");	?>
    </div>

	<div id="lateralDer">
    	<?php require("menuright.php");	?>
	</div>
    
    <div id="columnaCentro">
     
<p class="titulo_curso"><?php echo getNombreCurso($idCurso); ?></p>
    <hr />
    <br />


   <?php 
				 
				
//				print_r($datosRecurso);
				?>   
                 <p align="center">Usted ha ingresado al recurso:<br>
                 <strong><?php echo $datosRecurso["nombreRecurso"];?></strong>                 
                 <?php getLinkRecursoDownload($idRecurso); ?>
                   <br />
                   <br />
                   
				<?php
				$archivo = "subir/docs/".$datosRecurso["urlRecurso"];
				$path_parts = pathinfo($archivo);

				$ext = strtolower($path_parts["extension"]);
				// Determine Content Type
				$largo_ancho = ""; 
				switch ($ext) {
				  case "pdf": $ctype="application/pdf"; $largo_ancho = 'width="570" height="700"'; break;
				  case "zip": $ctype="application/zip"; break;
				  case "rar": $ctype="application/x-rar-compressed";break;
				  case "doc": $ctype="application/msword"; break;
				  case "docx": $ctype="application/msword"; break;
				  case "xls": $ctype="application/vnd.ms-excel"; break;
				  case "xlsx": $ctype="application/vnd.ms-excel"; break;
				  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
				  case "pptx": $ctype="application/vnd.ms-powerpoint"; break;
				  case "gif": $ctype="image/gif"; break;
				  case "png": $ctype="image/png"; break;
				  case "jpeg": $ctype="image/jpg"; break;
				  case "jpg": $ctype="image/jpg"; break;
				  case "mp3": $ctype="audio/mpeg3"; break;
				  case "wmv": $ctype="video/x-ms-wmv"; $largo_ancho = 'width="570" height="500"'; break;
				  
				  default:  die ( "Archivo invalido." ); 
    }                
                ?>
                  <embed src="subir/docs/<?php echo $datosRecurso["urlRecurso"];?>" type="<?php echo $ctype; ?>" <?php echo $largo_ancho; ?>>
					<br />
                   <br />
				
                <?php boton("Volver","history.back();"); ?>
    
      </div> 
    
     
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->
</body>
</html>
