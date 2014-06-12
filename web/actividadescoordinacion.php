<?php 
require("inc/incluidos.php");

$idPerfil =  $_SESSION["sesionPerfilUsuario"];
/* Registro de acceso a mi curso */
$idUsuario = $_SESSION["sesionIdUsuario"];
registraAcceso($idUsuario, 2, 'NULL'); 
$datosCurso2 = getDatosCurso($_SESSION["sesionIdCurso"]);


require ("hd.php");?>

<script language="javascript">
function nueva_bienvenida(){
	
	 var division = document.getElementById("textoBienvenida");
	 AJAXPOST("cursoBienvenidaEditar.php","",division);
	
}

function registraMuestra(link,idRecurso){
	
	//alert(link+"--"+idRecurso);
	location.target="n";
	location.href='recurso.php?idRecurso='+idRecurso;
	
}	

function getProfesores(idCurso){

    $.ajax({
    data:  "idCurso=" + idCurso,
    url:   'cursoProfesores.php',
    type:  'post',
    dataType: "html",
    success:  function (response) 
    {
        $("#divCursos").html(response);
    }});

}

$(document).ready(function(){

        var idCurso = $("#ddlmiscursos").val();
        getProfesores(idCurso);

        $("#ddlmiscursos").change(function(){

           var idCurso = $("#ddlmiscursos").val();

           getProfesores(idCurso);


        });
});
</script>

<body>
<div id="principal">
<?php 
	require("topMenu.php"); 
	
	require("_navegacion.php");

?>
    <div id="lateralIzq">
	    <?php require("menuleft.php");	?>
	</div>
    
    
    
    <div id="lateralDer">
	    <?php require("menuright.php");?>
    </div><!--lateralDer-->
    
    <div id="columnaCentro" >

    <p class="titulo_curso">Profesores por Curso</p>
    <br>
     
     <?php $cursosUsuario = getCursosUsuario($idUsuario);

     	echo "Seleccione Curso:  ";
        echo "<select name='ddlmiscursos' id='ddlmiscursos'>";

        foreach ($cursosUsuario as $row) {
        	echo "<option value=".$row["idCursoCapacitacion"].">".$row["nombreCortoCursoCapacitacion"]."</option>";
        }

        
        echo "</select>";     

     ?>
     <br><br>

     <div id="divCursos"></div>


    
    </div> 
    
     
       <?php //  require("misCursos.php");?>
     
       

   
    
              
	<?php 
    
    	require("pie.php");

    ?>      

                
</div><!--principal-->
</body>
</html>
