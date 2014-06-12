<?php

require_once (dirname(__FILE__) .'/../../db/pdo.php');

/**
 * Libro
 */
class Libro
{
    public function getLibros()
    {
      $db = new DB();

      $db->connectDb();

      $query = "SELECT parteLibro FROM seccionBitacora GROUP BY parteLibro HAVING parteLibro IS NOT NULL";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
