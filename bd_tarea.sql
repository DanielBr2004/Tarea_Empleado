CREATE DATABASE SENATIDB;
USE SENATIDB;

DROP DATABASE SENATIDB;
CREATE TABLE marcas
(
	idmarca			INT AUTO_INCREMENT PRIMARY KEY,
    marca			VARCHAR(100) NOT NULL,
    create_at       DATETIME     NOT NULL DEFAULT NOW(),
    update_at		DATETIME     NULL,
    inactive_at     DATETIME     NULL,
    CONSTRAINT uk_marca_mar UNIQUE (marca)
)
ENGINE=INNODB;


INSERT INTO marcas(marca)
	VALUES
		('Toyota'),
        ('Nissan'),
        ('Volvo'),
        ('Hyundai'),
        ('Kia');
	
SELECT * FROM marcas;

CREATE TABLE vehiculos
(
	idvehiculo 			INT AUTO_INCREMENT PRIMARY KEY,
    idmarca				INT NOT NULL,
    modelo				VARCHAR(70) NOT NULL,
    color 				VARCHAR(39) NOT NULL,
    tipocombustible		VARCHAR(3)  NOT NULL,
    peso				SMALLINT    NOT NULL,
    afabricacion		CHAR(4)     NOT NULL,
    placa               CHAR(7)     NOT NULL,
    create_at       DATETIME     NOT NULL DEFAULT NOW(),
    update_at		DATETIME     NULL,
    inactive_at     DATETIME     NULL,
    CONSTRAINT fk_marcas FOREIGN KEY (idmarca)REFERENCES marcas(idmarca),
    CONSTRAINT ck_combustible CHECK(tipocombustible	IN('GLP','GNV','GSL','DSL')),
    CONSTRAINT  ck_peso CHECK(peso>0),
    CONSTRAINT uk_placa UNIQUE (placa)

)
ENGINE=INNODB;

INSERT INTO vehiculos (idmarca,modelo,color,tipocombustible,peso,afabricacion,placa)
	VALUES 
		(1,'HILUX','blanco','DSL','1800','2020','ABC-111'),
        (2,'Sentra','gris','GSL','1200','2021','ABC-112'),
        (3,'EX30','negro','GNV','1350','2023','ABC-113'),
        (4,'Tucson','rojo','GLP','1800','2022','ABC-114'),
        (5,'Sportage','blanco','DSL','1500','2010','ABC-115');
        
        
CREATE TABLE SEDES
(
	idsede			INT AUTO_INCREMENT PRIMARY KEY,
	sede			VARCHAR(90),
    create_at       DATETIME     NOT NULL DEFAULT NOW(),
    update_at		DATETIME     NULL,
    inactive_at     DATETIME     NULL
)
ENGINE=INNODB;

INSERT INTO SEDES
		(sede) VALUES
			('CHINCHA'),
            ('ICA'),
            ('PISCO'),
            ('CAÑETE'),
            ('LIMA'),
            ('LA VICTORIA'),
            ('CHINCHA BAJA'),
            ('LURIN');
	
        
CREATE TABLE EMPLEADOS
(
idempleado			INT AUTO_INCREMENT PRIMARY KEY,
idsede				INT NOT NULL,
apellidos			VARCHAR(90) NOT NULL,
nombres				VARCHAR(90) NOT NULL,
ndocumentos			CHAR(8) NOT NULL,
fechaNac			DATE NOT NULL,
telefono			CHAR(9),
create_at       DATETIME     NOT NULL DEFAULT NOW(),
update_at		DATETIME     NULL,
inactive_at     DATETIME     NULL,
CONSTRAINT UK_ndocumentos_EM UNIQUE(ndocumentos),
CONSTRAINT FK_sedes_EM FOREIGN KEY(idsede) REFERENCES SEDES(idsede)
)
ENGINE=INNODB;
	INSERT INTO EMPLEADOS
			(idsede, apellidos, nombres, ndocumentos, fechaNac, telefono)
            VALUES
                (3,'Ortiz','Jayro','76364152','2000/01/01','147852358');
SELECT * FROM EMPLEADOS;

