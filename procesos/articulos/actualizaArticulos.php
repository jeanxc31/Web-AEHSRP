
<?php 

require_once "../../clases/Conexion.php";
require_once "../../clases/Articulos.php";

$obj= new articulos();

$datos=array(
		$_POST['idArticulo'],
	    $_POST['categoriaSelectU'],
	    $_POST['institucionSelectU'],
	    $_POST['codigoU'],
	    $_POST['descripcionU'],
	    $_POST['cantidadU'],
		$_POST['oficioU'],
	    $_POST['fechaProcedU'],
	    $_POST['docEntrU'],
	    $_POST['docSalU'],
	    $_POST['respProcU']
			);


    echo $obj->actualizaArticulo($datos);

 ?>