<?php

require_once (dirname(__FILE__) .'/../../db/pdo.php');

/**
 * Capitulo
 */
class Capitulo
{
    public function getByLibro($libro)
    {
      $db = new DB();

      $db->connectDb();

      $query = "SELECT idSeccionBitacora as id, nombreSeccionBitacora as nombre FROM seccionBitacora WHERE idPadreSeccionBitacora IS NULL and parteLibro = '{$libro}'";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
