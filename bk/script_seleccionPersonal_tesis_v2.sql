-- ESTRUCTURA DE LA BASE DE DATOS V2 mejorado 2017-II
 CREATE DATABASE seleccionpersonal_bd_v2;
	use seleccionpersonal_bd_v2;
	DROP DATABASE seleccionpersonal_bd_v2;
    
 CREATE TABLE DISPOSICION_LABORAL
 (
	Disposicion_laboral_id int not null auto_increment primary key,
	trabaja_actualmente char(2)not null,
	cambio_residencia char(2)not null
 );
call f_generar_correlativo('candidato')
 CREATE TABLE CANDIDATO --
 (
	-- DATOS PERSONALES PARA EL REGISTRO DE USUARIO
	codigo_candidato int not null primary key,
    doc_ID varchar(20)not null, -- OK
	nombre varchar(100)not null, -- OK
	apellidos varchar(100)not null,-- OK
	direccion varchar(200)not null,  -- OK
	celular varchar(20)not null, -- OK
	hijos varchar(2) not null, -- OK
	departamento_nacimiento varchar(50)not null, -- combo -- OK
	ciudad_nacimiento varchar(50)not null, -- combo -- OK
	estado_civil varchar(20)not null,-- combo  -- OK
	sexo varchar(20) not null, -- DATO PARA PROFESIOGRAMA, COMBO -- OK
	edad char(2)not null, -- DATO PARA PROFESIOGRAMA  -- OK
      -- trabaja char(2)not null, -- SI o NO, condicion, COMBO
      -- cambio_residencia varchar(15)not null, /* si o no, cambio de residencia */ -- COMBO
      --  familiares_cargo char(2)not null, -- no va, no es necesario aplicar
      -- profesion varchar(100)not null, no va, si tiene 4 profesiones?, seria mejor entidad estudios
	email varchar(200)not null, -- OK
	-- FIN DE DATOS PERSONALES PARA EL REGISTRO DE USUARIO
	-- curriculo varchar(50),reporte que muestre los datos de estudios y experiencia laboral
	Disposicion_laboral_id int,
	foreign key(Disposicion_laboral_id) references 
	DISPOSICION_LABORAL(Disposicion_laboral_id)
	
 );   
 alter table candidato
 add column codigo_cargo integer;

 alter table candidato
 add CONSTRAINT fk_personal_cargo FOREIGN KEY (codigo_cargo)
      REFERENCES cargo (codigo_cargo);

alter table candidato
 add CONSTRAINT uni_email UNIQUE (email);
 
 CREATE TABLE correlativo
(
  tabla varchar(100) NOT NULL,
  numero integer NOT NULL,
  CONSTRAINT pk_correlativo PRIMARY KEY (tabla)
);
 CREATE TABLE USUARIO
 ( 	
	codigo_usuario varchar(20) NOT NULL,
	-- p_cuenta varchar(8) not null,
	clave character(32) NOT NULL,
	tipo char(1) not null, -- postulante, jefe de recursos, asistente de recursos, psicólogo, académico
	-- p_foto varchar(50),
	estado char(1) DEFAULT 'P',
    -- doc_ID varchar(20),
    codigo_candidato int,
	primary key (codigo_usuario),
    foreign key candidato (codigo_candidato) references candidato(codigo_candidato)
 );

CREATE TABLE cargo
(
  codigo_cargo serial NOT NULL,
  descripcion character varying(50) NOT NULL,
  CONSTRAINT pk_cargo PRIMARY KEY (codigo_cargo)
);
/*
 CREATE TABLE RED_SOCIAL (
    red_social_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nombre_red_social VARCHAR(50),
    nombre_usuario VARCHAR(100),
    doc_ID VARCHAR(20),
    FOREIGN KEY (doc_ID)
        REFERENCES CANDIDATO (doc_ID)
);

 create sequence seq_area;
 CREATE TABLE AREA
 ( 
	area_id integer default nextval('seq_area'),
	nombre_area varchar(100)not null,
	constraint pk_area_id primary key (area_id)
 );
 */

 CREATE TABLE EXPERIENCIA_LABORAL -- DATO PARA PROFESIOGRAMA
 (
-- EXPERIENCIA
	experiencia_labora_ID int not null auto_increment primary key,
	rubro_empresa varchar(100)not null, -- nombre del rubo de la empresa
	empresa varchar(100)not null,
	puesto varchar(100)not null, -- funciona con un combo de todos los puesto, para una constructora
	lugar varchar(20)not null,-- of:oficina, ob:obra/ca:campo
	descripcion_laboral varchar(500)not null, -- funciones que realizaba
	-- motivo_cambio varchar(200)not null,-- porque dejó de trabajar
	area varchar(100)not null,
    duracion varchar(100)not null,
   -- fecha_inicio date not null, -- fecha de inicio de una experiencia laboral
   -- fecha_fin date not null, -- fecha fin de la experiencia laboral que tuvo el candidato
    codigo_candidato int,
	foreign key(codigo_candidato) references CANDIDATO(codigo_candidato)
	
 );
 /*create sequence seq_tipo_estudio; NO ES NECESARIO CREAR UNA TABLA TIPO DE ESTUDIO
 PORQUE NO ES GRANDE LA MANIPULACION DE LOS DATOS (REGISTRAR, ELIMINAR, MODIFICAR)
 CREATE TABLE TIPO_ESTUDIO
 (
	tipo_estudio_id integer default nextval('seq_tipo_estudio'),
	grado_estudio varchar(12)not null,
	constraint pk_tipo_estudio_id primary key (tipo_estudio_id)
 );*/
 CREATE TABLE ESTUDIO_CANDIDATO
 (
	estudio_candidato_id int not null auto_increment primary key,
	institucion_educativa varchar(100)not null,
	titulo_estudio varchar(100)not null,
	grado_estudio varchar(20)not null, -- universitario, magister, doctorado. MOSTRAR EL ESTUDIO MAS IMPORTANTE.
    fecha_inicio varchar(20)  not null, -- fecha de inicio de una experiencia laboral
    fecha_fin varchar(20)  not null, -- fecha fin de la experiencia laboral que tuvo el candidato
    codigo_candidato int,
	foreign key(codigo_candidato) references CANDIDATO(codigo_candidato)
 );
-- ---------------------------------------------------------------------------------------------------------------------

CREATE TABLE FORMACION_DESEABLE
(
	formacion_deseable_id int not null auto_increment primary key,
    formacion_deseable_nombre varchar(200)not null
);
CREATE TABLE DEPARTAMENTO
(
	departamento_id int not null auto_increment primary key,
    departamento_nombre varchar(200)not null
);
 CREATE TABLE PUESTO_LABORAL
 (
	puesto_laboral_ID int not null auto_increment primary key,
	nombre_puesto varchar(100)not null,
    edad varchar(100) not null,
    sexo char(1) not null, -- H:hombre, M:Mujer, C:cualquiera
	-- historia_puesto varchar(200)not null,
	-- posición_organigrama LONGBLOB not null,
	objetivo_puesto varchar(200)not null,
	funciones_puesto varchar(1000)not null, -- funciones del puesto o cotidianas, o habituales y frecuentes
	horario_trabajo varchar(150)not null,
	condiciones_trabajo varchar(100)not null,
	relaciones_sociales_internas varchar(150)not null,
	relaciones_sociales_externas varchar(150)not null,
	responsabilidades varchar(250)not null,
	equipo_de_trabajo varchar(250)not null,
	observaciones_finales varchar(150)not null,
    sueldo int not null,
    -- formacion varchar(200)not null,
    -- experiencia_deseable varchar(200)not null, ESTA EN LA ENTIDAD EXPERIENCIA REQUERIDA
    deteccion_necesidad varchar(500)not null,
    informacion_empresa varchar(500)not null,
    formacion_deseable_id int,
	departamento_id int,
    foreign key (formacion_deseable_id) references formacion_deseable(formacion_deseable_id),
    foreign key (departamento_id) references departamento(departamento_id)
 );
 -- ALTER TABLE PUESTO_LABORAL ADD FOREIGN KEY(puesto_laboral_ID)
 -- REFERENCES cliente(id_cliente) ON DELETE CASCADE;
 
 -- alter table PUESTO_LABORAL
 -- drop column estado;

 alter table puesto_laboral
 add convocatoria_id int;
 
 alter table puesto_laboral
 add tipo_jornada varchar(100);
 
 
 CREATE TABLE EXPERIENCIA_REQUERIDA -- DATO PARA PROFESIOGRAMA
 (
	experiencia_requeridad_id int not null auto_increment primary key,
	experiencia_requerida varchar(100)not null, -- SE DEBE MANEJAR UN COMBO PARA COMPARAR CON LA ESPERIENCIA DEL CANDIDATO Y FILTRAR 1
	duracion varchar(100) not null, 
    -- meses_anos varchar(50) not null,  
    puesto_laboral_ID int,
	foreign key(puesto_laboral_ID) references PUESTO_LABORAL(puesto_laboral_ID)
 );
 
 CREATE TABLE CONVOCATORIA
 (
	convocatoria_id int not null auto_increment primary key,
	nombre_convocatoria varchar(200)not null
	
);

 alter table puesto_laboral
 add foreign key (convocatoria_id) references convocatoria(convocatoria_id);
 
 /* drop table publicacion
 CREATE TABLE PUBLICACION
 (
	publicacion_id int not null auto_increment primary key,
	fecha_publicacion timestamp default current_timestamp on update current_timestamp,
	puesto_laboral_ID int,
	convocatoria_id int,
	foreign key(puesto_laboral_ID) references puesto_laboral(puesto_laboral_ID),
	foreign key(convocatoria_id) references convocatoria(convocatoria_id)
	
);
*/
 CREATE TABLE ETAPA
 (
	etapa_id int not null auto_increment primary key,
	nombre_etapa varchar(100) not null
);

 CREATE TABLE CRONOGRAMA
 (
	cronograma_id int not null auto_increment primary key,
	fecha_cronograma varchar(100) not null, 
	convocatoria_id int,
	etapa_id int,
	foreign key(convocatoria_id) references convocatoria(convocatoria_id),
	foreign key(etapa_id) references etapa(etapa_id)
	
);
/*CREATE TABLE SUPER_TIPO_PRUEBA
 (
	super_tipo_prueba_id int not null auto_increment primary key,
	nombre_super_tipo_prueba varchar(100) not null
);
*/
 CREATE TABLE TIPO_PRUEBA
 (
	tipo_prueba_id int not null auto_increment primary key,
	nombre_tipo_prueba varchar(100) not null
);

 CREATE TABLE PRUEBA
 (
	prueba_id int not null auto_increment primary key,
	nombre_prueba varchar(100) not null, 
	instruccion varchar(500),
	tipo_prueba_id int,
    puesto_laboral_id int,
	foreign key(tipo_prueba_id) references tipo_prueba(tipo_prueba_id),
	foreign key(puesto_laboral_id) references puesto_laboral(puesto_laboral_id)
);

 CREATE TABLE PONDERACION_DESEABLE
 (
	ponderacion_deseable_id int not null auto_increment primary key,
	ponderacion_deseable_minimo int,
    ponderacion_deseable_maximo int,
	prueba_id int,
	foreign key (prueba_id)references prueba(prueba_id)
);


 CREATE TABLE PROMEDIO_PRUEBA
 (
	resultado_candidato_prueba_id int auto_increment primary key,
	promedio float default 0, 
	prueba_id int,
    estado varchar(50),
	doc_ID varchar(20),
    FOREIGN KEY (prueba_id) REFERENCES prueba (prueba_id),
	foreign key(doc_ID) references CANDIDATO(doc_ID),
    UNIQUE DOC_ID_prueba_id_uniq (doc_id,prueba_id)
);
	ALTER TABLE PROMEDIO_PRUEBA
	ADD estado_promedio varchar(20);
	ALTER TABLE PROMEDIO_PRUEBA
	ADD pruebas_valoradas int; -- numero de pruebas valoradas; es decir que tienen el estado 'C'
	-- drop table PROMEDIO_PRUEBA;

CREATE TABLE PREGUNTA
 (
	pregunta_id int not null auto_increment primary key,
	nombre_pregunta varchar(100) not null,
	prueba_id int,
	foreign key(prueba_id) references prueba(prueba_id)
	
); 
	ALTER TABLE PREGUNTA MODIFY nombre_pregunta varchar(10000);
	alter table pregunta
	add column puntaje_incorrecto float;
    
CREATE TABLE RESPUESTA_CANDIDATO
 (
	RESPUESTA_CANDIDATO_ID int not null auto_increment primary key,
	respuesta char(1)not null,
    doc_id varchar(20)not null,
    puntaje_correcto float, -- puntaje correcto - puntaje incorrecto de una pregunta (comparar respuesta pregunta, con respuesta candidato)
    puntaje_incorrecto float,
    estado varchar(100)not null,
    pregunta_id int,
	foreign key(pregunta_id) references pregunta(pregunta_id),
    UNIQUE DOC_ID_PREGUNTA_ID_uniq (doc_id,pregunta_id)
);
/* 
drop table RESPUESTA_CANDIDATO
 CREATE TABLE RESPUESTA_CORRECTA
(
	respuesta_correcta_id int not null auto_increment primary key,
	respuesta_correcta varchar(200)not null,
    puntaje_id int,
    foreign key(puntaje_id)references puntaje(puntaje_id)
);
 
 
 

 CREATE TABLE RESPUESTA_candidato
 (
	respuesta_pregunta_ID int not null auto_increment primary key,
	respuesta_candidato varchar(100) not null, 
	puntaje_obtenido int,
	alternativas_pregunta_id int,
	pregunta_id int,
	foreign key(alternativas_pregunta_id) references ALTERNATIVA_PREGUNTA(alternativas_pregunta_id),
	foreign key(pregunta_id) references pregunta(pregunta_id)
	
);
*/ 
 CREATE TABLE FINALISTA (
    finalista_ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    doc_id VARCHAR(20),
    nombres VARCHAR(100),
    apellidos VARCHAR(100),
    email VARCHAR(200),
    celular VARCHAR(20),
    estado CHAR(2),
    puesto_laboral_id INT,
    FOREIGN KEY (puesto_laboral_id)
        REFERENCES puesto_laboral (puesto_laboral_id),
	UNIQUE DOC_ID_PREGUNTA_ID_uniq (doc_id,puesto_laboral_id)
);

-- DROP TABLE FINALISTA

	-- Un puesto tiene una o varias postulaciones de uno o varios candidatos y una postulacion de un candidato es para un puesto.
    -- Un puesto puede tener uno o varias postulaciones y una postulacion es para un puesto
	CREATE TABLE postulacion
    (
   -- postulacion_id INT NOT NULL AUTO_INCREMENT unique,
    postulacion INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    doc_id varchar(20),
    nombre varchar(100),
    estado varchar(100), -- SH: Si Habilitado, NH: No Hablitado
    fecha_postulacion varchar(100),
    puesto_laboral_id int,
    -- PRIMARY KEY (doc_id,puesto_laboral_id),
     foreign key(puesto_laboral_id) references puesto_laboral(puesto_laboral_id),
     UNIQUE DOC_ID_PREGUNTA_ID_uniq (doc_id,puesto_laboral_id)
    );

	alter table postulacion
	add column finalista varchar(50); -- Finalista: SI, No
	-- drop table postulacion;

-- ALTERAR TABLAS
-- drop table formacion_deseable
	
	alter table prueba
    add column duracion varchar(20);
    
    alter table pregunta
    add column estado varchar(50);
    
    alter table pregunta
    add column respuesta char(1);
    
	ALTER TABLE postulacion MODIFY estado varchar(100);
    
    alter table alternativa_pregunta
    drop column puntaje;
    
    alter table pregunta
    add column puntaje float;
    
	alter table puesto_laboral
    add column estado varchar(100);
    
    alter table ponderacion_deseable
    add column estado varchar(100);
    
	alter table estudio_candidato
	add column estado_estudios varchar(50) not null;

	alter table usuario
	add column fecha_registro varchar(50);
    
    alter table usuario
	drop column codigo_usuario;
    
	alter table Finalista
	add column ganador char(2); -- SI
    
  --  alter table prueba
   -- add column estado char(100);-- La prueba de encuentra Registrado o no Registrado.
 
        
    alter table puesto_laboral
	drop column informacion_empresa;
    
    alter table ponderacion_deseable
    add column valoracion int;
    

    
    alter table convocatoria
    add column estado varchar(100);
 -- -----------------------------------------------------------------------  
    select * from puesto_laboral;
-- FUNCIONES DE LA BASE DE DATOS
-- INSERTAR

	drop table super_tipo_prueba;
	drop table tipo_prueba;
	drop table prueba;
	drop table resultado_candidato;
	drop table respuesta_candidato;
	drop table respuesta_correcta;
	drop table alternativa_pregunta;
	drop table puntaje;
	drop table pregunta;
	drop table finalista;
	
	select * from prueba;
	select * from fecha_experiencia_requerida;
	select * from ponderacion_candidato;
	select * from candidato;
	select * from usuario;
	select * from respuesta_candidato;
	select * from FINALISTA;

	select * from candidato;
	select * from usuario;
	select * from etapa;
	select * from convocatoria;
	select * from publicacion;
	select * from puesto_laboral;
	select * from respuesta_candidato;
	select * from FINALISTA;



-- Function: f_generar_correlativo(character varying)

-- DROP FUNCTION f_generar_correlativo(character varying);
insert into correlativo
values('candidato',1);

delimiter $$
CREATE PROCEDURE f_generar_correlativo(p_tabla varchar(100))

	begin
		
			select
				numero + 1
			from
				correlativo
			where
				tabla = p_tabla;

end$$;


insert into usuario(p_cuenta, p_clave,p_tipo,p_foto,p_estado,fecha_registro)
values('48485474', '123','A','foto_12345678','A',(select now()));

insert into candidato(doc_id,nombre,apellidos,direccion,celular,hijos,departamento_nacimiento,
ciudad_nacimiento,estado_civil,sexo,edad,email)
values('45977448', 'Renzo','Ruiz Pastor','Calle Vaticano #664, las brisas','964550776','-',
'Lambayeque', 'Chiclayo', 'Soltero','Hombre','27','renzorp_14@hotmail.com');



select  c.nombre,
	c.apellidos,
	u.p_clave,
	u.p_estado	
	
from
	candidato c
	inner join usuario u on (c.doc_id = u.p_cuenta)
where
	c.doc_id = '45977448';

	update usuario
	set p_clave ='250cf8b51c773f3f8dc8b4be867a9a02'
	where
		nombre = 'Renzo';
drop table usuario



SELECT p_cuenta, IFNULL(p_foto,'') as p_foto, p_tipo, p_estado
 			FROM USUARIO 
			WHERE p_cuenta = '45977448' AND p_clave = '123' ;

insert into ponderacion_candidato
							(
								fecha_postulacion,puesto_laboral_id,doc_id
							)
values
	(
		'24/01/2017',1,'12345678'
	);


delete from ponderacion_deseable
where prueba_id = '2';

delete from usuario
where p_cuenta = '45977448';

select *
from 
	candidato;
insert into puesto_laboral
				(
					nombre_puesto,historia_puesto,objetivo_puesto, 
					funciones_puesto,horario_trabajo,condiciones_trabajo,
					relaciones_sociales_internas,relaciones_sociales_externas, 
					responsabilidades, equipo_de_trabajo,observaciones_finales
				)
values
	(
	'Contador','-','Apoyar al diseño y desarrollo de los proyectos de contrucción',
	'Supervisar que sus colaboradores cumplan con la planificación
	 de sus actividades, supervisar que el diseño y el desarrollo del puente se ajusten a los estándares
	 de calidad de la ISO 90001 y entre otras funciones netamente del puesto.',
	'8am - 5pm','Ambiente amigable en oficina y en campo.','Jefe del proyecto, Arquitectos y 
	 peones a su cargo',
	'Dueño del proyecto, accionistas, y supervisores de la ISO 9001','La supervision del personal a su cargo y de los diseños de puentes.',
	'Jefe de obras, arquitectos, obreros.', '-'
	);
update puesto_laboral
set sueldo = 3500
where puesto_laboral_id = 1;
insert into convocatoria
					(
					nombre_convocatoria
					)
values
	(
	'“Creación del servicio de saneamiento de los anexos Cruzpampa, Esmeralda y Tambopata, 
	ampliación y mejoramiento del servicio de agua potable en el anexo Cruzpampa 
	- Viñac – Yauyos- Lima”. '
	);
insert into etapa(nombre_etapa)values('Recepción de Postulaciones'); -- Tiempo en que los postulantes postulan al puesto.
insert into etapa(nombre_etapa)values('Filtro Curricular'); -- el sistema selecciona a los candidatos aptos para el puesto
insert into etapa(nombre_etapa)values('Pruebas de Selección'); -- los postulantes son sometidos a una serie de evaluaciones.
insert into etapa(nombre_etapa)values('Entrevista Gerencial'); -- los candidatos que mas se ajusten al puesto pasan por una entrevista
insert into etapa(nombre_etapa)values('Resultado Final'); -- se da a conocer al candidato que se hace del puesto.

select* from etapa
select* from convocatoria
select* from publicacion
insert into cronograma
					(
					fecha_cronograma, convocatoria_id, etapa_id
					)
values
	(
	'del 22/01/2017 al 25/01/2017',1,1
	);
insert into cronograma
					(
					fecha_cronograma, convocatoria_id, etapa_id
					)
values
	(
	'26/01/2017',1,2
	);
insert into cronograma
					(
					fecha_cronograma, convocatoria_id, etapa_id
					)
values
	(
	'del 27/01/2017 al 28/01/2017',1,3
	);
insert into cronograma
					(
					fecha_cronograma, convocatoria_id, etapa_id
					)
values
	(
	'29/01/2017',1,4
	);
insert into cronograma
					(
					fecha_cronograma, convocatoria_id, etapa_id
					)
values
	(
	'29/01/2017',1,5
	);
insert into publicacion
					(
					fecha_publicacion, puesto_laboral_id, convocatoria_id
					)
values
	(
	'2017-01-22 19:12:06',2,1
	);
insert into publicacion
					(
					fecha_publicacion, puesto_laboral_id, convocatoria_id
					)
values
	(
	'2017-01-22 19:12:06',3,1
	);
insert into publicacion
					(
					fecha_publicacion, puesto_laboral_id, convocatoria_id
					)
values
	(
	'2017-01-22 19:12:06',3,1
	);
insert into publicacion
					(
					fecha_publicacion, puesto_laboral_id, convocatoria_id
					)
values
	(
	'2017-01-22 19:12:06',4,1
	);


delete from publicacion
where publicacion_id > 1;

delete from etapa
where etapa_id > 0;

datetime current_date
select now() as fecha 
select * from publicacion
select current_date		

select 
	date_format(fecha_publicacion,'%d/%m/%y a las %h:%i') as 
	fecha, puesto_laboral_id, convocatoria_id 
from 
	publicacion;

-- consulta para mostrar en tabla de convocatoria
select distinct c.convocatoria_id,
	c.nombre_convocatoria, date_format(u.fecha_publicacion,'%d/%m/%y a las %h:%i') as 
	publicacion, p.nombre_puesto,o.fecha_postulacion
from 
	convocatoria c inner join publicacion u 
	on c.convocatoria_id = u.convocatoria_id inner join puesto_laboral p
	on p.puesto_laboral_id = u.puesto_laboral_id inner join ponderacion_candidato o
	on o.puesto_laboral_id = p.puesto_laboral_id
	
	order by 2

-- consulta para mostrar mis postulaciones que tuvo un determinado candidato.accessible

