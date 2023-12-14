<?php 

	class responsables{

		public function agregaResponsable($datos){
			$c= new conectar();
			$conexion=$c->conexion();

			$idusuario=$_SESSION['iduser'];

			$sql="INSERT into responsables (id_usuario,

										nombre,
										apellido,
										cargo,
										telefono)

							values ('$idusuario',
							
									'$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]')";
			return mysqli_query($conexion,$sql);	
		}


		public function obtenDatosResponsable($idresponsable){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_responsable, 

							nombre,
							apellido,
							cargo,
							telefono

				from responsables
				where id_responsable='$idresponsable'";
				

			$result=mysqli_query($conexion,$sql);
			$ver=mysqli_fetch_row($result);

			$datos=array(
					'id_responsable' => $ver[0], 
					'nombre' => $ver[1],
					'apellido' => $ver[2],
					'cargo' => $ver[3],
					'telefono' => $ver[4]  
				);
			return $datos;
		}




		public function actualizaResponsable($datos){
			$c= new conectar();
			$conexion=$c->conexion();
			$sql="UPDATE responsables set nombre='$datos[1]',
										apellido='$datos[2]',
										cargo='$datos[3]',
										telefono='$datos[4]'

								where id_responsable='$datos[0]'";
			return mysqli_query($conexion,$sql);
		}




		public function eliminaResponsable($idresponsable){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="DELETE from responsables where id_responsable='$idresponsable'";

			return mysqli_query($conexion,$sql);
		}
	}

 ?>