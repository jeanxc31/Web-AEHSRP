<?php
require_once "../../clases/Conexion.php";
require_once "../../clases/Ventas.php";


$objv= new ventas();


$c=new conectar();
$conexion= $c->conexion();

$idventa= $_GET['idventa'];



$sql="SELECT ve.id_venta,
		    ve.fecharegistro,
		    ve.id_responsable,
		    art.codigo,
            art.descripcion

	from ventas  as ve 
	
	inner join articulos as art
	on ve.id_producto=art.id_producto
	and ve.id_venta='$idventa'";

$result=mysqli_query($conexion,$sql);

	$ver=mysqli_fetch_row($result);

	$folio=$ver[0];
	$fecha=$ver[1];
	$idcliente=$ver[2];

?>


<!doctype html>
 <html lang="en">
 <head>
 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 	<title>Reporte de procedimiento</title>
	 <link rel="stylesheet" type="text/css" href="../../librerias/dompdf/lib/res/html.css">
 </head>
 <body>






 		<img src="../../img/loginimg.png" width="400" height="200">
 		
		<br>

 		<table>
 			<tr>
 				<td>Fecha: <?php echo $fecha; ?></td>
 			</tr>
 			<tr>
 				<td>Folio: <?php echo $folio ?></td>
 			</tr>
 			<tr>
 				<td>Usuario: <?php echo $objv->nombreCliente($idcliente); ?></td>
 			</tr>
 		</table>

		 <br>


 		<table class="table" >
 			<tr>
 				<td>Codigo</td>
 				<td>Descripción</td>
 				<td>Oficio</td>
 				<td>Categoria</td>
				 <td>Institución</td>
 			</tr>

 			<?php 
 			$sql="SELECT ve.id_venta,
						ve.fecharegistro,
						ve.id_responsable,
						art.codigo,
						art.descripcion,
						ve.oficio,
						ve.nombreCategoria,
						ve.nombreInstitucion
 
	 from ventas  as ve 
	 
	 inner join articulos as art
	 on ve.id_producto=art.id_producto
	 and ve.id_venta='$idventa'";
 
 $result=mysqli_query($conexion,$sql);

	 $ver=mysqli_fetch_row($result);

	 $codigo=$ver[3];
	 $descripcion=$ver[4];
	 $oficio=$ver[5];
	 $cat=$ver[6];
	 $ins=$ver[7];

 			 ?>

 			<tr>
 				<td><?php echo $codigo; ?></td>
 				<td><?php echo $descripcion; ?></td>
 				<td><?php  echo $oficio; ?></td>
				 <td><?php  echo $cat; ?></td>
				 <td><?php  echo $ins; ?></td>
				
 			</tr>

 			<?php 
 			
 			 ?>
 		
 		</table>
	
 </body>
 </html>