select distinct c.convocatoria_id,
	c.nombre_convocatoria, date_format(u.fecha_publicacion,'%d/%m/%y a las %h:%i') as 
	publicacion, p.nombre_puesto,o.fecha_postulacion
from 
	convocatoria c inner join publicacion u 
	on c.convocatoria_id = u.convocatoria_id inner join puesto_laboral p
	on p.puesto_laboral_id = u.puesto_laboral_id inner join ponderacion_candidato o
	on o.puesto_laboral_id = p.puesto_laboral_id



select * from puesto_laboral inner join publicacion


select date_format(fecha_publicacion,'%d/%m/%y a las %h:%i') as fecha from publicacion
select* from fecha_experiencia_requerida
select* from experiencia_requerida

insert into fecha_experiencia_requerida(duracion,anos_meses,puesto_laboral_id,experiencia_requeridad_id) values('2','años',1,1);
insert into experiencia_requerida(experiencia_requerida) values('Especialista en diseños de puentes para proyectos de mediana complejidad');







select distinct c.convocatoria_id,
                    c.nombre_convocatoria, date_format(u.fecha_publicacion,'%d/%m/%y a las %h:%i') as 
                    publicacion, p.nombre_puesto,p.funciones_puesto,p.objetivo_puesto,
                    p.condiciones_trabajo,p.relaciones_sociales_internas,p.relaciones_sociales_externas,
                    p.responsabilidades,p.horario_trabajo,p.observaciones_finales,p.sueldo,r.experiencia_requerida,
					f.duracion,f.anos_meses
                 from 
                    convocatoria c inner join publicacion u 
                    on c.convocatoria_id = u.convocatoria_id inner join puesto_laboral p
                    on p.puesto_laboral_id = u.puesto_laboral_id inner join ponderacion_candidato o
                    on o.puesto_laboral_id = p.puesto_laboral_id inner join fecha_experiencia_requerida f
					on f.puesto_laboral_id = p.puesto_laboral_id inner join experiencia_requerida r
					on r.experiencia_requeridad_id = f.experiencia_requeridad_id






select distinct c.convocatoria_id,
                    c.nombre_convocatoria, date_format(u.fecha_publicacion,'%d/%m/%y a las %h:%i') as 
                    publicacion, p.nombre_puesto,p.funciones_puesto,p.objetivo_puesto,
                    p.condiciones_trabajo,p.relaciones_sociales_internas,p.relaciones_sociales_externas,
                    p.responsabilidades,p.horario_trabajo,p.observaciones_finales,p.sueldo,r.experiencia_requerida,
                    f.duracion,f.anos_meses 
                 from 
                    convocatoria c inner join publicacion u 
                    on c.convocatoria_id = u.convocatoria_id inner join puesto_laboral p
                    on p.puesto_laboral_id = u.puesto_laboral_id inner join ponderacion_candidato o
                    on o.puesto_laboral_id = p.puesto_laboral_id inner join fecha_experiencia_requerida f
                    on f.puesto_laboral_id = p.puesto_laboral_id inner join experiencia_requerida r
                    on r.experiencia_requeridad_id = f.experiencia_requeridad_id 
                    where p.puesto_laboral_id = 21;



-- 
select * from estudio_candidato;
insert into estudio_candidato(institucion_educativa,titulo_estudio,grado_estudio,fecha_inicio,fecha_fin,doc_id, estado_estudios)
values('Usat','Ingeniero de Sistemas y Computacion','Universidad','2010-07-18','2015-07-18','12345678','culminado');

insert into fecha_estudio(f_inicio_mes,f_inicio_ano,f_fin_mes,f_fin_ano,doc_id,estudio_candidato_id)
values('Enero','2016','Enero','2017',12345678,2);

insert into estudio_candidato(institucion_educativa,titulo_estudio,grado_estudio,estado_estudios)
values('Usat','Ingeniero de Sistemas y Computacion con Mención a Tecnología de la Información','Magister','en proceso');

insert into fecha_estudio(f_inicio_mes,f_inicio_ano,f_fin_mes,f_fin_ano,doc_id,estudio_candidato_id)
values('Enero','2017','Enero','2018',12345678,3);

delete from fecha_estudio
where fecha_estudio_id > 0;

delete from estudio_candidato
where estudio_candidato_id > 0;

SELECT doc_id, CONCAT(UPPER(nombre),' ',UPPER(apellidos)) as nombre_completo, profesion, email, celular from candidato where doc_id = 

/*
select
	c.doc_id, CONCAT(UPPER(c.nombre),' ',UPPER(c.apellidos)) as nombre_completo,
	e.titulo_estudio,c.email,c.celular,e.grado_estudio
from 
	candidato c inner join fecha_estudio f
	on c.doc_id = f.doc_id inner join estudio_candidato e
	on f.estudio_candidato_id = e.estudio_candidato_id
	where e.grado_estudio = 'Universidad' or e.grado_estudio = 'Magister' or 
	e.grado_estudio = 'Doctorado' and c.doc_id = '88888888';
*/

select
	c.doc_id, CONCAT(UPPER(c.nombre),' ',UPPER(c.apellidos)) as nombre_completo,
	e.titulo_estudio,c.email,c.celular,e.grado_estudio
from 
	candidato c inner join fecha_estudio f
	on c.doc_id = f.doc_id inner join estudio_candidato e
	on f.estudio_candidato_id = e.estudio_candidato_id
	where e.grado_estudio ='Universidad' or e.grado_estudio = 'Magister' and c.doc_id = '12345678';

select*from estudio_candidato
select*from fecha_estudio

-- INSERTAR CANDIDATO
select*from candidato
		insert into candidato
					(
					doc_id,nombre,apellidos,direccion,celular,hijos,
					departamento_nacimiento,ciudad_nacimiento,estado_civil,
					sexo,edad,email,disposion_laboral
					)
		values(
				'45977448','Renzo','Ruiz Pastor','Las brisas','964550776',
				'0','Lambayeque','Chiclayo','S','H','26','renzorp_14@hotmail.com',
				1,1
				)
select* from DISPOSICION_LABORAL

insert into DISPOSICION_LABORAL(trabaja_actualmente, cambio_residencia)
values('Si','Si');
insert into DISPOSICION_LABORAL(trabaja_actualmente, cambio_residencia)
values('Si','No');
insert into DISPOSICION_LABORAL(trabaja_actualmente, cambio_residencia)
values('No','No');
insert into DISPOSICION_LABORAL(trabaja_actualmente, cambio_residencia)
values('No','Si');

select* from candidato
drop procedure fn_registrarCandidato; 

DELETE FROM candidato
WHERE doc_id = '12345678'


delimiter $$
CREATE PROCEDURE fn_registrarCandidato
									(
					in op1 char(2), in op2 char(2), in p_codigo_candidato int, in p_doc_id varchar(20), in p_nombre varchar(100),
					in p_apellidos varchar(100), in p_direccion varchar(200), in p_celular varchar(20),
					in p_hijos varchar(2), in p_departamento_nacimiento varchar(50),
					in p_ciudad_nacimiento varchar(50), in p_estado_civil varchar(20),
					in p_sexo varchar(20), in p_edad char(2), in p_email varchar(200), in codigo_usuario varchar(20),
                    in p_clave character(32), in p_tipo char(1)
									)

begin

					if op1 = "Si" and op2 = "Si" then
					
							insert into candidato
									(
									doc_id,nombre,apellidos,direccion,celular,hijos,
									departamento_nacimiento,ciudad_nacimiento,estado_civil,
									sexo,edad,email,disposicion_laboral_id,codigo_candidato
									)
							values(
									p_doc_id,p_nombre,p_apellidos,p_direccion,p_celular,p_hijos,
									p_departamento_nacimiento,p_ciudad_nacimiento,p_estado_civil,
									p_sexo,p_edad,p_email,1,p_codigo_candidato
									);

					elseif op1 = "Si" and op2 = "No" then
						
							insert into candidato
									(
									doc_id,nombre,apellidos,direccion,celular,hijos,
									departamento_nacimiento,ciudad_nacimiento,estado_civil,
									sexo,edad,email,disposicion_laboral_id
									)
							values(
									p_doc_id,p_nombre,p_apellidos,p_direccion,p_celular,p_hijos,
									p_departamento_nacimiento,p_ciudad_nacimiento,p_estado_civil,
									p_sexo,p_edad,p_email,2
									);
						elseif op1 = "No" and op2 = "No" then
							
								insert into candidato
										(
										doc_id,nombre,apellidos,direccion,celular,hijos,
										departamento_nacimiento,ciudad_nacimiento,estado_civil,
										sexo,edad,email,disposicion_laboral_id
										)
								values(
										p_doc_id,p_nombre,p_apellidos,p_direccion,p_celular,p_hijos,
										p_departamento_nacimiento,p_ciudad_nacimiento,p_estado_civil,
										p_sexo,p_edad,p_email,3
										);
							elseif op1 = "No" and op2 = "Si" then
								
									insert into candidato
											(
											doc_id,nombre,apellidos,direccion,celular,hijos,
											departamento_nacimiento,ciudad_nacimiento,estado_civil,
											sexo,edad,email,disposicion_laboral_id
											)
									values(
											p_doc_id,p_nombre,p_apellidos,p_direccion,p_celular,p_hijos,
											p_departamento_nacimiento,p_ciudad_nacimiento,p_estado_civil,
											p_sexo,p_edad,p_email,4
											);
							end if;	
                            
								insert into usuario(codigo_usuario, clave,p_tipo,fecha_registro) 
                                values (p_codigo_usuario,p_clave,'P',(select now()));
                                
			
            
end$$;



call fn_registrarCandidato
						(
				'No','Si','12345677','Renzo','Ruiz Pastor','Las brisas','964550776',
				'0','Lambayeque','Chiclayo','Soltero','H','26','renzorp_14@hotmail.com'
						);


select* from correlativo
select* from usuario
				
		
		
				select 
					doc_id,nombre,apellidos,direccion,celular,hijos,departamento_nacimiento,
					ciudad_nacimiento,estado_civil,sexo,edad,email
				from 
					candidato


			update candidato
			set doc_id ='$doc_id',nombre ='$nombre',apellidos ='$apellidos',direccion ='$direccion',
				celular ='$celular',hijos ='$hijos',departamento_nacimiento ='$departamento_nacimiento',
				ciudad_nacimiento ='$ciudad_nacimiento',estado_civil ='$estado_civil',
				sexo ='$sexo',edad ='$edad',email ='$email'
			where
				doc_id ='$doc_id';


		select 
			e.institucion_educativa,e.titulo_estudio,e.grado_estudio,
			e.fecha_inicio,e.fecha_fin,e.estado_estudios
		from 
			candidato c inner join estudio_candidato e
			on c.doc_id = e.doc_id
		where c.doc_id ='87654321';
				

select* from estudio_candidato;


select* from estudio_candidato;

drop procedure fn_Registrar_Estudios; 
			
delimiter $$
CREATE PROCEDURE fn_Registrar_Estudios
										(
					in p_doc_id varchar(20),
					in p_institucion_educativa varchar(100),in p_titulo_estudio varchar(100),
					in p_grado_estudio varchar(20),in p_f_inicio date,
                    in p_f_fin date,in p_estado_estudios varchar(50)
										)

	
begin

DECLARE specialty CONDITION FOR SQLSTATE '45000'; 
								IF p_f_inicio < p_f_fin THEN
				
									insert into estudio_candidato
												(
												institucion_educativa,titulo_estudio,grado_estudio,
												fecha_inicio,fecha_fin, doc_id,estado_estudios
												)
									values (
											p_institucion_educativa,p_titulo_estudio,p_grado_estudio,
											p_f_inicio,p_f_fin,p_doc_id,p_estado_estudios
											);
								 ELSE
									 SIGNAL SQLSTATE '45000'
									 SET MESSAGE_TEXT = 'Error: La fecha de inicio es mayor a la fecha fin!';
								end if;

end$$;

call fn_Registrar_Estudios
						(
					'45977448','Usat','Ingeniero de Sistemas y Computacion',
					'Universidad','01-01-2010','01-01-2016','culminado'
						);

delete from puesto_laboral
where puesto_laboral_id >0

select* from estudio_candidato

delete from estudio_candidato
where doc_id = '87654321'


truncate fecha_estudio;
truncate estudio_candidato;





drop procedure fn_Actualizar_Estudios; 
                
                
delimiter $$
CREATE PROCEDURE fn_Actualizar_Estudios
										(
					in p_doc_id varchar(20),in p_estudio_candidato_id int,
					in p_institucion_educativa varchar(100),in p_titulo_estudio varchar(100),
					in p_grado_estudio varchar(12),in p_f_inicio date,
                    in p_f_fin date,in p_estado_estudios varchar(50)
										)

begin
	
								update estudio_candidato
								set 
									institucion_educativa = p_institucion_educativa,
									titulo_estudio = p_titulo_estudio,
									grado_estudio = p_grado_estudio,
                                    fecha_inicio = p_f_inicio,
                                    fecha_fin = p_f_fin,
                                    estado_estudios = p_estado_estudios
								where
									doc_id = p_doc_id and estudio_candidato_id = p_estudio_candidato_id;

end$$;


select* from estudio_candidato
select 
                 *
                from 
                    puesto_laboral
                where convocatoria_id = 1

call fn_Actualizar_Estudios
						(
					'45977448',2,'Usat','Ingeniero de Sistemas y Computacion',
					'Universidadd','2011-01-01','2016-01-01',
					'culminado'
						);

p_doc_id varchar(20),
					in p_institucion_educativa varchar(100),in p_titulo_estudio varchar(100),
					in p_grado_estudio varchar(12),in p_f_inicio date,
                    in p_f_fin date,in p_estado_estudios varchar(50)
                    

drop procedure fn_Registrar_Experiencia; 
			
delimiter $$
CREATE PROCEDURE fn_Registrar_Experiencia
										(
					in p_doc_id varchar(20),in p_rubro_empresa varchar(100),
					in p_empresa varchar(100),in p_puesto varchar(100),
					in p_lugar varchar(20),in p_descripcion_laboral varchar(500),
					in p_area varchar(100),in p_duracion varchar(100)
										)
                              
begin
	
					insert into experiencia_laboral
								(
                                rubro_empresa,empresa,puesto,lugar,
                                descripcion_laboral,area,duracion,doc_id
                                )
					values (
							p_rubro_empresa,p_empresa,p_puesto,p_lugar,
                            p_descripcion_laboral,p_area,p_duracion,p_doc_id
                            );

end$$;

call fn_Registrar_Experiencia
						(
					'12345678','construccion','Vicsac',
					'TI','Oficina',
					'Etc','TI','De 1 a 2 anos'
						);
                        select* from experiencia_laboral
drop procedure fn_Actualizar_Experiencia; 
			
delimiter $$
CREATE PROCEDURE fn_Actualizar_Experiencia
										(
					in p_experiencia_laboral_id varchar(20),in p_rubro_empresa varchar(100),
					in p_empresa varchar(100),in p_puesto varchar(100),
					in p_lugar varchar(20),in p_descripcion_laboral varchar(500),
					in p_area varchar(100),in p_duracion varchar(100)
										)

	 
begin
	
								update experiencia_laboral
								set 
									rubro_empresa = p_rubro_empresa,
									empresa = p_empresa,
									puesto = p_puesto, lugar = p_lugar,
                                    descripcion_laboral = p_descripcion_laboral, area = p_area,
                                    duracion = p_duracion
								where
									experiencia_labora_id = p_experiencia_laboral_id;

end$$;

call fn_Actualizar_Experiencia
						(
					'87654321','construccionn','Vicsac',
					'TI','Oficina',
					'Etc','TI','menor a 1 ano'
						);
-- Registrar Puesto de Trabajo

insert into puesto_laboral
					(
                    nombre_puesto, departamento_id, objetivo_puesto, 
                    funciones_puesto, horario_trabajo, condiciones_trabajo, 
                    relaciones_sociales_internas, relaciones_sociales_externas, 
                    responsabilidades, equipo_de_trabajo, observaciones_finales,
                    sueldo, formacion, experiencia, otros_Requisitos, 
                    deteccion_necesidad, informacion_empresa
                    )
values
	( 
    'nombre_puesto', 'departamento_seccion', 'objetivo_puesto', 
	'funciones_puesto', 'horario_trabajo', 'condiciones_trabajo', 
    'relaciones_sociales_internas', 'relaciones_sociales_externas', 
	'responsabilidades', 'equipo_de_trabajo', 'observaciones_finales',
    1500, 'formacion', 'experiencia', 'otros_Requisitos', 
    'deteccion_necesidad', 'informacion_empresa'
    );
 

    
select* from puesto_laboral
select* from candidato
select* from fecha_estudio
select* from experiencia_laboral



select 
	e.empresa, e.rubro_empresa, e.puesto, e.lugar, e.descripcion_laboral, e.area,
    f.duracion, f.anos_meses
from 
	candidato c inner join fecha_experiencia_laboral f 
    on c.doc_id = f.doc_id inner join experiencia_laboral e
    on f.experiencia_labora_id = e.experiencia_labora_id 
    
    on 

select* from usuario;
SELECT 
    *
FROM
    candidato;



delete from Fecha_experiencia_laboral
where Fecha_experiencia_id >0

delete from experiencia_laboral
where experiencia_labora_id >0



select * from candidato
select * from usuario

select* from estudio_Candidato;







select
            c.doc_id, CONCAT(UPPER(c.nombre),' ',UPPER(c.apellidos)) as nombre_completo,
            e.titulo_estudio,c.email,c.celular,e.grado_estudio
from 
            candidato c inner join estudio_candidato e
            on c.doc_id = e.doc_id
where 
		   e.grado_estudio ='Universidad' or e.grado_estudio = 'Magister' and c.doc_id = '$_SESSION[dni]';
                
                
                
                
                
select 
                         e.doc_id,e.empresa, e.rubro_empresa, e.puesto, e.lugar, e.descripcion_laboral, e.area,
                         e.fecha_inicio, e.fecha_fin
                from 
                        candidato c inner join experiencia_laboral e
                         on c.doc_id = e.doc_id
                where 
                         e.doc_id = '87654321';
                         
                         
select 
		doc_id,concat(nombre, ", ", apellidos) as nombres
from
	candidato
where
	doc_id = '87654321';
    
    
    select* from usuario
    
    update usuario
    set p_foto = 'foto_87654321'
    where p_cuenta = '87654321';
 
 
 select * from tipo_prueba
 
 select 
			e.institucion_educativa,e.titulo_estudio,e.grado_estudio,
			e.fecha_inicio,e.fecha_fin,e.estado_estudios
		from 
			candidato c inner join estudio_candidato e
			on c.doc_id = e.doc_id
                where 
                    c.doc_id = '87654321';
                    
  /*                  
insert into super_tipo_prueba(nombre_super_tipo_prueba)
values('Prueba Específica');
insert into super_tipo_prueba(nombre_super_tipo_prueba)
values('Prueba de Prácticas Profesionales');
insert into super_tipo_prueba(nombre_super_tipo_prueba)
values('Prueba de Conocimiento'); 


insert into tipo_prueba(nombre_tipo_prueba,super_tipo_prueba_id)
values('Test de Aptitud',1);
insert into tipo_prueba(nombre_tipo_prueba,super_tipo_prueba_id)
values('Test de Personalidad',1);
insert into tipo_prueba(nombre_tipo_prueba,super_tipo_prueba_id)
values('Test de Motivación e Interes',1);
insert into tipo_prueba(nombre_tipo_prueba,super_tipo_prueba_id)
values('Test de Habilidades Sociales',1);

insert into prueba(nombre_prueba,tipo_prueba_id)
values('Verbal',1);
insert into prueba(nombre_prueba,tipo_prueba_id)
values('Fluidez Verbal 1',1);
insert into prueba(nombre_prueba,tipo_prueba_id)
values('Fluidez Verbal 2',1);
insert into prueba(nombre_prueba,tipo_prueba_id)
values('Numérica',1);
insert into prueba(nombre_prueba,tipo_prueba_id)
values('Espacial',1);
insert into prueba(nombre_prueba,tipo_prueba_id)
values('Abstracta',1);
insert into prueba(nombre_prueba,tipo_prueba_id)
values('Mecánica',1);
insert into prueba(nombre_prueba,tipo_prueba_id)
values('Atención',1);
insert into prueba(nombre_prueba,tipo_prueba_id)
values('Memoria',1);
  */
  
select * from prueba where tipo_prueba_id = 1;

-- PROCEDIMIENTO ALMACENADO QUE REGISTRA PRUEBA COMPLETA
select * from prueba;
select * from prueba;
select * from prueba;
select * from prueba;
select * from prueba;



select s.nombre_super_tipo_prueba,t.nombre_tipo_prueba,p.estado,p.estado from super_tipo_prueba s inner join tipo_prueba t
on s.super_tipo_prueba_id = t.super_tipo_prueba_id inner join prueba p
on t.tipo_prueba_id = p.tipo_prueba_id








select 
                       s.nombre_super_tipo_prueba,t.nombre_tipo_prueba,
                       p.estado,p.estado,p.nombre_prueba 
                 from super_tipo_prueba s inner join tipo_prueba t
                       on s.super_tipo_prueba_id = t.super_tipo_prueba_id inner join prueba p
                       on t.tipo_prueba_id = p.tipo_prueba_id;
                       
                       
                       
       -- Mostrar Puesto, formacion deseable,experiencia_requeridad                
SELECT 
    p.nombre_puesto,p.edad,p.sexo,p.objetivo_puesto,
    p.funciones_puesto,p.horario_trabajo,p.condiciones_trabajo,
    p.relaciones_sociales_internas,p.relaciones_sociales_externas,
    p.responsabilidades,p.equipo_de_trabajo,p.observaciones_finales,
    p.sueldo,p.formacion_deseable,p.experiencia_profesional,p.otros_estudios
    
FROM
    puesto_laboral p
        INNER JOIN
    departamento d ON p.departamento_id = d.departamento_id
        INNER JOIN
    experiencia_requerida e ON p.puesto_laboral_id = e.puesto_laboral_id
        INNER JOIN
    formacion_deseable f ON p.formacion_deseable_id = f.formacion_deseable_id;
    
    
    
-- FUNCIÓN PARA DETALLE DEL PUESTO


delimiter $$;
create procedure fn_registrarPuesto
							(
                            in p_departamento_id int,in p_convocatoria_id int,in p_nombre_puesto varchar(100),in p_edad varchar(100),
                            in p_sexo char(1),in p_objetivo_puesto varchar(200),
                            in p_funciones_puesto varchar(1000),in p_horario_trabajo varchar(150),
                            in p_condiciones_trabajo varchar(100),in p_relaciones_sociales_internas varchar(150),
                            in p_relaciones_sociales_externas varchar(150),in p_responsabilidades varchar(250),
                            in p_equipo_de_trabajo varchar(250),in p_observaciones_finales varchar(150),
                            in p_tipo_jornada varchar(100), in p_sueldo int
                            
                            )
begin
				insert into PUESTO_LABORAL
									(
                                    nombre_puesto,edad,sexo,objetivo_puesto,funciones_puesto,
                                    horario_trabajo,condiciones_trabajo,relaciones_sociales_internas,
                                    relaciones_sociales_externas,responsabilidades, equipo_de_trabajo,
									observaciones_finales,tipo_jornada,sueldo,departamento_id,convocatoria_id
									)
				values
					(
                    p_nombre_puesto,p_edad,p_sexo,p_objetivo_puesto,p_funciones_puesto,p_horario_trabajo,
					p_condiciones_trabajo,p_relaciones_sociales_internas,
                    p_relaciones_sociales_externas,p_responsabilidades,
                    p_equipo_de_trabajo,p_observaciones_finales,p_tipo_jornada,p_sueldo,p_departamento_id,
                    p_convocatoria_id
					);
                    
                

