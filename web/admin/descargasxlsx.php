<?php 
ini_set('display_errors','1');
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Descarga.xls");
header("Pragma: no-cache");
header("Expires: 0");
require("inc/config.php");

$nivel = $_GET["nivel"];

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

function getRutProfesor($rbdColegio,$letraCursoColegio,$idNivel,$cursoColegio){

	$sql = "select rutProfesor from cursoColegio where rbdColegio = " .$rbdColegio. " and letraCursoColegio = '".$letraCursoColegio."' and idNivel = " . $idNivel . " and anoCursoColegio = " . $cursoColegio . "";
	$res = mysql_query($sql);

	while ($row = mysql_fetch_array($res)) {

		return $row["rutProfesor"];
			
	}
	return null;

}


function getAlumnosCurso($nivel){
        
        
        $sql = "SELECT m.rbdColegio,m.idNivel,m.letraCursoColegio,m.anoCursoColegio,u.loginUsuario,u.rutAlumno,a.nombreAlumno,a.apellidoPaternoAlumno,a.apellidoMaternoAlumno,u.idUsuario,a.estadoAlumno,pi.idLista
                FROM `matricula` as m
                left join usuario as u on m.rutAlumno = u.rutAlumno 
                left join alumno as a on m.rutAlumno = a.rutAlumno
                left join pautaItem as pi on pi.idUsuario = u.idUsuario
                where m.idNivel = '$nivel' ORDER BY a.apellidoPaternoAlumno ASC";
        //echo $sql;

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
 
<p>

<table class="tablesorter" id="tabla"> 
   <thead>  
	<tr>
		<th>rbdColegio</th>
		<th>rutProfesor</th>
		<th>dvProfesor</th>
		<th>Nivel</th>
		<th>Letra</th>
		<th>Año</th>
		<th>idLista</th>
		<th>rutAlumno</th>
		<th>dvAlumno</th>
		<th>P1</th>
		<th>P2</th>
		<th>P3</th>
		<th>P4</th>
		<th>P5</th>
		<th>P6</th>
		<th>P7</th>
		<th>P8</th>
		<th>P9</th>
		<th>P10</th>
		<th>P11</th>
		<th>P12</th>
		<th>P13</th>
		<th>P14</th>
		<th>P15</th>
		<th>P16</th>
		<th>P17</th>
		<th>P18</th>
		<th>P19</th>
		<th>P20</th>
		<th>P21</th>
		<th>P22</th>
		<th>P23</th>
		<th>P24</th>
		<th>P25</th>
  	</tr>
  </thead>
  <tbody>

	
  <?php 

  		$alumnos = getAlumnosCurso($nivel); 

		$i=1;

		if(count($alumnos)>0){
			
			foreach($alumnos as $alumno)
			{
				

				if($alumno['idLista'] != '')
				{
					echo "<tr>";

					$items = getItemsLista($alumno['idLista']);

					$datosPauta = buscaPauta($alumno["idUsuario"],$alumno['idLista']);

					$respuestaUsuario = getRespuestaUsuarioByPauta($alumno["idUsuario"],$datosPauta["idPautaItem"]);

					$rutProfesor = getRutProfesor($alumno['rbdColegio'],$alumno['letraCursoColegio'],$alumno['idNivel'],$alumno['anoCursoColegio']);

					$rutA = explode('-',$alumno['rutAlumno']);
					$rutP = explode('-',$rutProfesor);

					echo "<td>".$alumno['rbdColegio']."</td>";
					echo "<td>".$rutP[0]."</td>";
					echo "<td>".$rutP[1]."</td>";
					echo "<td>".$alumno['idNivel']."</td>";
					echo "<td>".$alumno['letraCursoColegio']."</td>";
					echo "<td>".$alumno['anoCursoColegio']."</td>";
					echo "<td>".$alumno['idLista']."</td>";
					echo "<td>". $rutA[0] ."</td>";
					echo "<td>". $rutA[1] ."</td>";

					$k=1;
					foreach($items as $item){ 
	                    $respuesta = '';
	                    if (isset($respuestaUsuario[$item["idItem"]])) {
	                        $respuesta = $respuestaUsuario[$item["idItem"]];
	                    }

	                    if(isset($respuesta["puntajeRespuestaItem"]))
	                    {
	                   		echo "<td>". $respuesta["puntajeRespuestaItem"]."</td>";
	                   	}else{
	                   		echo "<td>-</td>";
	                   	}

	                    $k++;
	                }

	                for($j=1;$j<=(25-$k);$j++)
	                {
	                	echo "<td><center>-</center></td>";
	                }

					$i++;

					echo "</tr>";

				}
				
			}
		}
			
	
	?>


 </tbody> 
</table>