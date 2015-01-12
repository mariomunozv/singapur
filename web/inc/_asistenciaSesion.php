<?php

function getRelatoresSesion(){
    $sql = "SELECT DISTINCT us.idUsuario, ek.rutEmpleadoKlein, nombreEmpleadoKlein, apellidoPaternoEmpleadoKlein,apellidoMaternoEmpleadoKlein
            FROM empleadoKlein ek JOIN usuario us on us.rutEmpleadoKlein=ek.rutEmpleadoKlein
            WHERE us.estadoUsuario = 1
            AND (us.tipoUsuario = 'Coordinador General' OR us.tipoUsuario = 'Relator/Tutor' )";
    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
        $relatores[$i] = $row;
        $i++;
    }
    if ($i == 0){
        $relatores = array();  
    }
    return($relatores);
}
function cantidadSesionesCurso($idCurso, $idUsuario){
    $sql = "SELECT idInformeSesion 
            FROM `informeSesion`
            WHERE idCursoCapacitacion = $idCurso 
            AND idInformeSesion in (SELECT DISTINCT asi.idInformeSesion 
                                    FROM `asistenciaSesion` as asi join `informeSesion` as inf on asi.idInformeSesion = inf.idInformeSesion
                                    WHERE idCursoCapacitacion=$idCurso
                                    AND idUsuario = $idUsuario)";
    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
        $i++;
    }
    return $i;
}
function asistenciaProfesor($idUsuario, $idCurso,$cantidadSesiones){
    $sql_prof = "SELECT idAsistenciaSesion  
                 FROM `asistenciaSesion` as asi join `informeSesion` as inf on asi.idInformeSesion = inf.idInformeSesion
                 WHERE `presenteAsistenciaSesion` = 1
                 AND idUsuario = $idUsuario
                 AND idCursoCapacitacion=$idCurso";
    $res = mysql_query($sql_prof);
    $i=0;
    while($row = mysql_fetch_array($res)){
        $i++;
    }
    return $i/$cantidadSesiones*100;
}

function getIdPerfil($idUsuario){
    $sql = "SELECT idPerfil
            FROM detalleUsuarioProyectoPerfil
            WHERE idUsuario = $idUsuario ";
    $res = mysql_query($sql);
    $aux = mysql_fetch_array($res);
    return $aux["idPerfil"];
}

function getNumerosSesionesCurso($idCurso,$idUsuario){
    $anoActual = date('Y');
    $idPerfil=getIdPerfil($idUsuario);
    if($idPerfil == 5){
        $sql = "SELECT numeroSesion
            FROM informeSesion inf JOIN detalleUsuarioProyectoPerfil per on inf.idRelator = per.idUsuario
            WHERE idCursoCapacitacion = $idCurso 
            AND inf.idRelator = $idUsuario
            AND fechaSesion >='$anoActual-01-01'";
    }else{
        $sql = "SELECT numeroSesion
            FROM informeSesion inf JOIN detalleUsuarioProyectoPerfil per on inf.idRelator = per.idUsuario
            WHERE idCursoCapacitacion = $idCurso
            AND fechaSesion >='$anoActual-01-01'";
    }
    $res = mysql_query($sql);
    $i=0;
    
    while($row = mysql_fetch_array($res)){
        $informes[$i] = $row["numeroSesion"];
        $i++;
    }
    return $informes;
}

function getSesiones($idCurso){
    $anoActual = date('Y');
    $sql = "SELECT *
            FROM informeSesion inf JOIN detalleUsuarioProyectoPerfil per on inf.idRelator = per.idUsuario
            WHERE idCursoCapacitacion = $idCurso
            AND fechaSesion >= '$anoActual-01-01'
            ORDER BY numeroSesion";
    $res = mysql_query($sql);
    $i=0;
    
    while($row = mysql_fetch_array($res)){
        $informes[$i] = $row;
        $i++;
    }
    return $informes;
}
function getSesionesTodas(){
    $anoActual = date('Y');
    $sql = "SELECT *
            FROM informeSesion inf JOIN detalleUsuarioProyectoPerfil per on inf.idRelator = per.idUsuario
            WHERE fechaSesion >= '$anoActual-01-01'
            ORDER BY numeroSesion";
    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
        $informes[$i] = $row;
        $i++;
    }
    return $informes;
}