end$$;

drop procedure fn_registrarPuesto;

call fn_registrarPuesto
					(
                    2,1,'Ingeniero de Sistemas','entre 25 a 32 años','A','aaaaaaaa','aaaaa',
					'de 7am a 1pm - 3pm a 5pm','Bueno','aaaaaaaaaa',
                    'ssssssssssssssss','ddddddddddddddddd',
                    'aaaaaaaaaaa','ffffffffffff',9500
                    );

insert into PUESTO_LABORAL(
							nombre_puesto,edad,sexo,objetivo_puesto,funciones_puesto,horario_trabajo,
                            condiciones_trabajo,relaciones_sociales_internas,relaciones_sociales_externas,
                            responsabilidades, equipo_de_trabajo,observaciones_finales,sueldo,departamento_id
							)
values('Ingeniero civil','entre 25 a 32 años','Ambos Sexos','aaaaaaaaaaa','aaaaaaaaaaa','de 7am a 1pm - 3pm a 5pm','Bueno',
							'aaaaaaaaaa','ssssssssssssssss','ddddddddddddddddd', 'aaaaaaaaaaaaaaaaaa','ddddddd',3500);
                            
select* from PUESTO_LABORAL;
select* from convocatoria
select* from etapa;

insert into departamento(departamento_nombre)
values ('Administración');
insert into departamento(departamento_nombre)
values ('Contabilidad');
insert into departamento(departamento_nombre)
values ('Costo y Presupuesto');
insert into departamento(departamento_nombre)
values ('Logística');
insert into departamento(departamento_nombre)
values ('Mantenimientos de Equipos');
insert into departamento(departamento_nombre)
values ('Legal');
insert into departamento(departamento_nombre)
values ('Topografía');
insert into departamento(departamento_nombre)
values ('Sistemas de Información');
insert into departamento(departamento_nombre)
values ('Esctructuras');
insert into departamento(departamento_nombre)
values ('Medio Ambiente');
insert into departamento(departamento_nombre)
values ('Consulta y Atención');
insert into departamento(departamento_nombre)
values ('Hidráulica');
insert into departamento(departamento_nombre)
values ('Estudio de Suelos');
insert into departamento(departamento_nombre)
values ('Proyectos');








				select 
                        *
                 from
                        puesto_laboral
                 where 
                        puesto_laboral_id =
										(
                                        select count(*)	from puesto_laboral
                                        );
						
                        
                        
						 select 
                            max(select count(*)	from puesto_laboral)
						 from
							puesto_laboral;
                            
drop procedure fn_actualiza_puesto;                           
delimiter $$;
create procedure fn_actualiza_puesto
								(

									in p_puesto_laboral_id int,in p_convocatoria_id int,in p_nombre_puesto varchar(100),
                                    in p_departamento_id int,
									in p_edad varchar(100),
									in p_sexo char(1),
									in p_objetivo_puesto varchar(200),
									in p_funciones_puesto varchar(1000),
									in p_horario_trabajo varchar(150),
									in p_condiciones_trabajo varchar(100),
									in p_relaciones_sociales_internas varchar(150),
									in p_relaciones_sociales_externas varchar(150),
									in p_responsabilidades varchar(250),
									in p_equipo_de_trabajo varchar(250),
									in p_observaciones_finales varchar(150),
                                    in p_tipo_jornada varchar(100),
									in p_sueldo int
								)
begin
-- DECLARE _puestoID int;
		
        -- set _puestoID = (select count(*) from puesto_laboral);
		
				update puesto_laboral 
							set  
								nombre_puesto = p_nombre_puesto,                           
								edad = p_edad,
								sexo = p_sexo,
								objetivo_puesto = p_objetivo_puesto,
								funciones_puesto = p_funciones_puesto,
								horario_trabajo = p_horario_trabajo,
								condiciones_trabajo = p_condiciones_trabajo,
								relaciones_sociales_internas = p_relaciones_sociales_internas,
								relaciones_sociales_externas = p_relaciones_sociales_externas,
								responsabilidades = p_responsabilidades,
								equipo_de_trabajo = p_equipo_de_trabajo,
								observaciones_finales = p_observaciones_finales,
                                tipo_jornada = p_tipo_jornada,
								sueldo = p_sueldo,
								departamento_id = p_departamento_id,
                                convocatoria_id = p_convocatoria_id
						where
							puesto_laboral_id = p_puesto_laboral_id;

end$$;
      
    call fn_actualiza_puesto(9,'ingeniero civill',2,
									'30',
									'H',
									'ddddddd',
									'sssssssssssssssss',
									'aaaaaa',
									'ffffff ffffddd',
									'jjj jjjjj)',
									'gggg jjjjjjjj',
									'jj jjjg',
									'jjjj jj',
									'jjjjj',
									25
                                    );
    
select 
                    p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo,
                    d.departamento_id,
                    d.departamento_nombre
                from puesto_laboral p inner join departamento d on
                    p.departamento_id = d.departamento_id
                    where puesto_laboral_id = (select count(*) from puesto_laboral)
                    
select 
                    p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo,
                    d.departamento_id,
                    d.departamento_nombre
                from puesto_laboral p inner join departamento d on
                    p.departamento_id = d.departamento_id
                    where puesto_laboral_id = (select count(*) from puesto_laboral)
                    
                    
                  select * from puesto_laboral
                    
-- REGISTRAR PÉRFIL DEL PUESTO
insert into tipo_prueba(tipo_prueba_id,nombre_tipo_prueba)
values(1,'Prueba Específica');
insert into tipo_prueba(tipo_prueba_id,nombre_tipo_prueba)
values(2,'Prueba de Prácticas Profesionales');
insert into tipo_prueba(tipo_prueba_id,nombre_tipo_prueba)
values(3,'Prueba de Conocimiento');



drop procedure fn_registrarPerfil

select * from puesto_laboral;
select * from convocatoria;
 select * from experiencia_requerida

select * from convocatoria; 
select * from puesto_laboral;
select * from ponderacion_deseable;
select * from prueba;
select * from experiencia_requerida;

update puesto_laboral
set formacion_Deseable_id = null
where puesto_laboral_id = 1;

truncate experiencia_requerida;
truncate ponderacion_deseable;

delete from prueba
where prueba_id>=1;





