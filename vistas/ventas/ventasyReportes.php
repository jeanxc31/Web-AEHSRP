<?php 

	require_once "../../clases/Conexion.php";
	require_once "../../clases/Ventas.php";

	$c= new conectar();
	$conexion=$c->conexion();

	$obj= new ventas();

	$sql="SELECT id_venta,
				fecharegistro,
				id_responsable,
				oficio,
				id_producto
				id_usuario,
				nombreCategoria,
				nombreInstitucion
			from ventas group by id_venta";
	$result=mysqli_query($conexion,$sql); 
	?>

<h4>Reportes</h4>
<div class="row">
	<div class="col-sm-1"></div>
	<div class="col-sm-10">
		<div class="table-responsive">
			<table class="table table-hover table-condensed table-bordered" style="text-align: left;">
				<caption><label>Registro de reportes disponibles:</label></caption>
				<tr>
					<td>Folio</td>
					<td>Fecha</td>
					<td>Responsable</td>
					<td>Oficio</td>
					<td>Categoria</td>
					<td>Institución</td>
					<td>Reporte</td>
				
				</tr>
		<?php while($ver=mysqli_fetch_row($result)): ?>
				<tr>
					<td><?php echo $ver[0] ?></td>
					<td>	<?php echo date('d-m-Y', strtotime($ver[1])); ?></td>
					<td>
						<?php
							if($obj->nombreCliente($ver[2])==" "){
								echo "S/C";
							}else{
								echo $obj->nombreCliente($ver[2]);
							} ?></td>
					<td>
						<?php echo $ver[3] ?>
					</td>
					
					<td>
							<?php echo $ver[5] ?>
					</td>

					<td>
							<?php echo $ver[6] ?>
					</td>

					

					<td>
					<a href="../procesos/ventas/crearReportePdf.php?idventa=<?php echo $ver[0] ?>" class="btn btn-danger btn-sm">
							Reporte <span class="glyphicon glyphicon-file"></span>
						</a>
					</td>


				</tr>
		<?php endwhile; ?>
			</table>
		</div>
	</div>
	<div class="col-sm-1"></div>
</div>