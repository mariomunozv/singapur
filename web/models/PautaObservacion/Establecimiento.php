<?php

require_once '../db/pdo.php';

/**
 * Modelo Establecimiento para funcionalidad Pauta de Observacion
 */
class Establecimiento
{

  public function getByIdCongregacion($id) {

      $db = new DB();

      $db->connectDb();

      $query = "SELECT rbdColegio, nombreColegio 
        FROM colegio 
        WHERE estadoColegio = 1
        AND idCongregacion = '{$id}'";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_ASSOC);
  }

}
