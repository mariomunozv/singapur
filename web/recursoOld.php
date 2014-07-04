<?php 
require("inc/incluidos.php");

$idCurso = $_SESSION["sesionIdCurso"];


$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$jornadas = getJornadasCurso($idCurso);



$idRecurso = $_REQUEST["idRecurso"];



/* Registro de acceso a mi curso */
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
	
    <div id="lateralIzq">
    	<?php require("menuleft.php"); ?>
	</div>
    
    <div id="lateralDer">
		<?php require("menuright.php"); ?>
	</div>
    
     <div id="columnaCentro">
     
<p class="titulo_curso"><?php echo getNombreCurso($idCurso); ?></p>
    <hr />
    <br />


   <?php 
				 
				$datosRecurso = getRecurso($idRecurso);
//				print_r($datosRecurso);
				?>   <p align="center"><a href="subir/docs/<?php echo $datosRecurso["urlRecurso"];?>"><img src="img/documentos.png" border="0" width="128" height="128" /></a></p>
                 <p align="center">Usted a ingresado al recurso <strong><a href="subir/docs/<?php echo $datosRecurso["urlRecurso"];?>" target="_blank"><?php echo $datosRecurso["nombreRecurso"];?></a></strong>
                   <br />
                   <br />
                  
                   <a href="javascript:history.back();"><br />
                   <br />
                   
                   Volver</a></p>
				
                <?php // FIN CENTRO  ?>
    
      </div> 
    
     
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");
    
    ?>      

                
</div><!--principal-->
</body>
</html>
