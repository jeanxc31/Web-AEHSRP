<?php 
session_start();
if(isset($_SESSION['usuario'])){

	?>


	<!DOCTYPE html>
	<html>
	<head>
		<title>instituciones</title>
		<?php require_once "menu.php"; ?>
	</head>
	<body>

		<div class="container">
			<h1>Instituciones</h1>
			<div class="row">
				<div class="col-sm-4">
					<form id="frmInstituciones">
						<label>Institucion</label>
						<input type="text" class="form-control input-sm" name="institucion" id="institucion">
						<p></p>
						<span class="btn btn-primary" id="btnAgregaInstitucion">Agregar</span>
					</form>
				</div>
				<div class="col-sm-6">
					<div id="tablaInstitucionLoad"></div>
				</div>
			</div>
		</div>

		<!-- Button trigger modal -->

		<!-- Modal -->
		<div class="modal fade" id="actualizaInstitucion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel">Actualiza instituciones</h4>
					</div>
					<div class="modal-body">
						<form id="frmInstitucionU">
							<input type="text" hidden="" id="idinstitucion" name="idinstitucion">
							<label>Institucion</label>
							<input type="text" id="institucionU" name="institucionU" class="form-control input-sm">
						</form>


					</div>
					<div class="modal-footer">
						<button type="button" id="btnActualizaInstitucion" class="btn btn-warning" data-dismiss="modal">Guardar</button>

					</div>
				</div>
			</div>
		</div>

	</body>
	</html>
	<script type="text/javascript">
		$(document).ready(function(){

			$('#tablaInstitucionLoad').load("instituciones/tablaInstituciones.php");

			$('#btnAgregaInstitucion').click(function(){

				vacios=validarFormVacio('frmInstituciones');

				if(vacios > 0){
					alertify.alert("Debes llenar todos los campos!!");
					return false;
				}

				datos=$('#frmInstituciones').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/instituciones/agregaInstitucion.php",
					success:function(r){
						if(r==1){
					//esta linea nos permite limpiar el formulario al insetar un registro
					$('#frmInstituciones')[0].reset();

					$('#tablaInstitucionLoad').load("instituciones/tablaInstituciones.php");
					alertify.success("Institucion agregada con exito :D");
				}else{
					alertify.error("No se pudo agregar insitucion");
				}
			}
		});
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btnActualizaInstitucion').click(function(){

				datos=$('#frmInstitucionU').serialize();
				$.ajax({
					type:"POST",
					data:datos,
					url:"../procesos/instituciones/actualizaInstitucion.php",
					success:function(r){
						if(r==1){
							$('#tablaInstitucionLoad').load("instituciones/tablaInstituciones.php");
							alertify.success("Actualizado con exito :)");
						}else{
							alertify.error("no se pudo actualizar :(");
						}
					}
				});
			});
		});
	</script>

	<script type="text/javascript">
		function agregaDato(idInstitucion,institucion){
			$('#idinstitucion').val(idInstitucion);
			$('#institucionU').val(institucion);
		}

		function eliminaInstitucion(idinstitucion){
			alertify.confirm('¿Desea eliminar esta institucion?', function(){ 
				$.ajax({
					type:"POST",
					data:"idinstitucion=" + idinstitucion,
					url:"../procesos/instituciones/eliminarInstitucion.php",
					success:function(r){
						if(r==1){
							$('#tablaInstitucionLoad').load("instituciones/tablaInstituciones.php");
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
	<?php 
}else{
	header("location:../index.php");
}
?>