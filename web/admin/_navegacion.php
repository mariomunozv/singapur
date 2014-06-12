

<table width="100%"  border="0" cellspacing="0" cellpadding="0" style="border-bottom:1px solid #ccc; margin-bottom:10px;">
  <tr>
	<td style="padding-left:5px; "> 
		<?php
        $links_navegacion = explode(",",$navegacion);
        for($i = 0;$i < count($links_navegacion);$i++){
            $valores_navegacion = explode("*",$links_navegacion[$i]);
            ?><a href="<?php echo $valores_navegacion[1]; ?>"><?php echo $valores_navegacion[0]; ?></a> >> <?php
        }
        ?>
	</td>
	<td width="300" align="right" style="font-size:11px; font-weight:bold; padding-right:5px; padding-top:2px;"><?php
	echo $_SESSION["nombreCompletoUsuario"]; ?> <a href="index.php" >(X) Salir</a>
&nbsp;</td>
  </tr>
</table>  
<div class="contenido"> 