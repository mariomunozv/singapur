<?php
require("inc/config.php");
include "../inc/_funciones.php";

$idActividad = $_REQUEST["idActividad"];

function getActividades($idActividad)
{
$sql = "SELECT ap.*";
$sql .= " FROM actividad a, actividadPagina ap";
$sql .= " WHERE a.idActividad = ap.idActividad ";
$sql .= " AND ap.idActividad = ".$idActividad;
$sql .= " Order By(ordenActividadPagina)";
//echo $sql;
$res = mysql_query($sql);
$i=0;
while($row = mysql_fetch_array($res))
{
	$actividades[$i] = array(
	"idActividadPagina" => $row["idActividadPagina"],
	"idActividad" => $row["idActividad"],
	"nombreActividadPagina" => $row["nombreActividadPagina"],
	"tipoActividadPagina" => $row["tipoActividadPagina"],
	"ordenActividadPagina" => $row["ordenActividadPagina"]
	);
	$i++;
}
return ($actividades);
}



$actividades = getActividades($idActividad);
?>

<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/jquery.form.js"></script>  
<script type="text/javascript" src="js/main.js"></script> 
<script type="text/javascript" src="js/funciones.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>  
<script type="text/javascript" src="js/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript" src="js/validarut.js"></script> 
<script type="text/javascript" src="js/jquery.Rut.js"></script>
<script type="text/javascript" src="js/jquery.Rut.js"></script>
<script type="text/javascript" src="js/tablednd.js"></script>

<?php
boton("Nueva Pagina", "new_pagina($idActividad);");
?>

<script>
$('#tblAcPag').tableDnD({
        onDrop: function(table, row) {
           var a = $.tableDnD.serialize();
		   var division = document.getElementById("nuevo");
		   AJAXPOST("actividadesPaginaOrdenar.php",a,division);
        },

    });
</script>


<table class="tableSorter" id="tblAcPag">
	<tbody>
        <tr class="nodrop nodrag">
            <th>idActividadPagina</th>
            <th>idActividad</th>
            <th>Nombre Actvidad Página</th>
            <th>Tipo</th>
            <th>Orden</th>
            <th>Editar</th>
            <th>Ver Detalle</th>
        </tr>
        <?php 
        foreach($actividades as $actividad)
        {
        ?>
        <tr id="<?php echo $actividad["idActividadPagina"];?>" onmouseout="this.className='normal'" onmouseover="this.className='normalActive'">
            <td><?php echo $actividad["idActividadPagina"]; ?></td>
            <td><?php echo $actividad["idActividad"]; ?></td>
            <td><?php echo $actividad["nombreActividadPagina"]; ?></td>
            <td><?php echo $actividad["tipoActividadPagina"];?></td>
            <td><?php echo $actividad["ordenActividadPagina"];?></td>
            <td><a href="javascript:edit_actividadPagina(<?php echo $actividad["idActividad"].",".$actividad["idActividadPagina"] ?>)">Editar</a></td>
            <td><a id="detalle" href="javascript:listaPaginas(<?php echo $actividad["idActividadPagina"] ?>)">Ver Detalle</a></td>
        </tr>
        <?php } ?>
	<tbody>
</table>

