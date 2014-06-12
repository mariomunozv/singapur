<?php 
require("inc/incluidos.php");
$idCurso = $_REQUEST["idCurso"];
$_SESSION["sesionIdCurso"] = $idCurso; 
$idPerfil =  $_SESSION["sesionPerfilUsuario"];
$jornadas = getJornadasCurso($idCurso);

/* Registro de acceso a mi curso */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 2, 'NULL'); 
$datosCurso2 = getDatosCurso($_SESSION["sesionIdCurso"]);
require ("hd.php");?>

<script language="javascript">
function nueva_bienvenida(){
	
	 var division = document.getElementById("textoBienvenida");
	 AJAXPOST("cursoBienvenidaEditar.php","",division);
	
}
</script>


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
	if($idCurso != 28){
		$navegacion = "Home*curso.php?idCurso=".$idCurso;
	}else{
		$navegacion = "Home*curso.php?idCurso=$idCurso,Curso*#";
	}
	require("_navegacion.php");

?>
    <div id="lateralIzq">
	    <?php require("menuleft.php");	?>
	</div>
    
    
    
    <div id="lateralDer">
	    <?php require("menuright.php");?>
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
<p class="textoBienvenida"><?php echo nl2br($descripcion[0]);?></p>
<br />

</div>

<?php 
///////// EDITAR BIENVENIDA

if ($idPerfil == 7 || $idPerfil == 9 || $idPerfil == 20){ // APE o Admin

?>
	<p align="right"><a href="javascript:nueva_bienvenida();">Editar Bienvenida</a></p>
    
<?php 
} 


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
						
									if (count($recursos) > 0){ ?>
                                        <li>
											<div class="recursos">
												

											<?php echo "<h3>".getNombreAtributoDeTabla($i,"TipoRecurso")."</h3>";  ?>
                                            <ul>
                                                <?php foreach ($recursos as $rec){	
												
	//											echo getLinkRecurso($rec["idRecurso"]);
												?>
                                                        <li><?php echo $rec["nombreRecurso"];?> - <a name="rec_<?php echo $rec["idRecurso"];?>" href="<?php getLinkRecurso($rec["idRecurso"]); ?>">[ Ver ]</a> <?php getLinkRecursoDownload($rec["idRecurso"]); ?></li>
                                                 <?php } ?> 
                                            
                                            </ul>
                                        
                                        	</div>
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
