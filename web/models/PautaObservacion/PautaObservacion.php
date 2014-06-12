<?php
require_once (dirname(__FILE__) .'/../../db/pdo.php');

/**
 * Pauta Observacion
 */
class PautaObservacion
{
  public $idCongregacion;
  public $rbdColegio;
  public $rutProfesor;
  public $rutResponsable;
  public $idLibro;
  public $idCapitulo;
  public $idApartado;
  public $paginasTexto;
  public $paginasTextoEjercitacion;
  public $fecha;
  public $horaInicio;
  public $horaTermino;
  public $preguntaGestion;
  public $preguntaCondiciones;
  public $anoCurso;
  public $letraCurso;
  public $indicadoresGestion;
  public $indicadoresCondiciones;
  public $visibilidadUTP;

  public function save() {

    $db = new DB();

    $db->connectDb();

    $query = "INSERT INTO pautaObservacion (paginasTexto, paginasTextoEjercitacion, fecha, idCongregacion, rbdColegio, rutProfesor, rutResponsable, idLibro, idCapitulo, idApartado, horaInicio, horaTermino, preguntaGestion, preguntaCondiciones, anoCurso, letraCurso, indicadoresGestion, indicadoresCondiciones, visibilidadUTP) VALUES(:paginasTexto, :paginasTextoEjercitacion, :fecha, :idCongregacion, :rbdColegio, :rutProfesor, :rutResponsable, :idLibro, :idCapitulo, :idApartado, :horaInicio, :horaTermino, :preguntaGestion, :preguntaCondiciones, :anoCurso, :letraCurso, :indicadoresGestion, :indicadoresCondiciones, :visibilidadUTP)";

    $st = $db->getPDO()->prepare($query);

    $st->bindParam('paginasTexto', $this->paginasTexto);
    $st->bindParam('paginasTextoEjercitacion', $this->paginasTextoEjercitacion);
    $st->bindParam('fecha', $this->fecha);
    $st->bindParam('idCongregacion', $this->idCongregacion );
    $st->bindParam('rbdColegio', $this->rbdColegio );
    $st->bindParam('rutProfesor', $this->rutProfesor );
    $st->bindParam('rutResponsable', $this->rutResponsable );
    $st->bindParam('idLibro', $this->idLibro );
    $st->bindParam('idCapitulo', $this->idCapitulo );
    $st->bindParam('idApartado', $this->idApartado);
    $st->bindParam('horaInicio', $this->horaInicio);
    $st->bindParam('horaTermino', $this->horaTermino);
    $st->bindParam('preguntaGestion', $this->preguntaGestion);
    $st->bindParam('preguntaCondiciones', $this->preguntaCondiciones);
    $st->bindParam('anoCurso', $this->anoCurso);
    $st->bindParam('letraCurso', $this->letraCurso);
    $st->bindParam('indicadoresGestion', $this->indicadoresGestion);
    $st->bindParam('indicadoresCondiciones', $this->indicadoresCondiciones);
    $st->bindParam('visibilidadUTP', $this->visibilidadUTP);

    return $st->execute();
  }

  public function getProfesores($utp = null)
  {
    $db = new DB();


    $db->connectDb();
    if (is_null($utp) ) {
      $query = "SELECT DISTINCT(po.rutProfesor), CONCAT(p.nombreProfesor,' ', p.apellidoPaternoProfesor,' ', p.apellidoMaternoProfesor) as nombreProfesor FROM pautaObservacion as po JOIN profesor as p ON po.rutProfesor = p.rutProfesor WHERE po.estado = 1";
    } else {
      $query = "SELECT DISTINCT(po.rutProfesor), CONCAT(p.nombreProfesor,' ', p.apellidoPaternoProfesor,' ', p.apellidoMaternoProfesor) as nombreProfesor FROM pautaObservacion as po JOIN profesor as p ON po.rutProfesor = p.rutProfesor WHERE po.estado = 1 and po.visibilidadUTP = 1 and p.rbdColegio in ( SELECT rbdColegio FROM profesor WHERE rutProfesor = '$utp' )";

      
    }

    $sth = $db->query($query);

    return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getInforme($rutProfesor = null, $tipoUsuario = null)
  {
    $db = new DB();

    $db->connectDb();

    $query = "SELECT p.*, (SELECT CONCAT(pr.nombreProfesor,' ', pr.apellidoPaternoProfesor,' ', pr.apellidoMaternoProfesor)) as nombreResponsable, (SELECT nombreSeccionBitacora FROM seccionBitacora where idSeccionBitacora = p.idCapitulo) as capitulo,(SELECT nombreSeccionBitacora FROM seccionBitacora where idSeccionBitacora = p.idApartado) as apartado  FROM pautaObservacion as p
      JOIN profesor as pr 
      ON pr.rutProfesor = p.rutProfesor
      WHERE p.rutProfesor = '$rutProfesor'
      AND p.estado = 1";

    if ($tipoUsuario == 'UTP')
    {
      $query .= ' AND p.visibilidadUTP = 1';
    }

    $sth = $db->getPDO()->prepare($query);
    $sth->setFetchMode(PDO::FETCH_CLASS, 'PautaObservacion');
    $sth->execute();
    return $sth->fetchAll();
  }

  public function updateVisibilidad($id, $visibilidadUTP)
  {
    $db = new DB();

    $db->connectDb();

    $query = "UPDATE pautaObservacion SET visibilidadUTP =:visibilidadUTP WHERE id =:id";

    $sth = $db->getPDO()->prepare($query);
    $sth->bindParam('id', $id);
    $sth->bindParam('visibilidadUTP', $visibilidadUTP);

    return $sth->execute();
  }
}

?>
