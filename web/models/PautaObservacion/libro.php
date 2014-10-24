<?php

require_once (dirname(__FILE__) .'/../../db/pdo.php');

/**
 * Libro
 */
class Libro
{
    public function getLibros($nivel)
    {
      $db = new DB();

      $db->connectDb();

      $query = "SELECT parteLibro FROM seccionBitacora WHERE idNivelCursoSeccionBitacora = {$nivel} GROUP BY parteLibro HAVING parteLibro IS NOT NULL";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}
