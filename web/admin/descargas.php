<?php
ini_set("display_errors","on");
header('Content-Type: text/html; charset=UTF-8');
require("inc/config.php");
//require("inc/sesionAdmin.php");
require("_head.php");
$menu = "ite";
require("_menu.php");


function getRespuestaUsuarioByPauta($idUsuario,$idPauta){

	$sql = "select * from respuestaItem WHERE idUsuario = ".$idUsuario." AND idPautaItem = ".$idPauta;
	$res = mysql_query($sql);

	$respuestaUsuarioItem = array();

	while($row = mysql_fetch_array($res))
	{
		$respuestaUsuarioItem[$row["idItem"]] = array("idRespuesta" => $row["idRespuestaItem"],
										"valorSeleccionada" => $row["valorSeleccionadaItem"],
										"opcionSeleccionada" => $row["opcionSeleccionadaItem"],
										"valorCorrecta" => $row["valorCorrectaItem"],
										"puntajeRespuestaItem" => $row["puntajeRespuestaItem"],
										"opcionCorrecta" => $row["opcionCorrectaItem"]);
	}

	return $respuestaUsuarioItem;
}


function buscaPauta($idUsuario,$idLista){
	$sql = "SELECT * from pautaItem WHERE idUsuario = ".$idUsuario." AND idLista = ".$idLista;
	$res = mysql_query($sql);
	$row = mysql_fetch_array($res);
	if ($row){
		return ($row);
		}else{
		return (false);
	}
}

function getItemsLista($idLista){

	$sql = "SELECT * FROM item it JOIN lista_Item li ON it.idItem = li.idItem WHERE idLista = '$idLista' ORDER BY li.idItem ASC";
	$res = mysql_query($sql);
	$i =0;
	while ($row = mysql_fetch_array($res)) {
		$arreglo[$i] = array(
			"idItem"=> $row["idItem"],
			"puntajeItem" => $row["puntajeItem"]

			);
		$i++;
	}
	return($arreglo);


}

function getRutProfesor($idNivel,$cursoColegio){

	$sql = "select rutProfesor from cursoColegio where idNivel = " . $idNivel . " and $cursoColegio = " . $cursoColegio . "";
	$res = mysql_query($sql);

	while ($row = mysql_fetch_array($res)) {

		return $row["rutProfesor"];

	}
	return null;

}


function getAlumnosCurso(){

        $sql = "SELECT m.rbdColegio,m.idNivel,m.letraCursoColegio,m.anoCursoColegio,u.loginUsuario,u.rutAlumno,a.nombreAlumno,a.apellidoPaternoAlumno,a.apellidoMaternoAlumno,u.idUsuario,a.estadoAlumno,pi.idLista
                FROM `matricula` as m
                left join usuario as u on m.rutAlumno = u.rutAlumno
                left join alumno as a on m.rutAlumno = a.rutAlumno
                left join pautaItem as pi on pi.idUsuario = u.idUsuario
                where m.idNivel = '$nivel' ORDER BY a.apellidoPaternoAlumno ASC";
        echo $sql;
        die();

        $res = mysql_query($sql);
        $i = 0;
        while ($row = mysql_fetch_array($res)){
            $alumnosCurso[$i]= array( "idUsuario" =>$row["idUsuario"],
                               "rutAlumno" => $row["rutAlumno"],
							  "idLista" => $row["idLista"],
							  "rbdColegio" => $row["rbdColegio"],
							  "idNivel" => $row["idNivel"],
							  "letraCursoColegio" => $row["letraCursoColegio"],
							  "anoCursoColegio" => $row["anoCursoColegio"]
                              );
            //echo $i." <- <br>";$i++;
            $i++;
        }
        if ($i==0){
            return(NULL);
        }

        return($alumnosCurso);

}


?>

<link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
<script type="text/javascript" src="../js/bootstrap.min.js"></script>

<div class="container">
	<br>
	<div class="well" style="background-color: #dceaf4;">


        <div class="row">
            <div span="span4">
                <center>
                    <h3>Descargar Datos Registro de Evaluación</h3>

                    <b>NIVEL:</b>
                    <select id="nivel">
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                    </select><br>
                    <input class="btn btn-large btn-success download" type="button" name="Descargar" id="Descargar" value="Descargar .XLS" onclick="xls()"/>
                </center>

            </div>
        </div>


    </div>

    <div class="well" style="background-color: #dceaf4;">

		<div class="row">
			<div span="span4">
				<center>
					<h3>Descargar Datos de Actividad virtual</h3>

					<b>NIVEL:</b>
					<select id="nivel2">
					  <option value="1">1</option>
					  <option value="2">2</option>
					  <option value="3">3</option>
					  <option value="4">4</option>
					  <option value="5">5</option>
					</select><br>
					<input class="btn btn-large btn-success download" type="button" name="Descargar" id="Descargar" value="Descargar .XLS" onclick="xlsActividadVirtual()"/>
				</center>

			</div>
		</div>


	</div>

</div>

<script type="text/javascript">


    function xls(){
        var idNivel = $("#nivel").val();
        location.href="descargasxlsx.php?nivel="+idNivel;
    }

	function xlsActividadVirtual(){
		var idNivel = $("#nivel2").val();
        location.href="descargasxlsActividadVirtual.php?nivel="+idNivel;
    }



</script>
