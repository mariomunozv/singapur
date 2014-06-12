<?php 
require("inc/incluidos.php");

$idPerfil =  $_SESSION["sesionPerfilUsuario"];
/* Registro de acceso a mi curso */
$idProfesor = $_REQUEST["idProfesor"];
$idPautaItem = $_REQUEST["idPautaItem"];
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 2, 'NULL'); 
$datosCurso2 = getDatosCurso($_SESSION["sesionIdCurso"]);


require ("hd.php");

function getResultadoCapitulos($idPautaItem,$idUsuario){

    $sql = "SELECT SB.idSeccionBitacora,SB.idPadreSeccionBitacora,SB.nombreSeccionBitacora,RI.puntajeRespuestaItem,I.puntajeItem 
    FROM pautaItem as PI inner join respuestaItem as RI on PI.idPautaItem=RI.idPautaItem 
    inner join item as I on RI.idItem = I.idItem 
    inner join seccionBitacora as SB on SB.idSeccionBitacora = I.idSeccionBitacora
    WHERE PI.idPautaItem = ".$idPautaItem." and PI.idUsuario = ".$idUsuario."";

    $res = mysql_query($sql);

    while($row = mysql_fetch_array($res)){
            $resultados[] = array(
            "idSeccionBitacora"=> $row["idSeccionBitacora"],
            "idPadreSeccionBitacora"=> $row["idPadreSeccionBitacora"],
            "nombreSeccionBitacora" => $row["nombreSeccionBitacora"],
            "puntajeRespuestaItem" => $row["puntajeRespuestaItem"],
            "puntajeItem" => $row["puntajeItem"]);    
    }

    return $resultados;

}

function getRespuestaItem($idPautaItem,$idUsuario){
    $sql ="SELECT * FROM respuestaItem WHERE idPautaItem = ".$idPautaItem." and idUsuario = ".$idUsuario."";
    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
            $respuestasItem[] = array(
            "idItem"=> $row["idItem"],
            "opcionSeleccionadaItem"=> $row["opcionSeleccionadaItem"],
            "opcionCorrectaItem" => $row["opcionCorrectaItem"],
            "puntajeRespuestaItem" => $row["puntajeRespuestaItem"]);    
    }
    
    return $respuestasItem;

}

