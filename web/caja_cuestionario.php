<?php

$perfil = $_SESSION["sesionPerfilUsuario"];

if($perfil == 1 || $perfil == 4)
{
?>
<br/>
<div class="titulo_div">Cuestionario Docente</div>
<div class="info_div">
    <ul class="cajasLi">
			<li><a href="datosInicialesEncuesta.php?formulario=26">Cuestionario Para Docentes</a></li>
    </ul>
</div>
<?php } ?>