function getSiguienteSesionesCurso($idCurso){
    $sql = "SELECT numeroSesion
            FROM informeSesion
            WHERE idCursoCapacitacion = $idCurso ";
    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
        $informes[$i] = $row;
        $i++;
    }
    return (count($informes)+1);
}


function getCapitulos($nivel){
    $sql = "SELECT parteLibro 
            FROM seccionBitacora 
            WHERE idNivelCursoSeccionBitacora = $nivel GROUP BY parteLibro HAVING parteLibro IS NOT NULL";
    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
        $query = "SELECT idSeccionBitacora as id, nombreSeccionBitacora as nombre 
                  FROM seccionBitacora 
                  WHERE idPadreSeccionBitacora IS NULL and parteLibro='".$row["parteLibro"]."'";//falta filtrar segun nivel
        $res2 = mysql_query($query);
        while($row2 = mysql_fetch_array($res2)){
            $caps[$i] = $row2;
            $i++;
        }    
    }
    return $caps;
}

function getDatosSesionPorId($idSesion){
    $sql = "SELECT *
            FROM informeSesion
            WHERE idInformeSesion = $idSesion";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    if($row["fechaSesion"]){
        $row["fechaSesion"] = substr($row["fechaSesion"],-2,2)."/".substr($row["fechaSesion"],-5,2)."/".substr($row["fechaSesion"],0,4);
    }
    return $row;
}

function getDatosSesion($idCurso, $numSesion){
    $sql = "SELECT *
            FROM informeSesion
            WHERE idCursoCapacitacion = $idCurso 
            AND numeroSesion = $numSesion";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    if($row["fechaSesion"]){
        $row["fechaSesion"] = substr($row["fechaSesion"],-2,2)."/".substr($row["fechaSesion"],-5,2)."/".substr($row["fechaSesion"],0,4);
    }
    return $row;
}
function getAsistenciaSesion($idCurso, $numSesion){
    $sql = "SELECT *
            FROM informeSesion inf join asistenciaSesion asis on inf.idInformeSesion = asis.idInformeSesion
            WHERE inf.idCursoCapacitacion = $idCurso AND inf.numeroSesion = $numSesion";
    $res = mysql_query($sql);
    while($row = mysql_fetch_array($res)){
        $asistencias[$row["idUsuario"]] = $row["presenteAsistenciaSesion"];
    }
    return $asistencias;
}
function getAsistenciaGeneral(){
    $anoActual = date('Y');
    $sql = "SELECT *
            FROM informeSesion inf join asistenciaSesion asis on inf.idInformeSesion = asis.idInformeSesion
            WHERE fechaSesion >= '$anoActual-01-01'";
    $res = mysql_query($sql);
    while($row = mysql_fetch_array($res)){
        $asistencias[$row["idUsuario"]] = $row["presenteAsistenciaSesion"];
    }
    return $asistencias;
}
function getDetalleSesion($idInformeSesion){
    $sql = "SELECT *
            FROM detalleSesion
            WHERE idInformeSesion = $idInformeSesion";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    return $row;
}
function newInformeSesion($post){
    $fecha = substr($post["fechaSesion"],-4,4)."-".substr($post["fechaSesion"],-7,2)."-".substr($post["fechaSesion"],0,2);
    $sql = "INSERT INTO `informeSesion` (`idInformeSesion`, `idRelator`, `idCursoCapacitacion`, `numeroSesion`, `fechaSesion`) 
                                 VALUES (NULL,".$post["idRelator"].",".$post["idCurso"].",".$post["numeroSesion"].",'$fecha')";
    $res = mysql_query($sql);
}

function updateInformeSesion($post){
    $fecha = substr($post["fechaSesion"],-4,4)."-".substr($post["fechaSesion"],-7,2)."-".substr($post["fechaSesion"],0,2);
    $sql ="UPDATE `informeSesion` SET `fechaSesion` = '$fecha',`idRelator` = '".$post["idRelator"]."', `idCursoCapacitacion` = '".$post["idCurso"]."'  WHERE `informeSesion`.`numeroSesion` = ".$post["numeroSesion"]." AND `informeSesion`.`idCursoCapacitacion` = ".$post["idCurso"];
    $res = mysql_query($sql);
}
function newAsistenciaSesion($idInformeSesion, $usuario, $valor){
    if(mysql_fetch_array(mysql_query("SELECT * FROM asistenciaSesion WHERE idInformeSesion=$idInformeSesion AND idUsuario=$usuario"))){
        $sql ="UPDATE `asistenciaSesion` SET `presenteAsistenciaSesion` = '$valor'  WHERE `asistenciaSesion`.`idInformeSesion` = $idInformeSesion  AND `asistenciaSesion`.`idUsuario` = $usuario";
    }else{
        $sql ="INSERT INTO `asistenciaSesion` (`idAsistenciaSesion`, `idInformeSesion`,`idUsuario`,`presenteAsistenciaSesion`)
                                        VALUES(NULL, $idInformeSesion, $usuario, $valor)";
    }
    $res = mysql_query($sql);

}

