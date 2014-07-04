<?php 
require("inc/incluidos.php");

$idPerfil =  $_SESSION["sesionPerfilUsuario"];
/* Registro de acceso a mi curso */
$idProfesor = $_REQUEST["idProfesor"];
$idLista = $_REQUEST["idLista"];
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 2, 'NULL'); 
$datosCurso2 = getDatosCurso($_SESSION["sesionIdCurso"]);


require ("hd.php");

function segToMin($segundos) {
	$minutos = floor($segundos/60);
	$seg = ((integer)$segundos - ((integer)$minutos * 60));
	if ($seg < 10) {
		$seg = "0" . $seg;
	}
	if ($minutos < 10) {
		$minutos = "0" . $minutos;
	}

	return $minutos . ":" . $seg;
}


function getIntentos($idLista,$idUsuario){
    //$sql ="SELECT * FROM pautaItem as PI inner join lista as L on PI.idLista = L.idLista WHERE PI.idLista = ".$idLista." and idUsuario = ".$idUsuario." ORDER BY porcentajeLogroPautaItem DESC limit 3";
    $sql ="SELECT * FROM pautaItem as PI inner join lista as L on PI.idLista = L.idLista WHERE PI.idLista = ".$idLista." and idUsuario = ".$idUsuario." ORDER BY fechaRespuestaPautaItem ASC";
    
    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
            $intentos[] = array(
            "idPautaItem"=> $row["idPautaItem"],
            "porcentajeLogroPautaItem" => $row["porcentajeLogroPautaItem"],
            "tiempoPautaItem" => $row["tiempoPautaItem"]);    
    }
    
    return $intentos;

}

?>

<script language="javascript">
function nueva_bienvenida(){
	
	 var division = document.getElementById("textoBienvenida");
	 AJAXPOST("cursoBienvenidaEditar.php","",division);
	
}

function registraMuestra(link,idRecurso){
	
	//alert(link+"--"+idRecurso);
	location.target="n";
	location.href='recurso.php?idRecurso='+idRecurso;
	
}	


</script>

<body>

<style type="text/css">
    table.tablesorter {
        width: 60%;
    }

</style>

<div id="principal">
<?php 
	require("topMenu.php"); 
	
	require("_navegacion.php");

?>
    <div id="lateralIzq">
	    <?php require("menuleft.php");	?>
	</div>
    
    
    
    <div id="lateralDer">
	    <?php require("menuright.php");?>
    </div><!--lateralDer-->
    
    <div id="columnaCentro" >

    
    <center>

        <p class="titulo_curso">Actividades Profesor</p>
        <br>

        <?php $datos = getRutNombre($idProfesor);

           foreach($datos as $row){
                echo "<h3>Rut: ".$row["rutProfesor"]."</h3>";
                echo "<h3>Nombre: ".$row["nombreProfesor"] . " ". $row["apellidoPaternoProfesor"]."</h3>";
           }

        ?>
     
        <table class="tablesorter">
        <thead>
        <tr class="ui-state-active">
            <th width="20px"> Intento </th>
            <th width="100px"> <center>Porcentaje Logro</center></th>
            <th width=""> <center>Tiempo</center></th>
            <th width=""> </th>
        </tr>
        </thead>
        <tbody>
        <?php //$intentos = getIntentos($idActividad,$idUsuario);
           $intentos = getIntentos($idLista,$idProfesor);
           
           $i = 1;
           $maxPorcentaje = 0; 
           foreach($intentos as $row){

                if($i<=3){

                    $porcentaje = $row["porcentajeLogroPautaItem"];
                    $tiempo = $row["tiempoPautaItem"];

                    
                    ?>
                        <tr>
                            <td><center> <?php echo $i; ?></center></td>
                            <td><center> <?php echo $porcentaje."%"; ?></center></td>
                            <td><center> <?php echo segToMin($tiempo); ?></center></td>
                            <td><center> <a href="<?php echo "actividadesRespuestasCoordinacion.php?idPautaItem=".$row["idPautaItem"]."&idProfesor=".$idProfesor; ?>" >Ver Items</a></center></td>
                        </tr>
                    <?php

                    if($maxPorcentaje < $porcentaje){
                        $maxPorcentaje = $porcentaje;
                    }

                $i++;
                }else{
                    break;
                }
           }   
        ?>

        </tbody>
        </table>  

        
        <h2>Porcentaje de logro final: <?php echo $maxPorcentaje."%";?>.</h2> 
        <br>
        
    
    
    <br>

        <table class="tablesorter">
        <thead>
        <tr class="ui-state-active">
            <th width="20px"> Intento </th>
            <th width="100px"><center> Porcentaje Logro</center></th>
            <th width=""><center>Tiempo</center></th>
            <th width=""> </th>
        </tr>
        </thead>
        <tbody>
        <?php //$intentos = getIntentos($idActividad,$idUsuario);
           $intentos = getIntentos($idLista,$idProfesor);
           
           $i = 1;
           $maxPorcentaje = 0; 
           foreach($intentos as $row){

                if($i>3){

                    $porcentaje = $row["porcentajeLogroPautaItem"];
                    $tiempo = $row["tiempoPautaItem"];

                    ?>
                        <tr>
                            <td><center> <?php echo $i; ?></center></td>
                            <td><center> <?php echo $porcentaje."%"; ?></center></td>
                            <td><center> <?php echo segToMin($tiempo); ?></center></td>
                            <td><center> <a href="<?php echo "actividadesRespuestasCoordinacion.php?idPautaItem=".$row["idPautaItem"]."&idProfesor=".$idProfesor; ?>" >Ver Items</a></center></td>
                        </tr>
                    <?php

                    if($maxPorcentaje < $porcentaje){
                        $maxPorcentaje = $porcentaje;
                    }

                
                }

                $i++;
           }   
        ?>

        </tbody>
        </table>  

        </center>

    <center><?php boton("Volver","history.back();"); ?></center>
     
       
    </div>
   
    
              
	<?php 
    
    	require("pie.php");

    ?>      

                
</div><!--principal-->
</body>
</html>
