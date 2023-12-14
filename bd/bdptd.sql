CREATE SCHEMA `prestamos` DEFAULT CHARACTER SET utf8mb4 ;

use prestamos;

create table usuarios(
				id_usuario int auto_increment,
				nombre varchar(50),
				apellido varchar(50),
				email varchar(50),
				password text(50),
				fechaCaptura date,
				primary key(id_usuario)
					);

create table categorias (
				id_categoria int auto_increment,
				id_usuario int not null,
				nombreCategoria varchar(150),
				fechaCaptura date,
				primary key(id_categoria)
						);

create table imagenes(
				id_imagen int auto_increment,
				id_categoria int not null,
				nombre varchar(500),
				ruta varchar(500),
				fechaSubida date,
				primary key(id_imagen)
					);


create table articulos(
				id_producto int auto_increment,
				id_categoria int not null,
                id_institucion int not null,
				id_imagen int not null,
				id_usuario int not null,
				codigo varchar(50),
				descripcion varchar(500),
				cantidad int,
				oficio varchar(50),
                fechaProced date,
				docEntr varchar(80),
				docSal varchar(80),	
				respProc varchar(80),				
				fechaCaptura date,
				primary key(id_producto)

						);

create table instituciones(
				id_institucion int auto_increment,
				id_usuario int not null,
				nombreInstitucion varchar(200),
                fechaCaptura date,
				primary key(id_institucion)
					);
					
create table registro(
				id_registro int not null,
				id_institucion int,
				id_producto int,
				id_usuario int,
				fecharegistro date
					);
                    
                    
create table responsables(
				id_responsable int auto_increment,
				id_usuario int not null,
				nombre varchar(200),
				apellido varchar(200),
				cargo varchar(200),
				telefono varchar(200),
				primary key(id_responsable)
					);
                    
                    
create table ventas(
				id_venta int not null,
                id_responsable int,
                id_producto int,
                oficio varchar(50),
				id_usuario int,
                nombreCategoria varchar(200),
                nombreInstitucion varchar(200),
				fecharegistro date
					);
                    