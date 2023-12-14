<?php 
	session_start();
	$iduser=$_SESSION['iduser'];
	require_once "../../clases/Conexion.php";
	require_once "../../clases/Articulos.php";

	$obj= new articulos();

	$datos=array();
	
	$nombreImg=$_FILES['imagen']['name'];
	$rutaAlmacenamiento=$_FILES['imagen']['tmp_name'];
	$carpeta='../../archivos/';
	$rutaFinal=$carpeta.$nombreImg;

	$datosImg=array(
		$_POST['categoriaSelect'],
		$nombreImg,
		$rutaFinal
		
					);

		if(move_uploaded_file($rutaAlmacenamiento, $rutaFinal)){
				$idimagen=$obj->agregaImagen($datosImg);

				if($idimagen > 0){

					$datos[0]=$_POST['categoriaSelect'];
					$datos[1]=$_POST['institucionSelect'];
					$datos[2]=$idimagen;
					$datos[3]=$iduser;
					$datos[4]=$_POST['codigo'];
					$datos[5]=$_POST['descripcion'];
					$datos[6]=$_POST['cantidad'];
					$datos[7]=$_POST['oficio'];
					$datos[8]=$_POST['fechaProced'];
					$datos[9]=$_POST['docEntr'];
					$datos[10]=$_POST['docSal'];
					$datos[11]=$_POST['respProc'];


					echo $obj->insertaArticulo($datos);
				}else{
					echo 0;
				}
		}

 ?>