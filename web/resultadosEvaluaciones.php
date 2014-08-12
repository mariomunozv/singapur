<?php
ini_set("display_errors", "on");
require "inc/incluidos.php";
require "hd.php";

$idUsuario = $_SESSION["sesionIdUsuario"];
$idPerfil = $_SESSION["sesionPerfilUsuario"];
$rbdColegio = getRbdUsuario($idUsuario);
?>
<meta charset="iso-8859-1">
<style type="text/css" media="all">
  .block-btn {
    text-align: center;
    padding-bottom:15px;
    padding-top:10px;
  }
  .cajaCentralFondo {
    margin-top:15px;
    width: 570px;
    background-image: url("../img/cajaCentralFondo2.png");
    background-repeat: repeat-y;
  }
</style>
<body>
<div id="principal">
<?php
require "topMenu.php";
$navegacion = "Home*mural.php?idCurso=$idCurso,Resultados Evaluaciones*#";
require "_navegacion.php";
?>

  <div id="lateralIzq">
    <?php require "menuleft.php"; ?>
  </div> <!--lateralIzq-->

  <div id="lateralDer"> <?php require "menuright.php"; ?>
  </div><!--lateralDer-->

  <div id="columnaCentro">
  <p class="titulo_curso">Resultados Evaluaciones</p>
    <hr /><br />
    <!--Contenido-->

  </div>

<?php require "pie.php";?>

</div>
</body>
</html>
