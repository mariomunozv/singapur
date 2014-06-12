<?php 

function Conectarse(){   
   if (!($link=mysql_connect("localhost","desarrollo","..5&desarrollo")))
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
