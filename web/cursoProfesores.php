<?php 
require("inc/incluidos.php");

$idCurso = $_REQUEST["idCurso"];

function getProfesoresCurso($idCurso){

    $sql = "SELECT U.idUsuario,U.rutProfesor,P.nombreProfesor, P.apellidoPaternoProfesor, P.rbdColegio
            FROM  inscripcionCursoCapacitacion as IC 
            inner join usuario as U on IC.idUsuario = U.idUsuario
            inner join profesor as P on U.rutProfesor = P.rutProfesor
            WHERE  idCursoCapacitacion=".$idCurso." and estadoProfesor = 1";

    $res = mysql_query($sql);

    while($row = mysql_fetch_array($res)){
            $profesores[] = array(
            "idUsuario"=> $row["idUsuario"],
			"rbdColegio"=> $row["rbdColegio"],
            "rutProfesor"=> $row["rutProfesor"],
            "nombreProfesor" => $row["nombreProfesor"],
            "apellidoPaternoProfesor" => $row["apellidoPaternoProfesor"]);  
    }

    return $profesores;
}

function getCountActividades($idProfesor){

    $sql = "select count(*) as Num from (SELECT L.idLista,A.tituloActividad FROM pautaItem as PI
            inner join lista as L on PI.idLista = L.idLista
            inner join actividad as A on A.idActividad = L.idActividad
            WHERE idUsuario = ".$idProfesor." and L.idActividad IS NOT NULL 
            group by L.idLista,A.tituloActividad) as NumActividades";

    $res = mysql_query($sql);

    $num = 0;

    while($row = mysql_fetch_array($res)){
           $num = $row["Num"];  
    }

    return $num;
}

$profesores = getProfesoresCurso($idCurso);?>



    <table class="tablesorter">
        <thead>
            <tr>
                <th>RUT</th>
                <th>RBD</th>
                <th>Nombre</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

		<?php 
        foreach ($profesores as $row){ 

        $idUsuario = $row["idUsuario"];
		$num = getCountActividades($idUsuario);
        ?>
            <tr>
                <td><?phpecho $row["rutProfesor"];?></td>
                <td><?phpecho $row["rbdColegio"];?></td>
                <td><?phpecho $row["nombreProfesor"] . " " . $row["apellidoPaternoProfesor"];?></td>
                <td><a href="<?php echo "actividadesProfesor.php?id=".$idUsuario?>" >Actividades Realizadas (<?phpecho $num;?>)</a></td>
            </tr>
        <?php 
        }
        ?>

        </tbody>
    </table>
      
      

