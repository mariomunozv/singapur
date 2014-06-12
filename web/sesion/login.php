
<?php 
session_start();
include "../inc/conecta.php";
include "../inc/funciones.php";

Conectarse_seg(); 
@include "../inc/_accesoRecurso.php";
@include "../inc/_bitacoraClase.php";
@include "../inc/_cursoCapacitacion.php";
@include "../inc/_detalleColegioProyecto.php";
@include "../inc/_detalleUsuarioProyectoPerfil.php";
@include "../inc/_evento.php";
@include "../inc/_empleadoKlein.php";
@include "../inc/_glosario.php";
@include "../inc/_inscripcionCursoCapacitacion.php";
@include "../inc/_jornada.php";
@include "../inc/_mensaje.php";
@include "../inc/_mensajeTema.php";
@include "../inc/_palabra.php";
@include "../inc/_perfil.php";
@include "../inc/_profesor.php";
@include "../inc/_publicacion.php";
@include "../inc/_recurso.php";
@include "../inc/_tema.php";
@include "../inc/_usuario.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<link href="../css/custom-theme/jquery-ui-1.8rc3.custom.css" type="text/css" rel="stylesheet" />	
<link href="../css/botones.css" rel="stylesheet" type="text/css" />
<link href="../css/tabla.css" rel="stylesheet" type="text/css" />
<link href="../css/estilos.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/jquery.form.js"></script>  
<script type="text/javascript" src="../js/main.js"></script> 
<script type="text/javascript" src="../js/pngfix.js"></script>   
<script type="text/javascript" src="../js/tag.js"></script> 
<script type="text/javascript" src="../js/jquery.tablesorter.js"></script> 
<script type="text/javascript" src="../js/jquery.tablesorter.pager.js"></script>   
<script type="text/javascript" src="../js/validarut.js"></script>

 
<title>Pensar sin L&iacute;mites</title> 
</head>

<body>

<div id="principal">

	<div id="cabecera">
    	<img src="../img/header.jpg" width="950" height="170"> 
     	<div id="styletwo">
            <ul>
               
            </ul>
        </div>
    </div>
	
   
    
     <div id="columnaCentro">

<table border="0" cellspacing="10" cellpadding="10">
          <tr>
            <td height="457" align="left" valign="top" bgcolor="#FFFFFF"><table>
              <tr>
                <td align="center" background="../images/fondo.jpg"><?php //require("../header.php"); ?>
                  <table >
                    <tr>
                      <td height="240" align="center"><table>
                        <tr>
                          <td height="23" class="etiqueta">Login Sistema </td>
                          </tr>
                        <tr>
                          <td bgcolor="#BECCD7"><img src="../images/t.gif" width="1" height="1" /></td>
                          </tr>
                        <tr>
                          <td height="100" class="txtnegro10">
                          
						<?php  $usuario = $_POST["usuario"];	
                            $password = $_POST["password"];	
                            if(estaUsuario($usuario)){
                               if(claveCorrectaUsuario($usuario,md5($password))){ 	   
                                   
								     $datosUsuario = getDatosUsuario($usuario);
                     echo $datosUsuario;
                                     $_SESSION["sesionTipoUsuario"] = $datosUsuario["tipoUsuario"];
                                     $_SESSION["sesionPerfilUsuario"] = $datosUsuario["idPerfilUsuario"];				   
                                     $_SESSION["sesionIdUsuario"] = $datosUsuario["idUsuario"];
                                     $_SESSION["sesionRutUsuario"] = $datosUsuario["rut"];
									 $_SESSION["sesionImagenUsuario"] = $datosUsuario["imagenUsuario"];
									 
	                                  switch ($datosUsuario["tipoUsuario"]) {
                                            case "Profesor":
                                                 $nombre = getNombreProfesor($datosUsuario["rut"]);
                                                 break;

											case "UTP":
                                                 $nombre = getNombreProfesor($datosUsuario["rut"]);
                                                 break;	 
											 	 
                                            case "Directivo":
                                                 $nombre = getNombreDirectivo($datosUsuario["rut"]);
                                                 break;
												 
                                            case "Alumno":
                                                 $nombre = getNombreAlumno($datosUsuario["rut"]);
                                                 break;
												 
                                            case "Empleado Klein":
                                                 $nombre = getNombreEmpleadoKlein($datosUsuario["rut"]);
                                                 break;
                                     }
                                     $_SESSION["sesionNombreUsuario"] = $nombre;
										/* Registro de acceso al sistema */
									 	$idUsuario = $_SESSION["sesionIdUsuario"];
										registraAcceso($idUsuario, 1, 'NULL');
										@$idCurso = getCursoUs($_SESSION["sesionIdUsuario"]);
										$_SESSION["sesionIdCurso"] = $idCurso; 
										
										switch ($datosUsuario["idPerfilUsuario"]) {
                                            case "3":
                                                 dirigirse_a("../mural.php?idCurso=".$idCurso);
                                            break;
											
											case "4":
                                                 dirigirse_a("../mural.php?idCurso=".$idCurso);
                                            break;

											default:
                                                 dirigirse_a("../curso.php?idCurso=".$idCurso);
                                            break;	 
                                     }
										
										
										
										
                                }else{
                                     echo "Su clave es Incorrecta";  ?>
                                      <a href="../index.php">&lt;&lt; Volver</a>
               <?php               }
                           }else{
							   echo " El usuario ingresado no existe"; ?>
							  <br />
 <a href="../index.php">&lt;&lt; Volver</a> 
                           <?php }
                                
                                
                                ?>
                          
                          
                          </td>
                          </tr>
                        <tr>
                          <td bgcolor="#BFCDD8"><img src="../images/t.gif" width="1" height="1" /></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table>
                  <?php //require("../pie.php"); ?></td>
                </tr>
            </table>              <h2>
              
            </h2></td>
            </tr>
        </table>
</div>


	<div id="pie">Avda. Schatchtebeck Nº 4 (Zócalo Biblioteca Central) • Estación Central • Santiago • Chile • Teléfono (562) 718 20 84 • www.grupoklein.cl</div>
</div>
</body>
</html>
