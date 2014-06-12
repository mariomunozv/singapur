<?php 


function Conectarse_seg(){   
   if (!($link=mysql_connect("localhost","root","")))
   {
      echo "Error conectando a la base de datos.";
      exit();
   }
   if (!mysql_select_db("GESTION_ASESORIAS_v34",$link))
   {
      echo "Error seleccionando la base de datos.";
      exit();
   }
   return $link;
}

?>
