DROP DATABASE IF EXISTS Novath;
CREATE DATABASE Novath;
USE Novath;

CREATE TABLE Usuario (
  id int AUTO_INCREMENT,
  nombre varchar(60),
  apellido varchar(100),
  dni varchar(15),
  email varchar(50),
  contrasena varchar(200),
  telefono varchar(20),
  descuento_acumulativo int,
  suspension boolean,
  administrador boolean,
  super_admin boolean,
  PRIMARY KEY (id)
);

CREATE TABLE Evento (
  id_evento int AUTO_INCREMENT,
  artista varchar(60),
  nombre_evento varchar(100),
  fecha date,
  horario varchar(15),
  descripcion varchar(2000),
  imagen varchar(1000),
  PRIMARY KEY (id_evento)
);

CREATE TABLE Entrada (
  cod_entrada int AUTO_INCREMENT,
  id_evento int,
  qr varchar(1000),
  butaca varchar(10),
  precio float,
  PRIMARY KEY (cod_entrada),
  FOREIGN KEY (id_evento) REFERENCES Evento(id_evento)
);

CREATE TABLE Compra (
  id int AUTO_INCREMENT,
  cod_entrada int,
  id_evento int,
  id_usuario int,
  cantidad_entradas int,
  precio_total float,
  PRIMARY KEY (id),
  FOREIGN KEY (id_evento) REFERENCES Evento(id_evento),
  FOREIGN KEY (cod_entrada) REFERENCES Entrada(cod_entrada),
  FOREIGN KEY (id_usuario) REFERENCES Usuario(id)
);
