<?php 
require("inc/config.php");
require("_head.php");
$menu = "asp";
require("_menu.php"); 
$navegacion = "Aspectos Didacticos*aspectosDidacticos.php";
require("_navegacion.php");
?>
<script>
class_activo('boton_aspectosDidacticos','activo');
</script>

<script language="javascript">
function new_(pagina){
	var division = document.getElementById("lugar_de_carga");
	AJAXPOST(pagina,"",division);
} 
</script>


<p>
<a name="top" id="top"></a>
<span class="titulo_form">Aspectos Didácticos</span>


<div id="lugar_de_carga"></div>  
	
<ul>
    <li>
    <h3>Tareas matemáticas</h3>
	 <a class="button" href="javascript:new_('tareaMatematicaNuevo.php');">
    	<span>
        	<div class="add"><?php echo "Nueva tarea"; ?></div>
        </span>
	</a>
    
    <a class="button" href="javascript:new_('tareaMatematicaListado.php');">
        <span>
            <div class="add"><?php echo "Ver tareas"; ?></div>
        </span>
    </a>
    <br /><br />
    </li>
   

	<li>
    <h3>Variables didácticas</h3>
	<a class="button" href="javascript:new_('variableDidacticaNuevo.php');">
    	<span>
        	<div class="add"><?php echo "Nueva variable"; ?></div>
        </span>
	</a>
    
    <a class="button" href="javascript:new_('variableDidacticaListado.php');">
        <span>
            <div class="add"><?php echo "Ver variables"; ?></div>
        </span>
    </a>
    
    </li>

    
    
</ul>

</p>
<?php require("_pie.php"); ?>
