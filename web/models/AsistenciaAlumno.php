<?php

require '../db/pdo.php';

class AsistenciaAlumno {
    public $id;
    public $nombre;
    public $estado;
    public $asistio;
    public $fechaRespuestaPautaItem;
    public $fechaConfirmada;

    function getAlumnosSinPauta($curso) {
      $db = new DB();

      $db->connectDb();

      $query = "SELECT CONCAT(a.apellidoPaternoAlumno,' ', a.nombreAlumno) as nombre, u.idUsuario as id, a.estadoAlumno as estado, 1 as asistio, 0 as fechaConfirmada, NOW() fechaRespuestaPautaItem
        FROM `matricula` as m
        left join usuario as u on m.rutAlumno = u.rutAlumno
        left join alumno as a on m.rutAlumno = a.rutAlumno
        WHERE m.rbdColegio = '". $curso->rbd."'
        AND m.idNivel = ".$curso->idNivel."
        AND m.anoCursoColegio = ".$curso->ano."
        AND m.letraCursoColegio = "."'$curso->letra'"."
        ORDER BY a.apellidoPaternoAlumno ASC";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_CLASS, "AsistenciaAlumno");

    }

    function getAlumnos($curso, $idLista) {

      $db = new DB();

      $db->connectDb();

      $query = "SELECT CONCAT(a.apellidoPaternoAlumno,' ', a.nombreAlumno) as nombre, u.idUsuario as id, a.estadoAlumno as estado, pi.asistio as asistio, pi.fechaConfirmada, pi.fechaRespuestaPautaItem
        FROM `matricula` as m
        left join usuario as u on m.rutAlumno = u.rutAlumno
        left join alumno as a on m.rutAlumno = a.rutAlumno
        left join pautaItem as pi on pi.idUsuario = u.idUsuario
        WHERE m.rbdColegio = '". $curso->rbd."'
        AND m.idNivel = ".$curso->idNivel."
        AND m.anoCursoColegio = ".$curso->ano."
        AND m.letraCursoColegio = "."'$curso->letra'"."
        AND pi.idLista = ". $idLista ."
        ORDER BY a.apellidoPaternoAlumno ASC";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_CLASS, "AsistenciaAlumno");

    }

    public function makeHtml($index)
    {
        $presente = '';
        $ausente = '';
        if ($this->asistio == 1) {
          $presente = 'checked=checked';
        } else {
          $ausente = 'checked=checked';
        }

        echo "<tr>";
        echo "<td style='text-align:center'>" . $index . "</td>";
        echo "<td style='text-align:center'>" . $this->nombre . "</td>";
        echo "<td><input class='presente' type='radio' name=" . $this->id . " value='presente' " . $presente . " /></td>";
        echo "<td><input class='ausente' type='radio' name=" . $this->id ." value='ausente' " . $ausente . "/></td>";
        echo "</tr>";
    }

}
?>
