<?php
function getProfesoresAsistencia($idCurso){
    $anoAct = date("Y")-2;
    $sql = "SELECT DISTINCT pr.nombreProfesor, pr.apellidoPaternoProfesor, pr.apellidoMaternoProfesor,co.nombreColegio,us.tipoUsuario,pr.rutProfesor
            FROM profesor pr JOIN cursocolegio cu on pr.rutProfesor = cu.rutProfesor
            JOIN colegio co on co.rbdColegio = pr.rbdColegio
            JOIN usuario us on us.rutProfesor=pr.rutProfesor
            WHERE cu.anoCursoColegio = $anoAct
            AND (us.tipoUsuario = 'UTP' OR us.tipoUsuario = 'Profesor' )";
    $res = mysql_query($sql);
    $i=0;
    while($row = mysql_fetch_array($res)){
        $docentes[$i] = $row;
        $i++;
    }
    if ($i == 0){
        $docentes = array();  
    }
    return($docentes);
}

function getRelatoresSesion(){
    $sql = "SELECT DISTINCT ek.rutEmpleadoKlein, nombreEmpleadoKlein, apellidoPaternoEmpleadoKlein,apellidoMaternoEmpleadoKlein
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


?>
