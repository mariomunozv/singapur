<style type="text/css">
#button {
	padding: 0;
}
#button li {
	display: inline;
}
#button li a {
	font-family: Arial;
	font-size:11px;
	text-decoration: none;
	float:left;
	padding: 10px;
	background-color: #039;
	color: #fff;
}

#button li a:hover, #button li a.activo {
	background-color: #003;
	margin-top:0px;
	padding-bottom:10px;
}
</style>
 <script>
	 function class_activo(elem, clase){
       x = elem.split(',');
       y = clase.split(',');

       for(i=0; i<x.length; i++){
               window.document.getElementById(x[i]).className=y[i];
       }
}


 </script>

<?php
//sesion();
$datos_usuario["per_admin"] = 1;
?>
<div style="background-image:url(images/header2.jpg); height:90px;"></div>
<div style="background-color:#039; height:34px; margin:0px;">
	<ul id="button">
        <li><a href="inicio.php" id="boton_inicio">Inicio</a></li>
        <li><a href="usuarios.php" id="boton_profesores">Usuarios</a></li>
        <li><a href="cursosCapacitacion.php" id="boton_curso">Cursos</a></li>
        <li><a href="jornada.php" id="boton_jornada">Jornadas</a></li>
        <li><a href="publicacion.php" id="boton_publicacion">Publicaciones</a></li>
        <li><a href="actividades.php" id="boton_actividad">Actividades</a></li>
        <li><a href="accesos.php" id="boton_accesos">Accesos</a></li>
        <li><a href="informeBitacora.php" id="boton_informeBitacora">InformeBitacora</a></li>
        <li><a href="item.php" id="boton_cuenta">Items Pruebas</a></li>
        <li><a href="itemSerie.php" id="boton_cuenta">Items Actividades</a></li>
        <li><a href="aspectosDidacticos.php" id="boton_cuenta">Aspectos Didacticos</a></li>
        <li><a href="actividadNew.php" id="boton_actividadNew">Actividades New</a></li>
	</ul>
</div>


