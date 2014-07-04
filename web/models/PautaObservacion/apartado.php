<?php

require_once (dirname(__FILE__) .'/../../db/pdo.php');

/**
 * Apartado
 */
class Apartado
{
    public function getByCapituloId($id)
    {
      $db = new DB();

      $db->connectDb();

      $query = "SELECT idSeccionBitacora as id, nombreSeccionBitacora as nombre FROM seccionBitacora WHERE idPadreSeccionBitacora = '{$id}'";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
