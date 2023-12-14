
<?php 
	require_once "../../clases/Conexion.php";
	$c= new conectar();
	$conexion=$c->conexion();
	$sql="SELECT    art.codigo,
					art.descripcion,
					art.cantidad,
					art.oficio,
					art.fechaProced,
					art.docEntr,
					art.docSal,
					art.respProc,
					img.ruta,
					ins.nombreInstitucion,
					cat.nombreCategoria,
					art.id_producto


		  from articulos as art 

		  inner join imagenes as img
		  on art.id_imagen=img.id_imagen

		  inner join categorias as cat
		  on art.id_categoria=cat.id_categoria

		  inner join instituciones as ins
		  on art.id_institucion=ins.id_institucion"
		  ;

		  
	$result=mysqli_query($conexion,$sql);

 ?>
<table class="table table-hover table-condensed table-bordered" style="text-align: left;">
	<caption><label>Registros</label></caption>
	<tr>
		<td>Código</td>
		<td>Descripcion</td>	
		<td>Cantidad</td>
		<td>N° de Oficio</td>
		<td>Fecha Procedimiento</td>
		<td>Documento Entrada</td>
		<td>Documento Salida</td>
		<td>Responsable</td>
		<td>Imagen</td>
		<td>Institucion</td>
		<td>Categoria</td>
		<td>Editar</td>
		<td>Eliminar</td>
	</tr>
	<?php while($ver=mysqli_fetch_row($result)): ?>
	<tr>
		<td><?php echo $ver[0]; ?></td>
		<td><?php echo $ver[1]; ?></td>
		<td><?php echo $ver[2]; ?></td>
		<td><?php echo $ver[3]; ?></td>
		<td><?php echo date('d-m-Y', strtotime($ver[4])); ?></td>
		<td><?php echo $ver[5]; ?></td>
		<td><?php echo $ver[6]; ?></td>
		<td><?php echo $ver[7]; ?></td>
		<td>
			<?php 
			$imgVer=explode("/", $ver[8]) ; 
			$imgruta=$imgVer[1]."/".$imgVer[2]."/".$imgVer[3];
			?>
			<img width="80" height="80" src="<?php echo $imgruta ?>">
		</td>
		<td><?php echo $ver[9]; ?></td>
		<td><?php echo $ver[10]; ?></td>
		<td>
			<span  data-toggle="modal" data-target="#abremodalUpdateArticulo" class="btn btn-warning btn-xs" onclick="agregaDatosArticulo('<?php echo $ver[11] ?>')">
			<span class="glyphicon glyphicon-pencil"></span>
			</span>
		</td>
		<td>
			<span class="btn btn-danger btn-xs" onclick="eliminaArticulo('<?php echo $ver[11] ?>')">
			<span class="glyphicon glyphicon-remove"></span>
			</span>
		</td>
	</tr>
<?php endwhile; ?>
</table>