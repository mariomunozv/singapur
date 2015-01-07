<?php
require("../inc/incluidos.php");
require("../inc/_asistenciaSesion.php");
require("../inc/_inscripcionCursoCapacitacion.php");
require("../inc/_usuario.php");
require("../inc/_profesor.php");
?>
<style>
th,td{
    border:1px solid #000;
}
</style>

<?php informeExcelAsistenciaGeneral($_GET["c"]); ?>