/*
drop procedure fn_registrarPerfil;

delimiter $$;
CREATE PROCEDURE fn_registrarPerfil
					(
					in p_formacion_deseable_id int,
                    in p_experiencia_requerida1 varchar(100),in p_duracion1 int, p_meses_anos1 varchar(50),
                    in p_experiencia_requerida2 varchar(100),in p_duracion2 int, p_meses_anos2 varchar(50),
                    in p_experiencia_requerida3 varchar(100),in p_duracion3 int, p_meses_anos3 varchar(50),
                    in p_experiencia_requerida4 varchar(100),in p_duracion4 int, p_meses_anos4 varchar(50),
                    in p_experiencia_requerida5 varchar(100),in p_duracion5 int, p_meses_anos5 varchar(50),
                    in p_experiencia_requerida6 varchar(100),in p_duracion6 int, p_meses_anos6 varchar(50), 
                    in p_nombre_tipo_caracteristica_deseable1 varchar(100), -- tipo de test
                    in p_nombre_caracteristica_deseable1 varchar(100),in p_nombre_caracteristica_deseable2 varchar(100),
                    in p_nombre_caracteristica_deseable3 varchar(100),in p_nombre_caracteristica_deseable4 varchar(100),
                    in p_nombre_caracteristica_deseable5 varchar(100),in p_nombre_caracteristica_deseable6 varchar(100),
                    in p_nombre_caracteristica_deseable7 varchar(100),
                    in p_ponderacion_deseable_minimo1 int,
                    in p_ponderacion_deseable_maximo1 int,in p_valoracion1 int,in p_estado1 varchar(100),
                    in p_ponderacion_deseable_minimo2 int,in p_ponderacion_deseable_maximo2 int,
                    in p_valoracion2 int,in p_estado2 varchar(100),in p_ponderacion_deseable_minimo3 int,
                    in p_ponderacion_deseable_maximo3 int,in p_valoracion3 int,in p_estado3 varchar(100),
                    in p_ponderacion_deseable_minimo4 int,in p_ponderacion_deseable_maximo4 int,
                    in p_valoracion4 int,in p_estado4 varchar(100),in p_ponderacion_deseable_minimo5 int,
                    in p_ponderacion_deseable_maximo5 int,in p_valoracion5 int,in p_estado5 varchar(100),
                    in p_ponderacion_deseable_minimo6 int,in p_ponderacion_deseable_maximo6 int,
                    in p_valoracion6 int,in p_estado6 varchar(100),in p_ponderacion_deseable_minimo7 int,
                    in p_ponderacion_deseable_maximo7 int,in p_valoracion7 int,in p_estado7 varchar(100),
                    in p_ponderacion_deseable_minimo8 int,in p_ponderacion_deseable_maximo8 int,
                    in p_valoracion8 int,in p_estado8 varchar(100),in p_ponderacion_deseable_minimo9 int,
                    in p_ponderacion_deseable_maximo9 int,in p_valoracion9 int,in p_estado9 varchar(100),
                    in p_ponderacion_deseable_minimo10 int,in p_ponderacion_deseable_maximo10 int,
                    in p_valoracion10 int,in p_estado10 varchar(100),in p_ponderacion_deseable_minimo11 int,
                    in p_ponderacion_deseable_maximo11 int,in p_valoracion11 int,in p_estado11 varchar(100),
                    in p_ponderacion_deseable_minimo12 int,in p_ponderacion_deseable_maximo12 int,
                    in p_valoracion12 int,in p_estado12 varchar(100),in p_ponderacion_deseable_minimo13 int,
                    in p_ponderacion_deseable_maximo13 int,in p_valoracion13 int,in p_estado13 varchar(100),
                    in p_ponderacion_deseable_minimo14 int,in p_ponderacion_deseable_maximo14 int,
                    in p_valoracion14 int,in p_estado14 varchar(100),in p_ponderacion_deseable_minimo15 int,
                    in p_ponderacion_deseable_maximo15 int,in p_valoracion15 int,in p_estado15 varchar(100),
                    in p_ponderacion_deseable_minimo16 int,in p_ponderacion_deseable_maximo16 int,
                    in p_valoracion16 int,in p_estado16 varchar(100),in p_ponderacion_deseable_minimo17 int,
                    in p_ponderacion_deseable_maximo17 int,in p_valoracion17 int,in p_estado17 varchar(100),
                    in p_ponderacion_deseable_minimo18 int,in p_ponderacion_deseable_maximo18 int,
                    in p_valoracion18 int,in p_estado18 varchar(100),in p_ponderacion_deseable_minimo19 int,
                    in p_ponderacion_deseable_maximo19 int,in p_valoracion19 int,in p_estado19 varchar(100),
                    in p_ponderacion_deseable_minimo20 int,in p_ponderacion_deseable_maximo20 int,
                    in p_valoracion20 int,in p_estado20 varchar(100),in p_ponderacion_deseable_minimo21 int,
                    in p_ponderacion_deseable_maximo21 int,in p_valoracion21 int,in p_estado21 varchar(100),
                    in p_ponderacion_deseable_minimo22 int,in p_ponderacion_deseable_maximo22 int,
                    in p_valoracion22 int,in p_estado22 varchar(100),in p_ponderacion_deseable_minimo23 int,
                    in p_ponderacion_deseable_maximo23 int,in p_valoracion23 int,in p_estado23 varchar(100),
                    in p_ponderacion_deseable_minimo24 int,in p_ponderacion_deseable_maximo24 int,
                    in p_valoracion24 int,in p_estado24 varchar(100),in p_ponderacion_deseable_minimo25 int,
                    in p_ponderacion_deseable_maximo25 int,in p_valoracion25 int,in p_estado25 varchar(100),
                    in p_ponderacion_deseable_minimo26 int,in p_ponderacion_deseable_maximo26 int,
                    in p_valoracion26 int,in p_estado26 varchar(100),in p_ponderacion_deseable_minimo27 int,
                    in p_ponderacion_deseable_maximo27 int,in p_valoracion27 int,in p_estado27 varchar(100),
                    in p_ponderacion_deseable_minimo28 int,in p_ponderacion_deseable_maximo28 int,
                    in p_valoracion28 int,in p_estado28 varchar(100),in p_ponderacion_deseable_minimo29 int,
                    in p_ponderacion_deseable_maximo29 int,in p_valoracion29 int,in p_estado29 varchar(100),
                    in p_ponderacion_deseable_minimo30 int,in p_ponderacion_deseable_maximo30 int,
                    in p_valoracion30 int,in p_estado30 varchar(100),in p_ponderacion_deseable_minimo31 int,
                    in p_ponderacion_deseable_maximo31 int,in p_valoracion31 int,in p_estado31 varchar(100),
                    in p_ponderacion_deseable_minimo32 int,in p_ponderacion_deseable_maximo32 int,
                    in p_valoracion32 int,in p_estado32 varchar(100),in p_ponderacion_deseable_minimo33 int,
                    in p_ponderacion_deseable_maximo33 int,in p_valoracion33 int,in p_estado33 varchar(100),
                    in p_ponderacion_deseable_minimo34 int,in p_ponderacion_deseable_maximo34 int,
                    in p_valoracion34 int,in p_estado34 varchar(100),in p_ponderacion_deseable_minimo35 int,
                    in p_ponderacion_deseable_maximo35 int,in p_valoracion35 int,in p_estado35 varchar(100),
                    in p_nombre_tipo_caracteristica_deseable2 varchar(100), -- tipo de test
                    in p_nombre_caracteristica_deseable81 varchar(100),in p_nombre_caracteristica_deseable91 varchar(100),
                    in p_nombre_caracteristica_deseable101 varchar(100),in p_nombre_caracteristica_deseable111 varchar(100),
                    in p_nombre_caracteristica_deseable121 varchar(100),in p_nombre_caracteristica_deseable131 varchar(100),
                    in p_nombre_caracteristica_deseable141 varchar(100),
                    in p_ponderacion_deseable_minimo81 int,in p_ponderacion_deseable_maximo81 int,
                    in p_valoracion81 int,in p_estado81 varchar(100),in p_ponderacion_deseable_minimo82 int,
                    in p_ponderacion_deseable_maximo82 int,in p_valoracion82 int,in p_estado82 varchar(100),
                    in p_ponderacion_deseable_minimo83 int,in p_ponderacion_deseable_maximo83 int,
                    in p_valoracion83 int,in p_estado83 varchar(100),in p_ponderacion_deseable_minimo84 int,
                    in p_ponderacion_deseable_maximo84 int,in p_valoracion84 int,in p_estado84 varchar(100),
                    in p_ponderacion_deseable_minimo85 int,in p_ponderacion_deseable_maximo85 int,
                    in p_valoracion85 int,in p_estado85 varchar(100),in p_ponderacion_deseable_minimo91 int,
                    in p_ponderacion_deseable_maximo91 int,in p_valoracion91 int,in p_estado91 varchar(100),
                    in p_ponderacion_deseable_minimo92 int,in p_ponderacion_deseable_maximo92 int,
                    in p_valoracion92 int,in p_estado92 varchar(100),in p_ponderacion_deseable_minimo93 int,
                    in p_ponderacion_deseable_maximo93 int,in p_valoracion93 int,in p_estado93 varchar(100),
                    in p_ponderacion_deseable_minimo94 int,in p_ponderacion_deseable_maximo94 int,
                    in p_valoracion94 int,in p_estado94 varchar(100),
                    in p_ponderacion_deseable_minimo95 int,in p_ponderacion_deseable_maximo95 int,
                    in p_valoracion95 int,in p_estado95 varchar(100),
                    
                    in p_ponderacion_deseable_minimo101 int,
                    in p_ponderacion_deseable_maximo101 int,in p_valoracion101 int,in p_estado101 varchar(100),
                    in p_ponderacion_deseable_minimo102 int,in p_ponderacion_deseable_maximo102 int,
                    in p_valoracion102 int,in p_estado102 varchar(100),in p_ponderacion_deseable_minimo103 int,
                    in p_ponderacion_deseable_maximo103 int,in p_valoracion103 int,in p_estado103 varchar(100),
                    in p_ponderacion_deseable_minimo104 int,in p_ponderacion_deseable_maximo104 int,
                    in p_valoracion104 int,in p_estado104 varchar(100),in p_ponderacion_deseable_minimo105 int,
                    in p_ponderacion_deseable_maximo105 int,in p_valoracion105 int,in p_estado105 varchar(100),
                    
                    in p_ponderacion_deseable_minimo111 int,
                    in p_ponderacion_deseable_maximo111 int,in p_valoracion111 int,in p_estado111 varchar(100),
                    
                    in p_ponderacion_deseable_minimo112 int,in p_ponderacion_deseable_maximo112 int,
                    in p_valoracion112 int,in p_estado112 varchar(100),
                    
                    in p_ponderacion_deseable_minimo113 int,in p_ponderacion_deseable_maximo113 int,
                    in p_valoracion113 int,in p_estado113 varchar(100),
                    
                    in p_ponderacion_deseable_minimo114 int,in p_ponderacion_deseable_maximo114 int,
                    in p_valoracion114 int,in p_estado114 varchar(100),
                    
                    in p_ponderacion_deseable_minimo115 int,in p_ponderacion_deseable_maximo115 int,
                    in p_valoracion115 int,in p_estado115 varchar(100),
                    
                    in p_ponderacion_deseable_minimo121 int,
                    in p_ponderacion_deseable_maximo121 int,in p_valoracion121 int,in p_estado121 varchar(100),
                    in p_ponderacion_deseable_minimo122 int,in p_ponderacion_deseable_maximo122 int,
                    in p_valoracion122 int,in p_estado122 varchar(100),in p_ponderacion_deseable_minimo123 int,
                    in p_ponderacion_deseable_maximo123 int,in p_valoracion123 int,in p_estado123 varchar(100),
                    in p_ponderacion_deseable_minimo124 int,in p_ponderacion_deseable_maximo124 int,
                    in p_valoracion124 int,in p_estado124 varchar(100),in p_ponderacion_deseable_minimo125 int,
                    in p_ponderacion_deseable_maximo125 int,in p_valoracion125 int,in p_estado125 varchar(100),
                    in p_ponderacion_deseable_minimo131 int,in p_ponderacion_deseable_maximo131 int,
                    in p_valoracion131 int,in p_estado131 varchar(100),in p_ponderacion_deseable_minimo132 int,
                    in p_ponderacion_deseable_maximo132 int,in p_valoracion132 int,in p_estado132 varchar(100),
                    in p_ponderacion_deseable_minimo133 int,in p_ponderacion_deseable_maximo133 int,
                    in p_valoracion133 int,in p_estado133 varchar(100),in p_ponderacion_deseable_minimo134 int,
                    in p_ponderacion_deseable_maximo134 int,in p_valoracion134 int,in p_estado134 varchar(100),
                    in p_ponderacion_deseable_minimo135 int,in p_ponderacion_deseable_maximo135 int,
                    in p_valoracion135 int,in p_estado135 varchar(100),in p_ponderacion_deseable_minimo141 int,
                    in p_ponderacion_deseable_maximo141 int,in p_valoracion141 int,in p_estado141 varchar(100),
					in p_ponderacion_deseable_minimo142 int,in p_ponderacion_deseable_maximo142 int,
                    in p_valoracion142 int,in p_estado142 varchar(100),in p_ponderacion_deseable_minimo143 int,
                    in p_ponderacion_deseable_maximo143 int,in p_valoracion143 int,in p_estado143 varchar(100),
                    in p_ponderacion_deseable_minimo144 int,in p_ponderacion_deseable_maximo144 int,
                    in p_valoracion144 int,in p_estado144 varchar(100),in p_ponderacion_deseable_minimo145 int,
                    in p_ponderacion_deseable_maximo145 int,in p_valoracion145 int,in p_estado145 varchar(100),
                    in p_nombre_tipo_caracteristica_deseable3 varchar(100), -- tipo de test
                    in p_nombre_caracteristica_deseable151 varchar(100),in p_nombre_caracteristica_deseable161 varchar(100),
                    in p_nombre_caracteristica_deseable171 varchar(100),in p_nombre_caracteristica_deseable181 varchar(100),
                    in p_nombre_caracteristica_deseable191 varchar(100),in p_nombre_caracteristica_deseable201 varchar(100),
                    in p_nombre_caracteristica_deseable211 varchar(100),
                    in p_ponderacion_deseable_minimo151 int,in p_ponderacion_deseable_maximo151 int,
                    in p_valoracion151 int,in p_estado151 varchar(100),in p_ponderacion_deseable_minimo152 int,
                    in p_ponderacion_deseable_maximo152 int,in p_valoracion152 int,in p_estado152 varchar(100),
                    in p_ponderacion_deseable_minimo153 int,in p_ponderacion_deseable_maximo153 int,
                    in p_valoracion153 int,in p_estado153 varchar(100),in p_ponderacion_deseable_minimo154 int,
                    in p_ponderacion_deseable_maximo154 int,in p_valoracion154 int,in p_estado154 varchar(100),
                    in p_ponderacion_deseable_minimo155 int,in p_ponderacion_deseable_maximo155 int,
                    in p_valoracion155 int,in p_estado155 varchar(100),in p_ponderacion_deseable_minimo161 int,
                    in p_ponderacion_deseable_maximo161 int,in p_valoracion161 int,in p_estado161 varchar(100),
                    in p_ponderacion_deseable_minimo162 int,in p_ponderacion_deseable_maximo162 int,
                    in p_valoracion162 int,in p_estado162 varchar(100),in p_ponderacion_deseable_minimo163 int,
                    in p_ponderacion_deseable_maximo163 int,in p_valoracion163 int,in p_estado163 varchar(100),
                    in p_ponderacion_deseable_minimo164 int,in p_ponderacion_deseable_maximo164 int,
                    in p_valoracion164 int,in p_estado164 varchar(100),in p_ponderacion_deseable_minimo165 int,
                    in p_ponderacion_deseable_maximo165 int,in p_valoracion165 int,in p_estado165 varchar(100),
                    in p_ponderacion_deseable_minimo171 int,in p_ponderacion_deseable_maximo171 int,
                    in p_valoracion171 int,in p_estado171 varchar(100),in p_ponderacion_deseable_minimo172 int,
                    in p_ponderacion_deseable_maximo172 int,in p_valoracion172 int,in p_estado172 varchar(100),
                    in p_ponderacion_deseable_minimo173 int,in p_ponderacion_deseable_maximo173 int,
                    in p_valoracion173 int,in p_estado173 varchar(100),in p_ponderacion_deseable_minimo174 int,
                    in p_ponderacion_deseable_maximo174 int,in p_valoracion174 int,in p_estado174 varchar(100),
                    in p_ponderacion_deseable_minimo175 int,in p_ponderacion_deseable_maximo175 int,
                    in p_valoracion175 int,in p_estado175 varchar(100),in p_ponderacion_deseable_minimo181 int,
                    in p_ponderacion_deseable_maximo181 int,in p_valoracion181 int,in p_estado181 varchar(100),
                    in p_ponderacion_deseable_minimo182 int,in p_ponderacion_deseable_maximo182 int,
                    in p_valoracion182 int,in p_estado182 varchar(100),in p_ponderacion_deseable_minimo183 int,
                    in p_ponderacion_deseable_maximo183 int,in p_valoracion183 int,in p_estado183 varchar(100),
                    in p_ponderacion_deseable_minimo184 int,in p_ponderacion_deseable_maximo184 int,
                    in p_valoracion184 int,in p_estado184 varchar(100),in p_ponderacion_deseable_minimo185 int,
                    in p_ponderacion_deseable_maximo185 int,in p_valoracion185 int,in p_estado185 varchar(100),
                    in p_ponderacion_deseable_minimo191 int,in p_ponderacion_deseable_maximo191 int,
                    in p_valoracion191 int,in p_estado191 varchar(100),
                    in p_ponderacion_deseable_minimo192 int,in p_ponderacion_deseable_maximo192 int,
                    in p_valoracion192 int,in p_estado192 varchar(100),
                    in p_ponderacion_deseable_minimo193 int,in p_ponderacion_deseable_maximo193 int,
                    in p_valoracion193 int,in p_estado193 varchar(100),
                    in p_ponderacion_deseable_minimo194 int,in p_ponderacion_deseable_maximo194 int,
                    in p_valoracion194 int,in p_estado194 varchar(100),
                    in p_ponderacion_deseable_minimo195 int,in p_ponderacion_deseable_maximo195 int,
                    in p_valoracion195 int,in p_estado195 varchar(100),
                    in p_ponderacion_deseable_minimo201 int,
                    in p_ponderacion_deseable_maximo201 int,in p_valoracion201 int,in p_estado201 varchar(100),
                    in p_ponderacion_deseable_minimo202 int,in p_ponderacion_deseable_maximo202 int,
                    in p_valoracion202 int,in p_estado202 varchar(100),in p_ponderacion_deseable_minimo203 int,
                    in p_ponderacion_deseable_maximo203 int,in p_valoracion203 int,in p_estado203 varchar(100),
                    in p_ponderacion_deseable_minimo204 int,in p_ponderacion_deseable_maximo204 int,
                    in p_valoracion204 int,in p_estado204 varchar(100),in p_ponderacion_deseable_minimo205 int,
                    in p_ponderacion_deseable_maximo205 int,in p_valoracion205 int,in p_estado205 varchar(100),
                    in p_ponderacion_deseable_minimo211 int,in p_ponderacion_deseable_maximo211 int,
                    in p_valoracion211 int,in p_estado211 varchar(100),in p_ponderacion_deseable_minimo212 int,
                    in p_ponderacion_deseable_maximo212 int,in p_valoracion212 int,in p_estado212 varchar(100),
                    in p_ponderacion_deseable_minimo213 int,in p_ponderacion_deseable_maximo213 int,
                    in p_valoracion213 int,in p_estado213 varchar(100),in p_ponderacion_deseable_minimo214 int,
                    in p_ponderacion_deseable_maximo214 int,in p_valoracion214 int,in p_estado214 varchar(100),
                    in p_ponderacion_deseable_minimo215 int,in p_ponderacion_deseable_maximo215 int,
                    in p_valoracion215 int,in p_estado215 varchar(100)
                    )
begin

	DECLARE _puesto_laboral_id int;	
	-- DECLARE _formacion_deseable_id int;
	DECLARE _prueba1 int;
	DECLARE _prueba2 int;
	DECLARE _prueba3 int;
	DECLARE _prueba4 int;
	DECLARE _prueba5 int;
	DECLARE _prueba6 int;         
	DECLARE _prueba7 int;
    
    DECLARE _prueba8 int;
	DECLARE _prueba9 int;
	DECLARE _prueba10 int;
	DECLARE _prueba11 int;
	DECLARE _prueba12 int;
	DECLARE _prueba13 int;         
	DECLARE _prueba14 int;
    
    DECLARE _prueba15 int;
	DECLARE _prueba16 int;
	DECLARE _prueba17 int;
	DECLARE _prueba18 int;
	DECLARE _prueba19 int;
	DECLARE _prueba20 int;         
	DECLARE _prueba21 int;

 -- set _puesto_laboral_id = (select max(puesto_laboral_id) from puesto_laboral);
 select max(puesto_laboral_id) into _puesto_laboral_id from puesto_laboral;
 -- select formacion_deseable_id into _formacion_deseable_id from formacion_deseable where formacion_deseable_nombre = p_formacion_deseable_nombre;
-- set _formacion_deseable_id = (select formacion_deseable_id from formacion_deseable where formacion_deseable_nombre = p_formacion_deseable_nombre);
         
				-- insert into formacion_deseable (formacion_deseable_nombre)
                -- values(p_formacion_deseable_nombre);
                
                update puesto_laboral
                set formacion_deseable_id = p_formacion_deseable_id
                where puesto_laboral_id = _puesto_laboral_id;

		
					insert into experiencia_requerida 
												(
												experiencia_requerida,
												duracion,meses_anos,puesto_laboral_id
												)
					values(p_experiencia_requerida1,p_duracion1,p_meses_anos1,_puesto_laboral_id);
					insert into experiencia_requerida 
												(
												experiencia_requerida,
												duracion,meses_anos,puesto_laboral_id
												)
					values(p_experiencia_requerida2,p_duracion2,p_meses_anos2,_puesto_laboral_id);
					insert into experiencia_requerida 
												(
												experiencia_requerida,
												duracion,meses_anos,puesto_laboral_id
												)
					values(p_experiencia_requerida3,p_duracion3,p_meses_anos3,_puesto_laboral_id);
                    insert into experiencia_requerida 
												(
												experiencia_requerida,
												duracion,meses_anos,puesto_laboral_id
												)
					values(p_experiencia_requerida4,p_duracion4,p_meses_anos4,_puesto_laboral_id);
					insert into experiencia_requerida 
												(
												experiencia_requerida,
												duracion,meses_anos,puesto_laboral_id
												)
					values(p_experiencia_requerida5,p_duracion5,p_meses_anos5,_puesto_laboral_id);
                    insert into experiencia_requerida 
												(
												experiencia_requerida,
												duracion,meses_anos,puesto_laboral_id
												)
					values(p_experiencia_requerida6,p_duracion6,p_meses_anos6,_puesto_laboral_id); 
                    
                   
			if p_nombre_tipo_caracteristica_deseable1 = 'pE' then
                -- Titulo Test 1
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable1,1);
                        
select max(prueba_id) into _prueba1 from prueba;  
                        -- rango 1
                        
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo1,
                               p_ponderacion_deseable_maximo1,
                               _prueba1,_puesto_laboral_id,
                               p_valoracion1,p_estado1);    
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo2,
                               p_ponderacion_deseable_maximo2,
                               _prueba1,_puesto_laboral_id,
                               p_valoracion2,p_estado2);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo3,
                               p_ponderacion_deseable_maximo3,
                               _prueba1,_puesto_laboral_id,
                               p_valoracion3,p_estado3);    
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo4,
                               p_ponderacion_deseable_maximo4,
                               _prueba1,_puesto_laboral_id,
                               p_valoracion4,p_estado4);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo5,
                               p_ponderacion_deseable_maximo5,
                               _prueba1,_puesto_laboral_id,
                               p_valoracion5,p_estado5);
                               
                               -- Titulo Test 2
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable2,1);
                        
select max(prueba_id) into _prueba2 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo6,
                               p_ponderacion_deseable_maximo6,
                               _prueba2,_puesto_laboral_id,
                               p_valoracion6,p_estado6);    
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo7,
                               p_ponderacion_deseable_maximo7,
                               _prueba2,_puesto_laboral_id,
                               p_valoracion7,p_estado7);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo8,
                               p_ponderacion_deseable_maximo8,
                               _prueba2,_puesto_laboral_id,
                               p_valoracion8,p_estado8);    
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo9,
                               p_ponderacion_deseable_maximo9,
                               _prueba2,_puesto_laboral_id,
                               p_valoracion9,p_estado9);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo10,
                               p_ponderacion_deseable_maximo10,
                               _prueba2,_puesto_laboral_id,
                               p_valoracion10,p_estado10);
                               -- Titulo Test 3
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable3,1);
                        
select max(prueba_id) into _prueba3 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo11,
                               p_ponderacion_deseable_maximo11,
                               _prueba3,_puesto_laboral_id,
                               p_valoracion11,p_estado11);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo12,
                               p_ponderacion_deseable_maximo12,
                               _prueba3,_puesto_laboral_id,
                               p_valoracion12,p_estado12);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo13,
                               p_ponderacion_deseable_maximo13,
                               _prueba3,_puesto_laboral_id,
                               p_valoracion13,p_estado13);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo14,
                               p_ponderacion_deseable_maximo14,
                               _prueba3,_puesto_laboral_id,
                               p_valoracion14,p_estado14);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo15,
                               p_ponderacion_deseable_maximo15,
                               _prueba3,_puesto_laboral_id,
                               p_valoracion15,p_estado15);
                               
                                -- Titulo Test 4
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable4,1);
                        
select max(prueba_id) into _prueba4 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo16,
                               p_ponderacion_deseable_maximo16,
                               _prueba4,_puesto_laboral_id,
                               p_valoracion16,p_estado16);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo17,
                               p_ponderacion_deseable_maximo17,
                               _prueba4,_puesto_laboral_id,
                               p_valoracion17,p_estado17);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo18,
                               p_ponderacion_deseable_maximo18,
                               _prueba4,_puesto_laboral_id,
                               p_valoracion18,p_estado18);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo19,
                               p_ponderacion_deseable_maximo19,
                               _prueba4,_puesto_laboral_id,
                               p_valoracion19,p_estado19);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo20,
                               p_ponderacion_deseable_maximo20,
                               _prueba4,_puesto_laboral_id,
                               p_valoracion20,p_estado20);       
                -- Titulo Test 5
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable5,1);
                        
select max(prueba_id) into _prueba5 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo21,
                               p_ponderacion_deseable_maximo21,
                               _prueba5,_puesto_laboral_id,
                               p_valoracion21,p_estado21);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo22,
                               p_ponderacion_deseable_maximo22,
                               _prueba5,_puesto_laboral_id,
                               p_valoracion22,p_estado22);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo23,
                               p_ponderacion_deseable_maximo23,
                               _prueba5,_puesto_laboral_id,
                               p_valoracion23,p_estado23);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo24,
                               p_ponderacion_deseable_maximo24,
                               _prueba5,_puesto_laboral_id,
                               p_valoracion24,p_estado24);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo25,
                               p_ponderacion_deseable_maximo25,
                               _prueba5,_puesto_laboral_id,
                               p_valoracion25,p_estado25);
                -- titulo test 6         
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable6,1);
                        
select max(prueba_id) into _prueba6 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo26,
                               p_ponderacion_deseable_maximo26,
                               _prueba6,_puesto_laboral_id,
                               p_valoracion26,p_estado26);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo27,
                               p_ponderacion_deseable_maximo27,
                               _prueba6,_puesto_laboral_id,
                               p_valoracion27,p_estado27);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo28,
                               p_ponderacion_deseable_maximo28,
                               _prueba6,_puesto_laboral_id,
                               p_valoracion28,p_estado28);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo29,
                               p_ponderacion_deseable_maximo29,
                               _prueba6,_puesto_laboral_id,
                               p_valoracion29,p_estado29);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo30,
                               p_ponderacion_deseable_maximo30,
                               _prueba6,_puesto_laboral_id,
                               p_valoracion30,p_estado30);  
               -- titulo test 7         
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable7,1);
                        
select max(prueba_id) into _prueba7 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo31,
                               p_ponderacion_deseable_maximo31,
                               _prueba7,_puesto_laboral_id,
                               p_valoracion31,p_estado31);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo32,
                               p_ponderacion_deseable_maximo32,
                               _prueba7,_puesto_laboral_id,
                               p_valoracion32,p_estado32);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo33,
                               p_ponderacion_deseable_maximo33,
                               _prueba7,_puesto_laboral_id,
                               p_valoracion33,p_estado33);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo34,
                               p_ponderacion_deseable_maximo34,
                               _prueba7,_puesto_laboral_id,
                               p_valoracion34,p_estado34);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo35,
                               p_ponderacion_deseable_maximo35,
                               _prueba7,_puesto_laboral_id,
                               p_valoracion35,p_estado35);        
                end if;               
                                 
                               
                if p_nombre_tipo_caracteristica_deseable2 = 'pPP' then
                -- Titulo Test 1
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable81,2);
                        
select max(prueba_id) into _prueba8 from prueba;  
                        -- rango 1
                        
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo81,
                               p_ponderacion_deseable_maximo81,
                               _prueba8,_puesto_laboral_id,
                               p_valoracion81,p_estado81);    
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo82,
                               p_ponderacion_deseable_maximo82,
                               _prueba8,_puesto_laboral_id,
                               p_valoracion82,p_estado82);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo83,
                               p_ponderacion_deseable_maximo83,
                               _prueba8,_puesto_laboral_id,
                               p_valoracion83,p_estado83);    
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo84,
                               p_ponderacion_deseable_maximo84,
                               _prueba8,_puesto_laboral_id,
                               p_valoracion84,p_estado84);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo85,
                               p_ponderacion_deseable_maximo85,
                               _prueba8,_puesto_laboral_id,
                               p_valoracion85,p_estado85);
                               
                               -- Titulo Test 2
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable91,2);
                        
select max(prueba_id) into _prueba9 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo91,
                               p_ponderacion_deseable_maximo91,
                               _prueba9,_puesto_laboral_id,
                               p_valoracion91,p_estado91);    
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo92,
                               p_ponderacion_deseable_maximo92,
                               _prueba9,_puesto_laboral_id,
                               p_valoracion91,p_estado92);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo93,
                               p_ponderacion_deseable_maximo93,
                               _prueba9,_puesto_laboral_id,
                               p_valoracion93,p_estado93);    
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo94,
                               p_ponderacion_deseable_maximo94,
                               _prueba9,_puesto_laboral_id,
                               p_valoracion94,p_estado94);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo95,
                               p_ponderacion_deseable_maximo95,
                               _prueba9,_puesto_laboral_id,
                               p_valoracion95,p_estado95);
                               -- Titulo Test 3
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable101,2);
                        
select max(prueba_id) into _prueba10 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo101,
                               p_ponderacion_deseable_maximo101,
                               _prueba10,_puesto_laboral_id,
                               p_valoracion101,p_estado101);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo102,
                               p_ponderacion_deseable_maximo102,
                               _prueba10,_puesto_laboral_id,
                               p_valoracion102,p_estado102);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo103,
                               p_ponderacion_deseable_maximo103,
                               _prueba10,_puesto_laboral_id,
                               p_valoracion103,p_estado103);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo104,
                               p_ponderacion_deseable_maximo104,
                               _prueba10,_puesto_laboral_id,
                               p_valoracion104,p_estado104);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo105,
                               p_ponderacion_deseable_maximo105,
                               _prueba10,_puesto_laboral_id,
                               p_valoracion105,p_estado105);
                               
                                -- Titulo Test 4
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable111,2);
                        
select max(prueba_id) into _prueba11 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo111,
                               p_ponderacion_deseable_maximo111,
                               _prueba11,_puesto_laboral_id,
                               p_valoracion16,p_estado111);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo112,
                               p_ponderacion_deseable_maximo112,
                               _prueba11,_puesto_laboral_id,
                               p_valoracion112,p_estado112);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo113,
                               p_ponderacion_deseable_maximo113,
                               _prueba11,_puesto_laboral_id,
                               p_valoracion113,p_estado113);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo114,
                               p_ponderacion_deseable_maximo114,
                               _prueba11,_puesto_laboral_id,
                               p_valoracion114,p_estado114);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo115,
                               p_ponderacion_deseable_maximo115,
                               _prueba11,_puesto_laboral_id,
                               p_valoracion115,p_estado115);       
                -- Titulo Test 5
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable121,2);
                        
select max(prueba_id) into _prueba12 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo121,
                               p_ponderacion_deseable_maximo121,
                               _prueba12,_puesto_laboral_id,
                               p_valoracion121,p_estado121);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo122,
                               p_ponderacion_deseable_maximo122,
                               _prueba12,_puesto_laboral_id,
                               p_valoracion122,p_estado122);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo123,
                               p_ponderacion_deseable_maximo123,
                               _prueba12,_puesto_laboral_id,
                               p_valoracion123,p_estado123);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo124,
                               p_ponderacion_deseable_maximo124,
                               _prueba12,_puesto_laboral_id,
                               p_valoracion124,p_estado124);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo125,
                               p_ponderacion_deseable_maximo125,
                               _prueba12,_puesto_laboral_id,
                               p_valoracion125,p_estado125); 
                -- titulo test 6         
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable131,2);
                        
select max(prueba_id) into _prueba13 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo131,
                               p_ponderacion_deseable_maximo131,
                               _prueba13,_puesto_laboral_id,
                               p_valoracion131,p_estado131);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo132,
                               p_ponderacion_deseable_maximo132,
                               _prueba13,_puesto_laboral_id,
                               p_valoracion132,p_estado132);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo133,
                               p_ponderacion_deseable_maximo133,
                               _prueba13,_puesto_laboral_id,
                               p_valoracion133,p_estado133);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo134,
                               p_ponderacion_deseable_maximo134,
                               _prueba13,_puesto_laboral_id,
                               p_valoracion134,p_estado134);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo135,
                               p_ponderacion_deseable_maximo135,
                               _prueba13,_puesto_laboral_id,
                               p_valoracion135,p_estado135);  
               -- titulo test 7         
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable141,2);
                        
select max(prueba_id) into _prueba14 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo141,
                               p_ponderacion_deseable_maximo141,
                               _prueba14,_puesto_laboral_id,
                               p_valoracion141,p_estado141);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo142,
                               p_ponderacion_deseable_maximo142,
                               _prueba14,_puesto_laboral_id,
                               p_valoracion142,p_estado142);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo143,
                               p_ponderacion_deseable_maximo143,
                               _prueba14,_puesto_laboral_id,
                               p_valoracion143,p_estado143);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo144,
                               p_ponderacion_deseable_maximo144,
                               _prueba14,_puesto_laboral_id,
                               p_valoracion144,p_estado144);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo145,
                               p_ponderacion_deseable_maximo145,
                               _prueba14,_puesto_laboral_id,
                               p_valoracion145,p_estado145);
                               
                end if; 
                                         
                               
                if p_nombre_tipo_caracteristica_deseable3 = 'pC' then
                -- Titulo Test 1
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable151,3);
                        
select max(prueba_id) into _prueba15 from prueba;  
                        -- rango 1
                        
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo151,
                               p_ponderacion_deseable_maximo151,
                               _prueba15,_puesto_laboral_id,
                               p_valoracion151,p_estado151);    
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo152,
                               p_ponderacion_deseable_maximo152,
                               _prueba15,_puesto_laboral_id,
                               p_valoracion152,p_estado152);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo153,
                               p_ponderacion_deseable_maximo153,
                               _prueba15,_puesto_laboral_id,
                               p_valoracion153,p_estado153);    
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo154,
                               p_ponderacion_deseable_maximo154,
                               _prueba15,_puesto_laboral_id,
                               p_valoracion154,p_estado154);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo155,
                               p_ponderacion_deseable_maximo155,
                               _prueba15,_puesto_laboral_id,
                               p_valoracion155,p_estado155);
                               
                               -- Titulo Test 2
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable161,3);
                        
select max(prueba_id) into _prueba16 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo161,
                               p_ponderacion_deseable_maximo161,
                               _prueba16,_puesto_laboral_id,
                               p_valoracion161,p_estado161);    
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo162,
                               p_ponderacion_deseable_maximo162,
                               _prueba16,_puesto_laboral_id,
                               p_valoracion162,p_estado162);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo163,
                               p_ponderacion_deseable_maximo163,
                               _prueba16,_puesto_laboral_id,
                               p_valoracion163,p_estado163);    
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo164,
                               p_ponderacion_deseable_maximo164,
                               _prueba16,_puesto_laboral_id,
                               p_valoracion164,p_estado164);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo165,
                               p_ponderacion_deseable_maximo165,
                               _prueba16,_puesto_laboral_id,
                               p_valoracion165,p_estado165);
                               -- Titulo Test 3
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable171,3);
                        
select max(prueba_id) into _prueba17 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo171,
                               p_ponderacion_deseable_maximo171,
                               _prueba17,_puesto_laboral_id,
                               p_valoracion171,p_estado171);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo172,
                               p_ponderacion_deseable_maximo172,
                               _prueba17,_puesto_laboral_id,
                               p_valoracion172,p_estado172);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo173,
                               p_ponderacion_deseable_maximo173,
                               _prueba17,_puesto_laboral_id,
                               p_valoracion173,p_estado173);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo174,
                               p_ponderacion_deseable_maximo174,
                               _prueba17,_puesto_laboral_id,
                               p_valoracion174,p_estado174);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo175,
                               p_ponderacion_deseable_maximo175,
                               _prueba17,_puesto_laboral_id,
                               p_valoracion175,p_estado175);
                               
                                -- Titulo Test 4
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable181,3);
                        
select max(prueba_id) into _prueba18 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo181,
                               p_ponderacion_deseable_maximo181,
                               _prueba18,_puesto_laboral_id,
                               p_valoracion181,p_estado181);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo182,
                               p_ponderacion_deseable_maximo182,
                               _prueba18,_puesto_laboral_id,
                               p_valoracion182,p_estado182);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo183,
                               p_ponderacion_deseable_maximo183,
                               _prueba18,_puesto_laboral_id,
                               p_valoracion183,p_estado183);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo184,
                               p_ponderacion_deseable_maximo184,
                               _prueba18,_puesto_laboral_id,
                               p_valoracion184,p_estado184);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo185,
                               p_ponderacion_deseable_maximo185,
                               _prueba18,_puesto_laboral_id,
                               p_valoracion185,p_estado185);       
                -- Titulo Test 5
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable191,3);
                        
select max(prueba_id) into _prueba19 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo191,
                               p_ponderacion_deseable_maximo191,
                               _prueba19,_puesto_laboral_id,
                               p_valoracion191,p_estado191);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo192,
                               p_ponderacion_deseable_maximo192,
                               _prueba19,_puesto_laboral_id,
                               p_valoracion192,p_estado192);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo193,
                               p_ponderacion_deseable_maximo193,
                               _prueba19,_puesto_laboral_id,
                               p_valoracion193,p_estado193);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo194,
                               p_ponderacion_deseable_maximo194,
                               _prueba19,_puesto_laboral_id,
                               p_valoracion194,p_estado194);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo195,
                               p_ponderacion_deseable_maximo195,
                               _prueba19,_puesto_laboral_id,
                               p_valoracion195,p_estado195); 
                -- titulo test 6         
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable201,3);
                        
select max(prueba_id) into _prueba20 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo201,
                               p_ponderacion_deseable_maximo201,
                               _prueba20,_puesto_laboral_id,
                               p_valoracion201,p_estado201);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo202,
                               p_ponderacion_deseable_maximo202,
                               _prueba20,_puesto_laboral_id,
                               p_valoracion202,p_estado202);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo203,
                               p_ponderacion_deseable_maximo203,
                               _prueba20,_puesto_laboral_id,
                               p_valoracion203,p_estado203);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo204,
                               p_ponderacion_deseable_maximo204,
                               _prueba20,_puesto_laboral_id,
                               p_valoracion204,p_estado204);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo205,
                               p_ponderacion_deseable_maximo205,
                               _prueba20,_puesto_laboral_id,
                               p_valoracion205,p_estado205);  
               -- titulo test 7         
                        insert into prueba(nombre_prueba, tipo_prueba_id)
                        values(p_nombre_caracteristica_deseable211,3);
                        
select max(prueba_id) into _prueba21 from prueba;  
                        -- rango 1
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo211,
                               p_ponderacion_deseable_maximo211,
                               _prueba21,_puesto_laboral_id,
                               p_valoracion211,p_estado211);  
                       -- rango 2
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo212,
                               p_ponderacion_deseable_maximo212,
                               _prueba21,_puesto_laboral_id,
                               p_valoracion212,p_estado212);
                       -- rango 3
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo213,
                               p_ponderacion_deseable_maximo213,
                               _prueba21,_puesto_laboral_id,
                               p_valoracion213,p_estado213);  
                       -- rango 4
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo214,
                               p_ponderacion_deseable_maximo214,
                               _prueba21,_puesto_laboral_id,
                               p_valoracion214,p_estado214);
                        -- rango 5
                        insert into ponderacion_deseable
                                            (
                                            ponderacion_deseable_minimo,
                                            ponderacion_deseable_maximo,
                                            prueba_id,puesto_laboral_id,
                                            valoracion,estado)
                        values(p_ponderacion_deseable_minimo215,
                               p_ponderacion_deseable_maximo215,
                               _prueba21,_puesto_laboral_id,
                               p_valoracion215,p_estado215); 
        end if;
       

 end$$;
 
drop procedure fn_registrarPerfil;

select * from puesto_laboral;
select * from ponderacion_deseable;
select * from prueba;
select * from experiencia_requerida;

update puesto_laboral
set formacion_Deseable_id = null
where puesto_laboral_id = 1;

truncate experiencia_requerida;
truncate ponderacion_deseable;

delete from prueba
where prueba_id>=1;

call fn_registrarPerfil
					(
					5,
                    'En Control de calidad del medio ambiente',
                    1,'Año(s)',
                   'En diseño de puentes',
                    1,'Año(s)',
                    'En diseño de sillas',
                    2,'Año(s)',
                    'En diseño de pistas',
                    1,'Año(s)',
                    'En diseño de veredas',
                    1,'Año(s)',
                    'En diseño de torres',
                    1,'Año(s)',
                    'pE', -- tipo de test
                    'Test especifica 1',
                    'Test especifica 2',
                    'Test especifica 3',
                    'Test especifica 4',
                    'Test especifica 5',
                    'Test especifica 6',
                    'Test especifica 7',
                    -- prueba 1
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 2
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 3
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 4
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 5
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 6
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 7
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    'pPP', -- tipo de test
                    'Test de practica profesional 1',
                    'Test de practica profesional 2',
                    'Test de practica profesional 3',
                    'Test de practica profesional 4',
                    'Test de practica profesional 5',
                    'Test de practica profesional 6',
                    'Test de practica profesional 7',
                    
                    -- prueba 1
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 2
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 3
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 4
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 5
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 6
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 7
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    'pC', -- tipo de test
                    'Test de practica profesional 1',
                    'Test de practica profesional 2',
                    'Test de practica profesional 3',
                    'Test de practica profesional 4',
                    'Test de practica profesional 5',
                    'Test de practica profesional 6',
                    'Test de practica profesional 7',
                    -- prueba 1
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 2
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 3
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 4
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 5
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 6
                    0,
                    5,
                    1,
                    'No',
                    6,
                    11,
                    2,
                    'No',
                    12,
                    16,
                    3,
                    'No',
                    17,
                    25,
                    4,
                    'No',
                    26,
                    35,
                    5,
                    'Si',
                    -- prueba 7
                    null,
                    null,
                    null,
                    null
                    null,
                    null,
                    null,
                    null
                    null,
                    null,
                    null,
                    null
                    null,
                    null,
                    null,
                    null
                    null,
                    null,
                    null,
                    null
                    );
              */
  
 
 -- ---------------------------------------------------------------------
 
 
 
 
 select 
	* 
 from 
	experiencia_requerida e inner join puesto_laboral u
 on
	( e.puesto_laboral_id = u.puesto_laboral_id );
