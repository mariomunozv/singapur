<?php

require("admin/inc/config.php");
include "inc/_cursoCapacitacion.php";

$datos = getDatosCurso($_SESSION["sesionIdCurso"]);

?> 

<script language="javascript">

function cancelar(){
	if(confirm("Cancelar esta operacion?")){ location.href="notificacion.php"; }  
}
function save_bienvenida(){
	
 	if(confirm("Seguro de actualizar bienvenida?")){

		 var division = document.getElementById("textoBienvenida");
		 var a = $(".campos").fieldSerialize();
		 AJAXPOST("cursoBienvenidaGuarda.php",a,division);
	}
}


</script>

<input id="idCursoCapacitacion" name="idCursoCapacitacion" type="hidden" value="<?php echo $_SESSION["sesionIdCurso"];?>" class="campos" />
        
<textarea id="descripcionCursoCapacitacion" name="descripcionCursoCapacitacion" class="campos" cols="70" rows="15"><?php echo @$datos["descripcionCursoCapacitacion"]; ?></textarea>

<a class="button" href="javascript:save_bienvenida();"><span><div class="save">Guardar</div></span></a>

<br />
<br />
<br />
<br />
  
            