---------------------------------CRIAÇÃO DO BANCO E USUÁRIO----------------------------------------

CREATE DATABASE ff DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE ff;

DROP USER IF EXISTS 'admrent'@'localhost';

CREATE USER 'admrent'@'localhost' IDENTIFIED BY '12345'; 

GRANT SELECT, INSERT, UPDATE, DELETE ON rent.* TO 'admrent'@'localhost';

-----------------------------------------TPCAMINHAO--------------------------------------------------
CREATE TABLE ff.tpcaminhao ( 
	sig varchar(3)  NOT NULL,
	descr varchar(50)  NOT NULL  ,
	CONSTRAINT pk_tpcaminhao_sigla PRIMARY KEY ( sig )
) engine=InnoDB;

------------------------------------------ESTADO--------------------------------------------------
CREATE TABLE ff.estado ( 
	sigla varchar(3) NOT NULL  ,
	nome varchar(50)  NOT NULL  ,
	CONSTRAINT pk_estado_sigla PRIMARY KEY ( sigla )
) engine=InnoDB;

--------------------------------------------CIDADE------------------------------------------------
CREATE TABLE ff.cidade ( 
	sigla varchar(3) NOT NULL  ,
	nome varchar(50)  NOT NULL  ,
	estado varchar(3)  NOT NULL  ,
	CONSTRAINT pk_cidade_sigla PRIMARY KEY ( sigla )
 ) engine=InnoDB

CREATE INDEX idx_cidade_estado ON ff.cidade ( estado );

ALTER TABLE ff.cidade ADD CONSTRAINT fk_cidade_estado FOREIGN KEY ( estado ) REFERENCES ff.estado( sigla ) ON DELETE NO ACTION ON UPDATE NO ACTION;

--------------------------------------------CAMINHONEIRO----------------------------------------------------
CREATE TABLE ff.caminhoneiro ( 
	cnh                  numeric  NOT NULL  ,
	nome                 varchar(50)  NOT NULL  ,
	fone                 varchar(11)  NOT NULL  ,
	cpf                  numeric  NOT NULL  ,
	email                varchar(30)  NOT NULL  ,
	dtnasc               date NOT NULL  ,
	ender                varchar(50)  NOT NULL  ,
	ender_cida           varchar(3)  NOT NULL  ,
	CONSTRAINT pk_caminhoneiro_cpf PRIMARY KEY ( cpf )
 ) engine=InnoDB;

CREATE INDEX idx_caminhoneiro_ender_cida ON ff.caminhoneiro ( ender_cida );

