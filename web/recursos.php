<?php 
require("inc/incluidos.php");

$idCurso = $_REQUEST["idCurso"];
$_SESSION["sesionIdCurso"] = $idCurso; 
$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$jornadas = getJornadasRecurso($idCurso);

/* Registro de acceso a mi curso */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 2, 'NULL'); 
$datosCurso2 = getDatosCurso($_SESSION["sesionIdCurso"]);
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
<?php 
	require("topMenu.php");
	$navegacion = "Home*curso.php?idCurso=$idCurso,Recursos*#";
	require("_navegacion.php")


 ?>
    <div id="lateralIzq">
    
    <?php 
		require("menuleft.php");
	?>
	</div>
    
    
    
     <div id="lateralDer">
    <?php 		
		require("menuright.php");
	?>
    
    
    </div><!--lateralDer-->
    
     <div id="columnaCentro" >
     
<p class="titulo_curso"><?php echo getNombreCurso($idCurso); ?></p>
    <hr />
    <br />
<?php 

$descripcionTotal = $datosCurso2["descripcionCursoCapacitacion"];
$descripcion =  explode("#", $descripcionTotal);


?>
<div id="textoBienvenida">
<p class="textoBienvenida"><?php echo nl2br($descripcion[2]);?></p>
<br />

</div>

 
<?php 

$i = 0;
	foreach ($jornadas as $value){	   
	$i++; ?>  

        <div id="cajaCentralFondo" >
        <div id="cajaCentralTop">
        	<p class="titulo_jornada">
			<?php 
                echo @$value["nombreJornada"];
            ?>
            </p>
    	</div>
        
        <div id="textoJornada">
			<?php echo @nl2br($value["descripcionJornada"]);?>
		</div>
        <br>
    	

            <ul >
                <li>
				   <?php 
                   for ($i = 1; $i <= 6; $i++){
                   
                   ?>
                       
                       
                       <ul >
                        <?php @$recursos = getTiposRecursosJornada($value["idJornada"],$idPerfil,$i);
							//print_r($recursos);
						
									if (count($recursos) > 0){ 
										
									?>
                                    
                                        <li><?php echo getNombreAtributoDeTabla($i,"TipoRecurso")  ?>
                                            <ul>
                                                <?php foreach ($recursos as $rec){	?>
                                                         <li><?php echo $rec["nombreRecurso"];?> - <?php getLinkRecursoDownload($rec["idRecurso"]); ?></li>
                                                 <?php } ?> 
                                            
                                            </ul>
                                        
                                        </li>
                                   <?php } ?> 
                           
                       </ul>
					<?php 
					}
					   
					?>
     
                </li>
            </ul>
        <div id="cajaCentralDown">&nbsp; </div>
        </div>
        
        <br />
<?php }?>
    
      </div> 
    
     
       <?php //  require("misCursos.php");?>
     
               
    
              
	<?php 
    
    	require("pie.php");

    ?>      

                
</div><!--principal-->
</body>
</html>
