<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Instituciones.php";

	

	$datos=array(
		$_POST['idinstitucion'],
		$_POST['institucionU']
			);

	$obj= new instituciones();

	echo $obj->actualizaInstitucion($datos);

 ?>