ALTER TABLE ff.caminhoneiro ADD CONSTRAINT fk_caminhoneiro_cidade FOREIGN KEY ( ender_cida ) REFERENCES ff.cidade( sigla ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE ff.caminhoneiro ADD CONSTRAINT fk_caminhoneiro_cidade FOREIGN KEY ( ender_cida ) REFERENCES ff.cidade( sigla ) ON DELETE NO ACTION ON UPDATE NO ACTION;


-----------------------------------------CAMINHAO-----------------------------------------------
CREATE TABLE ff.caminhao ( 
	model                varchar(30)  NOT NULL  ,
	placa                varchar(7)  NOT NULL  ,
	chass                varchar(17)  NOT NULL  ,
	docum                varchar(15)  NOT NULL  ,
	tipo                 varchar(3)  NOT NULL  ,
	motorista            numeric  NOT NULL  ,
	CONSTRAINT pk_truck_plate PRIMARY KEY ( placa )
 ) engine=InnoDB;

CREATE INDEX idx_caminhao_tipo ON ff.caminhao ( tipo );

CREATE INDEX idx_caminhao_motorista ON ff.caminhao ( motorista );

ALTER TABLE ff.caminhao ADD CONSTRAINT fk_caminhao_tpcaminhao FOREIGN KEY ( tipo ) REFERENCES ff.tpcaminhao( sig ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE ff.caminhao ADD CONSTRAINT fk_caminhao_motorista FOREIGN KEY ( motorista ) REFERENCES ff.caminhoneiro( cpf ) ON DELETE NO ACTION ON UPDATE NO ACTION;


-----------------------------------------TPCARGA---------------------------------------------------
CREATE TABLE ff.tpcarga ( 
	sigla varchar(3) NOT NULL , 
	descr varchar(15) NOT NULL , 
	CONSTRAINT pk_tpcarga_sigla PRIMARY KEY ( sigla ) 
) engine=InnoDB;


----------------------------------------EMPRESA----------------------------------------------------
CREATE TABLE ff.empresa ( 
	cnpj                 numeric  NOT NULL  ,
	nome                 varchar(30)  NOT NULL  ,
	ender                varchar(30)  NOT NULL  ,
	fone                 varchar(11)  NOT NULL  ,
	email                varchar(30)  NOT NULL  ,
	ender_cidad          varchar(3)  NOT NULL  ,
	CONSTRAINT pk_empresa_cnpj PRIMARY KEY ( cnpj )
 ) engine=InnoDB;

CREATE INDEX idx_empresa_ender_cidad ON ff.empresa ( ender_cidad );

ALTER TABLE ff.empresa ADD CONSTRAINT fk_empresa_cidade FOREIGN KEY ( ender_cidad ) REFERENCES ff.cidade( sigla ) ON DELETE NO ACTION ON UPDATE NO ACTION;


-----------------------------------------FRETE-----------------------------------------------------
CREATE TABLE ff.frete ( 
    valor                numeric  NOT NULL  ,
    peso                 numeric  NOT NULL  ,
    volume               numeric  NOT NULL  ,
    ret_local            varchar(3)  NOT NULL  ,
    ent_local            varchar(3)  NOT NULL  ,
    ret_dthr             datetime  NOT NULL  ,
    ent_dthr             datetime    ,
    ciot                 numeric  NOT NULL  ,
    tipo_cami            varchar(3)    ,
    contratante          numeric  NOT NULL  ,
    motorista            numeric    ,
    ret_cidad            varchar(3)  NOT NULL  ,
    ent_cidad            varchar(3)  NOT NULL  ,
    tipo                 varchar(3)  NOT NULL  ,
    CONSTRAINT pk_frete_ciot PRIMARY KEY ( ciot )
 ) engine=InnoDB

CREATE INDEX idx_frete_tipo_cami ON ff.frete ( tipo_cami );

CREATE INDEX idx_frete_motorista ON ff.frete ( motorista );

CREATE INDEX idx_frete_contratante ON ff.frete ( contratante );

CREATE INDEX idx_frete_ret_cidad ON ff.frete ( ret_cidad );

CREATE INDEX idx_frete_ent_cidad ON ff.frete ( ent_cidad );

CREATE INDEX idx_frete_tipo ON ff.frete ( tipo );

ALTER TABLE ff.frete ADD CONSTRAINT fk_frete_tpcaminhao FOREIGN KEY ( tipo_cami ) REFERENCES ff.tpcaminhao( sig ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE ff.frete ADD CONSTRAINT fk_frete_caminhoneiro FOREIGN KEY ( motorista ) REFERENCES ff.caminhoneiro( cpf ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE ff.frete ADD CONSTRAINT fk_frete_empresa FOREIGN KEY ( contratante ) REFERENCES ff.empresa( cnpj ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE ff.frete ADD CONSTRAINT fk_frete_cidade_retirada FOREIGN KEY ( ret_cidad ) REFERENCES ff.cidade( sigla ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE ff.frete ADD CONSTRAINT fk_frete_cidade_entrega FOREIGN KEY ( ent_cidad ) REFERENCES ff.cidade( sigla ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE ff.frete ADD CONSTRAINT fk_frete_tpcarga FOREIGN KEY ( tipo ) REFERENCES ff.tpcarga( sigla ) ON DELETE NO ACTION ON UPDATE NO ACTION;

-------------------------------------------- USUARIO ----------------------------------------------------

CREATE TABLE `ff`.`usuario` ( 
	`email` VARCHAR(50) NOT NULL , 
	`senha` VARCHAR(50) NOT NULL , 
	`fl_tipo` VARCHAR(1) NOT NULL , 
	PRIMARY KEY (`email`)
) ENGINE = InnoDB;

-------------------------------------------- INSERTS ----------------------------------------------------

INSERT INTO `tpcaminhao` (`sig`, `descr`) VALUES 
	('VUC', 'Veículo Urbano de Carga'),
	('CTQ','Caminhão 3/4'),
	('TCO','Semipesado (Toco)'),
	('TRK','Pesado (Truck)'),
	('CRT','Carreta'),
	('CMB','Caminhão Combinado')

INSERT INTO `tpcarga`(`sigla`, `descr`) VALUES
	('FIG','Frigorífica'),
	('GRN','Granel'),
	('VIV','Viva'),
	('IND','Indivisíveis e excepcionais de grande porte'),
	('SEC','Produto seco'),
	('PER','perigosa')

INSERT INTO `estado`(`sigla`, `nome`) VALUES
	('SC','Santa Catarina'),
	('RS','Rio Grande do Sul'),
	('PR','Paraná'),
	('SP','São Paulo')

INSERT INTO `cidade`(`sigla`, `nome`, `estado`) VALUES 
	('XAP','Chapecó','SC'),
	('POA','Porto Alegre','RS'),
	('CBW','Curitiba','PR'),
	('SPO','São Paulo','SP')