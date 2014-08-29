<?php



function getInfoVisita($idVisita){
    $sql = "SELECT * FROM visitaEscuela
            WHERE idVisitaEscuela = $idVisita";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    return $row;
}
function getDocentesVisita($idVisita){
    $sql = "SELECT * FROM observacionDocentesVisitaEscuela
            WHERE idVisitaEscuela = $idVisita";
    $res = mysql_query($sql);
    while($row = mysql_fetch_array($res)){
        $docentes[$i] = $row;
        $i++;
    }
    if ($i == 0){
        $docentes = array();  
    } 
    return($docentes);
}

function getTipoUser($idUsuario){
    $sql = "SELECT tipoUsuario FROM usuario WHERE idUsuario = ".$idUsuario;
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    return($row["tipoUsuario"]);
    
    }

function getInfoVisitaUsuario($idUsuario){
        $tipo = getTipoUser($idUsuario);
        if($tipo=="Directivo" || $tipo =="UTP"){
            $sql = "SELECT nombreColegioVisitaEscuela,numeroVisitaEscuela,anoVisitaEscuela,nombreAsesorVisitaEscuela,idVisitaEscuela
                    FROM visitaEscuela ve JOIN usuariocolegio uc ON ve.rbdColegio = uc.rbdColegio
                    WHERE uc.idUsuario=$idUsuario
                    AND anoVisitaEscuela=".date("Y");  
        }
        elseif($tipo == "Asesor"){
            $sql = "SELECT nombreColegioVisitaEscuela,numeroVisitaEscuela,anoVisitaEscuela,nombreAsesorVisitaEscuela,idVisitaEscuela
                    FROM visitaEscuela
                    WHERE idAsesorVisitaEscuela=$idUsuario
                    AND anoVisitaEscuela=".date("Y");  
        }
        elseif($tipo == "Coordinador General" ||$tipo == "Empleado Klein" ){
            $sql = "SELECT nombreColegioVisitaEscuela,numeroVisitaEscuela,anoVisitaEscuela,nombreAsesorVisitaEscuela,idVisitaEscuela
                    FROM visitaEscuela
                    WHERE anoVisitaEscuela=".date("Y");  
        }
        $res = mysql_query($sql);
        while($row = mysql_fetch_array($res)){
            $informes[$i] = $row;
            $i++;
        }
        if ($i == 0){
            $informes = array();  
        } 
        return($informes);
    }


?>
