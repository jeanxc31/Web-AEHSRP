


<?php 

	class instituciones{

		public function agregaInstitucion($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="INSERT into instituciones(id_usuario,
										nombreInstitucion,
										fechaCaptura)
						values ('$datos[0]',
								'$datos[1]',
								'$datos[2]')";

			return mysqli_query($conexion,$sql);
		}

		public function actualizaInstitucion($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE instituciones set nombreInstitucion='$datos[1]'
								where id_institucion='$datos[0]'";
			echo mysqli_query($conexion,$sql);
		}

		public function eliminaInstitucion($idinstitucion){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="DELETE from instituciones 
					where id_institucion='$idinstitucion'";
			return mysqli_query($conexion,$sql);
		}

	}

 ?>