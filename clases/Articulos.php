

<?php 

	class articulos{
		public function agregaImagen($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			date_default_timezone_set("America/Lima");
			setlocale(LC_ALL, "es_ES");
			setlocale(LC_TIME, "es_ES.UTF-8");

			$fecha= date("Y-m-d");
			
			

			$sql="INSERT into imagenes (id_categoria,
										nombre,
										ruta,
										fechaSubida)
							values ('$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$fecha')";
			$result=mysqli_query($conexion,$sql);

			return mysqli_insert_id($conexion);
		}
		public function insertaArticulo($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			date_default_timezone_set("America/Lima");
			setlocale(LC_ALL, "es_ES");
			setlocale(LC_TIME, "es_ES.UTF-8");

			$fecha=date("Y-m-d");

			$sql="INSERT into articulos (id_categoria,
										id_institucion,
										id_imagen,
										id_usuario,
										codigo,
										descripcion,
										cantidad,
										oficio,
										fechaProced,
										docEntr,
										docSal,
										respProc,
										fechaCaptura) 
							values ('$datos[0]',
									'$datos[1]',
									'$datos[2]',
									'$datos[3]',
									'$datos[4]',
									'$datos[5]',
									'$datos[6]',
									'$datos[7]',
									'$datos[8]',	
									'$datos[9]',
									'$datos[10]',
									'$datos[11]',
									'$fecha')";
			return mysqli_query($conexion,$sql);
		}






		public function obtenDatosArticulo($idarticulo){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_producto, 
						id_categoria, 
						id_institucion,
						codigo,
						descripcion,
						cantidad,
						oficio,
						fechaProced,
						docEntr,
						docSal,
						respProc

				from articulos 
				where id_producto='$idarticulo'";
			$result=mysqli_query($conexion,$sql);

			$ver=mysqli_fetch_row($result);

			$datos=array(
					"id_producto" => $ver[0],
					"id_categoria" => $ver[1],
					"id_institucion" => $ver[2],
					"codigo" => $ver[3],
					"descripcion" => $ver[4],
					"cantidad" => $ver[5],
					"oficio" => $ver[6],
					"fechaProced" => $ver[7],
					"docEntr" => $ver[8],
					"docSal" => $ver[9],
					"respProc" => $ver[10]

						);

			return $datos;
		}




		public function actualizaArticulo($datos){
			$c=new conectar();
			$conexion=$c->conexion();

			$sql="UPDATE articulos set id_categoria='$datos[1]', 
										id_institucion='$datos[2]',
										codigo='$datos[3]',
										descripcion='$datos[4]',
										cantidad='$datos[5]',
										oficio='$datos[6]',
										fechaProced='$datos[7]',
										docEntr='$datos[8]',
										docSal='$datos[9]',
										respProc='$datos[10]'

						where id_producto='$datos[0]'";

			return mysqli_query($conexion,$sql);
		}




		public function eliminaArticulo($idarticulo){
			$c=new conectar();
			$conexion=$c->conexion();

			$idimagen=self::obtenIdImg($idarticulo);

			$sql="DELETE from articulos 
					where id_producto='$idarticulo'";
			$result=mysqli_query($conexion,$sql);

			if($result){
				$ruta=self::obtenRutaImagen($idimagen);

				$sql="DELETE from imagenes 
						where id_imagen='$idimagen'";
				$result=mysqli_query($conexion,$sql);
					if($result){
						if(unlink($ruta)){
							return 1;
						}
					}
			}
		}



		public function obtenIdImg($idProducto){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT id_imagen 
					from articulos 
					where id_producto='$idProducto'";
			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

		public function obtenRutaImagen($idImg){
			$c= new conectar();
			$conexion=$c->conexion();

			$sql="SELECT ruta 
					from imagenes 
					where id_imagen='$idImg'";

			$result=mysqli_query($conexion,$sql);

			return mysqli_fetch_row($result)[0];
		}

	}

 ?>