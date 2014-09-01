<?php

function existePK($ano, $numero, $rbdColegio ){
    $sql = "SELECT * 
            FROM visitaEscuela
            WHERE rbdColegio = $rbdColegio
            AND anoVisitaEscuela = $ano
            AND numeroVisitaEscuela = $numero";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    if(count($row)>1){
        return true;
    }else{
        return false;
    }
}

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

function nombreCargoDirectivo($post){
    $nombres = "";
    $cargos = "";
    for ($num=5; $num > 0; $num--) { 
        
        $nombreDirectivo = "";
        $cargoDirectivo  = "";
        if( $post["participante-reunion-cargo-".$num]!="" ){
            if($post["participante-reunion-cargo-".$num]=="Otro"){
                if($post["otro-participante-reunion-directivos-".$num]!=""){
                    $nombreDirectivo = $post["otro-participante-reunion-directivos-".$num];
                    $cargoDirectivo  = $post["otro-participante-reunion-cargo-".$num];
                }
            }else{
                $cargoDirectivo = $post["participante-reunion-cargo-".$num];
                if($post["select-docente-directivos-".$num]=="otr" && $post["otro-participante-reunion-directivos-".$num]!=""){
                    $nombreDirectivo = $post["otro-participante-reunion-directivos-".$num];
                }
                if($post["select-docente-directivos-".$num]!="otr" && $post["select-docente-directivos-".$num]!=""){
                    $nombreDirectivo = $post["select-docente-directivos-".$num];
                }
            }
        }
        if($nombreDirectivo =="" || $cargoDirectivo == ""){
            $nombreDirectivo = "";
            $cargoDirectivo  = "";
        }
        $cargos = "'".$cargoDirectivo."', ".$cargos;
        $nombres = "'".$nombreDirectivo."', ".$nombres;
    }
    return $nombres.$cargos;

}

function getNombreColegio($rbdColegio){
    $sql = "SELECT nombreColegio 
            FROM colegio 
            WHERE rbdColegio = $rbdColegio";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res); 
    return($row["nombreColegio"]);
}

function getNombreAsesor($id){
    //echo $rutEmpleadoKlein;
    $sql = "SELECT * 
            FROM empleadoKlein ek join usuario us ON ek.rutEmpleadoKlein=us.rutEmpleadoKlein
            WHERE us.idUsuario = '$id'";
    //echo $sql;
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $nombreEmpleadoKlein = $row["nombreEmpleadoKlein"]." ".$row["apellidoPaternoEmpleadoKlein"]." ".$row["apellidoMaternoEmpleadoKlein"];
    return ($nombreEmpleadoKlein);
}
function getNombreProfe($rut){
    $sql = "SELECT * 
            FROM profesor
            WHERE rutProfesor = '$rut'";
    //echo $sql;
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    $nombre = $row["nombreProfesor"]." ".$row["apellidoPaternoProfesor"]." ".$row["apellidoMaternoProfesor"];
    return ($nombre);
}

