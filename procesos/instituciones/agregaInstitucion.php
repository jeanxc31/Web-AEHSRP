<?php 
	session_start();
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Instituciones.php";
	$fecha=date("Y-m-d");
	$idusuario=$_SESSION['iduser'];
	$institucion=$_POST['institucion'];

	$datos=array(
		$idusuario,
		$institucion,
		$fecha
				);

	$obj= new instituciones();

	echo $obj->agregaInstitucion($datos);


 ?>