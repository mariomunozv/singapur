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
                    $nombreDirectivo = getNombreProfe($post["select-docente-directivos-".$num]);
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

function validarVisitaEscuela($idVisita, $idUsuario){
    $tipo = getTipoUser($idUsuario);
    if($tipo=="Directivo" || $tipo =="UTP"){
        $sql = "SELECT nombreColegioVisitaEscuela,numeroVisitaEscuela,anoVisitaEscuela,nombreAsesorVisitaEscuela,idVisitaEscuela
                FROM visitaEscuela ve JOIN usuariocolegio uc ON ve.rbdColegio = uc.rbdColegio
                WHERE uc.idUsuario=$idUsuario
                AND ve.idVisitaEscuela = $idVisita
                AND anoVisitaEscuela=".date("Y");  
    }
    elseif($tipo == "Asesor"){
        $sql = "SELECT nombreColegioVisitaEscuela,numeroVisitaEscuela,anoVisitaEscuela,nombreAsesorVisitaEscuela,idVisitaEscuela
                FROM visitaEscuela
                WHERE idAsesorVisitaEscuela=$idUsuario
                AND idVisitaEscuela = $idVisita
                AND anoVisitaEscuela=".date("Y");  
    }
    elseif($tipo == "Coordinador General" ||$tipo == "Empleado Klein" ){
        $sql = "SELECT nombreColegioVisitaEscuela,numeroVisitaEscuela,anoVisitaEscuela,nombreAsesorVisitaEscuela,idVisitaEscuela
                FROM visitaEscuela
                WHERE idVisitaEscuela = $idVisita
                AND anoVisitaEscuela=".date("Y");  
    }
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    if(count($row)>1){ return 1; }
    return 0;
}

function crearObservacionDocente($post, $idVisita){
    if($post["select-observo-docentes"]=="si"){
        for($i=0; $i<5 ; $i++){
            if($post["select-docente-observado-".$i]!=""){
                $nombreDocente = "";
                $cursoDocente  = "";
                if($post["select-docente-observado-".$i]=="otr"){
                    $nombreDocente = $post["input-otro-docente-observado-".$i];
                    $cursoDocente  = $post["input-otro-cursos-observado-".$i];
                }else{
                    $nombreDocente = getNombreProfe($post["select-docente-observado-".$i]);
                    $cursoDocente  = $post["select-cursos-observado-".$i];
                }
                if($nombreDocente != "" && $cursoDocente != ""){
                    $accion1 = $post["doc1-".$i]=="on" ? 1 : 0;
                    $accion2 = $post["doc2-".$i]=="on" ? 1 : 0;
                    $accion3 = $post["doc3-".$i]=="on" ? 1 : 0;
                    $accion4 = $post["doc4-".$i]=="on" ? 1 : 0;
                    $accion5 = $post["doc5-".$i]=="on" ? 1 : 0;
                    $accion6 = $post["doc6-".$i]=="on" ? 1 : 0;
                    $accion7 = $post["doc7-".$i]=="on" ? 1 : 0;
                    $accion8 = $post["doc8-".$i]=="on" ? 1 : 0;
                    $sql_docente = "INSERT INTO `observacionDocentesVisitaEscuela` (`idObservacionDocenteVisitaEscuela`, `idVisitaEscuela`, `nombreDocenteObservacion`, `cursoDocenteObservacion`, `opcion1Observacion`, `opcion2Observacion`, `opcion3Observacion`, `opcion4Observacion`, `opcion5Observacion`, `opcion6Observacion`, `opcion7Observacion`, `opcion8Observacion`, `detalleOpcion8Observacion`,`observacionTrabajoConDocentes`) 
                                    VALUES (NULL, '$idVisita', '$nombreDocente', '$cursoDocente', '$accion1', '$accion2', '$accion3', '$accion4', '$accion5', '$accion6', '$accion7', '$accion8', '".$post["otroAccionDocente-".$i]."', '".$post["observacionTrabajoDocentes-".$i]."')";
                    $resp = mysql_query($sql_docente);
                }
            }
        }
    }
}