function crearVisitaEscuela($post){
    $nombreColegio = getNombreColegio($post["rbdColegio"]);
    $nombreAsesor = getNombreAsesor($post["idAsesor"]);
    $numeroVisitas = $post["numeroVisita"]!="" ? $post["numeroVisita"] : $post["numeroVisitaOtro"];
    $fechaActual = date("Y-m-d h:i:s");
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-0"]!="otr"){
        $nombreDocenteColectivo1 = $post["select-docente-colectivo-0"];
        $cursoDocenteColectivo1  = $post["select-cursos-colectivo-0"];
    }else{
        $nombreDocenteColectivo1 = $post["input-otro-docente-colectivo-0"];
        $cursoDocenteColectivo1  = $post["input-otro-cursos-colectivo-0"];
    }
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-1"]!="otr"){
        $nombreDocenteColectivo2 = $post["select-docente-colectivo-1"];
        $cursoDocenteColectivo2  = $post["select-cursos-colectivo-1"];
    }else{
        $nombreDocenteColectivo2 = $post["input-otro-docente-colectivo-1"];
        $cursoDocenteColectivo2  = $post["input-otro-cursos-colectivo-1"];
    }
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-2"]!="otr"){
        $nombreDocenteColectivo3 = $post["select-docente-colectivo-2"];
        $cursoDocenteColectivo3  = $post["select-cursos-colectivo-2"];
    }else{
        $nombreDocenteColectivo3 = $post["input-otro-docente-colectivo-2"];
        $cursoDocenteColectivo3  = $post["input-otro-cursos-colectivo-2"];
    }
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-3"]!="otr"){
        $nombreDocenteColectivo4 = $post["select-docente-colectivo-3"];
        $cursoDocenteColectivo4  = $post["select-cursos-colectivo-3"];
    }else{
        $nombreDocenteColectivo4 = $post["input-otro-docente-colectivo-3"];
        $cursoDocenteColectivo4  = $post["input-otro-cursos-colectivo-3"];
    }
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-4"]!="otr"){
        $nombreDocenteColectivo5 = $post["select-docente-colectivo-4"];
        $cursoDocenteColectivo5  = $post["select-cursos-colectivo-4"];
    }else{
        $nombreDocenteColectivo5 = $post["input-otro-docente-colectivo-4"];
        $cursoDocenteColectivo5  = $post["input-otro-cursos-colectivo-4"];
    }
    $tema1 = $post["docentes-colectivo-1"]=="on" ? 1 : 0;
    $tema2 = $post["docentes-colectivo-2"]=="on" ? 1 : 0; 
    $tema3 = $post["docentes-colectivo-3"]=="on" ? 1 : 0; 
    $tema4 = $post["docentes-colectivo-4"]=="on" ? 1 : 0; 
    $tema5 = $post["docentes-colectivo-5"]=="on" ? 1 : 0;

    $tema1Directivo = $post["check-factores-institucionales"]=="on" ? 1 : 0;
    $tema2Directivo = $post["check-factores-pedagogicos"]=="on" ? 1 : 0;
    $retro1Directivo = $post["check-retroalimentacion-1"]=="on" ? 1 : 0;
    $retro2Directivo = $post["check-retroalimentacion-2"]=="on" ? 1 : 0;
    $retro3Directivo = $post["check-retroalimentacion-3"]=="on" ? 1 : 0;
    $retro4Directivo = $post["check-retroalimentacion-4"]=="on" ? 1 : 0;

    $fechaVisita = substr($post["fechaVisita"],6,4)."-".substr($post["fechaVisita"], 3,2)."-".substr($post["fechaVisita"], 0,2);
    
    $sql = "INSERT INTO `visitaEscuela` (`idVisitaEscuela`, `anoVisitaEscuela`, `rbdColegio`, `nombreColegioVisitaEscuela`, `numeroVisitaEscuela`, `idAsesorVisitaEscuela`, `nombreAsesorVisitaEscuela`, `fechaRegistroVisitaEscuela`, `fechaVisitaEscuela`, `horaLlegadaVisitaEscuela`, `horaSalidaVisitaEscuela`, `nombreDocenteColectivo1`, `nombreDocenteColectivo2`, `nombreDocenteColectivo3`, `nombreDocenteColectivo4`, `nombreDocenteColectivo5`, `cursoDocenteColectivo1`, `cursoDocenteColectivo2`, `cursoDocenteColectivo3`, `cursoDocenteColectivo4`, `cursoDocenteColectivo5`, `indicador1VisitaEscuela`, `indicador2VisitaEscuela`, `indicador3VisitaEscuela`, `indicador4VisitaEscuela`, `indicador5VisitaEscuela`, `indicador6VisitaEscuela`, `indicador7VisitaEscuela`, `indicador8VisitaEscuela`, `indicador9VisitaEscuela`, `indicador10VisitaEscuela`, `indicador11VisitaEscuela`, `indicador12VisitaEscuela`, `indicador13VisitaEscuela`, `indicador14VisitaEscuela`, `DetalleIndicador14VisitaEscuela`, `refieraseAIndicadoresVisitaEscuela`, `cumplenDocentesVisitaEscuela`, `tema1VisitaEscuela`, `tema2VisitaEscuela`, `tema3VisitaEscuela`, `tema4VisitaEscuela`, `tema5VisitaEscuela`, `detalleTema5VisitaEscuela`, `acuerdosDocentesVisitaEscuela`, `nombreDirectivo1VisitaEscuela`, `nombreDirectivo2VisitaEscuela`, `nombreDirectivo3VisitaEscuela`, `nombreDirectivo4VisitaEscuela`, `nombreDirectivo5VisitaEscuela`, `cargoDirectivo1VisitaEscuela`, `cargoDirectivo2VisitaEscuela`, `cargoDirectivo3VisitaEscuela`, `cargoDirectivo4VisitaEscuela`, `cargoDirectivo5VisitaEscuela`, `cumplenDirectivosVisitaEscuela`, `detalleCumpleDocenteVisitaEscuela`, `detalleCumpleDirectivoVisitaEscuela`, `temaDirectivo1VisitaEscuela`, `detalleTemaDirectivo1VisitaEscuela`, `temaDirectivo2VisitaEscuela`, `detalleTemaDirectivo2VisitaEscuela`, `retroalimentacion1VisitaEscuela`, `detalleRetroalimentacion1VisitaEscuela`, `retroalimentacion2VisitaEscuela`, `detalleRetroalimentacion2VisitaEscuela`, `retroalimentacion3VisitaEscuela`, `detalleRetroalimentacion3VisitaEscuela`, `retroalimentacion4VisitaEscuela`, `detalleRetroalimentacion4VisitaEscuela`, `acuerdosDirectivoVisitaEscuela`) 
                                 VALUES (NULL,'".substr($post["fechaVisita"], 6)."', '".$post["rbdColegio"]."', '$nombreColegio', $numeroVisitas, '".$post["idAsesor"]."', '$nombreAsesor', '$fechaActual', '$fechaVisita', '".$post["horaLlegada"].":00', '".$post["horaSalida"].":00','$nombreDocenteColectivo1', '$nombreDocenteColectivo2', '$nombreDocenteColectivo3', '$nombreDocenteColectivo4', '$nombreDocenteColectivo5', '$cursoDocenteColectivo1', '$cursoDocenteColectivo2', '$cursoDocenteColectivo3', '$cursoDocenteColectivo4', '$cursoDocenteColectivo5',                 '".$post["fac-1"]."', '".$post["fac-2"]."', '".$post["fac-3"]."', '".$post["fac-4"]."', '".$post["fac-5"]."', '".$post["fac-6"]."', '".$post["fac-7"]."', '".$post["fac-8"]."', '".$post["fac-9"]."', '".$post["fac-10"]."', '".$post["fac-11"]."', '".$post["fac-12"]."', '".$post["fac-13"]."', '".$post["fac-14"]."', '".$post["fac-otro"]."', '".$post["refieraseMarcadosNo"]."', '".$post["cumplen-compromisos-docentes"]."',                                                                      '$tema1', '$tema2', '$tema3', '$tema4', '$tema5',                                      '".$post["apoyo-docentes-otro"]."', '".$post["acuerdos-docentes-colectivo"]."',      ".nombreCargoDirectivo($post)."                                                                                                                                                                                                                                                                                 '".$post["cumplen-compromisos-directivos"]."', '".$post["detalle-cumplen-docentes"]."', '".$post["detalle-cumplen-directivos"]."', '$tema1Directivo', '".$post["indicar-factores-institucionales"]."', '$tema2Directivo', '".$post["indicar-factores-pedagogicos"]."',       '$retro1Directivo', '".$post["indicar-retroalimentacion-1"]."', '$retro2Directivo', '".$post["indicar-retroalimentacion-2"]."', '$retro3Directivo', '".$post["indicar-retroalimentacion-3"]."', '$retro4Directivo', '".$post["indicar-retroalimentacion-4"]."', '".$post["acuerdos-directivo-visita"]."')";
    $res = mysql_query($sql);
    echo $res;
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