function newDetalleSesion($post){
    $sql = "INSERT INTO `detalleSesion` (`idDetalleSesion`,`idInformeSesion`, `capitulosProgramadosSesion`, `trabajoRealizadoSesion`, `justificacionNoRealizadoSesion`, `dificultadesMatDidSesion`, `matematicoSesion`, `didacticoSesion`, `participacionDestacadaSesion`, `participacionDebilSesion`, `situacionPedagogicaSesion`, `cualSituacionPedagogicaSesion`, `situacionInstitucionalSesion`, `cualSituacionInstitucionalSesion`) 
                                 VALUES (NULL,".$post["idInformeSesion"].",'".$post["programados"]."','".$post["trabajados"]."','".$post["justificaNoRealizado"]."',".$post["dificultades"].",'".$post["difMatematicas"]."','".$post["difDidactico"]."','".$post["destacados"]."','".$post["debiles"]."',".$post["situaciones"].",'".$post["situacionPedagogica"]."',".$post["institucionales"].",'".$post["situacionInstitucional"]."')";
    $res = mysql_query($sql);
}
function updateDetalleSesion($post){
    $sql = "UPDATE `detalleSesion` SET `capitulosProgramadosSesion` = '".$post["programados"]."', `trabajoRealizadoSesion`='".$post["trabajados"]."', `justificacionNoRealizadoSesion`='".$post["justificaNoRealizado"]."', `dificultadesMatDidSesion`=".$post["dificultades"].", `matematicoSesion`='".$post["difMatematicas"]."', `didacticoSesion`='".$post["difDidactico"]."', `participacionDestacadaSesion`='".$post["destacados"]."', `participacionDebilSesion`='".$post["debiles"]."', `situacionPedagogicaSesion`=".$post["situaciones"].", `cualSituacionPedagogicaSesion`='".$post["situacionPedagogica"]."', `situacionInstitucionalSesion`=".$post["institucionales"].", `cualSituacionInstitucionalSesion`='".$post["situacionInstitucional"]."' WHERE `idInformeSesion`=".$post["idInformeSesion"]." ";
    $res = mysql_query($sql);
}

function getNombreCurso2($idCurso){
    $sql ="SELECT * FROM cursoCapacitacion WHERE idCursoCapacitacion = ".$idCurso;
    // echo "<br>".$sql;
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    return($row["nombreCortoCursoCapacitacion"]);
}
function getNombreColegio($rbdColegio){
    $sql = "SELECT nombreColegio 
            FROM colegio 
            WHERE rbdColegio = $rbdColegio";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res); 
    return $row["nombreColegio"] ;
}