function crearVisitaEscuela($post){
    $nombreColegio = getNombreColegio($post["rbdColegio"]);
    $nombreAsesor = getNombreAsesor($post["idAsesor"]);
    $numeroVisitas = $post["numeroVisita"]!="" ? $post["numeroVisita"] : $post["numeroVisitaOtro"];
    $fechaActual = date("Y-m-d h:i:s");
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-0"]!="otr"){
        $nombreDocenteColectivo1 = getNombreProfe($post["select-docente-colectivo-0"]);
        $cursoDocenteColectivo1  = $post["select-cursos-colectivo-0"];
    }else{
        $nombreDocenteColectivo1 = $post["input-otro-docente-colectivo-0"];
        $cursoDocenteColectivo1  = $post["input-otro-cursos-colectivo-0"];
    }
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-1"]!="otr"){
        $nombreDocenteColectivo2 = getNombreProfe($post["select-docente-colectivo-1"]);
        $cursoDocenteColectivo2  = $post["select-cursos-colectivo-1"];
    }else{
        $nombreDocenteColectivo2 = $post["input-otro-docente-colectivo-1"];
        $cursoDocenteColectivo2  = $post["input-otro-cursos-colectivo-1"];
    }
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-2"]!="otr"){
        $nombreDocenteColectivo3 = getNombreProfe($post["select-docente-colectivo-2"]);
        $cursoDocenteColectivo3  = $post["select-cursos-colectivo-2"];
    }else{
        $nombreDocenteColectivo3 = $post["input-otro-docente-colectivo-2"];
        $cursoDocenteColectivo3  = $post["input-otro-cursos-colectivo-2"];
    }
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-3"]!="otr"){
        $nombreDocenteColectivo4 = getNombreProfe($post["select-docente-colectivo-3"]);
        $cursoDocenteColectivo4  = $post["select-cursos-colectivo-3"];
    }else{
        $nombreDocenteColectivo4 = $post["input-otro-docente-colectivo-3"];
        $cursoDocenteColectivo4  = $post["input-otro-cursos-colectivo-3"];
    }
    if($post["select-docente-colectivo-0"]!="" && $post["select-docente-colectivo-4"]!="otr"){
        $nombreDocenteColectivo5 = getNombreProfe($post["select-docente-colectivo-4"]);
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
    if($res){
        crearObservacionDocente($post, mysql_insert_id() );
        echo 8;
    }else{
        echo 7;
    }
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

function getVisitasUsuario($idUsuario){
    $tipo = getTipoUser($idUsuario);
    if($tipo == "Coordinador General" ||$tipo == "Empleado Klein" ){
        $sql = "SELECT *
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

function booleano($i){
    if($i){
        return "Si";
    }else{
        return "No";
    }
}

function informeExcel()
{

    $titulos =<<<HTML
    <table>
    <tr>
        <th colspan='34'></th>
        <th colspan='50'>Trabajo con docentes de forma individual</th>
        <th colspan='12' rowspan='2'>Trabajo colectivo con docentes</th>
        <th rowspan ='2' colspan='18'>Reunion con directivos</th>
    </tr>
    <tr>
       <th colspan='9'>Datos Generales</th>
       <th colspan='10'>Observación de clases</th>
       <th colspan='15'>Factores que afectan la implementación</th>
       <th colspan='10'>Trabajo con Docente 1</th>
       <th colspan='10'>Trabajo con Docente 2</th>
       <th colspan='10'>Trabajo con Docente 3</th>
       <th colspan='10'>Trabajo con Docente 4</th>
       <th colspan='10'>Trabajo con Docente 5</th>
    </tr>
    <tr>
        <th rowspan='2'>ID</th>
        <th rowspan='2'>Año</th>
        <th rowspan='2'>Fecha de ingreso</th>
        <th rowspan='2'>RBD establecimiento</th>
        <th rowspan='2'>Asesor</th>
        <th rowspan='2'>nº Visita</th>
        <th rowspan='2'>Fecha de la visita</th>
        <th rowspan='2'>Hora de llegada a la escuela</th>
        <th rowspan='2'>Hora de salida de la escuela</th>
        <th rowspan='2'>Nombre del docente 1</th>
        <th rowspan='2'>Curso 1</th>
        <th rowspan='2'>Nombre del docente 2</th>
        <th rowspan='2'>Curso 2</th>
        <th rowspan='2'>Nombre del docente 3</th>
        <th rowspan='2'>Curso 3</th>
        <th rowspan='2'>Nombre del docente 4</th>
        <th rowspan='2'>Curso 4</th>
        <th rowspan='2'>Nombre del docente 5</th>
        <th rowspan='2'>Curso 5</th>
        <th rowspan='2'>Indicador 1</th>
        <th rowspan='2'>Indicador 2</th>
        <th rowspan='2'>Indicador 3</th>
        <th rowspan='2'>Indicador 4</th>
        <th rowspan='2'>Indicador 5</th>
        <th rowspan='2'>Indicador 6</th>
        <th rowspan='2'>Indicador 7</th>
        <th rowspan='2'>Indicador 8</th>
        <th rowspan='2'>Indicador 9</th>
        <th rowspan='2'>Indicador 10</th>
        <th rowspan='2'>Indicador 11</th>
        <th rowspan='2'>Indicador 12</th>
        <th rowspan='2'>Indicador 13</th>
        <th rowspan='2'>Indicador 14</th>
        <th rowspan='2'>Refierase a indicadores marcados</th>
        <th rowspan='2'>Nomnbre docente 1</th>
        <th rowspan='2'>Curso 1</th>
        <th rowspan='1' colspan='8'>Tipo de trabajo realizado</th>
        <th rowspan='2'>Nomnbre docente 2</th>
        <th rowspan='2'>Curso 2</th>
        <th rowspan='1' colspan='8'>Tipo de trabajo realizado</th>
        <th rowspan='2'>Nomnbre docente 3</th>
        <th rowspan='2'>Curso 3</th>
        <th rowspan='1' colspan='8'>Tipo de trabajo realizado</th>
        <th rowspan='2'>Nomnbre docente 4</th>
        <th rowspan='2'>Curso 4</th>
        <th rowspan='1' colspan='8'>Tipo de trabajo realizado</th>
        <th rowspan='2'>Nomnbre docente 5</th>
        <th rowspan='2'>Curso 5</th>
        <th rowspan='1' colspan='8'>Tipo de trabajo realizado</th>
        <th rowspan='2'>Nombre docente 1</th>
        <th rowspan='2'>Nombre docente 2</th>
        <th rowspan='2'>Nombre docente 3</th>
        <th rowspan='2'>Nombre docente 4</th>
        <th rowspan='2'>Nombre docente 5</th>
        <th rowspan='2'>Se cumplen acuerdos o compromisos</th>
        <th rowspan='1' colspan="5">Temas abordados</th>
        <th rowspan='2'>Acuerdos o compromisos</th>
        <th rowspan='1' colspan='2'>Directivo 1</th>
        <th rowspan='1' colspan='2'>Directivo 2</th>
        <th rowspan='1' colspan='2'>Directivo 3</th>
        <th rowspan='1' colspan='2'>Directivo 4</th>
        <th rowspan='1' colspan='2'>Directivo 5</th>
        <th rowspan='2'>Se cumplen compromisos anteriores</th>
        <th colspan='2'>Temas abordados en la reunión</th>
        <th colspan='4'>Retroalimentación al establecimiento</th>
        <th rowspan='2'>Acuerdos y compromisos</th>
    </tr>
    <tr>
        <th>Opción 1</th><th>Opción 2</th><th>Opción 3</th><th>Opción 4</th><th>Opción 5</th><th>Opción 6</th><th>Opción 7</th><th>Opción 8</th>
        <th>Opción 1</th><th>Opción 2</th><th>Opción 3</th><th>Opción 4</th><th>Opción 5</th><th>Opción 6</th><th>Opción 7</th><th>Opción 8</th>
        <th>Opción 1</th><th>Opción 2</th><th>Opción 3</th><th>Opción 4</th><th>Opción 5</th><th>Opción 6</th><th>Opción 7</th><th>Opción 8</th>
        <th>Opción 1</th><th>Opción 2</th><th>Opción 3</th><th>Opción 4</th><th>Opción 5</th><th>Opción 6</th><th>Opción 7</th><th>Opción 8</th>
        <th>Opción 1</th><th>Opción 2</th><th>Opción 3</th><th>Opción 4</th><th>Opción 5</th><th>Opción 6</th><th>Opción 7</th><th>Opción 8</th>
        <th>Tema 1</th><th>Tema 2</th><th>Tema 3</th><th>Tema 4</th><th>Tema 5</th>
        <th>Nombre del directivo 1</th>
        <th>Cargo del directivo 1</th>
        <th>Nombre del directivo 2</th>
        <th>Cargo del directivo 2</th>
        <th>Nombre del directivo 3</th>
        <th>Cargo del directivo 3</th>
        <th>Nombre del directivo 4</th>
        <th>Cargo del directivo 4</th>
        <th>Nombre del directivo 5</th>
        <th>Cargo del directivo 5</th>
        <th>Tema 1</th>
        <th>Tema 2</th>
        <th>Tema 1</th>
        <th>Tema 2</th>
        <th>Tema 3</th>
        <th>Tema 4:otro</th>
    </tr>
    <tbody>
HTML;

$datos = getVisitasUsuario($_SESSION["sesionIdUsuario"]);
    foreach ($datos as $val) {
        $arreglo = [38,39,40,41,42,58,60,62,64,66,68];
        foreach($arreglo as $i){
            $val[$i] = $val[$i] ? "Si: " : "No";
        }
        $val[7]=substr($val[7], 8,2)."/".substr($val[7],5,2)."/".substr($val[7], 0,4)." [".substr($val[7], 11,5)."]";
        $val[8]=substr($val[8], 8,2)."/".substr($val[8],5,2)."/".substr($val[8], 0,4);
        $val[9]=substr($val[9], 0,5);
        $val[10]=substr($val[10], 0,5);
        $docentes = getDocentesVisita($val[0]);
        echo "-".count($docentes)."-";
        for ($i=0; $i < 5 ; $i++) { 
            if(count($docentes)>$i){
                $nombres[$i] = $docentes[$i][2];
                $cursos[$i] = $docentes[$i][3];
            }else{
                $nombres[$i] = "";
                $cursos[$i] = "";
            }
            
        }

        $tabla .=<<<HTML
            <tr>
                <td>$val[0]</td>
                <td>$val[1]</td>
                <td>$val[7]</td>
                <td>$val[2]</td>
                <td>$val[6]</td>
                <td>$val[4]</td>
                <td>$val[8]</td>
                <td>$val[9]</td>
                <td>$val[10]</td>
                <td>$nombres[0]</td>
                <td>$cursos[0]</td>
                <td>$nombres[1]</td>
                <td>$cursos[1]</td>
                <td>$nombres[2]</td>
                <td>$cursos[2]</td>
                <td>$nombres[3]</td>
                <td>$cursos[3]</td>
                <td>$nombres[4]</td>
                <td>$cursos[4]</td>

                <td>$val[21]</td>
                <td>$val[22]</td>
                <td>$val[23]</td>
                <td>$val[24]</td>
                <td>$val[25]</td>
                <td>$val[26]</td>
                <td>$val[27]</td>
                <td>$val[28]</td>
                <td>$val[29]</td>
                <td>$val[30]</td>
                <td>$val[31]</td>
                <td>$val[32]</td>
                <td>$val[33]</td>
                <td>$val[34]: $val[35]</td>
                <td>$val[36]</td>
                <td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>
                <td>$val[11]</td>
                <td>$val[12]</td>
                <td>$val[13]</td>
                <td>$val[14]</td>
                <td>$val[15]</td>
                <td>$val[37]: $val[56]</td>
                <td>$val[38]</td><!--tema1-->
                <td>$val[39]</td><!--tema2-->
                <td>$val[40]</td><!--tema3-->
                <td>$val[41]</td><!--tema4-->
                <td>$val[42]</td><!--tema5-->
                <td>$val[44]</td>

                <td>$val[45]</td><!--directivo-->
                <td>$val[50]</td><!--curso-->

                <td>$val[46]</td><!--directivo-->
                <td>$val[51]</td><!--curso-->

                <td>$val[47]</td><!--directivo-->
                <td>$val[52]</td><!--curso-->

                <td>$val[48]</td><!--directivo-->
                <td>$val[53]</td><!--curso-->

                <td>$val[49]</td><!--directivo-->
                <td>$val[54]</td><!--curso-->

                <td>$val[55]: $val[57]</td>
                <td>$val[58]$val[59]</td>
                <td>$val[60]$val[61]</td>
                <td>$val[62]$val[63]</td>
                <td>$val[64]$val[65]</td>
                <td>$val[66]$val[67]</td>
                <td>$val[68]$val[69]</td>
                <td>$val[70]</td>

            </tr>
HTML;
    }
    $tabla.=<<<HTML
    </tbody>
    </table>
HTML;

  header('Content-type: application/vnd.ms-excel');
  header("Content-Disposition: attachment; filename=visitaEscuela[".date("d-m-Y")."].xls");
  header("Pragma: no-cache");
  header("Expires: 0");
  echo $titulos;
  echo $tabla;
}


?>
