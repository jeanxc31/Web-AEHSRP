<?php 

require_once "../../clases/Conexion.php";
$c= new conectar();
$conexion=$c->conexion();
?>


<h4>Generar Reporte</h4>
<div class="row">
	<div class="col-sm-4">
		<form id="frmVentasProductos">



			<label>Seleciona Responsable</label>
			<select class="form-control input-sm" id="clienteVenta" name="clienteVenta">
				<option value="A">Selecciona</option>
				<option value="0">Sin responsable</option>
				<?php
				$sql="SELECT id_responsable,nombre,apellido 
				from responsables";
				$result=mysqli_query($conexion,$sql);
				while ($cliente=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $cliente[0] ?>"><?php echo $cliente[2]." ".$cliente[1] ?></option>
				<?php endwhile; ?>
			</select>


			<label>Oficio</label>
			<select class="form-control input-sm" id="productoVenta" name="productoVenta">
				<option value="A">Selecciona</option>
				<?php
				$sql="SELECT id_producto,
				oficio
				from articulos";
				$result=mysqli_query($conexion,$sql);

				while ($producto=mysqli_fetch_row($result)):
					?>
					<option value="<?php echo $producto[0] ?>"><?php echo $producto[1] ?></option>
				<?php endwhile; ?>
			</select>


			<label>Codigo</label>
			<input readonly="" type="number"  class="form-control input-sm" id="codigoV" name="codigoV" >
			<label>Descripcion</label>
			<textarea readonly=""  type="text"  class="form-control input-sm" id="descripcionV" name="descripcionV" ></textarea>
			<label>Cantidad</label>
			<input readonly="" type="number" class="form-control input-sm" id="cantidadV" name="cantidadV">
			<label>Categoria</label>
			<input readonly="" type="text" class="form-control input-sm" id="categoriaV" name="categoriaV" ></select>
			<label>Institucion</label>
			<input readonly="" type="text" class="form-control input-sm" id="institucionV" name="institucionV"></select>
			<label>Fecha Procedimiento</label>
			<input readonly="" type="date" class="form-control input-sm" id="fechaProcedV" name="fechaProcedV">
			<label>Documento Entrada</label>
			<input readonly=""  type="text" class="form-control input-sm" id="docEntrV" name="docEntrV">
			<label>Documento Salida</label>
			<input readonly="" type="text" class="form-control input-sm" id="docSalV" name="docSalV">

			<p></p>
			<span class="btn btn-primary" id="btnAgregaVenta">Agregar</span>
			<span class="btn btn-danger" id="btnVaciarVentas">Vaciar ventas</span>
		</form>
	</div>
	<div class="col-sm-3">
		<div id="imgProducto"></div>

	</div>
	<div class="col-sm-4">
		<div id="tablaVentasTempLoad"></div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){

		$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
		$('#productoVenta').change(function(){
			$.ajax({
				type:"POST",
				data:"idproducto=" + $('#productoVenta').val(),
				url:"../procesos/ventas/llenarFormProducto.php",
				success:function(r){
		
					dato=jQuery.parseJSON(r);

					$('#codigoV').val(dato['codigo']);
					$('#descripcionV').val(dato['descripcion']);
					$('#cantidadV').val(dato['cantidad']);
					$('#categoriaV').val(dato['nombreCategoria']);
					$('#imgProducto').empty();
					$('#imgProducto').prepend('<img class="img-thumbnail" id="imgp" src="' + dato['ruta'] + '" />  ');
					$('#institucionV').val(dato['nombreInstitucion']);
					$('#fechaProcedV').val(dato['fechaProced']);
					$('#docEntrV').val(dato['docEntr']);
					$('#docSalV').val(dato['docSal']);

					

				}
			});
		});



		$('#btnAgregaVenta').click(function(){
			vacios=validarFormVacio('frmVentasProductos');

			if(vacios > 0){
				alertify.alert("Debes llenar todos los campos!!");
				return false;
			}

			datos=$('#frmVentasProductos').serialize();
			$.ajax({
				type:"POST",
				data:datos,
				url:"../procesos/ventas/agregaProductoTemp.php",
				success:function(r){
					$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
				}
			});
		});

		$('#btnVaciarVentas').click(function(){

		$.ajax({
			url:"../procesos/ventas/vaciarTemp.php",
			success:function(r){
				$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
			}
		});
	});

	});
</script>

<script type="text/javascript">
	function quitarP(index){
		$.ajax({
			type:"POST",
			data:"ind=" + index,
			url:"../procesos/ventas/quitarproducto.php",
			success:function(r){
				$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
				alertify.success("Se quito el producto :D");
			}
		});
	}

	function crearVenta(){
		$.ajax({
			url:"../procesos/ventas/crearVenta.php",
			success:function(r){
				if(r > 0){
					$('#tablaVentasTempLoad').load("ventas/tablaVentasTemp.php");
					$('#frmVentasProductos')[0].reset();
					alertify.alert("Reporte creado con exito, consulte la informacion de esta en Reportes realizados :D");
				}else if(r==0){
					alertify.alert("No hay lista de reportes!!");
				}else{
					alertify.error("No se pudo crear el reporte");
				}
			}
		});
	}
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('#clienteVenta').select2();
		$('#productoVenta').select2();

		
	});
</script>