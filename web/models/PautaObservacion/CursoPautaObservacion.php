<?php

require_once (dirname(__FILE__) .'/../../db/pdo.php');

/**
 * Modelo CursoPautaObservacion para funcionalidad de Pauta de observacion
 */
class CursoPautaObservacion
{
  
  public function getByRutProfesor($id) {

      $db = new DB();
      $db->connectDb();
      $query = "SELECT CONCAT( c.idNivel,'-',c.letraCursoColegio,'-',c.anoCursoColegio) as curso, CONCAT(n.nombreNivel,' ',c.letraCursoColegio,' ',c.anoCursoColegio) as nivel 
        FROM cursoColegio as c
        JOIN nivel as n
        ON n.idNivel = c.idNivel 
        WHERE c.rutProfesor = '{$id}' AND c.anoCursoColegio = YEAR(NOW())";
      $sth = $db->query($query);
      return $sth->fetchAll(PDO::FETCH_ASSOC);
  
  }

}
