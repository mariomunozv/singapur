<?php

Class PautaItem {
  public $idLista;
  public $fechaRespuestaPautaItem;
  public $idUsuario;
  public $asistio;
  public $fechaConfirmada;

  function updateAsistencia() {
    $db = new DB();

    $db->connectDb();

    $query = "UPDATE pautaItem SET fechaRespuestaPautaItem =:fecha, asistio =:asistio, fechaConfirmada =:fechaConfirmada  WHERE idUsuario =:idUsuario and idLista =:idLista";

    $st = $db->getPDO()->prepare($query);

    $st->bindParam( 'fecha', $this->fechaRespuestaPautaItem );
    $st->bindParam( 'fechaConfirmada', $this->fechaConfirmada);
    $st->bindParam( 'asistio', $this->asistio );
    $st->bindParam( 'idUsuario', $this->idUsuario );
    $st->bindParam( 'idLista', $this->idLista );

    $st->execute();

  }

  function insertPautaItem() {
    $db = new DB();

    $db->connectDb();

    $query = "INSERT INTO pautaItem (fechaRespuestaPautaItem, asistio, fechaConfirmada, idUsuario, idLista) VALUES(:fecha, :asistio, :fechaConfirmada, :idUsuario, :idLista)";

    $st = $db->getPDO()->prepare($query);

    $st->bindParam( 'fecha', $this->fechaRespuestaPautaItem );
    $st->bindParam( 'asistio', $this->asistio );
    $st->bindParam( 'fechaConfirmada', $this->fechaConfirmada);
    $st->bindParam( 'idUsuario', $this->idUsuario );
    $st->bindParam( 'idLista', $this->idLista );

    $st->execute();

  }

}
?>