select * from prueba;
select * from experiencia_requerida;
 
 
 
 
 
 
 
 
 
 
 
 /*
  
insert into tipo_caracteristica_Deseable(nombre_tipo_caracteristica_Deseable)
values('Prueba Específica');
insert into tipo_caracteristica_Deseable(nombre_tipo_caracteristica_Deseable)
values('Prueba de Prácticas Profesionales');
insert into tipo_caracteristica_Deseable(nombre_tipo_caracteristica_Deseable)
values('Prueba de Conocimiento');

select* from etapa;

insert into formacion_deseable(formacion_deseable_nombre)
values('Abogado especialista en constructoras');
insert into formacion_deseable(formacion_deseable_nombre)
values('Administrador');
insert into formacion_deseable(formacion_deseable_nombre)
values('Arquitecto especializado en diseños de puentes');
insert into formacion_deseable(formacion_deseable_nombre)
values('Arquitecto especializado en diseño de casas');
insert into formacion_deseable(formacion_deseable_nombre)
values('Arquitecto especializado en diseño de interiores');
insert into formacion_deseable(formacion_deseable_nombre)
values('Asistente de costo y presupuesto');
insert into formacion_deseable(formacion_deseable_nombre)
values('Asistente de logística');
insert into formacion_deseable(formacion_deseable_nombre)
values('Consulta y atención de reclamos');
insert into formacion_deseable(formacion_deseable_nombre)
values('Contador');
insert into formacion_deseable(formacion_deseable_nombre)
values('Ingeniero civil especialista en cálidad');
insert into formacion_deseable(formacion_deseable_nombre)
values('Ingeniero civil especialista en carreteras');
insert into formacion_deseable(formacion_deseable_nombre)
values('Ingeniero civil especialista en estudios de suelos');
insert into formacion_deseable(formacion_deseable_nombre)
values('Ingeniero civil especialista en medio ambiente');
insert into formacion_deseable(formacion_deseable_nombre)
values('Ingeniero civil especialista en puentes');
insert into formacion_deseable(formacion_deseable_nombre)
values('Ingeniero civil especialista en supervición de obras');
insert into formacion_deseable(formacion_deseable_nombre)
values('Ingeniero de software');
insert into formacion_deseable(formacion_deseable_nombre)
values('Ingeniero especialista en estructuras');
insert into formacion_deseable(formacion_deseable_nombre)
values('Ingeniero hidráulico');
insert into formacion_deseable(formacion_deseable_nombre)
values('Jefe de Logística');
insert into formacion_deseable(formacion_deseable_nombre)
values('Jefe de obra');
insert into formacion_deseable(formacion_deseable_nombre)
values('Jefe de proyectos');
insert into formacion_deseable(formacion_deseable_nombre)
values('Jefe de proyectos de software');
insert into formacion_deseable(formacion_deseable_nombre)
values('Obrero constructor');
insert into formacion_deseable(formacion_deseable_nombre)
values('Obrero mesclador de cemento');
insert into formacion_deseable(formacion_deseable_nombre)
values('Prácticante de ingeniería civil');
insert into formacion_deseable(formacion_deseable_nombre)
values('Prácticante de ingeniería de software');
insert into formacion_deseable(formacion_deseable_nombre)
values('prácticante programador android');
insert into formacion_deseable(formacion_deseable_nombre)
values('prácticante programador de escritorio');
insert into formacion_deseable(formacion_deseable_nombre)
values('prácticante programador web');
insert into formacion_deseable(formacion_deseable_nombre)
values('Programador android');
insert into formacion_deseable(formacion_deseable_nombre)
values('Programador de escritorio');
insert into formacion_deseable(formacion_deseable_nombre)
values('Programador web');
insert into formacion_deseable(formacion_deseable_nombre)
values('secretaria');
insert into formacion_deseable(formacion_deseable_nombre)
values('Técnico en mantenimiento y reparaciones de pcs');
insert into formacion_deseable(formacion_deseable_nombre)
values('Técnico en maquinarías de construcción');
insert into formacion_deseable(formacion_deseable_nombre)
values('Técnico hidráulico');
insert into formacion_deseable(formacion_deseable_nombre)
values('Topógrafo');

select* from formacion_deseable

delete from formacion_deseable
where formacion_deseable_id > 0;

update puesto_laboral
set formacion_deseable_id = null
where puesto_laboral_id >= 11
truncate formacion_deseable

*/
-- -------------------------------------------------------------------------------------------------------
-- REGISTRAR CONVOCATORIA, ETAPA Y CRONOGRAMA

delimiter $$;
create procedure fn_registrarConvocatoria
										(
                                       in p_nombre_convocatoria varchar(200), 
                                       in p_etapa1 varchar(100),
                                       in p_fecha_cronograma1 varchar(100),
                                       in p_etapa2 varchar(100),
                                       in p_fecha_cronograma2 varchar(100),
                                       in p_etapa3 varchar(100),
                                       in p_fecha_cronograma3 varchar(100),
                                       in p_etapa4 varchar(100),
                                       in p_fecha_cronograma4 varchar(100),
                                       in p_etapa5 varchar(100),
                                       in p_fecha_cronograma5 varchar(100)
                                        )

begin
	-- DECLARE _puesto_laboral_id int;
    DECLARE _convocatoria_id int;
	-- set _puesto_laboral_id = (select max(puesto_laboral_id) from puesto_laboral);
    
-- ------------------------------------------------------------------------									
					insert into convocatoria(nombre_convocatoria, estado)
                    values(p_nombre_convocatoria,'NP');
    set _convocatoria_id = (select max(convocatoria_id) from convocatoria);                
    
					-- update puesto_laboral
                    -- set convocatoria_id = _convocatoria_id
                    -- where puesto_laboral_id = _puesto_laboral_id;
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma1,_convocatoria_id,p_etapa1);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma2,_convocatoria_id,p_etapa2);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma3,_convocatoria_id,p_etapa3);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma4,_convocatoria_id,p_etapa4);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values(p_fecha_cronograma5,_convocatoria_id,p_etapa5);
end$$;

drop procedure fn_registrarConvocatoria;

select * from convocatoria;
select * from puesto_laboral;
select * from cronograma;
select * from convocatoria;
select * from tipo_prueba;

call fn_registrarConvocatoria
							(
                            'PIP Chiclayo',
                            1,
							'01/01/2010',
							2,
							'04/01/2010',
                            3,
							'05/01/2010',
                            4,
							'06/01/2010',
                            5,
							'07/01/2010'
                            );
		

delimiter $$;
create procedure fn_actualzizarConvocatoria
										(
                                       in p_nombre_convocatoria varchar(200), 
                                       in p_fecha_cronograma1 varchar(100),
                                       in p_fecha_cronograma2 varchar(100),
                                       in p_fecha_cronograma3 varchar(100),
                                       in p_fecha_cronograma4 varchar(100),
                                       in p_fecha_cronograma5 varchar(100)
                                        )

begin
	
    DECLARE _convocatoria_id int;
	set _convocatoria_id = (select count(*) from convocatoria);
    
-- ------------------------------------------------------------------------									
					update convocatoria
                    set nombre_convocatoria = p_nombre_convocatoria
                    where convocatoria_id = _convocatoria_id;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma1
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 1;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma2
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 2;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma3
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 3;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma4
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 4;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma5
                    where convocatoria_id = _convocatoria_id and 
						  etapa_id = 5;
end$$;



delimiter $$;
create procedure fn_actualizarConvocatoria2
										(
                                       in p_convocatoria_id int,
                                       in p_estado varchar(100), 
                                       in p_nombre_convocatoria varchar(200), 
                                       in p_fecha_cronograma1 varchar(100),
                                       in p_fecha_cronograma2 varchar(100),
                                       in p_fecha_cronograma3 varchar(100),
                                       in p_fecha_cronograma4 varchar(100),
                                       in p_fecha_cronograma5 varchar(100)
                                        )

begin
							
 
    
-- ------------------------------------------------------------------------									
					update convocatoria
                    set nombre_convocatoria = p_nombre_convocatoria,
                    estado = p_estado
                    where convocatoria_id = p_convocatoria_id;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma1
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 1;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma2
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 2;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma3
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 3;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma4
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 4;
                    
                    update cronograma
                    set fecha_cronograma = p_fecha_cronograma5
                    where convocatoria_id = p_convocatoria_id and 
						  etapa_id = 5;
end$$;

drop procedure fn_actualizarConvocatoria2;

call fn_actualizarConvocatoria2(11,'SP','PIP Jaen','01/01/2010','04/01/2010','05/01/2010','06/01/2010','07/01/2010');










				select 
					c.nombre_convocatoria,
					c.estado,
					r.fecha_cronograma,
					e.nombre_etapa
				from 
					convocatoria c inner join cronograma r on
					c.convocatoria_id = r.convocatoria_id inner join etapa e on
					e.etapa_id = r.etapa_id
				where
					c.convocatoria_id = (select count(*) from convocatoria);

select * from convocatoria;
select * from cronograma where convocatoria_id = (select count(*) from convocatoria) and etapa_id =1;

update convocatoria
set nombre_convocatoria = 'PIP Cajamarca'
where convocatoria_id = 8;

select nombre_convocatoria from convocatoria where convocatoria_id = (select count(*) from convocatoria) and etapa_id =1

				select 
                    c.nombre_convocatoria,
                    c.estado,
                    r.fecha_cronograma,
                    e.nombre_etapa,
                    e.etapa_id
                from 
                    convocatoria c inner join cronograma r on
                    c.convocatoria_id = r.convocatoria_id inner join etapa e on
                    e.etapa_id = r.etapa_id
                where
                    c.convocatoria_id = (select count(*) from convocatoria) and r.etapa_id = 1
                    
    
    insert into prueba(nombre_prueba,instruccion,tipo_prueba_id)
    values('Test de aptitud verbal','bla bla bla bla bla',1);
    insert into prueba(nombre_prueba,instruccion,tipo_prueba_id)
    values('Test de fluidez verbal','bla bla bla bla bla',1);
    
    
                    select
					    u.nombre_puesto,
                        p.nombre_prueba,
                        p.estado
		from
			prueba p inner join ponderacion_deseable o on
                        p.prueba_id = o.prueba_id inner join puesto_laboral u on
                        u.puesto_laboral_id = o.puesto_laboral_id
                where
			o.puesto_laboral_id = (select count(*) from puesto_laboral);
            
select* from prueba

update ponderacion_deseable
set  = 0,
 = 5,
 = 1,
 = 12,
 = ,
 = 1;tipo_prueba
drop 
insert into ponderacion_deseable (ponderacion_deseable_minimo,ponderacion_deseable_maximo,prueba_id,
									puesto_laboral_id,estado,valoracion)
values(0,5,1,12,'No aceptado',1);
insert into ponderacion_deseable (ponderacion_deseable_minimo,ponderacion_deseable_maximo,prueba_id,
									puesto_laboral_id,estado,valoracion)
values(6,12,2,12,'No aceptado',2);





select* from departamento
select* from convocatoria


select 
                    p.puesto_laboral_id,
                    p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo,
                    d.departamento_id,
                    d.departamento_nombre
                from puesto_laboral p inner join departamento d on
                    p.departamento_id = d.departamento_id
                    where puesto_laboral_id = (select max(puesto_laboral_id) from puesto_laboral);
                    
                    delete from convocatoria
                    where convocatoria_id >=0;
                    
                    delete from puesto_laboral
                    where puesto_laboral_id >=0
                    
                    
                    select* from puesto_laboral;
                    where puesto_laboral_id = (select max(puesto_laboral_id) from puesto_laboral);
                    select* from cronograma
                    
                    
                    
                    
            select 
                    p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    d.departamento_id,
                    d.departamento_nombre
                from puesto_laboral p inner join departamento d on
                    p.departamento_id = d.departamento_id
                    where puesto_laboral_id = (select max(puesto_laboral_id) from puesto_laboral);
                    
                    
                    
                   update Puesto_laboral
                   set
						estado= 'Registrado'
				   where 
						Puesto_laboral_id= 1;
                        
                         update convocatoria
                   set
						nombre_convocatoria= 'PIP Puno'
				   where 
						convocatoria_id= 4;
                    
                    
                   select 
                    *
                from 
                    convocatoria 
                    where nombre_convocatoria = 'P';
                    
                    
                    
                    select* from puesto_laboral
                    
                    
                    
                    
                    
                 select 
                    p.puesto_laboral_id,
                    p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo,
                    d.departamento_id,
                    d.departamento_nombre,
                    c.convocatoria_id,
                    c.nombre_convocatoria
                from puesto_laboral p inner join departamento d on
                    p.departamento_id = d.departamento_id inner join convocatoria c
		on (p.convocatoria_id = c.convocatoria_id)
                    where puesto_laboral_id = (select max(puesto_laboral_id) from puesto_laboral);
                    
                    
                    
			select 
					c.convocatoria_id,
                    c.nombre_convocatoria
                 
                from 
                    convocatoria c inner join puesto_laboral p
                 on c.convocatoria_id    = p.convocatoria_id
				where c.estado = 'NP' and P.puesto_laboral_id = 3
				order by 2
                
                    
         select 
					convocatoria_id,
                    nombre_convocatoria
                 
                from 
                    convocatoria 
				where estado = 'NP'
				order by 2;            
        
        
        
                select 
					*
                 
                from 
                    usuario 
				where estado = 'NP'
				order by 2;
                
               
          delete from convocatoria
	where convocatoria_id =4
    
    
          select 
                    c.convocatoria_id,
                    c.nombre_convocatoria
                from 
                    convocatoria c inner join puesto_laboral p
                    on c.convocatoria_id    = p.convocatoria_id
                where 
                    c.estado = 'NP' and 
                    p.puesto_laboral_id = 
                    (select max(puesto_laboral_id) from puesto_laboral)
                
             select 
					*                   
                from 
                    puesto_laboral  
				where 
                    estado = 'NP'
				order by 2;
                
                update puesto_laboral  
                set convocatoria_id = null
                where puesto_laboral_id = 1;
                
                
                
                
                select
					*
                from
					convocatoria c inner join cronograma r
				on
					(c.convocatoria_id = r.convocatoria_id) inner join etapa e
				on 
					(r.etapa_id = e.etapa_id )
				where
					c.convocatoria_id = 1 and e.etapa_id = 1;
                
delete from estudio_candidato
where doc_id = '87654321'
truncate puesto_laboral;
truncate convocatoria



select* from convocatoria;
select* from cronograma;
delimiter $$;
create procedure fn_eliminarConvocatoriaCronograma
										(
                                       in p_convocatoria_id int
                                        )

begin	
                       
                    /*   delete from cronograma
					where convocatoria_id = p_convocatoria_id;
                    
                    delete from convocatoria
					where convocatoria_id = p_convocatoria_id;
                      */ 
                       
                       
                    delete 
						r,
                        c
                    from 
						cronograma r LEFT JOIN convocatoria c
					on
						r.convocatoria_id = c.convocatoria_id
					where 
						r.convocatoria_id = p_convocatoria_id;
                    
				                    
end$$;
drop procedure fn_eliminarConvocatoriaCronograma
call fn_eliminarConvocatoriaCronograma(2);

select* from convocatoria;
select* from pregunta;
select* from prueba;

delete from experiencia_requerida
					where puesto_laboral_id = _p_puesto_laboral_id; -- 8
                    
                    delete from prueba
					where puesto_laboral_id = 8;
                    
                    delete from pregunta
					where pregunta_id = 1;
                    
                    delete from puesto_laboral
					where p_convocatoria_id = 12;
                    
                    
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values('11111111',23,1);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values('11111111',23,2);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values('11111111',23,3);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values('11111111',23,4);
                    insert into cronograma(fecha_cronograma,convocatoria_id,etapa_id)
                    values('11111111',23,5);
                    
select* from convocatoria
delimiter $$;
create procedure fn_eliminarPuesto
										(
                                       in p_puesto_laboral_id int
                                        )

begin	
                    delete from puesto_laboral
					where puesto_laboral_id = p_puesto_laboral_id;
                    
                  
                    
end$$;

call fn_eliminarPuesto(4);


drop procedure fn_eliminarPuesto
select * from experiencia_Requerida;
select * from puesto_laboral;
select * from prueba;
select * from experiencia_Requerida;
select * from ponderacion_Deseable;
select * from CRONOGRAMA;
select * from ponderacion_Deseable;
truncate CRONOGRAMA;
truncate puesto_laboral;
truncate convocatoria;

truncate experiencia_Requerida;
truncate ponderacion_Deseable;
truncate prueba;
truncate finalista;
truncate alternativa_pregunta;
truncate pregunta;

delete from experiencia_Requerida
where experiencia_Requeridad_id > 0;

delete from ponderacion_Deseable
where ponderacion_Deseable_id > 0;

delete from puesto_laboral
where puesto_laboral_ID > 0;

delete from convocatoria
where convocatoria_id > 0;

delete from prueba
where prueba_id > 0;

delete from convocatoria
where convocatoria_id > 0;

select * from usuario
nombre_puesto,edad,sexo,objetivo_pues



