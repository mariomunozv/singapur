<?php 
//sesion();
$datos_usuario["per_admin"] = 1;
?>
<div style="background-image:url(images/header2.jpg); height:90px;"></div>
<div style="background-image:url(images/menu_fondo.jpg); height:31px; margin:0px;">
	<a href="inicio.php"><img src="images/menu_1<?php if($menu == "ini"){ echo "on"; } ?>.jpg" border="0" /></a>
	<?php 
	if($datos_usuario["per_admin"] == 1){
	?>
    <a href="sesiones.php"><img src="images/menu_2<?php if($menu == "ses"){ echo "on"; } ?>.jpg" border="0" /></a>
    <?php
	}
	?>
	<a href="item.php"><img src="images/menu_3<?php if($menu == "ite"){ echo "on"; } ?>.jpg" border="0"></a>
    <?php 
	if($datos_usuario["per_admin"] == 1){
	?>
	<a href="reportes.php"><img src="images/menu_4<?php if($menu == "rep"){ echo "on"; } ?>.jpg" border="0"></a>
	<a href="administracion.php"><img src="images/menu_5<?php if($menu == "adm"){ echo "on"; } ?>.jpg" border="0" /></a>
    <?php
	}
	?>
</div> 