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
	background-color: #396;
	color: #fff;
}

#button li a:hover, #button li a.activo {
	background-color: #060;
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
<div style="background-color:#396; height:34px; margin:0px;">
	 <ul id="button">

    <li><a href="home.php" id="boton_home">Home</a></li>

    <li><a href="bandeja.php" id="boton_bandeja">Mis Mensajes</a></li>

    <li><a href="foro.php" id="boton_foro">Foro</a></li>
   
  </ul>
</div> 

 
