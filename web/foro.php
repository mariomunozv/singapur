<?php 
require("inc/incluidos.php");
require ("hd.php");

$idCurso = $_SESSION["sesionIdCurso"];
$_SESSION["sesionIdCurso"] = $idCurso; 
?>

<script language="javascript">
$(function() {
	<?php /* Asi inicializas tablesorter */ ?>	   
	$("#tabla").tablesorter({ 
		headers: {  
			5: { sorter: false },
			6: { sorter: false }  // Esto es para inabilitar el filtro en una columna
		},
		widthFixed: true,
		widgets: ['zebra']}).tablesorterPager({
			container: $("#pager"),
			positionFixed: false,
			size:1 //Numero de registros tb
			});  
}); 
</script> 
<body>

<div id="principal">
<?php 
	require("topMenu.php"); 
	$navegacion = "Home*curso.php?idCurso=$idCurso,Foro*#";	
	require("_navegacion.php");

?>
	
	<div id="lateralIzq">
    <?php 
		require("menuleft.php");
		require ("categoriaForo.php");
	?>
    </div> <!--lateralIzq-->
    
    <div id="lateralDer">
	    <?php require("menuright.php");?>
    </div><!--lateralDer-->
    
     <div id="columnaCentro">
		<p class="titulo_curso">Foros de Conversación</p>
    	<hr/><br />

		<div class="demo">
        	<table width="100%" border="0" cellspacing="2" class="tablesorter">
            	<tr class="ui-state-active" >
                	<th width="17%">&nbsp;Categor&iacute;a</th>
                    <th width="12%">Numero de Temas</th>
                    <th width="71%">Descripci&oacute;n</th>
				</tr>
				<?php 
				$res = getCategoriaCurso($_SESSION["sesionIdCurso"]); 
				if (@mysql_num_rows($res) > 0 ){
					while($row = mysql_fetch_array($res)){
                    dirigirse_a("foroCategoria.php?idCategoria=".$row["idTemaCategoria"]."&flag=1");
				?>
				<tr class="style1">
                	<td valign="top" bgcolor="#D9E3EC"><a href="foroCategoria.php?idCategoria=<?php echo $row["idTemaCategoria"]."&flag=1"; ?>"><?php echo $row["nombreTemaCategoria"];?></a></td>
					<td align="justify" valign="top" bgcolor="#D9E3EC">(<?php echo cuentaTemasCategoria($row["idTemaCategoria"],$_SESSION["sesionIdCurso"]); ?>)</td>
                    <td height="50" align="justify" valign="top" bgcolor="#D9E3EC"><?php echo $row["descripcionTemaCategoria"];?></td>
				</tr>
				<?php } }else{	 ?>
                <tr>
                	<td colspan="4" align="center"><br />
                    	No hay ninguna categoría disponible por el momento.<br/>
					</td>
				</tr>
                <?php }?>
			</table>
			<br /><br />
		</div> <!-- Fin <div class="demo"> -->
	</div> <!-- Fin <div id="columnaCentro"> -->

	<?php require("pie.php"); ?> 
</div> <!-- Fin <div id="principal"> -->
</body>
</html>
