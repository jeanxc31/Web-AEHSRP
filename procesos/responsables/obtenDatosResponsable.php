<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Responsables.php";

	$obj= new responsables();

	echo json_encode($obj->obtenDatosResponsable($_POST['idresponsable']));

 ?>			