select 
                    c.nombre_convocatoria,
                    p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo,
                    d.departamento_nombre
                from puesto_laboral p inner join departamento d on
                    p.departamento_id = d.departamento_id inner join convocatoria c
		on (p.convocatoria_id = c.convocatoria_id);
        
        
        
        
        
        
        
     select 
                    c.convocatoria_id,
                    c.nombre_convocatoria
                from 
                    convocatoria c inner join puesto_laboral p
                    on c.convocatoria_id    = p.convocatoria_id
                where 
                    c.estado = 'NP' and 
                    p.puesto_laboral_id = 6
        
        
        
        
        
        
        select 
                    c.convocatoria_id,
                    c.nombre_convocatoria
                from 
                    convocatoria c inner join puesto_laboral p
                    on c.convocatoria_id    = p.convocatoria_id
                where 
                    c.estado = 'NP' and 
                    p.puesto_laboral_id = 7
                    
                    
                -- CONSULTA PARA LISTAR CONVOCATORIAS     
                    select 
                    distinct c.convocatoria_id,
                    c.nombre_convocatoria, 
                     (
						select 
							distinct date_format(c.fecha_cronograma,'%d/%m/%y a las %h:%i') 
						from 
							cronograma c inner join etapa e
						on 
							c.etapa_id = e.etapa_id where e.etapa_id = 1
					) as fecha_inicio,
                    (
						select 
							distinct date_format(c.fecha_cronograma,'%d/%m/%y a las %h:%i') 
						from 
							cronograma c inner join etapa e
						on c.etapa_id = e.etapa_id where e.etapa_id = 5
					) as fecha_fin,
                    p.puesto_laboral_id
                from 
                    convocatoria c inner join puesto_laboral p 
                on
					(c.convocatoria_id = p.convocatoria_id)inner join cronograma r
				on 
					(c.convocatoria_id = r.convocatoria_id) inner join etapa e
                on 
					(r.etapa_id = e.etapa_id)
				where 
					c.estado = 'SP';
                    
                    
                    
                    
                    select* from puesto_laboral
                    
              --      -----------------------------------------------
              
                   select 
                    distinct c.convocatoria_id,
                    c.nombre_convocatoria, 
                    p.nombre_puesto,
                    p.puesto_laboral_id
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id)
                order by 2;  
                
                
                
                -- --------------------
                
                select 
					c.convocatoria_id,
                    p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo,
                    e.experiencia_requerida,
                    e.duracion,
                    e.meses_anos
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id) 
                    left join experiencia_requerida e
				on
					(p.puesto_laboral_id = e.puesto_laboral_id)
				where
					p.puesto_laboral_id = 8
                order by 2;  
                    
                    select* from experiencia_requerida
                    
                    insert into experiencia_requerida(experiencia_requerida,duracion,meses_anos,puesto_laboral_id)
                    values ('Penalista',1,'A',11);
                    insert into experiencia_requerida(experiencia_requerida,duracion,meses_anos,puesto_laboral_id)
                    values ('En diseño de puentes',1,'A',12);
                    
				
                select experiencia_requerida from experiencia_requerida
                where puesto_laboral_id = 8
                    
               select 
                    distinct c.convocatoria_id,
                    c.nombre_convocatoria, 
                    (select date_format(r.fecha_cronograma,'%d/%m/%y a las %h:%i') from cronograma r inner join etapa e
                    on r.etapa_id = e.etapa_id where c.convocatoria_id = 2 and
                    e.etapa_id = 1) as fecha_inicio,
                    (select date_format(r.fecha_cronograma,'%d/%m/%y a las %h:%i') from cronograma r inner join etapa e
                    on r.etapa_id = e.etapa_id where c.convocatoria_id = 2 and
                    e.etapa_id = 5) as fecha_fin,
                    
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id)inner join cronograma r
		on 
                    (c.convocatoria_id = r.convocatoria_id) inner join etapa e
                on 
                    (r.etapa_id = e.etapa_id)
                where 
                    c.estado = 'SP'
                    
                    
                    
                 
                 
                 
                 
                 
                 
                 
                 
                 
                 select 
                    distinct c.convocatoria_id,
                    p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo,
                    e.experiencia_requerida,
                    e.duracion,
                    e.meses_anos
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id) 
                    inner join experiencia_requerida e
		on
                    (p.puesto_laboral_id = e.puesto_laboral_id)
		where
                    p.puesto_laboral_id = 7
                order by 2;
                
                
                select
					p.puesto_laboral_id,
                    p.doc_id,
                    p.nombre,
                    p.estado,
                    p.fecha_postulacion
                    
                from 
					puesto_laboral u inner join postulacion p 
				on
					(u.puesto_laboral_id = p.puesto_laboral_id)
				where u.puesto_laboral_id =
 
				select 
                    date_format(now(),'%d/%m/%y a las %h:%i')as fecha;
                    
                    
                    insert into postulacion(postulacion_id,doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
                    values(1,'45977448',(select nombre from candidato where doc_id='45977448'),'SH',(select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),8)
                    
                    update postulacion
                    set 
						puesto_laboral_id = 8
                    where
						doc_id ='45977448';
                        
                        truncate postulacion
                        
                        
                        
                        select
                  *
                from 
                    puesto_laboral u inner join postulacion p 
		on
                    (u.puesto_laboral_id = p.puesto_laboral_id)
                where
                    p.doc_id = '45977448'
                    
                    
                    
                    
                    
                    
                    
                    
                    select experiencia_requerida,duracion,meses_anos from experiencia_requerida
                where puesto_laboral_id = 12
                
                
                
                select 
                    c.convocatoria_id,
                    c.nombre_convocatoria,
                    p.puesto_laboral_id
                from 
                    convocatoria c inner join puesto_laboral p
                    on c.convocatoria_id    = p.convocatoria_id
                where 
                    p.puesto_laboral_id =11
                
                
                
                
        select 
                   *
                from 
                    convocatoria c inner join puesto_laboral p
                    on c.convocatoria_id    = p.convocatoria_id
                where 
                    c.convocatoria_id = 11
                 order by 2
                
                
                
                
                
                
                select 
                    distinct c.convocatoria_id,
                    c.nombre_convocatoria, 
                     (
                    select 
			distinct date_format(c.fecha_cronograma,'%d/%m/%y a las %h:%i') 
                    from 
			cronograma c inner join etapa e
                    on 
                        c.etapa_id = e.etapa_id where e.etapa_id = 1
                    ) as fecha_inicio,
                    (
                    select 
                        distinct date_format(c.fecha_cronograma,'%d/%m/%y a las %h:%i') 
                    from 
			cronograma c inner join etapa e
                    on c.etapa_id = e.etapa_id where e.etapa_id = 5
		   ) as fecha_fin
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id)inner join cronograma r
		on 
                    (c.convocatoria_id = r.convocatoria_id) inner join etapa e
                on 
                    (r.etapa_id = e.etapa_id)
		where 
                    c.estado = 'SP';
                    
                    
                    
                   
                    
                    
                    
                    
                    
                    
        insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
        values('45977448',(
							select nombre from candidato where doc_id = '45977448'
                            ),'SH',(
									select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),12
                                    );
                
                
                
                
                
                
 -- POSTULAR --------------------------------------------------------------               
		 
         ¨insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
							values(
								'45977448',(
												select nombre from candidato where doc_id = '45977448'
												),'SH',(
														select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),5
												);   
							
                   
				
         call fn_postular(5,'45977448');
         call fn_postular(6,'45977448');
         drop procedure fn_postular;
        select* from postulacion
           
		 truncate postulacion
         
         
         
        
         
         
         delimiter $$;
		 create procedure fn_postular
										(
                                       in p_puesto_laboral_id int,
                                       in p_doc_id varchar(20)
                                        )
		
		begin
         DECLARE _doc_id int;
		 DECLARE _p_puesto_laboral_id int;
         
			set _doc_id = (select count(doc_id) from postulacion where doc_id = p_doc_id);
			set _p_puesto_laboral_id = (select count(puesto_laboral_id) from postulacion where puesto_laboral_id = p_puesto_laboral_id);   
            
					if _p_puesto_laboral_id = 0 then

							insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
            values(
                    '$_SESSION[dni]',(
                                select nombre from candidato where doc_id = '$_SESSION[dni]'
                                ),'SH',(
                                                select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),$puesto_laboral_id
                                );
					end if;
		end$$;
        
        drop procedure fn_postular;
        
        call fn_postular(5,'45977448');
        
			u.nombre_puesto
            p.fecha_postulacion
            
		 select* from postulacion
           
		 truncate postulacion
        
             
            
		 from 
			postulacion p inner join puesto_laboral u
         on
			(p.puesto_laboral_id = u.puesto_laboral_id)inner join convocatoria c
         on
			(c.convocatoria_id = c.convocatoria_id)inner join cronograma r
         on
			(c.convocatoria_id = r.convocatoria_id)inner join etapa e
         on
			(r.etapa_id = e.etapa_id)   
		where
			p.doc_id = '45977448' and p.puesto_laboral_id = 11
        order by 2;
         
         
                truncate postulacion
                
                distinct c.nombre_convocatoria,
            u.nombre_puesto,
            p.fecha_postulacion,
            e.nombre_etapa
            
            
            
            select 
				distinct c.convocatoria_id,
				c.nombre_convocatoria,
				p.nombre_puesto,
                o.fecha_postulacion
             
			from
				convocatoria c inner join puesto_laboral p
            on 
				(c.convocatoria_id = p.convocatoria_id) inner join postulacion o
            on
				(p.puesto_laboral_id = o.puesto_laboral_id) inner join cronograma r
			on
				(c.convocatoria_id = r.convocatoria_id ) inner join etapa e
			on
				(r.etapa_id = e.etapa_id)
            where
				o.doc_id = '45977448' AND e.nombre_etapa = 'Recepción de Postulaciones';
            
            
            select * from postulacion
            select * from convocatoria
            select * from puesto_laboral
            
            select * from cronograma
            where convocatoria_id = 8 and 9 and
				  etapa_id = 
            
            
            
            
            select
				z.convocatoria_id
			from 
				convocatoria z inner join puesto_laboral t 
            on
				(z.convocatoria_id = t.convocatoria_id) inner join postulacion n
            on
				(t.puesto_laboral_id = n.puesto_laboral_id) inner join cronograma x
            on
				(z.convocatoria_id = x.convocatoria_id)
			where 
				z.convocatoria_id = 9
                
                
                
                
                
                
             select 
				
                distinct r.fecha_cronograma,
                e.nombre_etapa
             from convocatoria c inner join cronograma r
             on
				(c.convocatoria_id = r.convocatoria_id) inner join etapa e
             on
				(r.etapa_id = e.etapa_id)
			 where
				r.convocatoria_id = 9
             order by 1
				
                
                
                
                select 
                    distinct c.convocatoria_id,
                    c.nombre_convocatoria, 
                     (
                    select 
			distinct date_format(c.fecha_cronograma,'%d/%m/%y a las %h:%i') 
                    from 
			cronograma c inner join etapa e
                    on 
                        c.etapa_id = e.etapa_id where e.etapa_id = 1
                    ) as fecha_inicio,
                    (
                    select 
                        distinct date_format(c.fecha_cronograma,'%d/%m/%y a las %h:%i') 
                    from 
			cronograma c inner join etapa e
                    on c.etapa_id = e.etapa_id where e.etapa_id = 5
		   ) as fecha_fin
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id)inner join cronograma r
		on 
                    (c.convocatoria_id = r.convocatoria_id) inner join etapa e
                on 
                    (r.etapa_id = e.etapa_id)
		where 
                    c.estado = 'SP'
                    
                    
                    
                    
                    
                    
                    
                    
                    
            select 
                    distinct c.convocatoria_id,
                    c.nombre_convocatoria, 
                     (
                    select 
						distinct date_format(o.fecha_cronograma,'%d/%m/%y a las %h:%i') 
                    from 
						cronograma o inner join etapa e
                    on 
                        o.etapa_id = e.etapa_id where e.etapa_id = 1 and o.convocatoria_id = c.convocatoria_id
                    ) as fecha_inicio,
                    (
                    select 
                        distinct date_format(a.fecha_cronograma,'%d/%m/%y a las %h:%i') 
                    from 
						cronograma a inner join etapa e
                    on a.etapa_id = e.etapa_id where e.etapa_id = 5 and a.convocatoria_id = c.convocatoria_id
		   ) as fecha_fin
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id)inner join cronograma r
		on 
                    (c.convocatoria_id = r.convocatoria_id) inner join etapa e
                on 
                    (r.etapa_id = e.etapa_id)
		where 
                    c.estado = 'SP'
                
                
                
                select * from convocatoria
                
                
                
-- ----------------------------------------------------------------                

/*
DELIMITER $$;
CREATE PROCEDURE FN_POSTULAR(in p_doc_id varchar(20), in p_puesto_laboral_id int)

	BEGIN
    
     DECLARE _experienciaCandidato_1 int; -- puesto que trabajó
		
        set _experienciaCandidato_1 = (select puesto from experiencia_laboral where experiencia_labora_id = 1);

			insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
			values(
					p_doc_id,
					(
						select nombre from candidato where doc_id = p_doc_id
					),
					'SH',
						(
							select date_format(now(),'%d/%m/%y a las %h:%i')as fecha
						),
                        p_puesto_laboral_id
					);
                    
                    update postulacion
                    set estado = 'Recepción de Postulaciones'
                    where puesto_laboral_id = p_puesto_laboral_id;
                    
                    if select experiencia_requerida from experiencia_requerida where puesto_laboral_id = 11 experiencia_requeridad_id = 1
                    .............. then
                    elseif
						.
                    
                    

END $$;                

	select* from puesto_laboral
    
    
    */
    
 

select * from puesto_laboral;
select * from convocatoria;
 select * from experiencia_requerida
 
 select * from puesto_laboral;
select * from ponderacion_deseable;
select * from prueba;
select * from formacion_Deseable;

update puesto_laboral
set formacion_Deseable_id = 46
where puesto_laboral_id = 8;

truncate experiencia_requerida;
truncate ponderacion_deseable;

delete from prueba
where prueba_id>=1;


  select
		c.nombre_convocatoria,
		p.nombre_puesto,
		e.experiencia_requerida, 
        e.duracion,
        e.meses_anos
	from 
		puesto_laboral p inner join experiencia_requerida e 
	on
		(p.puesto_laboral_id = e.puesto_laboral_id) inner join convocatoria c
	on
		(p.convocatoria_id = c.convocatoria_id)
	where
		e.puesto_laboral_id = 13;
        
    
    
    
    
 select
                   *
                from 
                   experiencia_requerida p inner join convocatoria c 
                on
                  (p.convocatoria_id = c.convocatoria_id)
                where
                   c.estado = 'NP'
    
    
    
    

		insert into experiencia_requerida (experiencia_requerida,duracion,meses_anos,puesto_laboral_id)
        values('Programador web',1,'A',8);
    
    
    
    update experiencia_requerida
    set experiencia_requerida = 'Programador android'
    where puesto_laboral_id = 8
    
    
    select 
                    c.convocatoria_id,
                    c.nombre_convocatoria,
                    e.experiencia_requerida
                from 
                    convocatoria c inner join puesto_laboral p
                    on c.convocatoria_id    = p.convocatoria_id inner join experiencia_requerida e
                    on p.puesto_laboral_id = e.puesto_laboral_id
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
select 
                    distinct nombre_puesto
                 
                from 
                    puesto_laboral 
                    where 
                        puesto_laboral_id = 8 
                
                
                
       select 		
                    o.ponderacion_deseable_id,
                    r.nombre_prueba,
                    o.ponderacion_deseable_minimo,
                    o.ponderacion_deseable_maximo,
                    o.valoracion,
                    o.estado,
                    p.nombre_puesto
                from 
                    puesto_laboral p inner join ponderacion_deseable o
                on
                    p.puesto_laboral_id = o.puesto_laboral_id inner join prueba r
                on
					r.prueba_id = o.prueba_id
				
                where 
                    o.puesto_laboral_id = 8 and o.ponderacion_deseable_id = 1
                    
                    
                  select* from cronograma
                        
                        
                        
delimiter $$;
create procedure fn_registrarCriterio(
									in p_ponderacion_deseable_minimo1 int,
                                    in p_ponderacion_deseable_maximo1 int,
                                    in p_valoracion1 int,
                                    in p_estado1 varchar(100),
                                    in p_ponderacion_deseable_minimo2 int,
                                    in p_ponderacion_deseable_maximo2 int,
                                    in p_valoracion2 int,
                                    in p_estado2 varchar(100),
                                    in p_ponderacion_deseable_minimo3 int,
                                    in p_ponderacion_deseable_maximo3 int,
                                    in p_valoracion3 int,
                                    in p_estado3 varchar(100),
                                    in p_ponderacion_deseable_minimo4 int,
                                    in p_ponderacion_deseable_maximo4 int,
                                    in p_valoracion4 int,
                                    in p_estado4 varchar(100),
                                    in p_ponderacion_deseable_minimo5 int,
                                    in p_ponderacion_deseable_maximo5 int,
                                    in p_valoracion5 int,
                                    in p_estado5 varchar(100),
                                    in p_prueba_id int
                                  --  in p_nombre_prueba varchar(100),
                                  
                                 --   in p_tipo_prueba_id int
									)

begin    
        -- 1
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo1,
                p_ponderacion_deseable_maximo1,
                p_valoracion1,
                p_estado1,
                p_prueba_id
			);
            -- 2
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo2,
                p_ponderacion_deseable_maximo2,
                p_valoracion2,
                p_estado2,
                p_prueba_id
			);
            -- 3
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo3,
                p_ponderacion_deseable_maximo3,
                p_valoracion3,
                p_estado3,
                p_prueba_id
			);
            -- 4
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo4,
                p_ponderacion_deseable_maximo4,
                p_valoracion4,
                p_estado4,
                p_prueba_id
			);
            -- 5
		insert into ponderacion_deseable
									(
										ponderacion_deseable_minimo,
                                        ponderacion_deseable_maximo,
                                        valoracion,
                                        estado,
                                        prueba_id
									)
		values(
				p_ponderacion_deseable_minimo5,
                p_ponderacion_deseable_maximo5,
                p_valoracion5,
                p_estado5,
                p_prueba_id
			);
        
 end$$;
 drop procedure fn_registrarCriterio;
 
 call fn_registrarCriterio(
							0,
							1,
							1,
							'Incorrecto',
							2,
							3,
							2,
							'Incorrecto',
							3,
							4,
							3,
							'Incorrecto',
							5,
							6,
							4,
							'Incorrecto',
                            7,
							8,
							5,
							'Correcto',
							'Aptitud Matemático',
							4,
                            1
						   );
select* from prueba;
select* from ponderacion_deseable;
select* from puesto_laboral;


truncate ponderacion_deseable;

delete from prueba
where prueba_id>=1;



delimiter $$;
create procedure fn_actualizarCriterio(
									in p_ponderacion_deseable_minimo int,
                                    in p_ponderacion_deseable_maximo int,
                                    in p_valoracion int,
                                    in p_estado varchar(100),
                                   /* in p_ponderacion_deseable_minimo2 int,
                                    in p_ponderacion_deseable_maximo2 int,
                                    in p_valoracion2 int,
                                    in p_estado2 varchar(100),
                                    in p_ponderacion_deseable_minimo3 int,
                                    in p_ponderacion_deseable_maximo3 int,
                                    in p_valoracion3 int,
                                    in p_estado3 varchar(100),
                                    in p_ponderacion_deseable_minimo4 int,
                                    in p_ponderacion_deseable_maximo4 int,
                                    in p_valoracion4 int,
                                    in p_estado4 varchar(100),
                                    in p_ponderacion_deseable_minimo5 int,
                                    in p_ponderacion_deseable_maximo5 int,
                                    in p_valoracion5 int,
                                    in p_estado5 varchar(100),*/
                                    in p_nombre_prueba varchar(100), 
                                    -- in p_puesto_laboral_id int,
                                    in p_tipo_prueba_id int,
                                    in p_prueba_id int,
                                    in p_ponderacion_deseable_id int
									)

begin
-- ACTUALIZA EL REGISTRO DE LA PRUEBA        
        update 
			prueba
        set 
			nombre_prueba = p_nombre_prueba,
            tipo_prueba_id = p_tipo_prueba_id
		where
			prueba_id = p_prueba_id;
        -- 1
        
        update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo,
            valoracion = p_valoracion,
            estado = p_estado,
            prueba_id = p_prueba_id
		where
			ponderacion_deseable_id = p_ponderacion_deseable_id;
 /*           
            -- 2
		update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo2,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo2,
            valoracion = p_valoracion2,
            estado = p_estado2,
            prueba_id = p_prueba_id
		where
            ponderacion_deseable_id = p_ponderacion_deseable_id;
            
            -- 3
		update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo3,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo3,
            valoracion = p_valoracion3,
            estado = p_estado3,
            prueba_id = p_prueba_id
		where
            ponderacion_deseable_id = p_ponderacion_deseable_id;
            -- 4
		update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo4,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo4,
            valoracion = p_valoracion4,
            estado = p_estado4,
            prueba_id = p_prueba_id
		where
            ponderacion_deseable_id = p_ponderacion_deseable_id;
            -- 5
		update 
			ponderacion_deseable
        set 
			ponderacion_deseable_minimo = p_ponderacion_deseable_minimo5,
            ponderacion_deseable_maximo = p_ponderacion_deseable_maximo5,
            valoracion = p_valoracion5,
            estado = p_estado5,
            prueba_id = p_prueba_id
		where
            ponderacion_deseable_id = p_ponderacion_deseable_id;
        */
 end$$;
 
 drop procedure fn_actualizarCriterio;
 
 
 

 call fn_actualizarCriterio(
							0,
							1,
							1,
							'Incorrecto',
						/*	2,
							3,
							2,
							'Incorrecto',
							3,
							4,
							3,
							'Incorrecto',
							5,
							6,
							4,
							'Incorrecto',
                            7,
							8,
							5,
							'Correcto', */
							'Aptitud Matematico',
							1,
                            4,
                            1
						   );
                           
                           
select 		
                    o.ponderacion_deseable_id,
                    r.nombre_prueba,
                    o.ponderacion_deseable_minimo,
                    o.ponderacion_deseable_maximo,
                    o.valoracion,
                    o.estado,
                    p.nombre_puesto
                from 
                    puesto_laboral p inner join ponderacion_deseable o
                on
                    p.puesto_laboral_id = o.puesto_laboral_id inner join prueba r
                on
					r.prueba_id = o.prueba_id
               order by 3




select 
                    distinct c.convocatoria_id,
                    c.nombre_convocatoria, 
                     (
                    select 
						distinct date_format(o.fecha_cronograma,'%d/%m/%y a las %h:%i') 
                    from 
						cronograma o inner join etapa e
                    on 
                        o.etapa_id = e.etapa_id where e.etapa_id = 1 and o.convocatoria_id = o.convocatoria_id
                    ) as fecha_inicio,
                    (
                    select 
                        distinct date_format(a.fecha_cronograma,'%d/%m/%y a las %h:%i') 
                    from 
						cronograma a inner join etapa e
                    on a.etapa_id = e.etapa_id where e.etapa_id = 5
		   ) as fecha_fin
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id) inner join cronograma r
		on 
                    (c.convocatoria_id = r.convocatoria_id) inner join etapa e
                on 
                    (r.etapa_id = e.etapa_id)
		where 
                    c.estado = 'SP';
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    select 
                    c.nombre_convocatoria,
                    p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo,
                    d.departamento_nombre,
                    p.puesto_laboral_id,
                    p.convocatoria_id,
                    e.experiencia_requeridad_id
                from puesto_laboral p inner join departamento d on
                    p.departamento_id = d.departamento_id inner join convocatoria c
		on (p.convocatoria_id = c.convocatoria_id) inner join experiencia_requerida e
                on (p.puesto_laboral_id = e.puesto_laboral_id);
                
                
                
                
                
                select * from formacion_deseable
                
             select 
                        experiencia_requeridad_id,
                        experiencia_requerida
                from 
                        experiencia_requerida
                where 
                        experiencia_requeridad_id = 2
                order by 2
                
                
                
                
                
                
                
                
           select 		
                    distinct r.prueba_id,
                    r.nombre_prueba,
                    p.nombre_puesto
                    
                from 
                    puesto_laboral p inner join prueba r
                on
                    p.puesto_laboral_id = r.puesto_laboral_id inner join ponderacion_deseable o
                on
					r.prueba_id = o.prueba_id
               order by 2
               
               
               select* from ponderacion_deseable
               
               
               select 
                    distinct t.tipo_prueba_id,
                    t.nombre_tipo_prueba,
                    t.nombre_prueba
                 from
                    tipo_prueba t inner join prueba p 
                 on
                    (t.tipo_prueba_id = p.tipo_prueba_id) inner join puesto_laboral u 
                 on   
                    (u.puesto_laboral_id = p.puesto_laboral_id) inner join ponderacion_deseable o
                 on
                    (p.prueba_id = o.prueba_id)
                 where
                    p.prueba_id = 4 and u.puesto_laboral_id = 4
                    
              
              
		select
                         
                from 
                        puesto_laboral p inner join experiencia_requerida e
                on
                        (p.puesto_laboral_id = e.puesto_laboral_id)
                where
                        e.puesto_laboral_id = 4 and e.experiencia_requeridad_id = 3;
                        
                        
                        select* from puesto_laboral;
                        select* from experiencia_requerida
                        
                        
                        
                        
             select 		
                    distinct r.prueba_id,
                    r.nombre_prueba,
                    p.nombre_puesto,
                    p.puesto_laboral_id,
                    e.experiencia_requeridad_id,
                    t.tipo_prueba_id,
                    o.ponderacion_deseable_minimo,
                    o.ponderacion_deseable_maximo,
                    o.estado,
                    o.valoracion
                    
                from 
                    puesto_laboral p inner join prueba r 
                on
                    p.puesto_laboral_id = r.puesto_laboral_id inner join tipo_prueba t
				on
					t.tipo_prueba_id = r.tipo_prueba_id inner join ponderacion_deseable o
                on
					r.prueba_id = o.prueba_id inner join experiencia_requerida e
				on
					p.puesto_laboral_id = e.puesto_laboral_id
				where
					r.prueba_id = 4 and e.experiencia_requeridad_id = 3
               order by 2;
                        
                        
                        
                        select
                    p.puesto_laboral_id,
                    p.nombre_puesto,
                    o.ponderacion_deseable_minimo,
                    o.ponderacion_deseable_maximo,
                    o.estado,
                    o.valoracion
                from 
                   puesto_laboral p inner join convocatoria c 
                on
                  (p.convocatoria_id = c.convocatoria_id) inner join prueba r
				on
				  (p.puesto_laboral_id = r.puesto_laboral_id) inner join ponderacion_deseable o
				on
				  (r.prueba_id = o.prueba_id)
                where
                   c.estado = 'NP' and p.puesto_laboral_id = 4;
                   
                   
                   
                   
                   
                   
                   select 		
					r.prueba_id,
                    r.nombre_prueba,
                    p.nombre_puesto,
                    p.puesto_laboral_id,
                    o.ponderacion_deseable_id,
                    o.ponderacion_deseable_minimo,
                    o.ponderacion_deseable_maximo,
                    o.estado,
                    o.valoracion,
                    t.tipo_prueba_id
                    
                from 
                    puesto_laboral p inner join prueba r 
                on
                    p.puesto_laboral_id = r.puesto_laboral_id inner join tipo_prueba t
				on
                    t.tipo_prueba_id = r.tipo_prueba_id inner join ponderacion_deseable o
                on
                    r.prueba_id = o.prueba_id inner join experiencia_requerida e
                on
                    p.puesto_laboral_id = e.puesto_laboral_id
				where
					ponderacion_deseable_id = 1
               order by 2
               
               
               
               
               
               
               select 		
                    r.prueba_id,
                    r.nombre_prueba,
                    p.nombre_puesto,
                    p.puesto_laboral_id,
                    e.experiencia_requeridad_id,
                    o.ponderacion_deseable_id,
                    o.ponderacion_deseable_minimo,
                    o.ponderacion_deseable_maximo,
                    o.estado,
                    o.valoracion
                    
                from 
                    puesto_laboral p inner join prueba r
                on
                    p.puesto_laboral_id = r.puesto_laboral_id inner join ponderacion_deseable o
                on
                    r.prueba_id = o.prueba_id inner join experiencia_requerida e
                on
                    p.puesto_laboral_id = e.puesto_laboral_id
               order by 5;
                        
                        select* from puesto_laboral
                        
                        