function getCapitulo($idSeccionBitacora){
    $sql = "SELECT * FROM seccionBitacora where idSeccionBitacora =".$idSeccionBitacora."";

    $res = mysql_query($sql);

    while($row = mysql_fetch_array($res)){
            $cap[] = array(
            "idSeccionBitacora"=> $row["idSeccionBitacora"],
            "idPadreSeccionBitacora"=> $row["idPadreSeccionBitacora"],
            "nombreSeccionBitacora" => $row["nombreSeccionBitacora"]);  
    }

    return $cap;

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

<link rel="stylesheet" type="text/css" href="series/shadowbox/shadowbox.css">
<script type="text/javascript" src="series/shadowbox/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();
</script>
<script language=javascript>
function closer() {
    var ventana = window.self;
    ventana.opener = window.self;
    ventana.close();
}
</script>

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

    <p class="titulo_curso">Actividades Profesor</p>
    <br>
    <?php $datos = getRutNombre($idProfesor);

       foreach($datos as $row){
            echo "<h3>Rut: ".$row["rutProfesor"]."</h3>";
            echo "<h3>Nombre: ".$row["nombreProfesor"] . " ". $row["apellidoPaternoProfesor"]."</h3>";
       }

    ?>
     
    <center>
        <?php 
        $respuestas = getRespuestaItem($idPautaItem,$idProfesor);
        echo '<table class="tablesorter"><thead><tr><th><center>Numero Item</center></th><th colspan="2"><center>Puntos Obtenidos</center></th><th><center>Puntaje Total </center></th><th><center>Opcion</center></th></tr></thead>';
        $i = 0;

        foreach($respuestas as $row){
            $imagen = "";

            $idItem = $row["idItem"];
            $opcionSeleccionadaItem = $row["opcionSeleccionadaItem"];
            $opcionCorrectaItem = $row["opcionCorrectaItem"];
            $puntajeRespuestaItem = $row["puntajeRespuestaItem"];   

            $isCorrecta = false;

            if($opcionSeleccionadaItem == $opcionCorrectaItem){
                $isCorrecta = true;
            }

            
            
            if($isCorrecta){
                $imagen = '<img src="img/ok.jpg"  />';
            }
    
            if(!$isCorrecta){
                if($opcionSeleccionadaItem == ""){
                    $imagen = '<img src="img/reloj.png"  />';
                }else{
                    $imagen = '<img src="img/malo.jpg"  />';
                }
            }       
                    
                
                
            echo "<tr>";
            echo "<td><center>".($i+1)."</center></td>";
            //echo $lista["idItem"]."--ID";
            $totalPuntosItem = 1;
            echo "<td><center>"." (".$puntajeRespuestaItem.") </center></td><td><center>".$imagen."</center></td>";
            echo "<td><center>".$totalPuntosItem." </center></td><td><center><a href='series/verItemContestado.php?idProfesor=".$idProfesor."&idItem=".$idItem."&idPautaItem=".$idPautaItem."' rel='shadowbox;height=550;width=1000'>Ver Item</a></center></td>";
            @$totalObtenidos = $totalObtenidos + $puntajeRespuestaItem;
            @$totalPuntos =$totalPuntos+$totalPuntosItem;
            $i++;
            echo '</tr>';
        }

        echo '<tr>    <td><center>Totales</center></td> <td colspan="2"><center>'.$totalObtenidos.' Punto(s) obtenido(s)</center></td>    <td><center>'.$totalPuntos .' Puntos en total</center></td> <td></td> </tr></table>';
        $porcentaje = ($totalObtenidos/$totalPuntos);
        //echo '<tr><th colspan="4"><h2>'.(round($porcentaje,2)*100).'% de Logro Obtenido</th> </h2></tr>';
        ?>
        </center>


        <?php 

        $result = getResultadoCapitulos($idPautaItem,$idProfesor);
        
        foreach($result as $row){

            $id = $row["idSeccionBitacora"];
            $padre = $row["idPadreSeccionBitacora"];
            $nombre = $row["nombreSeccionBitacora"];
            $puntajeobtenido = $row["puntajeRespuestaItem"]; 
            $puntajepregunta = $row["puntajeItem"]; 

            $tipo = ""; 

            if($padre == ""){
                //Se obtiene capitulo
                $tipo = "1"; //1 corresponde a capitulo, 0 corresponde a apartado

                $datos[] = array(
                "id"=> $id,
                "puntajeobtenido" => $puntajeobtenido,
                "nombre" => $nombre,
                "padre" => "",
                "tipo" => $tipo,
                "puntajepregunta"=>$puntajepregunta);

            }else{
                //Se obtiene apartado
                $tipo = "0";
                $datos[] = array(
                "id"=> $id,
                "puntajeobtenido" => $puntajeobtenido,
                "nombre" => $nombre,
                "padre" => $padre,
                "tipo" => $tipo,
                "puntajepregunta"=>$puntajepregunta);

                //Obtener Capitulo

                $cap = getCapitulo($padre);

                foreach($cap as $rowcap){
                    $tipo = "1";

                    $datos[] = array(
                    "id"=> $rowcap["idSeccionBitacora"],
                    "puntajeobtenido" => $puntajeobtenido,
                    "nombre" => $rowcap["nombreSeccionBitacora"],
                    "padre" => "",
                    "tipo" => $tipo,
                    "puntajepregunta"=>$puntajepregunta);

                }

            }

        }

        $agrupados = array();
        foreach ($datos as $key => $value) {
            if ($value["tipo"] == "1") {
                $agrupados[$value["id"]]["nombre"] = $value["nombre"];
                if(isset($agrupados[$value["id"]]["puntajeobtenido"])){
                    $agrupados[$value["id"]]["puntajeobtenido"] += $value["puntajeobtenido"];
                    $agrupados[$value["id"]]["puntajepregunta"] += $value["puntajepregunta"];
                }else{
                    $agrupados[$value["id"]]["puntajeobtenido"] = $value["puntajeobtenido"];
                    $agrupados[$value["id"]]["puntajepregunta"] += $value["puntajepregunta"];
                }
            }
        }


        foreach ($datos as $key => $value) {
            if ($value["tipo"] == "0") {
                $agrupados[$value["padre"]]["apartado"][$value["id"]]["nombre"] = $value["nombre"];

                if(isset($agrupados[$value["padre"]]["apartado"][$value["id"]]["puntajeobtenido"])){
                    $agrupados[$value["padre"]]["apartado"][$value["id"]]["puntajeobtenido"] += $value["puntajeobtenido"];
                    $agrupados[$value["padre"]]["apartado"][$value["id"]]["puntajepregunta"] += $value["puntajepregunta"];
                }else{
                    $agrupados[$value["padre"]]["apartado"][$value["id"]]["puntajeobtenido"] = $value["puntajeobtenido"];
                    $agrupados[$value["padre"]]["apartado"][$value["id"]]["puntajepregunta"] += $value["puntajepregunta"];

                }
            }
        }

        ?>



        <center>
        <table class="tablesorter">
        <tr>
            <th colspan="2">Resultados por Capitulos</th>
            <th colspan="2">Resultados por Apartado</th>
        </tr>
        <?php

        foreach ($agrupados as $key => $value) {

            if(isset($value["apartado"])){
                $num = count($value["apartado"]);
            }else{
                $num = 1;
            }
            
            

            echo "<tr>";
            echo "<td class='capitulo' rowspan=".($num).">".$agrupados[$key]["nombre"]."</td>";
            echo "<td rowspan=".($num).">".$agrupados[$key]["puntajeobtenido"]." de ".$agrupados[$key]["puntajepregunta"]."</td>";
            
            $j = 1;
            foreach($value["apartado"] as $llave => $valor){
                if($j!=1){
                    echo "<tr>";
                }

                echo "<td class='apartado'>".$valor["nombre"]."</td>";
                echo "<td>".$valor["puntajeobtenido"]." de ".$valor["puntajepregunta"]."</td>";
                echo "</tr>";   

                $j++;
            }

            if(!isset($value["apartado"])){
                echo "</tr>";
            }
            
        }

        ?>

        </table>
        <br>
        <?php boton("Volver","history.back();"); ?>
        </center>    

       
    </div>
   
    
              
	<?php 
    
    	require("pie.php");

    ?>      

                
</div><!--principal-->
</body>
</html>
