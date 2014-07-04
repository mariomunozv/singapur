<?php
  
require_once (dirname(__FILE__) .'/../../db/pdo.php');

class IndicadorGestion
{
  public function all() {

      $db = new DB();

      $db->connectDb();

      $query = "SELECT id, descripcion FROM indicadoresGestion WHERE estado = 1";

      $sth = $db->query($query);

      return $sth->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>