-- --------------------------------------------------------------
-- Eliinnar en cascada

		
		delete 
			*
		from
			puesto_laboral p left join experiencia_requerida e 
		on
			(p.puesto_laboral_id = e.puesto_laboral_id) left join prueba r
        on
			(p.puesto_laboral_id = r.puesto_laboral_id) left join ponderacion_deseable o
		on
			(r.prueba_id = o.prueba_id )
		where
			p.puesto_laboral_id = 4
        
        
        
        delete 
			
		from
			puesto_laboral p left join experiencia_requerida e 
		on
			(p.puesto_laboral_id = e.puesto_laboral_id) 
		where
			p.puesto_laboral_id = 4
            
            
            
 
delimiter $$;
create procedure fn_eliminarPuesto(
									in p_puesto_laboral_id int
									)
           
            
begin

			 
            delete 
                from 
                    puesto_laboral
				where 
                    puesto_laboral_id = p_puesto_laboral_id;
			delete 
                 from 
                     experiencia_requerida
                 where
                    puesto_laboral_id = p_puesto_laboral_id;
            delete 
                 from 
                     prueba
                 where
                    puesto_laboral_id = p_puesto_laboral_id;
            delete 
                 from 
                     ponderacion_deseable
                 where
                    puesto_laboral_id = p_puesto_laboral_id;
            delete 
                 from 
                     prueba
                 where
                    puesto_laboral_id = p_puesto_laboral_id;        
                    
       
 end$$;
 
 call fn_eliminarPuesto (4);
             
             
             
             
             
             
             
             
             
             
             select 		
                    distinct o.ponderacion_deseable_id,
                     r.prueba_id,
                    r.nombre_prueba,
                --    p.nombre_puesto,
                   -- e.experiencia_requeridad_id,
                    o.ponderacion_deseable_minimo,
                    o.ponderacion_deseable_maximo,
                    o.estado,
                    o.valoracion
                    
                from 
                    puesto_laboral p inner join prueba r
                on
                    p.puesto_laboral_id = r.puesto_laboral_id inner join ponderacion_deseable o
                on
                    r.prueba_id = o.prueba_id inner join experiencia_requerida e
                on
                    p.puesto_laboral_id = e.puesto_laboral_id
                -- where r.puesto_laboral_id = 5
               order by 1
               
               select* from puesto_laboral;
               
               select* from puesto_laboral
               
               
               
               
               
               
               
               
               
               
               
               select 
                   
                  --  distinct p.nombre_puesto,
                  --  p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo
                  --  e.duracion,
                 --   e.meses_anos
                from 
                    puesto_laboral p inner join convocatoria c
                on
                    (p.convocatoria_id = c.convocatoria_id) 
                    inner join experiencia_requerida e
		on
                    (p.puesto_laboral_id = e.puesto_laboral_id)
		where
                    p.puesto_laboral_id = 5
                order by 2
        
        
        
       select 
                   -- distinct c.convocatoria_id,
                    distinct p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id) 
                    inner join experiencia_requerida e
		on
                    (p.puesto_laboral_id = e.puesto_laboral_id)
		where
                    p.puesto_laboral_id = 5
                order by 2
        
        
        select
			p.prueba_id,
			p.nombre_prueba,
            p.instruccion,
            t.nombre_tipo_prueba
		from 
			prueba p inner join tipo_prueba t
		on
			(p.tipo_prueba_id = t.tipo_prueba_id) 
            
            
            select * from prueba
      
      
      
      
      
      
      
      
      select
			p.prueba_id,
			p.nombre_prueba,
                        p.instruccion,
                        t.nombre_tipo_prueba
		from 
			prueba p inner join tipo_prueba t
		on
			(p.tipo_prueba_id = t.tipo_prueba_id)
                  where 
                        p.prueba_id = 7
            
            
            insert into prueba
                                    (
                                     nombre_prueba,
                                     instruccion,
                                     tipo_prueba,
                                     puesto_laboral_id
                                    )
                   values
                        (
                        'Estándares de calidad',
                        'De ser rapido y preciso en contestar las alternativas correctas.',
                        $tipo_test,
                        $Puesto_id    
                        )
            
insert into pregunta
                                    (
                                        nombre_pregunta,
                                        respuesta,
                                        puntaje,
                                        prueba_id
                                     )   
                   values
                        (
                        '2 + 2',
                        'a',
                         1,
                         5
                         );
                         
                         
                         
                         
         delete from pregunta
		 where pregunta_id = 17
                         
                         
                   select
                   pregunta_id,
                   nombre_pregunta,
                   prueba_id,
                   puntaje,
                   respuesta                    
                 from
                    pregunta
                 where
                    prueba_id = 5
                 order by 1;
                 
                 
                 
                 
                 select
                   pregunta_id,
                   nombre_pregunta,
                   prueba_id,
                   puntaje,
                   respuesta                    
                 from
                    pregunta
                 where
                    pregunta_id = 15
                    
                    
                    
                    select
						estudio_candidato_id,
                        institucion_educativa,
                        titulo_estudio,
                        grado_estudio,
                        fecha_inicio,
                        fecha_fin,
                        doc_id,
                        estado_estudios
					from 
						estudio_candidato
					where estudio_candidato_id = 3;
                    
                    
           delete from estudio_candidato 
                 where estudio_candidato_id = 1
                 
                 
                 
                 
                 select
					experiencia_labora_id,
                    rubro_empresa,
                    empresa,
                    puesto,
                    lugar,
                    descripcion_laboral,
                    area,
                    fecha_inicio,
                    fecha_fin
				 from
					experiencia_laboral
                    
                    
                    
                    
                    
                    
                   select * from postulacion;
                   select * from experiencia_requerida;
                   
                   
                   
                   
                   
                   
                   
                   
                   select 
                   -- distinct c.convocatoria_id,
                    distinct p.nombre_puesto,
                    p.edad,
                    p.sexo,
                    p.objetivo_puesto,
                    p.funciones_puesto,
                    p.horario_trabajo,
                    p.condiciones_trabajo,
                    p.relaciones_sociales_internas,
                    p.relaciones_sociales_externas,
                    p.responsabilidades,
                    p.equipo_de_trabajo,
                    p.observaciones_finales,
                    p.sueldo
                from 
                    convocatoria c inner join puesto_laboral p 
                on
                    (c.convocatoria_id = p.convocatoria_id) 
                    inner join experiencia_requerida e
		on
                    (p.puesto_laboral_id = e.puesto_laboral_id)
		where
                    p.puesto_laboral_id = 6
                order by 2
                
                
                
                
  select
			distinct p.prueba_id,
                        p.nombre_prueba,
                        p.instruccion,
                        t.nombre_tipo_prueba,
                        u.nombre_puesto
                        
		from 
			prueba p inner join tipo_prueba t
		on
			(p.tipo_prueba_id = t.tipo_prueba_id) inner join puesto_laboral u
        on
			(p.puesto_laboral_id = u.puesto_laboral_id)inner join pregunta r
		on
			(p.prueba_id = r.prueba_id)
                order by 2
                
select
                    experiencia_requerida, 
                    duracion,
                    meses_anos,
                    experiencia_requeridad_id
                from 
                    experiencia_requerida
               where
                    experiencia_requeridad_id = 5
               
               select* from experiencia_requerida
               
               
               delete from convocatoria
               where convocatoria_id = 20
               
               select * from ponderacion_deseable
               
               delete from ponderacion_deseable
		 where prueba_id = 13
               
               
               
               
               select 		
                    ponderacion_deseable_id,
                    ponderacion_deseable_minimo,
                    ponderacion_deseable_maximo,
                    estado,
                    valoracion
                    
                from 
                    ponderacion_deseable 
               
                where prueba_id = 13
               order by 1;
               
               
               
               
               select* from postulacion
               
               insert into cronograma(fecha_cronograma,convocatoria,etapa_id)
               values(
               
               truncate postulacion
               
               
               select 		
                    ponderacion_deseable_id,
                    ponderacion_deseable_minimo,
                    ponderacion_deseable_maximo,
                    estado,
                    valoracion,
                    prueba_id
                from 
                    ponderacion_deseable 
               
                where prueba_id = 13
               order by 1
               
               
               
               
               
               
               select* from departamento
               
               
               
               
               
               
               select
                   pregunta_id,
                   nombre_pregunta,
                   prueba_id,
                   puntaje,
                   respuesta                    
                 from
                    pregunta
                 where
                    prueba_id = 15
                 order by 1
                 
                 
                 select* from experiencia_requerida;
                 
                 select* from puesto_laboral;
                 
         


-- experiencia laboral que son iguales a las experiencias requeridas del puesto
		select 
			e.experiencia_requerida, e.duracion
		from
			experiencia_requerida e inner join experiencia_laboral x
		on
			e.experiencia_requerida = x.puesto;

-- ------------------------------------------------
		select 
			e.experiencia_requerida, e.duracion
		from
			experiencia_requerida e left join experiencia_laboral x
		on
			e.experiencia_requerida = x.puesto

-- ------------------------------------------------

-- FUNCION CURRICULAR TERMINADO AL 100% Y OPERATIVA.
	call fn_FiltroCurriculo('46547854',12,'Tiempo completo','Si');
DROP PROCEDURE IF EXISTS fn_FiltroCurriculo;
	DELIMITER $$
	CREATE PROCEDURE fn_FiltroCurriculo (
									in p_doc_id varchar(20),
									in p_puesto_laboral_id int,
									in p_tipo_jornada varchar(50),
									in p_estado_requerimientos varchar(50)
								) 
	begin
		 if p_tipo_jornada = (select tipo_jornada from puesto_laboral where puesto_laboral_id = p_puesto_laboral_id) and 
				   p_estado_requerimientos = 'Si' then
			if	
				(select experiencia_requerida from experiencia_requerida where puesto_laboral_id = p_puesto_laboral_id and experiencia_requerida not in 
                (select puesto from	experiencia_laboral where doc_id = p_doc_id )) IS NULL and 
                (select duracion from experiencia_requerida where puesto_laboral_id = p_puesto_laboral_id and duracion not in 
                (select duracion from experiencia_laboral where doc_id = p_doc_id )) IS NULL THEN 

					insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
					values(
							p_doc_id,(
									select nombre from candidato where doc_id = p_doc_id
									),'CURRICULO APTO',(
													select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),p_puesto_laboral_id
						  );
                          
							   -- insert into PROMEDIO_PRUEBA(doc_id)
							   -- values(p_doc_id);       
				else
					insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
					values(
							p_doc_id,(
									select nombre from candidato where doc_id = p_doc_id
									),'CURRICULO NO APTO',(
													select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),p_puesto_laboral_id
						  );
			end if;
		else
					insert into postulacion(doc_id,nombre,estado,fecha_postulacion,puesto_laboral_id)
					values(
							p_doc_id,(
									select nombre from candidato where doc_id = p_doc_id
									),'CURRICULO NO APTO',(
													select date_format(now(),'%d/%m/%y a las %h:%i')as fecha),p_puesto_laboral_id
						  );
			end if;
	END$$
	DELIMITER ;

 SELECT * FROM POSTULACION
 
 TRUNCATE POSTULACION;







select* from tablaTemp_requerimientoRequerido
-- -----------------------------------------------------------------


/*Table structure for table `tabla` */
drop table if exists `tablaTemp_requerimientoRequerido`;
create table `tablaTemp_requerimientoRequerido` (
  `experiencia_requerida1` varchar(100) default null,
  `experiencia_requerida2` varchar(100) default null,
  `experiencia_requerida3` varchar(100) default null,
  `experiencia_requerida4` varchar(100) default null,
  `experiencia_requerida5` varchar(100) default null,
  `experiencia_requerida6` varchar(100) default null,
  `experiencia_requerida7` varchar(100) default null
) engine=innodb default charset=latin1;

/*Data for the table `tabla` */
insert  into `tabla`(`campo1`,`campo2`,`campo3`,`fecha`)
values
(1,'A','1000','2011-01-18 00:56:56'),
(2,'B','2000','2011-01-18 00:57:02'),
(3,'C','3000','2011-01-18 00:57:08');


	call proc_para_probar(12);
	DROP PROCEDURE IF EXISTS proc_para_probar;
    
	delimiter $$
	drop procedure if exists `proc_para_probar`$$
	create procedure `proc_para_probar`(
										-- in p_doc_id varchar(20),
										in p_puesto_laboral_id int
									-- in p_tipo_jornada varchar(50),
										-- in p_estado_requerimientos varchar(50)
										)
	begin
	-- declaracion de variables locales
	declare p_du int;
    declare p_req1 varchar(100);/*
	declare p_req2 varchar(100);
	declare p_req3 varchar(100);
	declare p_req4 varchar(100);
	declare p_req5 varchar(100);
	declare p_req6 varchar(100);
	declare p_req7 varchar(100);*/
	declare no_hay_mas_registros int default 0;
	declare elCursor cursor for
	SELECT experiencia_requerida, duracion FROM experiencia_requerida where puesto_laboral_id = p_puesto_laboral_id; 
	declare continue handler for not found set no_hay_mas_registros = 1;
	-- tabla temporal
	drop temporary table if exists tablatemporal;
	create temporary table tablaTemp_requerimientoRequerido 
    (
      `experiencia_requerida1` varchar(100) default null,
      `duracion1` int default null,
	  `experiencia_requerida2` varchar(100) default null,
      `duracion2` int default null,
	  `experiencia_requerida3` varchar(100) default null,
      `duracion3` int default null,
	  `experiencia_requerida4` varchar(100) default null,
      `duracion4` int default null,
	  `experiencia_requerida5` varchar(100) default null,
      `duracion5` int default null,
	  `experiencia_requerida6` varchar(100) default null,
      `duracion6` int default null,
	  `experiencia_requerida7` varchar(100) default null,
      `duracion7` int default null
    );
	-- se abre el cursor
		open elCursor;
		-- se van tomando los datos hasta que el cursor llegue al final
		bucle: loop
			fetch elCursor into p_req1, p_du;
			if (no_hay_mas_registros = 1) then
				leave bucle;
			end if;
			-- se cargan los datos en la tabla temporal
			 insert tablaTemp_requerimientoRequerido
												(
												experiencia_requerida1,duracion1
                                                ) 
			values (p_req1,p_du);
            
             insert tablaTemp_requerimientoRequerido
												(
												experiencia_requerida2,duracion1
                                                ) 
			values (p_req1,p_du);
        
		end loop bucle;
		close elCursor;
		select * from tablaTemp_requerimientoRequerido;
		drop temporary table if exists tablaTemp_requerimientoRequerido;
	end$$
	delimiter ;
    
    truncate postulacion
    
    SELECT * FROM EXPERIENCIA_rEQUERIDA
    
select 
			
			distinct c.nombre_convocatoria,
			p.nombre_puesto,
                        p.puesto_laboral_id,
                        o.fecha_postulacion,
                        o.estado,
                        c.convocatoria_id,
                        o.nombre,
                        u.nombre_prueba,
                        t.tipo_prueba_id
		from
			convocatoria c inner join puesto_laboral p
                 on 
			(c.convocatoria_id = p.convocatoria_id) inner join postulacion o
                 on
			(p.puesto_laboral_id = o.puesto_laboral_id) inner join cronograma r
		on
			(c.convocatoria_id = r.convocatoria_id ) inner join etapa e
		on
			(r.etapa_id = e.etapa_id) inner join prueba u
		on
			(p.puesto_laboral_id = u.puesto_laboral_id) inner join tipo_prueba t
		on
			(u.tipo_prueba_id = t.tipo_prueba_id)
    
Select 
                      p.prueba_id,
                      p.nombre_prueba
                  from 
                      prueba p inner join tipo_prueba t
                  on
                      p.tipo_prueba_id = t.tipo_prueba_id
                  where
                      p.puesto_laboral_id = 12 and
                      p.tipo_prueba_id = 1 
				 order by 1
                      
                      
                      
                   select 
						p.prueba_id,
						p.nombre_prueba,
                        p.instruccion,
                        r.nombre_pregunta
					from
						prueba p inner join pregunta r
					where
						p.prueba_id = 15
					order by 1
                    
                    
                    
                    select* from etapa
                    
                    update etapa
                    set nombre_etapa = 'Entrevista Gerencial'
                    where etapa_id = 4;
                    
                    update etapa
                    set nombre_etapa = 'Resultado de Pruebas de selección'
                    where etapa_id = 5;
                    
                    update etapa
                    set nombre_etapa = 'Resultado Final'
                    where etapa_id = 5;
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                 select 
                        distinct 
                        p.nombre_prueba,
                        p.instruccion
                from
                        prueba p inner join pregunta r
                where
                        p.prueba_id = 15
                        
                        
                        
                        
                        
                        
                        select 
			
						distinct p.puesto_laboral_id,
                        b.duracion,
						c.nombre_convocatoria,
						p.nombre_puesto,
                        o.fecha_postulacion,
                        o.estado,
                        c.convocatoria_id,
                        o.nombre
		from
			convocatoria c inner join puesto_laboral p
                 on 
			(c.convocatoria_id = p.convocatoria_id) inner join postulacion o
                 on
			(p.puesto_laboral_id = o.puesto_laboral_id) inner join cronograma r
		on
			(c.convocatoria_id = r.convocatoria_id ) inner join etapa e
		on
			(r.etapa_id = e.etapa_id) inner join prueba b
		on
			(p.puesto_laboral_id = b.puesto_laboral_id )
                where
			o.doc_id = '45977448' and b.duracion in (select duracion from prueba where puesto_laboral_id = 12 )
            
            
            
            
            
            
            
            
            
            Select 
                      p.prueba_id,
                      p.nombre_prueba,
                      p.duracion
                      
                  from 
                      prueba p inner join tipo_prueba t
                  on
                      (p.tipo_prueba_id = t.tipo_prueba_id) 
                  where
                      p.puesto_laboral_id = 12 and
                      p.tipo_prueba_id = 1
            
            select* from pregunta


-- -------------------- CREACIÓN DE TABLAS TEMPORANEAS -------------------------------
             
             CREATE TEMPORARY TABLE TEMP_PROMEDIO
             (
             DOC_ID VARCHAR(20),
             PRUEBA_ID INT,
             PROMEDIO FLOAT -- PUNTAJE FINAL = SUMA DE PUNTAJES CORRECTOS - PUNTAJES INCORRECTOS
             );
             CREATE TEMPORARY TABLE TEMP_PROMEDIO_ANTERIOR
             (
             DOC_ID VARCHAR(20),
             PRUEBA_ID INT,
             PROMEDIO FLOAT -- PUNTAJE FINAL = SUMA DE PUNTAJES CORRECTOS - PUNTAJES INCORRECTOS
             );
             CREATE TEMPORARY TABLE TEMP_PUNTAJE
             (
             DOC_ID VARCHAR(20),
             PREGUNTA_ID INT,
             PUNTAJE_CORRECTO FLOAT,
             PUNTAJE_INCORRECTO FLOAT,
             RESPUESTA CHAR(1),
             PRUEBA_ID INT,
             UNIQUE DOC_ID_PREGUNTA_ID_uniq (DOC_ID,PREGUNTA_ID)
             );
             
DROP TABLE TEMP_PROMEDIO;
DROP TABLE TEMP_PROMEDIO_ANTERIOR;
DROP TABLE TEMP_PUNTAJE;

TRUNCATE TEMP_PUNTAJE;

select * from TEMP_PROMEDIO;
select * from TEMP_PROMEDIO_ANTERIOR;
select * from TEMP_PUNTAJE;
-- FUNCION DE ALMACENAR RESPUESTA, PUNTAJE, ETC DEL CANDIDATO PARA UNA PRUEBA TERMINADO AL 100% Y OPERATIVA.
	call fn_guardarRespuesta('45977448',3,'b');
  call fn_guardarRespuesta(
                                    '45977448',
                                    2,
                                    'b'
                                    );
    
 call fn_guardarRespuesta('45977448',2,'b');
	DROP PROCEDURE IF EXISTS fn_guardarRespuesta;
	DELIMITER $$
	CREATE PROCEDURE fn_guardarRespuesta (
									in p_doc_id varchar(20),
									in p_pregunta_id int,
									in p_respuesta char(1)
								) 
	begin
    
		DECLARE _puntaje_correcto float;
        DECLARE _puntaje_incorrecto float;
        DECLARE _respuesta_correcta float;
		DECLARE _prueba_id int;

        
			SET _puntaje_correcto = (select puntaje from pregunta where pregunta_id = p_pregunta_id);
			SET _puntaje_incorrecto = (select puntaje_incorrecto from pregunta where pregunta_id = p_pregunta_id);
			SET _respuesta_correcta = (select respuesta from pregunta where pregunta_id = p_pregunta_id);
			SET _prueba_id = (select prueba_id from pregunta where pregunta_id = p_pregunta_id);
				
            
			-- -------------------- CONDICIONES IF -------------------------------		
                
					
                
                 IF (select respuesta from pregunta where pregunta_id = p_pregunta_id) = p_respuesta THEN
                
					insert into RESPUESTA_CANDIDATO(respuesta,doc_id,puntaje_correcto,puntaje_incorrecto,estado,pregunta_id)
					values(p_respuesta,p_doc_id,_puntaje_correcto,_puntaje_incorrecto,'Respuesta Correcta',p_pregunta_id);
				ELSEIF (select respuesta from pregunta where pregunta_id = p_pregunta_id) <> p_respuesta THEN
					insert into RESPUESTA_CANDIDATO(respuesta,doc_id,puntaje_incorrecto,estado,pregunta_id)
					values(p_respuesta,p_doc_id,_puntaje_incorrecto,'Respuesta Incorrecta',p_pregunta_id);
			    END IF;
                
	END$$
	DELIMITER ;

SELECT * FROM RESPUESTA_CANDIDATO

 SELECT * FROM PROMEDIO_PRUEBA;

 
 TRUNCATE RESPUESTA_CANDIDATO;            
 
 
 
 
 
 Select 
                      p.prueba_id,
                      p.nombre_prueba,
                      p.duracion,
                      o.estado,
                      o.doc_id
                  from 
                      prueba p inner join tipo_prueba t
                  on
                      p.tipo_prueba_id = t.tipo_prueba_id left join PROMEDIO_PRUEBA o
                  on
                      p.prueba_id = o.prueba_id inner join candidato c
				  on
                      o.doc_id = c.doc_id 
                  where
                      p.puesto_laboral_id = 12 and
                      p.tipo_prueba_id = 1 and c.doc_id = '46547854'
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 select* from prueba
 
 select sum(puntaje_correcto) - sum(puntaje_incorrecto) as PROMEDIO from RESPUESTA_CANDIDATO
 
 -- FUNCION PARA CALIFICAR PROMEDIOS DE EXAMENES DE LOS CANDIDATOS
 
 call fn_calificarPrueba('45977448',15);
 
	DROP PROCEDURE IF EXISTS fn_calificarPrueba;
    
	DELIMITER $$
	CREATE PROCEDURE fn_calificarPrueba (
									in p_doc_id varchar(20),
									in p_prueba_id int
                                   -- in p_puesto_id int,
                                    -- in p_tipo_puesto_id int
								) 
	begin
    
		DECLARE _promedio float;
        DECLARE _num_pruebas_correctas_prueba int;
        DECLARE _num_pruebas_correctas_candidato int;
			IF (
					SELECT 
						sum(r.puntaje_correcto) - sum(r.puntaje_incorrecto)
					FROM RESPUESTA_CANDIDATO r inner join pregunta p
					ON
						(r.pregunta_id = p.pregunta_id) inner join prueba u
					ON
						(p.prueba_id = u.prueba_id)
					WHERE
						r.doc_id =  p_doc_id  and u.prueba_id = p_prueba_id
							) IS NULL THEN
                          
                           insert into PROMEDIO_PRUEBA(promedio,prueba_id,estado,doc_id)
						 values( 0,p_prueba_id,'CALIFICADO',p_doc_id);
                         
						/*		UPDATE 
									PROMEDIO_PRUEBA
								SET 
									promedio = 0,
									prueba_id = p_prueba_id,
									estado = 'CALIFICADO'
								where 
									doc_id = p_doc_id;
				*/
			 ELSE
						SELECT 
							(sum(r.puntaje_correcto) - sum(r.puntaje_incorrecto)) into _promedio 
						FROM RESPUESTA_CANDIDATO r inner join pregunta p
						ON
							(r.pregunta_id = p.pregunta_id) inner join prueba u
						ON
							(p.prueba_id = u.prueba_id)
						WHERE
							r.doc_id =  p_doc_id  and u.prueba_id = p_prueba_id;
							
						 insert into PROMEDIO_PRUEBA(promedio,prueba_id,estado,doc_id)
						 values( _promedio,p_prueba_id,'CALIFICADO',p_doc_id);
						
							/* UPDATE 
								PROMEDIO_PRUEBA
							SET 
								promedio = _promedio,
								prueba_id = p_prueba_id,
								estado = 'CALIFICADO'
							where 
								doc_id = p_doc_id;
                                
                                */
					end if;			
                         IF (
								SELECT 
									DISTINCT PD.ESTADO
								FROM PROMEDIO_PRUEBA PP INNER JOIN PRUEBA P
								ON
									(PP.PRUEBA_ID = P.PRUEBA_ID) INNER JOIN PONDERACION_DESEABLE PD
								ON
									(P.PRUEBA_ID = PD.PRUEBA_ID)
								WHERE
									PP.DOC_ID = p_doc_id AND
									PP.PRUEBA_ID = p_prueba_id  AND
									PROMEDIO BETWEEN 
												PD.PONDERACION_DESEABLE_MINIMO and PD.PONDERACION_DESEABLE_MAXIMO
								  ) = 'I' THEN
										
											UPDATE 
												PROMEDIO_PRUEBA
											SET 
												estado_promedio = 'I'
											where 
												 doc_id = p_doc_id and
												prueba_id = p_prueba_id;
							
								ELSE
											UPDATE 
												PROMEDIO_PRUEBA
											SET 
												estado_promedio = 'C'
											where 
												doc_id = p_doc_id and
												prueba_id = p_prueba_id;
								end if;     
					
	END$$
	DELIMITER ;
 
 
-- --------------------------------------------------------- 
	 
				delete from postulacion
                where doc_id = '46547854';
                
                 delete from RESPUESTA_CANDIDATO
                where doc_id = '46547854' and pregunta_id =10;
                
                 delete from PROMEDIO_PRUEBA
                where doc_id = '46547854'  and prueba_id =18;
     
     
     select 
		distinct p.doc_id,
                    p.nombre,
                    p.estado,
                    p.fecha_postulacion
				 	
	 from 
		postulacion p left join promedio_prueba pp
	 on
		( p.doc_id = pp.doc_id)
	where
		p.puesto_laboral_id = 12;
        
             select 
		*
	 from 
		PROMEDIO_PRUEBA;
        
        
     where
		doc_id = '45977448' and prueba_id = 15;
		
	 select 
		count(puntaje_correcto) as aciertos,
		(select count(*) from respuesta_candidato where puntaje_correcto is null) as No_acierto
	 from
		respuesta_candidato r inner join pregunta p
	 on
		(r.pregunta_id = p.pregunta_id) inner join prueba u
	 on
		(p.prueba_id = u.prueba_id)
	 where
		r.doc_id = '45977448' and p.prueba_id = 15;
        
        
	 select 
		(select count(*) from respuesta_candidato where puntaje_correcto is null) as No_acierto
	 from
		respuesta_candidato r inner join pregunta p
	 on
		(r.pregunta_id = p.pregunta_id) inner join prueba u
	 on
		(p.prueba_id = u.prueba_id)
	 where
		r.doc_id = '45977448' and p.prueba_id = 15;
        
     
     
     
     
     
     
     
truncate PROMEDIO_PRUEBA
     
     
     
				  Select     
					  r.pregunta_id,
                      r.nombre_pregunta,
                      r.respuesta as resp_pregunta,
                      s.respuesta as resp_candidato,
                      o.promedio,
                      s.puntaje_correcto,
                      s.puntaje_incorrecto
                      
                  from 
                      prueba p inner join PROMEDIO_PRUEBA o
                  on
                      p.prueba_id = o.prueba_id inner join pregunta r
                  on
                      p.prueba_id = r.prueba_id inner join respuesta_candidato s    
				  on
                      r.pregunta_id = s.pregunta_id
                  where
                      p.prueba_id = 15 and
                      c.doc_id = '45977448'
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      delete from postulacion
                      where 
						doc_id = '46547854'
                      
                      select 
                           *
                       from
                            postulacion r 
                       where
                            doc_id = '45977448' and puesto_laboral_id = 12
                            
                            
                            inner join pregunta p
                       on
                            (r.pregunta_id = p.pregunta_id) inner join prueba u
                       on
                            (p.prueba_id = u.prueba_id)
                       where
                            r.doc_id = '45977448' and p.prueba_id = 15) as aciertos,
                       (select 
                        distinct (select count(*) from respuesta_candidato where puntaje_correcto is null) as No_acierto
                        from
                               respuesta_candidato r inner join pregunta p
                        on
                               (r.pregunta_id = p.pregunta_id) inner join prueba u
                        on
                               (p.prueba_id = u.prueba_id)
                        where
                               r.doc_id = '45977448' and p.prueba_id = 15) as no_aciertos   
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               
                               select 
                        distinct 
                        r.pregunta_id,
                        p.prueba_id,
                        p.nombre_prueba,
                        p.instruccion,
                        r.nombre_pregunta
                        -- r.estado,
                        -- p.duracion,
                        -- c.estado
                from
                        prueba p inner join pregunta r
                on
                        (p.prueba_id = r.prueba_id)       
                where
                        p.prueba_id = 15 
                order by 1;
                
                
                
                
                
                
                
                 Select 
                      p.prueba_id,
                      p.nombre_prueba,
                      p.duracion,
					  o.estado,
                     -- o.promedio,
                      o.doc_id
                  from 
                      prueba p inner join tipo_prueba t
                  on
                      p.tipo_prueba_id = t.tipo_prueba_id left join PROMEDIO_PRUEBA o
                  on
                      p.prueba_id = o.prueba_id
                  where
                      p.puesto_laboral_id = 12 and
                      p.tipo_prueba_id = 1 
				  group by O.estado 
                
                
                 TRUNCATE RESPUESTA_CANDIDATO;            
  TRUNCATE postulacion;            
   TRUNCATE select* from PROMEDIO_PRUEBA;
   
   
   select* from PROMEDIO_PRUEBA;
   select* from postulacion;
                 select* from RESPUESTA_CANDIDATO
                
                delete from postulacion
                where doc_id = '47741254';
                
                 delete from RESPUESTA_CANDIDATO
                where doc_id = '47741254';
                
                 delete from PROMEDIO_PRUEBA
                where doc_id = '47741254';
                
                
                
                
                
                
                
                
                
                
             Select 
                      p.prueba_id,
                      p.nombre_prueba,
                      p.duracion,
                      o.estado,
                      o.promedio,
                      o.doc_id
                  from 
                      prueba p inner join tipo_prueba t
                  on
                      p.tipo_prueba_id = t.tipo_prueba_id left join PROMEDIO_PRUEBA o
                  on
                      p.prueba_id = o.prueba_id
                  where
                      p.puesto_laboral_id = 12 and
                      p.tipo_prueba_id = 1 and 
                   group by o.doc_id desc;
                   
                   
            
            
            
            
            
            
            
            
            
            
          select
                        prueba_id,
                        nombre_prueba
                        -- o.estado,
                        -- o.promedio,
                        -- o.doc_id
                from 
                        prueba  
                where        
						tipo_prueba_id = 1 
          
          
          
          

                   
                   
              Select     
                      
                      *
                      
                  from 
                      prueba 
                  
                  where
                      o.doc_id = '46547854' and prueba_id = 15
                   
                   
                   
                   select
                        o.prueba_id,
                        p.nombre_prueba,
                        o.estado,
                        o.promedio,
                        o.doc_id
                from 
                        prueba p left join promedio_prueba o
                on
                        ( p.prueba_id = o.prueba_id )
                where 
                        tipo_prueba_id = 1 
                group by p.prueba_id;
                   
                   
                   
                   
                   
                   
                   
                   
