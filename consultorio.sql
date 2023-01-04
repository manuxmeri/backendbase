drop database if exists consultorio;
create database consultorio;
use consultorio;


create table tpaciente
(
 id  INT NOT NULL AUTO_INCREMENT,
 nombre varchar(50) not null,
 apellido varchar(50) not null,
direccion varchar(50) not null,
 fechanaci varchar(50) not null,
edad int(3) not null,
 PRIMARY KEY (`id`)

);
create table tvisitaMedica
(
id  INT NOT NULL AUTO_INCREMENT,
 diagnosticoEnfermedad varchar(50) not null,
 fecha varchar(50) not null,
 hora varchar(50) not null,
PRIMARY KEY (`id`),
 fkPaciente INT NOT NULL, 
 foreign key (fkPaciente) references tpaciente(id)

);

create table tmedicamento(
id  INT NOT NULL AUTO_INCREMENT,
 nombre varchar(50) not null,
 capacidad varchar(50) not null,  
PRIMARY KEY (`id`)
);
create table treceta
(
id INT NOT NULL AUTO_INCREMENT,
 fechaReceta varchar(50) not null,
 dosis varchar(50),
 nota varchar(50),
 fkPaciente INT NOT NULL,
PRIMARY KEY (`id`),
 foreign key (fkPaciente) references tpaciente(id),
fkMedicamento INT NOT NULL ,
 foreign key (fkMedicamento) references tmedicamento(id)

);


create table tExamen
(
id INT NOT NULL AUTO_INCREMENT,
 fechaVExamen varchar(50) not null,
 hora varchar(50) not null,
 temperatura varchar(50),
 peso varchar(50),
 altura varchar(50),
 sintomas varchar(50),
 diagnostico varchar(50),
 notas varchar(50),
PRIMARY KEY (`id`),
 fkPaciente INT NOT NULL ,
 foreign key (fkPaciente) references tpaciente(id)
);


INSERT INTO `tmedicamento` (`id`, `nombre`, `capacidad`) VALUES (NULL, 'Ibuprofeno', '24 pastillas');