function informeExcelAsistenciaGeneral($idCurso){
    $curso = (getNombreCurso2($idCurso));
    $titulos =<<<HTML
    <table>
    <tr>
        <th style='background-color:#d9edf7;'>Curso de Capacitaci&oacute;n</th>
        <th style='background-color:#d9edf7;'>Perfil</th>
        <th style='background-color:#d9edf7;'>Nombre</th>
        <th style='background-color:#d9edf7;'>Apellido Paterno</th>
        <th style='background-color:#d9edf7;'>Apellido Materno</th>
        <th style='background-color:#d9edf7;'>Establecimiento</th>
        <th style='background-color:#d9edf7;'>Asistencia general del particpante</th>
    </tr>
    <tbody>
HTML;
    $profesores = getAlumnosCurso($idCurso);
    ordenar($profesores,array("idPerfil"=>"ASC","apellidoPaterno"=>"ASC"));
    //$contProf = 0;
    $cantTotal=0;
    $listado = array();
    foreach ($profesores as $i => $prof) {
      if($profesores[$i]["nombrePerfil"] == "Profesor" || $profesores[$i]["nombrePerfil"]=="UTP"){
        $datos = getDatosProfesor($prof["idUsuario"]);
        $aux[0]=(getNombreCurso2($idCurso));
        $aux[1]=$prof["nombrePerfil"];
        $aux[2]=($datos["nombreProfesor"]);
        $aux[3]=($prof["apellidoPaterno"]);
        $aux[4]=($datos["apellidoMaternoProfesor"]);
        $aux[5]=(getNombreColegio($prof["rbdColegio"]));
        $cantidadSesiones = cantidadSesionesCurso($_SESSION["sesionIdCurso"],$prof["idUsuario"]);
        $cantTotal+=$cantidadSesiones;
        $aux[6]=round(asistenciaProfesor($prof["idUsuario"],$_SESSION["sesionIdCurso"],$cantidadSesiones));
        array_push($listado,$aux);
      }
    }
    foreach ($listado as $val) {       
        $tabla .=<<<HTML
            <tr>
                <td>$val[0]</td>
                <td>$val[1]</td>
                <td>$val[2]</td>
                <td>$val[3]</td>
                <td>$val[4]</td>
                <td>$val[5]</td>
                <td>$val[6]%</td>                
            </tr>
HTML;
    }
    $tabla.=<<<HTML
    </tbody>
    </table>
HTML;

  header('Content-type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=Informe general de asistencia - $curso [".date("d-m-Y")."].xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  echo $titulos;
  echo $tabla;
}

function informeExcelSesionGeneral($idCurso){
    $curso = (getNombreCurso2($idCurso));
    $sesiones = getSesiones($_SESSION["sesionIdCurso"]);
    $titulos =<<<HTML
    <table>
    <tr>
        <th style="border:0px;text-align:left;">Curso:</th>
        <th style="border:0px;text-align:left;">$curso</th>
    </tr>
    <tr>
        <th style='background-color:#d9edf7;'>N&#176; Sesi&oacute;n</th>
        <th style='background-color:#d9edf7;'>Fecha de sesi&oacute;n</th>
        <th style='background-color:#d9edf7;'>Taller</th>
        <th style='background-color:#d9edf7;'>Cap&iacute;tulo</th>
        <th style='background-color:#d9edf7;'>Estado</th>
        <th style='background-color:#d9edf7;'>Relator</th>
    </tr>
    <tbody>
HTML;

    foreach ($sesiones as $ses) {
        $fecha = substr($ses["fechaSesion"],8)."/".substr($ses["fechaSesion"],5,2)."/".substr($ses["fechaSesion"],0,4);
        $detalle = getDetalleSesion($ses["idInformeSesion"]);
        $capitulos = split(",",substr($detalle["capitulosProgramadosSesion"],1,count($detalle["capitulosProgramadosSesion"])-2));
        if($capitulos[0]==""){$capitulos=array();}
        foreach ($capitulos as $dat) {
            $talleres = split(",",substr($detalle["trabajoRealizadoSesion"],1,count($detalle["trabajoRealizadoSesion"])-2));
            $strTaller = "";
            foreach ($talleres as $tall) {
                if($tall!=""){
                    $aux = split(":",$tall);
                    if($aux[1]==$dat){
                        $strTaller.="Taller ".$aux[0]."<br>";
                    }
                }
            }
            if (strlen($strTaller)==0){
                $estado = "Omitido";
                $strTaller = "-----";
            }else{
                $estado = "Implementado";
            }
        
            $numeroSes = $ses["numeroSesion"];
            $nombreCap = (getNombreCapitulo($dat));
            $nombreUsu = (getNombreUsuario($ses["idUsuario"]));
            $tabla .=<<<HTML
    <tr>
      <td>$numeroSes</td>
      <td>$fecha</td>
      <td>$strTaller</td>
      <td>$nombreCap</td>
      <td>$estado</td>
      <td>$nombreUsu</td>
    </tr>
HTML;
        }}
        $tabla.=<<<HTML
    </tbody>
    </table>
HTML;

  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=Informe General de Sesiones - $curso [".date("d-m-Y")."].xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  echo $titulos;
  echo $tabla;
}


function informeExcelAsistencia($idSesion){
    $sesion = getDatosSesionPorId($idSesion);
    $numeroSes = $sesion["numeroSesion"];
    $rutIngres = getDatosUsuarioPorId($sesion["idRelator"]);
    $rutIngres = $rutIngres["rut"];
    $curso = (getNombreCurso2($sesion["idCursoCapacitacion"]));
    $asistencia = getAsistenciaSesion( $sesion["idCursoCapacitacion"], $sesion["numeroSesion"] );
    print_r($asistencia[0]);
    $titulos =<<<HTML
    <table>
    <tr>
        <th style='background-color:#d9edf7;'>N&#176; Sesi&oacute;n</th>
        <th style='background-color:#d9edf7;'>RUT de qui&eacute;n ingres&oacute;</th>
        <th style='background-color:#d9edf7;'>Nombre</th>
        <th style='background-color:#d9edf7;'>Apellido</th>
        <th style='background-color:#d9edf7;'>Perfil</th>
        <th style='background-color:#d9edf7;'>Establecimiento</th>
        <th style='background-color:#d9edf7;'>Asistencia</th>
    </tr>
    <tbody>
HTML;
    
    foreach ($asistencia as $i => $val) {
        $perfil=getTipoUsuario($i);
        if($perfil == "UTP" || $perfil =="Profesor"){
            $datProfe = getRutNombre($i);
            $nombre = ($datProfe[0]["nombreProfesor"]);
            $apellido = ($datProfe[0]["apellidoPaternoProfesor"]." ".$datProfe[0]["apellidoMaternoProfesor"]);
            $establecimiento = (getNombreColegioProfesor($i));
            $asistencia= $val? "<td style='background-color:#dff0d8;'>Presente</td>":"<td style='background-color:#f2dede;'>Ausente</td>";
            $tabla .=<<<HTML
                <tr>
                    <td>$numeroSes</td>
                    <td>$rutIngres</td>
                    <td>$nombre</td>
                    <td>$apellido</td>
                    <td>$perfil</td>
                    <td>$establecimiento</td>
                    $asistencia
                </tr>
HTML;
        }
    }
    $tabla.=<<<HTML
    </tbody>
    </table>
HTML;

  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=Informe general de asistencia - $curso [".date("d-m-Y")."].xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  echo $titulos;
  echo $tabla;
}

function informeExcelVaciadoSesion(){
    $sesiones = getSesionesTodas();
    foreach ($sesiones as $sesion) {
        //$sesion = getDatosSesionPorId(1);
        $numeroSes = $sesion["numeroSesion"];
        $rutIngres = getDatosUsuarioPorId($sesion["idRelator"]);
        $rutIngres = $rutIngres["rut"];
        $curso = (getNombreCurso2($sesion["idCursoCapacitacion"]));
        $asistencia = getAsistenciaSesion( $sesion["idCursoCapacitacion"], $sesion["numeroSesion"] );
        $titulos =<<<HTML
        <table>
        <tr>
            <th style='background-color:#d9edf7;'>Curso</th>
            <th style='background-color:#d9edf7;'>N&#176; Sesi&oacute;n</th>
            <th style='background-color:#d9edf7;'>RUT de qui&eacute;n ingres&oacute;</th>
            <th style='background-color:#d9edf7;'>Nombre</th>
            <th style='background-color:#d9edf7;'>Apellido</th>
            <th style='background-color:#d9edf7;'>Perfil</th>
            <th style='background-color:#d9edf7;'>Establecimiento</th>
            <th style='background-color:#d9edf7;'>Asistencia</th>
        </tr>
        <tbody>
HTML;
        
        foreach ($asistencia as $i => $val) {
            $perfil=getTipoUsuario($i);
            if($perfil == "UTP" || $perfil =="Profesor"){
                $datProfe = getRutNombre($i);
                $nombre = ($datProfe[0]["nombreProfesor"]);
                $apellido = ($datProfe[0]["apellidoPaternoProfesor"]." ".$datProfe[0]["apellidoMaternoProfesor"]);
                $establecimiento = (getNombreColegioProfesor($i));
                $asistencia= $val? "<td style='background-color:#dff0d8;'>Presente</td>":"<td style='background-color:#f2dede;'>Ausente</td>";
                $tabla .=<<<HTML
                    <tr>
                        <td>$curso</td>
                        <td>$numeroSes</td>
                        <td>$rutIngres</td>
                        <td>$nombre</td>
                        <td>$apellido</td>
                        <td>$perfil</td>
                        <td>$establecimiento</td>
                        $asistencia
                    </tr>
HTML;
            }
        }
    }
    $tabla.=<<<HTML
    </tbody>
    </table>
HTML;
  header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
  header("Content-Disposition: attachment; filename=Informe general de asistencia - $curso [".date("d-m-Y")."].xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  echo $titulos;
  echo $tabla;
}


?>
