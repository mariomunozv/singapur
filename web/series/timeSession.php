<?php 
session_start();
if (isset($_POST["tiempo"])) {
	$_SESSION["tiempo"] = $_POST["tiempo"];
}

 ?>