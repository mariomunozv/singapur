<?php

require_once (dirname(__FILE__) .'/../../db/pdo.php');

/**
 * Congregacion
 */
class Congregacion
{
    public function get()
    {
      $db = new DB();

      $db->connectDb();

      $query = "SELECT id, nombre FROM congregacion";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
