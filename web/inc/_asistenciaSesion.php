<?php


function getRelatoresSesion(){
    $sql = "SELECT DISTINCT us.idUsuario, ek.rutEmpleadoKlein, nombreEmpleadoKlein, apellidoPaternoEmpleadoKlein,apellidoMaternoEmpleadoKlein
            FROM empleadoklein ek JOIN usuario us on us.rutEmpleadoKlein=ek.rutEmpleadoKlein
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

function getIdPerfil($idUsuario){
    $sql = "SELECT idPerfil
            FROM detalleUsuarioProyectoPerfil
            WHERE idUsuario = $idUsuario ";
    $res = mysql_query($sql);
    return mysql_fetch_array($res)["idPerfil"];
}

function getNumerosSesionesCurso($idCurso,$idUsuario){
    $idPerfil=getIdPerfil($idUsuario);
    if($idPerfil == 5){
        $sql = "SELECT numeroSesion
            FROM informeSesion inf JOIN detalleUsuarioProyectoPerfil per on inf.idRelator = per.idUsuario
            WHERE idCursoCapacitacion = $idCurso AND inf.idRelator = $idUsuario";
    }else{
        $sql = "SELECT numeroSesion
            FROM informeSesion inf JOIN detalleUsuarioProyectoPerfil per on inf.idRelator = per.idUsuario
            WHERE idCursoCapacitacion = $idCurso";
    }
    $res = mysql_query($sql);
    $i=0;
    
    while($row = mysql_fetch_array($res)){
        $informes[$i] = $row["numeroSesion"];
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

function getDatosSesion($idCurso, $numSesion){
    $sql = "SELECT *
            FROM informeSesion
            WHERE idCursoCapacitacion = $idCurso AND numeroSesion = $numSesion ";
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
function getDetalleSesion(){

}
function newInformeSesion($post){
    $fecha = substr($post["fechaSesion"],-4,4)."-".substr($post["fechaSesion"],-7,2)."-".substr($post["fechaSesion"],0,2);
    $sql = "INSERT INTO `informeSesion` (`idInformeSesion`, `idRelator`, `idCursoCapacitacion`, `numeroSesion`, `fechaSesion`) 
                                 VALUES (NULL,".$post["idRelator"].",".$post["idCurso"].",".$post["numeroSesion"].",'$fecha')";
    $res = mysql_query($sql);
    echo $sql;
}

function updateInformeSesion($post){
    $fecha = substr($post["fechaSesion"],-4,4)."-".substr($post["fechaSesion"],-7,2)."-".substr($post["fechaSesion"],0,2);
    $sql ="UPDATE `informeSesion` SET `fechaSesion` = '$fecha',`idRelator` = '".$post["idRelator"]."', `idCursoCapacitacion` = '".$post["idCurso"]."'  WHERE `informesesion`.`numeroSesion` = ".$post["numeroSesion"]." AND `informesesion`.`idCursoCapacitacion` = ".$post["idCurso"];
    $res = mysql_query($sql);
    echo $sql;
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



?>