DELIMITER $$
CREATE PROCEDURE spu_empleados_registrar(
 _idsede		INT,
 _apellidos 		VARCHAR(90),
 _nombres       	VARCHAR(90),
 _ndocumentos		CHAR(8),
 _fechaNac		DATE,
 _telefono              CHAR(9)    
 )
BEGIN
	INSERT INTO EMPLEADOS 
		(idsede,apellidos,nombres,ndocumentos,fechaNac,telefono)
	VALUES	(_idsede,_apellidos,_nombres,_ndocumentos,_fechaNac,_telefono);
SELECT @@LAST_INSERT_ID 'idempleado';
END$$
        
        
CALL spu_empleados_registrar (2,'Buleje','Javier','74747474','2002/10/09','147741147');

DELIMITER $$
CREATE PROCEDURE spu_empleados_listar(IN _ndocumentos CHAR(8))
BEGIN
	SELECT 
    EMP.idempleado,
    SED.sede,
    EMP.apellidos,
    EMP.nombres,
    EMP.ndocumentos,
    EMP.fechaNac,
    EMP.telefono
    FROM EMPLEADOS EMP
    INNER JOIN SEDES SED ON SED.idsede= EMP.idsede
    WHERE (EMP.inactive_at IS NULL) AND
          (EMP.ndocumentos=_ndocumentos);
    
END $$

DELIMITER $$
CREATE PROCEDURE spu_empleados_listado()
BEGIN
	SELECT 
    EMP.idempleado,
    SED.sede,
    EMP.apellidos,
    EMP.nombres,
    EMP.ndocumentos,
    EMP.fechaNac,
    EMP.telefono
    FROM EMPLEADOS EMP
    INNER JOIN SEDES SED ON SED.idsede= EMP.idsede
    WHERE EMP.inactive_at IS NULL;
    
END $$

CALL spu_empleados_listado();

CALL spu_empleados_listar ('76364152');

DELIMITER $$
CREATE PROCEDURE spu_vehiculos_listar(IN _placa CHAR(7))
BEGIN
	SELECT 
    VEH.idvehiculo,
    MAR.marca,
    VEH.modelo,
    VEH.color,
    VEH.tipocombustible,
    VEH.peso,
    VEH.afabricacion,
    VEH.placa
    FROM vehiculos VEH
    INNER JOIN marcas MAR ON MAR.idmarca= VEH.idmarca
    WHERE (VEH.inactive_at IS NULL) AND
          (VEH.placa=_placa);
    
END $$

CALL spu_vehiculos_listar('ABC-111');

DELIMITER $$
CREATE PROCEDURE spu_vehiculos_registrar(
 _idmarca			 INT,
 _modelo			VARCHAR(70),
 _color 				VARCHAR(39),
 _tipocombustible       VARCHAR(3),
 _peso				    SMALLINT,
 _afabricacion		    CHAR(4),
 _placa                 CHAR(7)    
 )
BEGIN
	INSERT INTO vehiculos 
		(idmarca,modelo,color,tipocombustible,peso,afabricacion,placa)
	VALUES	(_idmarca,_modelo,_color,_tipocombustible,_peso,_afabricacion,_placa);
SELECT @@LAST_INSERT_ID 'idvehiculo';
END$$
CALL spu_vehiculos_registrar (1,'Supra','Negro','GLP','1800','1998','ABC-116');
CALL spu_vehiculos_registrar (1,'Ranger','Negro','GLP','2600','1998','ABC-118');


CALL spu_vehiculos_listar('ABC-116');

CALL spu_sedes_listar();

DELIMITER $$
CREATE PROCEDURE spu_marcas_listar()
BEGIN
  SELECT idmarca,marca FROM marcas
  WHERE inactive_at IS NULL
  ORDER BY marca;
END$$


DELIMITER $$
CREATE PROCEDURE spu_empleados_cantsedes()
BEGIN
    SELECT sede, COUNT(*) AS cantidad FROM SEDES GROUP BY sede;
END$$

CALL spu_empleados_cantsedes();


DELIMITER ;

DELIMITER $$
CREATE PROCEDURE spu_sedes_listar()
BEGIN
 SELECT idsede,sede FROM SEDES
 WHERE inactive_at IS NULL
 ORDER BY sede;
END$$

CALL spu_marcas_listar();
SELECT * FROM empleados;
SELECT  * FROM vehiculos;