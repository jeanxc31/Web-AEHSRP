<?php 
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Instituciones.php";
	$id=$_POST['idinstitucion'];

	$obj= new instituciones();
	echo $obj->eliminaInstitucion($id);

 ?>