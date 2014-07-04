<?php 
session_start();
require("inc/config.php");
require("_head.php");
$menu = "adm";
require("_menu.php"); 
$navegacion = "Administración*administracion.php";
require("_navegacion.php");
?>
<ul>
<li><a href="adm_competencias.php">Competencias</a></li>
<li><a href="adm_conductas.php">Conductas</a></li>
<li><a href="adm_familias.php">Familia de Cargos</a></li>
<li><a href="adm_cargos.php">Cargos</a></li>
<li><a href="adm_paises.php">Paises</a></li>
<li><a href="adm_empresas.php">Empresas</a></li>
<li><a href="adm_areas.php">Areas</a></li>
</ul>
<?php require("_pie.php"); ?>