select* from prueba
 
 select sum(puntaje_correcto) - sum(puntaje_incorrecto) as PROMEDIO from RESPUESTA_CANDIDATO
 
 -- FUNCION PARA CALIFICAR PROMEDIOS DE EXAMENES DE LOS CANDIDATOS
 
 call fn_seleccion_candidatoIdoneo('45977448',15);
 
	DROP PROCEDURE IF EXISTS fn_seleccion_candidatoIdoneo;
    
	DELIMITER $$
	CREATE PROCEDURE fn_seleccion_candidatoIdoneo (
									-- in p_doc_id varchar(20),
									-- in p_prueba_id int,
                                    in p_puesto_id int
                                    -- in p_tipo_puesto_id int
								) 
	begin
		DECLARE _num_pruebas_correctas_prueba int;
        DECLARE _num_pruebas_correctas_candidato int;
					
                    
                 IF (   
                    SELECT 
						*
					FROM PROMEDIO_PRUEBA PP INNER JOIN PRUEBA P
                    ON
						(PP.PRUEBA_ID = P.PRUEBA_ID) INNER JOIN PONDERACION_DESEABLE PD
					ON
						(P.PRUEBA_ID = PD.PRUEBA_ID)
                    WHERE
						PP.DOC_ID = p_doc_id AND
                        PP.PRUEBA_ID = 15  AND
                        PROMEDIO BETWEEN 
									PD.PONDERACION_DESEABLE_MINIMO and PD.PONDERACION_DESEABLE_MAXIMO
                      ) = 'I' THEN
                            
								UPDATE 
									PROMEDIO_PRUEBA
								SET 
									estado_promedio = 'I'
								where 
									-- doc_id = p_doc_id and
                                    prueba_id = p_prueba_id;
				
			        ELSE
								UPDATE 
									PROMEDIO_PRUEBA
								SET 
									estado_promedio = 'C'
								where 
									-- doc_id = p_doc_id and
                                    prueba_id = p_prueba_id; (select prueba_id from prueba where puesto_laboral_id = 12)
			end if;
							SELECT
								COUNT(R.PRUEBA_ID) INTO _num_pruebas_correctas_prueba
							FROM
								PUESTO_LABORAL P INNER JOIN PRUEBA R
							ON
								( P.PUESTO_LABORAL_ID = R.PUESTO_LABORAL_ID);
                                
                            SELECT
								COUNT(PR.estado_promedio) INTO _num_pruebas_correctas_candidato
							FROM
								PROMEDIO_PRUEBA PR INNER JOIN PRUEBA P
							ON
								( PR.PRUEBA_ID = P.PRUEBA_ID)
							WHERE
								PR.DOC_ID = p_doc_id;
                                
            IF	( _num_pruebas_correctas_prueba =  _num_pruebas_correctas_candidato) THEN
					
                    INSERT INTO FINALISTA (doc_id,nombres,apellidos,email,celular,puesto_laboral_id)
                    values(p_doc_id, (select nombre from candidato where doc_id = p_doc_id),
                          (select apellidos from candidato where doc_id = p_doc_id),
                          (select email from candidato where doc_id = p_doc_id),
                          (select celular from candidato where doc_id = p_doc_id), 
                          (select distinct puesto_laboral_id from prueba where prueba_id = p_prueba_id));
                    
			END IF;
								
	END$$
	DELIMITER ;
 
 
-- ---------------------------------------------------------                    



		select 
			*
		from
			FINALISTA
		where
			puesto_laboral_id = 12
		order by 3;
-- ---------------------------------------------------------                    



truncate RESPUESTA_CANDIDATO
select* from finalista;
   select* from postulacion;
                 select* from RESPUESTA_CANDIDATO
                
                delete from postulacion
                where doc_id = '45977448';
                
                 delete from RESPUESTA_CANDIDATO
                where doc_id = '45977448';
                
                 delete from PROMEDIO_PRUEBA
                where doc_id = '45977448';
                
-- ------------------------------------------------------------
 call fn_seleccion_finalistas1('46547854',12);
 -- SELECCION DE LOS CANDIDATOS QUE CUMPLEN CON LOS CRITERIOS DE SELECCION . 100% OPERATIVO
	DROP PROCEDURE IF EXISTS fn_seleccion_finalistas1;
    
	DELIMITER $$
	CREATE PROCEDURE fn_seleccion_finalistas1 (
									 in p_doc_id varchar(20),
									-- in p_prueba_id int,
                                    in p_puesto_id int
                                    -- in p_tipo_puesto_id int
								) 
	begin
    
		DECLARE _num_prueba int;
        DECLARE _num_pruebas_correctas_candidato int;
        DECLARE specialty CONDITION FOR SQLSTATE '45000';  
							
                            
                            
                            select 
								count(*) into _num_prueba
							from
								prueba
							where
								puesto_laboral_id = p_puesto_id;
						
							
							select 
								count(*) into _num_pruebas_correctas_candidato
							from
								promedio_prueba pp inner join prueba p
							on
								( pp.prueba_id = p.prueba_id ) inner join puesto_laboral pl
							on
								( p.puesto_laboral_id = pl.puesto_laboral_id)
							where
								pl.puesto_laboral_id = p_puesto_id and
								pp.estado_promedio = 'C' and
								pp.doc_id = p_doc_id;
                                
                                
                                
                                 IF	( _num_pruebas_correctas_candidato =  _num_prueba) THEN
					
						
									INSERT INTO FINALISTA (doc_id,nombres,apellidos,email,celular,puesto_laboral_id)
									values(p_doc_id, (select nombre from candidato where doc_id = p_doc_id),
										  (select apellidos from candidato where doc_id = p_doc_id),
										  (select email from candidato where doc_id = p_doc_id),
										  (select celular from candidato where doc_id = p_doc_id),p_puesto_id 
										  );
								-- ELSE
									-- SIGNAL SQLSTATE '45000'
									-- SET MESSAGE_TEXT = 'LO SENTIMOS!, USTED NO A SIDO SELECCIONADO.';
                                    
								END IF;



END$$
	DELIMITER ;
    
    
    
    
    
    
    truncate finalista
    
    select
		doc_id 
	from
		finalista
    where 
		doc_id = '45977448'




select
distinct c.nombre_convocatoria,
                    pl.nombre_puesto,
                    CONCAT(f.nombres,  ' ', f.apellidos) as Nombres,
                    o.fecha_cronograma
                 from
                    puesto_laboral pl inner join finalista f
                 on
                    ( pl.puesto_laboral_id = f.puesto_laboral_id ) 
                 where
                    pl.puesto_laboral_id = 12 and
                    o.etapa_id = 5
				order by 
    
    
    
    select
		p.doc_id,
        CONCAT(c.nombre, ' ',c.apellidos) as Nombres,
        pr.nombre_prueba,
        p.promedio
	from
		promedio_prueba p inner join candidato c
    on
		( p.doc_id = c.doc_id ) inner join prueba pr
    on 
		( p.prueba_id = pr.prueba_id)     
	where
		p.doc_id in (select doc_id from finalista)
    
    
    
    
    
    
    
	select
		tp.nombre_tipo_prueba,
		pr.nombre_prueba,
        p.promedio,
        f.doc_id
	from
		promedio_prueba p inner join candidato c
    on
		( p.doc_id = c.doc_id ) inner join prueba pr
    on 
		( p.prueba_id = pr.prueba_id) inner join tipo_prueba tp
    on 
		( pr.tipo_prueba_id = tp.tipo_prueba_id) inner join finalista f
    on 
		( c.doc_id = f.doc_id)    
	where
		c.doc_id in (select doc_id from finalista) and
        
    
    
    
    
    
    
    
    select 
			
			distinct c.nombre_convocatoria,
			p.nombre_puesto,
                        p.puesto_laboral_id,
                        o.fecha_postulacion,
                        o.estado,
                        c.convocatoria_id,
                        o.nombre
		from
			convocatoria c inner join puesto_laboral p
                 on 
			(c.convocatoria_id = p.convocatoria_id) inner join postulacion o
                 on
			(p.puesto_laboral_id = o.puesto_laboral_id) inner join cronograma r
		on
			(c.convocatoria_id = r.convocatoria_id ) inner join etapa e
		on
			(r.etapa_id = e.etapa_id) inner join prueba b 
		on
			(p.puesto_laboral_id = b.puesto_laboral_id ) inner join finalista f
		on
			(p.puesto_laboral_id = f.puesto_laboral_id ) 
                where
			f.doc_id = '46547854'
    
    
    
    
    
    
    Select     
                      distinct r.pregunta_id,
                      r.nombre_pregunta
                      
                  from 
                      prueba p inner join PROMEDIO_PRUEBA o
                  on
                      p.prueba_id = o.prueba_id left join pregunta r
                  on
                      p.prueba_id = r.prueba_id left join respuesta_candidato s    
		  on
                      r.pregunta_id = s.pregunta_id
                  where
                      p.prueba_id = 15 and
                      o.doc_id = '45977448'
                  group by 1,2
    
    
    
    
    
    ,
                      r.respuesta as resp_pregunta,
                      s.respuesta as resp_candidato,
                      s.puntaje_correcto,
                      s.puntaje_incorrecto,
                      o.doc_id
    
    
    select 
		e.institucion_educativa,
        e.titulo_estudio,
        e.grado_estudio,
        e.fecha_inicio,
        e.fecha_fin,
        e.estado_estudios
	from 
		candidato c inner join estudio_candidato e
    on
		( c.doc_id = e.doc_id )
	where e.doc_id = ;
    
    
    
    select 
		 e.rubro_empresa,
        e.empresa,
        e.puesto,
        e.lugar,
        e.descripcion_laboral,
        e.area
	from 
		candidato c inner join experiencia_laboral e
    on
		( c.doc_id = e.doc_id )
	where e.doc_id = '46547854';
    
    
    
   select 
		 doc_id,
		 concat(nombre, ", ", apellidos) as nombres,
         direccion,
         celular,
         hijos,
         departamento_nacimiento,
         ciudad_nacimiento,
         estado_civil,
         (case when sexo = 'M' then 'Masculino' else 'Mujer' end) as sexo,
         edad,
         email,
         trabaja_actualmente,
         cambio_residencia
	from 
		candidato c inner join disposicion_laboral d
	on
		( c.disposicion_laboral_id = d.disposicion_laboral_id)
	where
		c.doc_id = ;
    
    
    
    select 
		 c.doc_id,
		 concat(c.nombre, ", ", c.apellidos) as nombres,
         c.direccion,
         c.celular,
         c.hijos,
         c.departamento_nacimiento,
         c.ciudad_nacimiento,
         c.estado_civil,
         (case when c.sexo = 'M' then 'Masculino' else 'Mujer' end) as sexo,
         c.edad,
         c.email
	from 
		usuario u inner join candidato c
	on
		( u.p_cuenta = c.doc_id ) 
    
    
    
    -- SELECCION DE LOS CANDIDATOS QUE CUMPLEN CON LOS CRITERIOS DE SELECCION . 100% OPERATIVO
	DROP PROCEDURE IF EXISTS fn_seleccion_finalistas;
    
	DELIMITER $$
	CREATE PROCEDURE fn_seleccion_finalistas (
									 in p_doc_id varchar(20),
									-- in p_prueba_id int,
                                    in p_puesto_id int
                                    -- in p_tipo_puesto_id int
								) 
	begin
    
		DECLARE _num_prueba int;
        DECLARE _num_pruebas_correctas_candidato int;
        
							select 
								count(*) into _num_prueba
							from
								prueba
							where
								puesto_laboral_id = p_puesto_id;
						
							
							select 
								count(*) into _num_pruebas_correctas_candidato
							from
								promedio_prueba pp inner join prueba p
							on
								( pp.prueba_id = p.prueba_id ) inner join puesto_laboral pl
							on
								( p.puesto_laboral_id = pl.puesto_laboral_id)
							where
								pl.puesto_laboral_id = p_puesto_id and
								pp.estado_promedio = 'C' and
								pp.doc_id = p_doc_id;
                                
                                
                                
                                 IF	( _num_pruebas_correctas_candidato =  _num_prueba) THEN
					
						
									INSERT INTO FINALISTA (doc_id,nombres,apellidos,email,celular,puesto_laboral_id)
									values(p_doc_id, (select nombre from candidato where doc_id = p_doc_id),
										  (select apellidos from candidato where doc_id = p_doc_id),
										  (select email from candidato where doc_id = p_doc_id),
										  (select celular from candidato where doc_id = p_doc_id),p_puesto_id 
										  );
								end if;




END$$
	DELIMITER ;