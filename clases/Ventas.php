<?php 

class ventas{

	
	public function obtenDatosProducto($idproducto){

		date_default_timezone_set("America/Lima");
		setlocale(LC_ALL, "es_ES");
		setlocale(LC_TIME, "es_ES.UTF-8");

		
		$c=new conectar();
		$conexion=$c->conexion();

		$sql = "SELECT 
				   
					art.codigo,
					art.descripcion,
					art.cantidad,
					img.ruta,
					cat.nombreCategoria,
					ins.nombreInstitucion,
					art.fechaProced,
					art.docEntr,
					art.docSal

				FROM
				    articulos AS art
					
				
				        INNER JOIN
						
				    imagenes AS img 

					ON art.id_imagen = img.id_imagen
				        AND art.id_producto = '$idproducto'
						
						inner join categorias as cat
		  on art.id_categoria=cat.id_categoria
		  
		  inner join instituciones as ins
		  on art.id_institucion=ins.id_institucion";



		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		$d=explode('/', $ver[3]);

		$img=$d[1].'/'.$d[2].'/'.$d[3];

		$data=array(
			'codigo' => $ver[0],
			'descripcion' => $ver[1],
			'cantidad' => $ver[2],
			'ruta' => $img,
			'nombreCategoria' => $ver[4],
			'nombreInstitucion' => $ver[5],
			'fechaProced' => $ver[6],
			'docEntr' => $ver[7],
			'docSal' => $ver[8]
		
		);		
		return $data;
	}

	public function crearVenta(){
		$c= new conectar();
		$conexion=$c->conexion();

		

		$fecha=date('Y-m-d');

		$idventa=self::creaFolio();
		$datos=$_SESSION['tablaComprasTemp'];
		$idusuario=$_SESSION['iduser'];
		$r=0;

		for ($i=0; $i < count($datos) ; $i++) { 
			$d=explode("||", $datos[$i]);

			$sql="INSERT into ventas (id_venta,
										id_responsable,
										id_producto,
										oficio,
										id_usuario,
										nombreCategoria,
										nombreInstitucion,
										fecharegistro)
							values ('$idventa',
									'$d[11]',
									'$d[0]',
									'$d[1]',
									'$idusuario',
									'$d[5]',
									'$d[6]',
									'$fecha')";
			$r=$r + $result=mysqli_query($conexion,$sql);
		}

		return $r;
	}

	public function creaFolio(){
		$c= new conectar();
		$conexion=$c->conexion();

		$sql="SELECT id_venta from ventas group by id_venta desc";

		$resul=mysqli_query($conexion,$sql);
		$id=mysqli_fetch_row($resul)[0];

		if($id=="" or $id==null or $id==0){
			return 1;
		}else{
			return $id + 1;
		}
	}
	public function nombreCliente($idCliente){
		$c= new conectar();
		$conexion=$c->conexion();

		 $sql="SELECT apellido,nombre 
			from responsables 
			where id_responsable='$idCliente'";
		$result=mysqli_query($conexion,$sql);

		$ver=mysqli_fetch_row($result);

		return $ver[0]." ".$ver[1];
	}



}

?>