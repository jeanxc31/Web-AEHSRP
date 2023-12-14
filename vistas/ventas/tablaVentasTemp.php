<?php 

	session_start();
	//print_r($_SESSION['tablaComprasTemp']);
 ?>

 <h4>Generar Reporte</h4>
 <h4><strong><div id="nombreclienteVenta"></div></strong></h4>
 <table class="table table-bordered table-hover table-condensed" style="text-align: left;">
 	<caption>
 		<span class="btn btn-success" onclick="crearVenta()"> Generar reporte
 			<span class="glyphicon glyphicon-signal"></span>
 		</span>
 	</caption>
 	<tr>
 		<td>Oficio</td>
 		<td>Codigo</td>
 		<td>Descripcion</td>
 		<td>Cantidad</td>
 		<td>Categoria</td>
 		<td>Institucion</td>
 		<td>Fecha Procedimiento</td>
 		<td>Documento Entrada</td>
		<td>Documento Salida</td>
 		<td>Quitar</td>

 	</tr>
 	<?php 
 	$cliente=""; // guarda el nombre del cliente
 		if(isset($_SESSION['tablaComprasTemp'])):
 			$i=0;
 			foreach (@$_SESSION['tablaComprasTemp'] as $key) {

 				$d=explode("||", @$key);
			?>
 	 
 	<tr>
 		<td><?php echo $d[1]; ?></td>
 		<td><?php echo $d[2]; ?></td>
 		<td><?php echo $d[3]; ?></td>
		 <td><?php echo $d[4]; ?></td>
		 <td><?php echo $d[5]; ?></td>
		 <td><?php echo $d[6]; ?></td>
		 <td><?php echo date('d-m-Y', strtotime($d[7])); ?> </td>
		 <td><?php echo $d[8]; ?></td>
		 <td><?php echo $d[9]; ?></td>
 		
 		<td>
 			<span class="btn btn-danger btn-xs" onclick="quitarP('<?php echo $i; ?>')">
 				<span class="glyphicon glyphicon-remove"></span>
 			</span>
 		</td>
 	</tr>

 <?php 
 	
 		$cliente=$d[10];
 	}
 	endif; 
 ?>

 	

 </table>


 <script type="text/javascript">
 	$(document).ready(function(){
 		nombre="<?php echo @$cliente ?>";
 		$('#nombreclienteVenta').text("Responsable:"+" "+ nombre);
 	});
 </script>