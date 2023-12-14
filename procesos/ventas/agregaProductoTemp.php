<?php 
	session_start();
	require_once "../../clases/Conexion.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$idcliente=$_POST['clienteVenta'];
	$idproducto=$_POST['productoVenta'];
	$codigo=$_POST['codigoV'];
	$descripcion=$_POST['descripcionV'];
	$cantidad=$_POST['cantidadV'];
	$categoria=$_POST['categoriaV'];
	$institucion=$_POST['institucionV'];
	$fechaProced=$_POST['fechaProcedV'];
	$docEntr=$_POST['docEntrV'];
	$docSal=$_POST['docSalV'];


	$sql="SELECT nombre,apellido 
			from responsables 
			where id_responsable='$idcliente'";
	$result=mysqli_query($conexion,$sql);

	$c=mysqli_fetch_row($result);

	$ncliente=$c[1]." ".$c[0];

	$sql="SELECT oficio 
			from articulos 
			where id_producto='$idproducto'";
	$result=mysqli_query($conexion,$sql);

	$nombreproducto=mysqli_fetch_row($result)[0];

	$articulo=$idproducto."||".
				$nombreproducto."||".
				$codigo."||".
				$descripcion."||".
				$cantidad."||".
				$categoria."||".
				$institucion."||".	
				$fechaProced."||".
				$docEntr."||".
				$docSal."||".
				$ncliente."||".
				$idcliente;

	$_SESSION['tablaComprasTemp'][]=$articulo;

 ?>