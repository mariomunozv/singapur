<?php

require_once (dirname(__FILE__) .'/../../db/pdo.php');

/**
 * Modelo profesor para funcionalidad de Pauta de observacion
 */
class Profesor
{
  
  public function getByEstablecimientoId($id) {

      $db = new DB();

      $db->connectDb();

      $query = "SELECT rutProfesor, CONCAT(nombreProfesor,' ', apellidoPaternoProfesor) as nombre 
        FROM profesor 
        WHERE rbdColegio = {$id}
        AND estadoProfesor = 1";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_ASSOC);
  
  }

  public function getEstablecimientoByRut($rut) {

      $db = new DB();

      $db->connectDb();

      $query = "SELECT p.rbdColegio, c.nombreColegio, c.idCongregacion, con.nombre as nombreCongregacion
        FROM profesor as p
        JOIN colegio as c
        ON p.rbdColegio = c.rbdColegio 
        JOIN congregacion as con
        ON c.idCongregacion = con.id
        WHERE rutProfesor = '{$rut}'";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_ASSOC);
  
  }

}
