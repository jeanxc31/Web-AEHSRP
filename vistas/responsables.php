<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>responsables</title>
		<?php require_once "menu.php"; ?>
		<?php require_once "../clases/Conexion.php"; ?>
	</head>
	<body>
		<div class="container">
			<h1>Responsables</h1>			
			<div class="row">
				<div class="col-sm-4">
					<form id="frmResponsables">

						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombre" name="nombre">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellido" name="apellido">
						<label>Cargo</label>
						<input type="text" class="form-control input-sm" id="cargo" name="cargo">
						<label>Telefono</label>
						<input type="number" class="form-control input-sm" id="telefono" name="telefono">
					
						<p></p>
						<span class="btn btn-primary" id="btnAgregarResponsable">Agregar</span>
					</form>
				</div>
				<div class="col-sm-8">
					<div id="tablaResponsablesLoad"></div>
				</div>
			</div>
		</div>




		<!-- Button trigger modal -->
		<!-- Modal -->
		<div class="modal fade" id="abremodalResponsablesUpdate" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

						<h4 class="modal-title" id="myModalLabel">Actualizar Responsable</h4>
					</div>
					<div class="modal-body">

						<form id="frmResponsablesU">

						<input type="text" hidden="" id="idresponsableU" name="idresponsableU">
						
						<label>Nombre</label>
						<input type="text" class="form-control input-sm" id="nombreU" name="nombreU">
						<label>Apellido</label>
						<input type="text" class="form-control input-sm" id="apellidoU" name="apellidoU">
						<label>Cargo</label>
						<input type="text" class="form-control input-sm" id="cargoU" name="cargoU">
						<label>Telefono</label>
						<input type="number" class="form-control input-sm" id="telefonoU" name="telefonoU">

						</form>
					</div>
					<div class="modal-footer">
						<button id="btnAgregarResponsableU" type="button" class="btn btn-primary" data-dismiss="modal">Actualizar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>



	
	<script type="text/javascript">
		function agregaDatosResponsable(idresponsable){

			$.ajax({
				type:"POST",
				data:"idresponsable=" + idresponsable,
				url:"../procesos/responsables/obtenDatosResponsable.php",
				success:function(r){

					dato=jQuery.parseJSON(r);
					$('#idresponsableU').val(dato['id_responsable']);
					$('#nombreU').val(dato['nombre']);
					$('#apellidoU').val(dato['apellido']);
					$('#cargoU').val(dato['cargo']);
					$('#telefonoU').val(dato['telefono']);
				
				}
			});
		}



		function eliminarResponsable(idresponsable){
			alertify.confirm('¿Desea eliminar este responsable?', function(){ 
				$.ajax({
					type:"POST",
					data:"idresponsable=" + idresponsable,
					url:"../procesos/responsables/eliminarResponsable.php",
					success:function(r){
						if(r==1){
							$('#tablaResponsablesLoad').load("responsables/tablaResponsables.php");
							alertify.success("Eliminado con exito!!");
						}else{
							alertify.error("No se pudo eliminar :(");
						}
					}
				});
			}, function(){ 
				alertify.error('Cancelo !')
			});
		}
	</script>



	<script type="text/javascript">
		$(document).ready(function(){
			$('#tablaResponsablesLoad').load("responsables/tablaResponsables.php");

			$('#btnAgregarResponsable').click(function(){
				vacios=validarFormVacio('frmResponsables');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmResponsables').serialize();

				
				$.ajax({
					type:"POST",
					url:"../procesos/responsables/agregaResponsable.php",
					data: datos,

					success:function(r){
					
						if(r==1){
							$('#frmResponsables')[0].reset();
							$('#tablaResponsablesLoad').load("responsables/tablaResponsables.php");
							alertify.success("Responsable agregado con exito :D");
						}else{
							alertify.error("No se pudo agregar responsable");
						}
					}
				});
			});
		});
	</script>




	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnAgregarResponsableU').click(function(){
				datos=$('#frmResponsablesU').serialize();

				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/responsables/actualizaResponsable.php",
					success:function(r){

						if(r==1){
							$('#frmResponsables')[0].reset();
							$('#tablaResponsablesLoad').load("responsables/tablaResponsables.php");
							alertify.success("Responsable actualizado con exito :D");
						}else{
							alertify.error("No se pudo actualizar responsable");
						}
					}
				});
			})
		})
	</script>


	<?php 
}else{
	header("location:../index.php");
}
?>