drop database if exists PROCESOS;

create database PROCESOS;

use PROCESOS;

create table usuario
(
	USERcod varchar(10) not null,
	USERpassw varchar(20) not null,
	USERnombres varchar(50) null,
	USERapellidos varchar(50) null,
	USERempresa varchar(80) null,
	USERestado char(1) null,
	primary key (USERcod asc)
);

create table proveedor
(
	USERcod varchar(10) not null,
	PRVcod int not null,
	PRVnombre varchar(50),
	PRVdescripcion varchar(100),
	PRVnivel int not null,
	primary key (PRVcod asc, USERcod asc),
	foreign key (USERcod) references usuario(USERcod)
);

create table cliente
(
	USERcod varchar(10) not null,
	CLIcod int not null,
	CLInombre varchar(50) null,
	CLIdescripcion varchar(100) null,
	CLInivel int not null,
	primary key (CLIcod asc, USERcod asc),
	foreign key (USERcod) references usuario(USERcod)
);

create table relation
(
	USERcod varchar(10) not null,
	RELcod int not null,
	RELchild int not null,
	RELparent int not null,
	RELtipo char(1) not null,
	primary key (RELcod asc, USERcod asc),
	foreign key (USERcod) references usuario(USERcod)
);

create table PROCESO
(
	USERcod varchar(10) not null,
	PROCcod int not null,
	PROCkey varchar(50) null,
	PROCnombre varchar(100) null,
	PROCresponsable varchar(100) null,
	PROCcategory varchar(100) null,
	PROCloc varchar(100) null,
	PROCtipo char(1) null,
	PROCesMacro varchar(10) null,
	PROCcodMacro int null,
	PROCestado char(1) null,
	primary key (PROCcod asc, USERcod asc),
	foreign key (USERcod) references usuario(USERcod)
);

create table PROC_RELATION
(
	USERcod varchar(10) not null,
	RELcod int not null,
	PROCcod int not null,
	RELorigen varchar(50) null,
	RELdestino varchar(50) null,
	RELMfromPort varchar(10) null,
	RELMtoPort varchar(10) null,
	primary key (USERcod asc, RELcod asc, PROCcod asc),
	foreign key (PROCcod, USERcod) references PROCESO(PROCcod, USERcod)
);

create table CARACTERIZACION
(
	USERcod varchar(10) not null,
	PROCcod int not null,
	CARmision varchar(1000) null,
	CARempieza varchar(1000)null,
	CARincluye varchar(1000) null,
	CARtermina varchar(1000) null,
	CARproveedores varchar(500) null,
	CARclientes varchar(500) null,
	CARentradas varchar(500) null,
	CARsalidas varchar(500) null,
	CARinspecciones varchar(1000) null,
	CARregistros varchar(1000) null,
	CARvarControl varchar(1000) null,
	CARindicadores varchar(1000) null,
	primary key (PROCcod asc, USERcod asc),
	foreign key (PROCcod, USERcod) references PROCESO(PROCcod, USERcod)
);

create table FLUJO_PROCESO
(
	USERcod varchar(10) not null,
	PROCcod int not null,
	FLUcod int not null,
	FLUdescripcion varchar(200) null,
	FLUestado char(1) null,
	FLUtiempo decimal(9,3),
	FLUunidadTiempo varchar(20),
	primary key (USERcod asc, PROCcod asc, FLUcod asc),
	foreign key (PROCcod, USERcod) references PROCESO(PROCcod, USERcod)
);

create table ACTIVIDADES
(
	USERcod varchar(10) not null,
	PROCcod int not null,
	FLUcod int not null,
	ACTcod int not null,
	ACTdescripcion varchar(200) null,
	ACTtipo char(3) null,
	ACTtiempo decimal(8,3) null,
	ACTrol varchar(50) null,
	primary key (USERcod asc, PROCcod asc, FLUcod asc, ACTcod asc),
	foreign key (USERcod, PROCcod, FLUcod) references FLUJO_PROCESO(USERcod, PROCcod, FLUcod)
);

create table OBJETIVOS
(
	USERcod varchar(10) not null,
	PROCcod int not null,
	OBJcod int not null,
	OBJdescripcion varchar(200) null,
	OBJperspectiva int null,
	OBJdestino int null,
	OBJkey varchar(10) null,
	OBJcategory varchar(50) null,
	OBJposition varchar(50) null,
	primary key (USERcod asc, PROCcod asc, OBJcod asc),
	foreign key (PROCcod, USERcod) references PROCESO(PROCcod, USERcod)
);

create table RELATION_OBJ
(
	USERcod varchar(10) not null,
	PROCcod int not null,
	OBJcod int not null,
	RELcod int not null,
	RELdestino int null,
	RELfromPort varchar(5) null,
	RELtoPort varchar(5) null,
	primary key (USERcod asc, PROCcod asc, OBJcod asc, RELcod asc),
	foreign key (USERcod, PROCcod, OBJcod) references OBJETIVOS(USERcod, PROCcod, OBJcod)
);

create table INDICADORES
(
	USERcod varchar(10) not null,
	PROCcod int not null,
	INDcod int not null,
	INDidentificador varchar(5) null,
	INDobjetivo varchar(300) null,
	INDnombre varchar(300) null,
	INDformula varchar(300) null,
	INDunidadMed varchar(100) null,
	INDlineaBase decimal(10,3) null,
	INDmeta decimal(9,2) null,
	INDfrecMedicion varchar(50) null,
	INDresponsable varchar(200) null,
	INDiniciativas varchar(1000) null,
	INDcondMenor decimal(9,2) null,
	INDcodMayor decimal(9,2) null,
	primary key (USERcod asc, PROCcod asc, INDcod asc),
	foreign key (PROCcod, USERcod) references PROCESO(PROCcod, USERcod)
);


create table HISTORIAL
(
	USERcod varchar(10) not null,
	PROCcod int not null,
	INDcod int not null,
	HISTcod int not null,
	HISTperiodo varchar(50) null,
	HISTvalor decimal(9,2) null,
	HISTcolor varchar(20),
	primary key (USERcod asc, PROCcod asc, INDcod asc, HISTcod asc),
	foreign key (USERcod, PROCcod, INDcod) references INDICADORES(USERcod, PROCcod, INDcod)
);




DELIMITER //
CREATE PROCEDURE SP_account(
	tipo int,
	user varchar(10),
	passw varchar(20),
	nombres varchar(50),
	apellidos varchar(50),
	empresa varchar(80)
)
BEGIN
	if tipo=1 then		-- Registrar usuario
		insert into usuario (USERcod, USERpassw, USERnombres, USERapellidos, USERempresa, USERestado)
			values (user, passw, nombres, apellidos, empresa, 'A');
		insert into proveedor (PRVcod, PRVnombre, PRVdescripcion, PRVnivel, USERcod) 
			values (0, empresa, 'Mi empresa', 0, user);
		insert into cliente (CLIcod, CLInombre, CLIdescripcion, CLInivel, USERcod) 
			values (0, empresa, 'Mi empresa', 0, user);
		-- Insertar contenedores
		insert into PROCESO (USERcod, PROCcod, PROCkey, PROCnombre, PROCresponsable, PROCcategory, PROCloc, PROCtipo, PROCestado)
			values(user, '1', '1', 'Procesos de Apoyo', '', 'ContenedorApoyo', '280 530', 'C', 'C'),
			(user, '2', '2', 'Procesos Primarios', '', 'ContenedorPrimario', '280 270', 'C', 'C'),
			(user, '3', '3', 'Procesos Estratégicos', '', 'ContenedorEstrategico', '280 10', 'C', 'C'),
			(user, '4', '4', 'Start', '', 'Start', '-127 261', 'C', 'C'),
			(user, '5', '5', 'End', '', 'End', '685 260', 'C', 'C');
	end if;
	if tipo=2 then
		select USERcod as 'usuario', USERnombres+' '+USERapellidos as 'nombre', USERempresa as 'empresa' from usuario where USERcod=user and USERpassw=passw;
	end if;
END//

DELIMITER ;


-- ****************************************************
-- PROCEDIMIENTOS ALMACENADOS
-- ****************************************************


DROP PROCEDURE IF EXISTS SP_supplychain;

DELIMITER //

create procedure SP_supplychain
(
	tipo int,
	cod int,
	nivel int,
	tipoRelation char(1),
	usuario varchar(10)
)
BEGIN
	if tipo=1 then		--   listar proveedores
		select PRVcod as 'cod', PRVnombre as 'nombre', PRVdescripcion as 'descripcion', PRVnivel as 'nivel' 
		from proveedor where PRVcod>0 and USERcod=usuario;
	end if;
	if tipo=2 then		--   listar clientes
		select CLIcod 'cod', CLInombre as 'nombre', CLIdescripcion as 'descripcion', CLInivel as 'nivel' 
		from cliente where USERcod=usuario;
	end if;
	if tipo=6 then		--   Eliminar proveedor
		delete from relation where RELchild=cod and RELtipo=tipoRelation and USERcod=usuario;
		delete from relation where RELparent=cod and RELtipo=tipoRelation and USERcod=usuario;
		delete from proveedor where PRVcod=cod and USERcod=usuario;
	end if;
	if tipo=7 then		--   Eliminar cliente
		delete from relation where RELchild=cod and RELtipo=tipoRelation and USERcod=usuario;
		delete from relation where RELparent=cod and RELtipo=tipoRelation and USERcod=usuario;
		delete from cliente where CLIcod=cod and USERcod=usuario;
	end if;
	if tipo=8 then 		--   Eliminar relacion
		delete from relation where RELcod=cod and USERcod=usuario;
	end if;
	if tipo=9 then 		--   Listar posibles destinos de recursos
		select PRVnivel into nivel from proveedor where PRVcod=cod;
		select PRVcod as 'cod', PRVnombre as 'nombre', PRVdescripcion as 'descripcion' 
		from proveedor where PRVnivel<nivel and USERcod=usuario;
	end if;
	if tipo=10 then		--   Listar posibles destinos de clientes
		select CLInivel into nivel from cliente where CLIcod=cod;
		select CLIcod as 'cod', CLInombre as 'nombre', CLIdescripcion as 'descripcion' 
		from cliente where CLInivel>nivel and USERcod=usuario;
	end if;
	if tipo=11 then		--   Listar relacion entre Proveedores
		select	RELcod as 'cod', 
				(select PRVnombre from proveedor where PRVcod=R.RELchild and USERcod=usuario) as 'origen', 
				(select PRVnombre from proveedor where PRVcod=R.RELparent and USERcod=usuario) as 'destino'
		from relation R where RELtipo='P' and USERcod=usuario;
	end if;
	if tipo=12 then		--   Listar relacion entre clientes
		select	RELcod as 'cod', 
				(select CLInombre from cliente where CLIcod=R.RELchild and USERcod=usuario) as 'destino', 
				(select CLInombre from cliente where CLIcod=R.RELparent and USERcod=usuario) as 'origen'
		from relation R where RELtipo='C' and USERcod=usuario;
	end if;
	if tipo=13 then		--   Listar proveedores directos
		select concat('P', cast(R.RELchild as char(3))) as 'child', 
				P.PRVnombre as 'nombre', concat('P', cast(R.RELparent as char(3))) as 'parent'
		from relation R inner join proveedor P on R.RELchild=P.PRVcod and R.USERcod=P.USERcod
		where R.RELtipo='P' and PRVnivel=1 and P.USERcod=usuario;
	end if;
	if tipo=14 then		--   Listar clients directos
		select concat('C', cast(R.RELchild as char(2))) as 'child', 
				C.CLInombre as 'nombre', concat('C', cast(R.RELparent as char(2))) as 'parent'
		from relation R inner join cliente C on R.RELchild=C.CLIcod and R.USERcod=C.USERcod
		where R.RELtipo='C' and C.CLInivel=1 and C.USERcod=usuario;
	end if;
	if tipo=15 then		--   Listar proveedores indirectos
		select concat('P', cast(R.RELchild as char(3))) as 'child', 
				P.PRVnombre as 'nombre', concat('P', cast(R.RELparent as char(3))) as 'parent'
		from relation R inner join proveedor P on R.RELchild=P.PRVcod and R.USERcod=P.USERcod
		where R.RELtipo='P' and P.PRVnivel>1 and P.USERcod=usuario;
	end if;
	if tipo=16 then		--   Listar clientes indirectos
		select concat('C', cast(R.RELchild as char(2))) as 'child', 
				C.CLInombre as 'nombre', concat('C', cast(R.RELparent as char(2))) as 'parent'
		from relation R inner join cliente C on R.RELchild=C.CLIcod and R.USERcod=C.USERcod
		where R.RELtipo='C' and C.CLInivel>1 and C.USERcod=usuario;
	end if;
END//

DELIMITER ;

DROP PROCEDURE IF EXISTS SP_insertSupplychain;
DELIMITER //
create procedure SP_insertSupplychain
(
	tipo int,
	cod int,
	nombre varchar(50),
	descripcion varchar(100),
	nivel int,
	origen int,
	destino int,
	tipoRelation char(1),
	usuario varchar(10)
)
BEGIN
	DECLARE existen int DEFAULT 0;
	if tipo=3 then		--  registrar proveedor
		SELECT ifnull(max(PRVcod)+1,1) into cod from proveedor where USERcod=usuario;
		insert into proveedor (PRVcod, PRVnombre, PRVdescripcion, PRVnivel, USERcod) 
			values (cod, nombre, descripcion, nivel, usuario);
	end if;
	if tipo=4 then		--  registrar cliente
		SELECT ifnull(max(CLIcod)+1,1) into cod from cliente where USERcod=usuario;
		insert into cliente(CLIcod, CLInombre, CLIdescripcion, CLInivel, USERcod) 
			values (cod, nombre, descripcion, nivel, usuario);
	end if;
	if tipo=5 then		--  Registrar relacion
		select count(RELcod) into existen from relation where RELchild=origen and RELparent=destino and RELtipo=tipoRelation and USERcod=usuario;
		if existen=0 then
			SELECT ifnull(max(RELcod)+1,1) into cod from relation where USERcod=usuario;
			if tipoRelation='P' then
				insert into relation (RELcod, RELchild, RELparent, RELtipo, USERcod)
					values (cod, origen, destino, 'P', usuario);
			else
				insert into relation (RELcod, RELchild, RELparent, RELtipo, USERcod)
					values (cod, destino, origen, 'C', usuario);
			END if;
		else
			select 'false';
		end if;
	end if;
END//

DELIMITER ;


-- Procedimientos de procesos, macroprocesos y relaciones
DROP PROCEDURE IF EXISTS SP_procesos;
DELIMITER //
create procedure SP_procesos
(
	tipo int,
	usuario varchar(10),
	cod int,
	PROCtipo char(1),
	PROCcodMacro int,
	relation int,
	destino varchar(50)
) BEGIN
	declare dest int default 0;
	declare caracterizacion int default 0;
	if tipo=1 then		-- listar procesos según tipo
		select P.PROCcod as 'cod', P.PROCnombre as nombre, (case when P.PROCesMacro='true' then 'SI' else 'NO' end) as esMacro, P.PROCresponsable AS responsable, P.PROCestado as estado
		from PROCESO P where USERcod=usuario and P.PROCtipo=PROCtipo;
	end if;	
	if tipo= 3 then		-- detallar macroproceso
		-- Verifica que el subproceso no sea macroproceso y que el macroproceso realmente lo sea
		if (select PROCesMacro from PROCESO where PROCcod=cod and USERcod=usuario)='false' 
			and (select PROCesMacro from PROCESO where PROCcod=PROCcodMacro and USERcod=usuario)='true' then
			update PROCESO set PROCcodMacro=PROCcodMacro where USERcod=usuario and PROCcod=cod;
			-- exec SP_procesos tipo=9, usuario=usuario, cod=cod;
		else
			select 'false';
		end if;
	end if;
	if tipo=4 then		-- Registrar relacion
		select count(*) into dest from PROC_RELATION where USERcod=usuario and PROCcod=cod and RELdestino=destino;
		if dest=0 then	-- Verifica q no se haya registrado la relaciones
			select ifnull(max(RELcod)+1,1) into relation from PROC_RELATION where USERcod=usuario and PROCcod=cod;
			insert into PROC_RELATION (USERcod, RELcod, PROCcod, RELorigen, RELdestino, RELMfromPort, RELMtoPort)
				values (usuario, relation, cod, cod, destino, 'R', 'L');
		else 
			select 'false';
		end if;
		-- exec SP_procesos tipo=9, usuario=usuario, cod=cod;
	end if;
	if tipo=5 then		-- Eliminar proceso
		delete from CARACTERIZACION where PROCcod=cod and USERcod=usuario;
		delete from PROC_RELATION where PROCcod=cod and USERcod=usuario;
		delete from PROC_RELATION where RELdestino=cod and USERcod=usuario;
		if(select PROCesMacro from PROCESO where PROCcod=cod and USERcod=usuario)='true' then
			update PROCESO set PROCcodMacro='0' where PROCcodMacro=cod and USERcod=usuario;
		end if;
		delete from PROCESO where PROCcod=cod and USERcod=usuario;
	end if;
	if tipo=6 then		-- Eliminar relacion
		delete from PROC_RELATION where USERcod=usuario and PROCcod=cod and RELorigen=cod and RELcod=relation;
		-- exec SP_procesos tipo=9, usuario=usuario, cod=cod;
	end if;
	if tipo=7 then		-- Listar procesos disponibles para tener macro proceso
		select PROCnombre as 'nombre', PROCcod as 'cod' from PROCESO 
			where PROCesMacro='false' and PROCcodMacro='0' and PROCtipo=PROCtipo and USERcod=usuario;
	end if;
	if tipo=8 then		-- Listar los subprocesos correspondientes a un macroproceso
		select PROCnombre as 'nombre', PROCcod as 'cod' from PROCESO 
			where PROCesMacro='false' and PROCcodMacro=cod and PROCtipo=PROCtipo and USERcod=usuario;
	end if;
	if tipo=9 then		-- Verificar estado del proceso
		select count(RELdestino) into destino from PROC_RELATION where USERcod=usuario and (RELorigen=cod or PROCcod=cod);
		if(caracterizacion>0 or destino>0) then
			update PROCESO set PROCestado='I' where USERcod=usuario and PROCcod=cod;
		end if;
		if(destino>0 and caracterizacion>0) then
			update PROCESO set PROCestado='F' where USERcod=usuario and PROCcod=cod;
		end if;
	end if;
	if tipo=10 then		-- Listar relaciones de cada tipo de proceso
		select	R.RELcod as 'cod', R.RELorigen as 'origenCod', R.RELdestino as 'destinoCod', P.PROCnombre as 'origen',
				(select PP.PROCnombre from PROCESO PP where PP.PROCcod=R.RELdestino) as 'destino'
			from PROC_RELATION R inner join PROCESO P on P.PROCcod=R.RELorigen and P.USERcod=R.USERcod
			where R.USERcod=usuario and P.PROCtipo=PROCtipo;
	end if;
	if tipo=11 then		-- Limpiar los subprocesos de un macroproceso antes de actulizar sus subprocesos
		update PROCESO set PROCcodMacro = 0
		where PROCcodMacro=PROCcodMacro and USERcod=usuario;
	end if;
	if tipo=12 then		-- Mostrar todos los procesos q pueden ser destinos, excepto el q se indica, 
		select P.PROCnombre as 'nombre', P.PROCcod as 'cod' from proceso P 
			where P.PROCcod<>cod and P.PROCtipo=PROCtipo
				and P.PROCcod not in (select PR.RELdestino from PROC_RELATION PR where PR.RELorigen=cod and PR.USERcod=usuario)
				and P.PROCcod <> (select PM.PROCcodMacro from PROCESO PM where PM.PROCcod=cod and PM.USERcod=usuario)
				and P.PROCcod not in (select SP.PROCcod from PROCESO SP where SP.USERcod=usuario and SP.PROCcodMacro=cod);
	end if;
	if tipo=13 then		-- Listar procesosque no son subprocesos ni macroprocesos para grafico
		select P.PROCcod as 'cod', P.PROCnombre as 'nombre', P.PROCtipo as 'tipo'
			from PROCESO P where P.PROCcodMacro='0' and P.PROCesMacro='false' and USERcod=usuario;
	end if;
	if tipo=14 then		-- Lista macroprocesos para gráfico
		select P.PROCnombre as 'nombre', P.PROCcod as 'cod'
		from PROCESO P WHERE P.PROCesMacro='true' and USERcod=usuario and PROCtipo=PROCtipo;
	end if;
	if tipo=15 then		-- Lista sub procesos para grafico
		select P.PROCcod as 'cod', P.PROCnombre as 'nombre', P.PROCcodMacro as 'macroCod'
			from PROCESO P where P.PROCcodMacro<>'0' and USERcod=usuario;
	end if;
	if tipo=16 then
		select	R.RELorigen as 'origenCod', R.RELdestino as 'destinoCod'
			from PROC_RELATION R
			where R.USERcod=usuario;
	end if;
	if tipo=17 then
		select P.PROCkey, P.PROCcategory, P.PROCloc, P.PROCesMacro, P.PROCcodMacro, P.PROCnombre
			from PROCESO P
			where P.USERcod=usuario and P.PROCtipo<>'C';
	end if;
	if tipo=18 then		-- Listar solo los contenedores para q se muestren en el mapa
		select P.PROCkey, P.PROCcategory, P.PROCloc, P.PROCnombre
			from PROCESO P
			where P.USERcod=usuario and P.PROCtipo='C';
	end if;
	if tipo=20 then		-- Listar las relaciones para el mapa
		select R.RELorigen as 'origen', R.RELdestino as 'destino', R.RELMfromPort as 'from', R.RELMtoPort as 'to' from PROC_RELATION R
		where USERcod=usuario ;
	end if;
	if tipo=21 then		-- Listar las relaciones para el mapa
		select PROCnombre as 'nombre', PROCresponsable as 'responsable', PROCtipo as 'tipo', 
			PROCesMacro as 'esMacro', PROCcodMacro as 'codMacro', PROCestado as 'estado'
		from PROCESO 
		where USERcod=usuario and PROCcod=cod;
	end if;
END//

DELIMITER ;
DROP PROCEDURE IF EXISTS SP_InsertProcesos;
DELIMITER //
create procedure SP_InsertProcesos
(
	tipo int,
	usuario varchar(10),
	cod int,
	PROCcategory varchar(50),
	PROCnombre varchar(100),
	PROCloc varchar(100),
	PROCresponsable varchar(100),
	PROCtipo char(1),
	PROCesMacro varchar(10),
	PROCcodMacro int,
	PROCestado char(1),
	relation int,
	destino varchar(50)
) BEGIN
	if tipo=2 then		-- registrar procesos
		SELECT ifnull(max(PROCcod)+1,1) into cod from PROCESO where USERcod=usuario;
		set PROCloc= coalesce(
			case PROCtipo
				when 'E' then '300 50'
				when 'P' then '300 250'
				when 'A' then '300 500'
				else '0 0'
			end
		);
		if PROCesMacro='SI' then 
			set PROCesMacro='true';
		else 
			set PROCesMacro='false';
		end if;
		insert into PROCESO (PROCcod, USERcod, PROCkey, PROCcategory, PROCnombre, PROCresponsable, PROCloc, PROCtipo,PROCesMacro, PROCcodMacro, PROCestado) 
			values (cod, usuario, cod, PROCcategory, PROCnombre, PROCresponsable, PROCloc, PROCtipo, PROCesMacro, 0, 'C');
		insert into CARACTERIZACION (PROCcod, USERcod, CARmision, CARempieza, CARincluye, CARtermina, CARentradas, CARproveedores, CARsalidas, CARclientes, CARinspecciones,CARregistros, CARvarControl, CARindicadores)
			values (cod, usuario, '', '', '','', '', '', '', '', '', '', '', '');
	end if;
	if tipo=19 then	 	-- Actualizar ubicacion de los nodos
		update PROCESO set PROCloc=PROCloc 
		where USERcod=usuario and PROCcod=cod;
	end if;
END//


DELIMITER ;
DROP PROCEDURE IF EXISTS SP_getHojaCaract;
DELIMITER //
create procedure SP_getHojaCaract
(
	usuario varchar(10),
	cod int
)BEGIN
	-- listar los datos básicos de la hoja
	select P.PROCnombre as 'nombre', P.PROCresponsable as 'responsable', C.CARmision as 'mision',
			C.CARempieza as 'empieza', C.CARincluye as 'incluye', C.CARtermina as 'termina',
			C.CARentradas as 'entradas', C.CARproveedores as 'proveedores', C.CARsalidas as 'salidas',
			C.CARclientes as 'clientes', C.CARinspecciones as 'inspecciones', C.CARregistros as 'registros',
			C.CARvarControl as 'variables', C.CARindicadores as 'indicadores'
		from PROCESO P inner join CARACTERIZACION C on P.PROCcod=C.PROCcod and P.USERcod=C.USERcod
		where P.USERcod=usuario and P.PROCcod=cod;
END//

DELIMITER ;
DROP PROCEDURE IF EXISTS SP_setHojaCaract;

DELIMITER //
create procedure SP_setHojaCaract
(
	usuario varchar(10),
	cod int,
	CARmision varchar(1000),
	CARempieza varchar(1000),
	CARincluye varchar(1000),
	CARtermina varchar(1000),
	CARproveedores varchar(500),
	CARclientes varchar(500),
	CARentradas varchar(500),
	CARsalidas varchar(500),
	CARinspecciones varchar(1000),
	CARregistros varchar(1000),
	CARvarControl varchar(1000),
	CARindicadores varchar(1000)
)BEGIN	
	update CARACTERIZACION set
		CARmision=CARmision,		CARempieza=CARempieza,		CARincluye=CARincluye,
		CARtermina=CARtermina,		CARentradas=CARentradas,	CARproveedores=CARproveedores,
		CARsalidas=CARsalidas,		CARclientes=CARclientes,	CARinspecciones=CARinspecciones,
		CARregistros=CARregistros,	CARvarControl=CARvarControl, CARindicadores=CARindicadores
	where PROCcod=cod and USERcod=usuario;
END//

DELIMITER ;


DROP PROCEDURE IF EXISTS SP_Flujos;

DELIMITER //
create procedure SP_Flujos
(
	tipo int,
	usuario varchar(10),
	codProceso int,
	codFlujo int,
	descripcion varchar(200),
	estado char(1),
	tiempoFlujo decimal(9,3),
	unidadTiempo varchar(20)
) BEGIN
	if tipo=1 then
		select ifnull(max(F.FLUcod)+1,1) into codFlujo from FLUJO_PROCESO F where F.USERcod=usuario and	F.PROCcod=codProceso;
		insert into FLUJO_PROCESO (USERcod, PROCcod, FLUcod, FLUdescripcion, FLUestado, FLUtiempo, FLUunidadTiempo)
			values (usuario, codProceso, codFlujo, descripcion, 'P', 0, unidadTiempo);
	 end if;
	if tipo=2 then
		select F.FLUcod as 'cod', F.FLUdescripcion as 'descripcion', F.FLUunidadTiempo as 'unidadTiempo' 
		from FLUJO_PROCESO F where F.USERcod=usuario and F.PROCcod=codProceso; 
	 end if;
	if tipo=3 then
		if (select count(A.ACTcod) from ACTIVIDADES A where A.PROCcod=codProceso and A.flucod=codFlujo and A.usercod=usuario)>0 then
			select count(AC.ACTcod) as 'cant' from ACTIVIDADES AC where AC.PROCcod=codProceso and AC.FLUcod=codFlujo and AC.USERcod=usuario;
		else
			delete from ACTIVIDADES where PROCcod=codProceso and FLUcod=codFlujo and USERcod=usuario;
			delete from FLUJO_PROCESO where PROCcod=codProceso and FLUcod=codFlujo and USERcod=usuario;
			select count(A.ACTcod) as 'cant' from ACTIVIDADES A where A.PROCcod=codProceso and A.FLUcod=codFlujo and A.USERcod=usuario;
		end if;
	 end if;
END//

DELIMITER ;
DROP PROCEDURE IF EXISTS SP_Actividades;

DELIMITER //
create procedure SP_Actividades
(
	tipo int,
	usuario varchar(10),
	codProceso int,
	codFlujo int,
	codActiv int,
	tiempoAct decimal(8,3),
	tiempoFlujo decimal(8,3)
) BEGIN
	DECLARE anterior decimal(8,3);
	if tipo=1 then
		select	A.ACTcod as 'codActividad', A.ACTdescripcion as 'descripcion', 
				A.ACTtipo as 'tipo', A.ACTrol as 'rol', A.ACTtiempo as 'tiempo', 
				P.PROCnombre as 'proceso', P.PROCcod as 'codProceso', A.FLUcod as 'codFlujo'
		from actividades A inner join PROCESO P on A.USERcod=P.USERcod and A.PROCcod=P.PROCcod
		where A.USERcod=usuario and A.PROCcod=codProceso and A.FLUcod=codFlujo;
	end if;
	if tipo=4 then
		select cast(A.ACTtiempo as decimal(8,3)) into anterior from ACTIVIDADES A 
			where A.ACTcod=codActiv and A.FLUcod=codFlujo and A.PROCcod=codProceso and A.USERcod=usuario;
		update FLUJO_PROCESO set FLUtiempo=tiempoFlujo-ifnull(anterior,0)
			where USERcod=usuario and PROCcod=codProceso and FLUcod=codFlujo;
		delete from ACTIVIDADES where ACTcod=codActiv and FLUcod=codFlujo and PROCcod=codProceso and USERcod=usuario;
	 end if;
	if tipo=5 then		-- Resumen por tipo de actividad
		select ifnull(FLUtiempo,1) into tiempoFlujo from FLUJO_PROCESO 
			where USERcod=usuario and PROCcod=codProceso and FLUcod=codFlujo;
		select (case when A.ACTtipo='OPE' then 'Operación'
				when A.ACTtipo='DEM' then 'Demora'
				when A.ACTtipo='TRA' then 'Trasnporte'
				when A.ACTtipo='INS' then 'Inspección'
				when A.ACTtipo='COM' then 'Oper. combinada'
				else 'Otro tipo de actividad' end)
			as 'tipo', sum(A.ACTtiempo) as 'tiempo', (sum(A.ACTtiempo)*100/tiempoFlujo) as 'porcentaje'
		from ACTIVIDADES A
		where A.USERcod=usuario and A.PROCcod=codProceso and A.FLUcod=codFlujo
		group by A.ACTtipo
		order by A.ACTtiempo desc;
	 end if;
	if tipo=6 then		-- Resumen por tipo de actividad
		select ifnull(FLUtiempo,1) into tiempoFlujo from FLUJO_PROCESO where USERcod=usuario and PROCcod=codProceso and FLUcod=codFlujo;
		select A.ACTrol as 'responsable', sum(A.ACTtiempo) as 'tiempo', (sum(A.ACTtiempo)*100/tiempoFlujo) as 'porcentaje'
		from ACTIVIDADES A
		where A.USERcod=usuario and A.PROCcod=codProceso and A.FLUcod=codFlujo
		group by A.ACTrol
		order by A.ACTtiempo desc;
	 end if;
END//


DELIMITER ;
DROP PROCEDURE IF EXISTS SP_setActividades;

DELIMITER //
create procedure SP_setActividades
(
	tipo int,
	usuario varchar(10),
	codProceso int,
	codFlujo int,
	codActiv int,
	descripcion varchar(200),
	tipoActiv char(3),
	tiempoActiv decimal(8,3),
	rol varchar(50),
	unidadTiempo varchar(20),
	tiempoFlujo decimal(8,3)
) BEGIN
	DECLARE anterior decimal(8,3);
	if tipo=2 then
		select ifnull(max(A.ACTcod)+1,1) into codActiv from actividades A where A.USERcod=usuario and A.PROCcod=codProceso AND A.FLUcod=codFlujo;
		insert into ACTIVIDADES (USERcod, PROCcod, FLUcod, ACTcod, ACTdescripcion, ACTtipo, ACTtiempo, ACTrol)
			values (usuario, codProceso, codFlujo, codActiv, descripcion, 'OPE', '0', rol);
		-- update FLUJO_PROCESO set FLUunidadTiempo=FLUunidadTiempo 
		-- 	where PROCcod=codProceso and FLUcod=FLUcod and USERcod=usuario;
	end if;
	if tipo=3 then
		select ACTtiempo into anterior from ACTIVIDADES 
				where ACTcod=codActiv and FLUcod=codFlujo and PROCcod=codProceso and USERcod=usuario;
		update FLUJO_PROCESO set FLUtiempo=FLUtiempo+cast(tiempoActiv as decimal(8,3))-cast(anterior as decimal(8,3))
			where USERcod=usuario and PROCcod=codProceso and FLUcod=codFlujo;
		update ACTIVIDADES set ACTdescripcion=descripcion, ACTtipo=tipoActiv, ACTrol=rol, ACTtiempo=cast(tiempoActiv as decimal(8,3))
			where ACTcod=codActiv and FLUcod=codFlujo and PROCcod=codProceso and USERcod=usuario;
	end if;	
END//

DELIMITER ;


DROP PROCEDURE IF EXISTS SP_objetivos;

DELIMITER //
create procedure SP_objetivos
(
	tipo int,
	usuario varchar(10),
	codProceso int,
	codObj int,
	perspectiva int,
	codRelation int,
	destino int,
	position varchar(50)
) BEGIN
	if tipo=1 then
		select PROCcod as 'codProceso', OBJcod as 'codObjetivo', OBJdescripcion as 'descripcion', 
			case when OBJperspectiva=1 then 'Financiera'
				 when OBJperspectiva=2 then 'Clientes'
				 when OBJperspectiva=3 then 'Procesos Internos'
				 when OBJperspectiva=4 then 'Aprendizaje'
				 else '' end
			as'perspectiva' , OBJcategory as 'category', OBJposition as 'position'
		from OBJETIVOS
		where USERcod=usuario AND PROCcod=codProceso;
	 end if;
	if tipo=3 then
		if (select count(OBJcod) from RELATION_OBJ where (RELdestino=codObj or OBJcod=codObj) and PROCcod=codProceso and USERcod=usuario)>0 then
			select 'false' as 'rpta';
		else
			delete from RELATION_OBJ where (RELdestino=OBJcod or OBJcod=OBJcod) and PROCcod=codProceso and USERcod=usuario;
			delete from OBJETIVOS where OBJcod=codObj and PROCcod=codProceso and USERcod=usuario;
			select 'true' as 'rpta';
		end if;
	 end if;
	if tipo=4 then
		select OBJperspectiva into perspectiva from OBJETIVOS WHERE USERcod=usuario AND PROCcod=codProceso AND OBJcod=codObj;
		select PROCcod as 'codProceso', OBJcod as 'codObjetivo', OBJdescripcion as 'descripcion', 
			case when OBJperspectiva=1 then 'Financiera'
				 when OBJperspectiva=2 then 'Clientes'
				 when OBJperspectiva=3 then 'Procesos Internos'
				 when OBJperspectiva=4 then 'Aprendizaje'
				 else '' end
			as'perspectiva' from OBJETIVOS
		where USERcod=usuario AND PROCcod=codProceso AND OBJperspectiva<=perspectiva and OBJcod<>codObj and
			OBJcod not in (select RELdestino from RELATION_OBJ where USERcod=usuario AND PROCcod=codProceso AND OBJcod=codObj);
	 end if;
	
	if tipo=6 then
		delete from RELATION_OBJ 
		where USERcod=usuario AND PROCcod=codProceso and OBJcod=codObj;
	end if;
	if tipo=7 then
		select ifnull(max(RELcod)+1,1) into codRelation from RELATION_OBJ where USERcod=usuario and PROCcod=codProceso;
		insert into RELATION_OBJ (USERcod, PROCcod, OBJcod, RELcod, RELdestino, RELfromPort, RELtoPort)
			values(usuario, codProceso, codObj, codRelation, destino, 'T', 'B');
	end if;
	if tipo=8 then
		select RELcod as 'codRelation', OBJcod as 'origen', RELdestino as 'destino', RELfromPort as 'fromPort', RELtoPort as 'toPort'
		from RELATION_OBJ
		where USERcod=usuario and PROCcod=codProceso;
	 end if;
	if tipo=9 then
		update OBJETIVOS set OBJposition=position 
		where USERcod=usuario AND PROCcod=codProceso AND OBJcod=codObj;
	 end if;
	if tipo=5 then
		select O.PROCcod as 'codProceso', O.OBJcod as 'codObjetivo', O.OBJdescripcion as 'descripcion', 
			case when O.OBJperspectiva=1 then 'Financiera'
				 when O.OBJperspectiva=2 then 'Clientes'
				 when O.OBJperspectiva=3 then 'Procesos Internos'
				 when O.OBJperspectiva=4 then 'Aprendizaje'
				 else '' end
			as'perspectiva' 
		from OBJETIVOS O inner join RELATION_OBJ R 
			on O.USERcod=R.USERcod and O.PROCcod=R.PROCcod and O.OBJcod=R.RELdestino
		where R.USERcod=usuario AND R.PROCcod=codProceso and R.OBJcod=codObj;
	end if;
END//

DELIMITER ;
DROP PROCEDURE IF EXISTS SP_setObjetivos;

DELIMITER //
create procedure SP_setObjetivos
( 	tipo int,
	usuario varchar(10),
	codProceso int,
	codObj int,
	descripcion varchar(200),
	perspectiva int,
	keyObj varchar(10),
	category varchar(50),
	position varchar(50),
	codRelation int,
	destino int
)BEGIN
	declare posX decimal(9,2);
	declare posY decimal(9,2);
	select ifnull(max(OBJcod)+1,1) into codObj from OBJETIVOS where USERcod=usuario and PROCcod=codProceso;
	select (case when perspectiva=1 then 'F' when perspectiva=2 then 'C' 
			when perspectiva=3 then 'P' when perspectiva=4 then 'A' end) into category;
	-- if isnull(select max( cast( substring_index(OBJposition, ' ', 1) as decimal(9,2) ) ) from OBJETIVOS) then
	if (select count(*) from OBJETIVOS where USERcod=usuario and PROCcod=codProceso and OBJperspectiva=perspectiva and OBJposition is not null)=0 then
		select concat('80 ', cast(perspectiva*200-50 as char(40))) into position;
	else
		select max(cast(substring_index(O.OBJposition,' ',1) as decimal(9,2)))+20 into posX
			from OBJETIVOS O 
			where O.USERcod=usuario and O.PROCcod=codProceso and O.OBJperspectiva=perspectiva;
		select max(cast(substring_index(O.OBJposition, ' ',-1) as decimal(9,2)))+20 into posY
			from OBJETIVOS O
			where O.USERcod=usuario and O.PROCcod=codProceso and O.OBJperspectiva=perspectiva;
		select concat(cast(posX as char(20)), ' ', + cast(posY as char(20)) ) into position;
	end if;
	insert into OBJETIVOS (USERcod, PROCcod, OBJcod, OBJdescripcion, OBJperspectiva, OBJkey, OBJposition, OBJcategory)
		values (usuario, codProceso, codObj, descripcion, perspectiva, codObj, position, category);
END//

DELIMITER ;

DROP PROCEDURE IF EXISTS SP_indicadores;

DELIMITER //
create procedure SP_indicadores
(
	tipo int,
	usuario varchar(10),
	codProceso int,
	codIndicador int,
	objetivo varchar(300),
	codHistorial int
) BEGIN
	if tipo=1 then
		select I.PROCcod as 'codProceso', I.INDcod as 'codIndicador', I.INDidentificador as 'identificador', I.INDnombre as 'nombre', I.INDformula as 'formula', 
				I.INDunidadMed as 'unidadMed', I.INDmeta as 'meta', I.INDfrecMedicion as 'frecMedicion'
		from INDICADORES I
		where I.USERcod=usuario and I.PROCcod=codProceso;
	 end if;
	if tipo=3 then
		if (select count(*) from HISTORIAL where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador)>0 then
			select 'false' as 'rpta';
		else
			delete from HISTORIAL where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador;
			delete from INDICADORES where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador;
			select 'true' as 'rpta';
		end if;
	end if;
	if tipo=4 then
		select PROCcod as 'codProceso', INDcod as 'codIndicador', HISTcod as 'codHistorial', 
				HISTperiodo AS 'periodo', HISTvalor as 'valor', HISTcolor as 'color'
		from HISTORIAL where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador;
	end if;
	if tipo=6 then
		select I.INDcod as 'codIndicador', ifnull(I.INDformula,'') as 'formula', I.INDfrecMedicion as 'frecMedicion', 
				ifnull(I.INDlineaBase, 0) AS 'lineaBase', ifnull(I.INDiniciativas,0) as 'iniciativas', ifnull(I.INDmeta,'') as 'meta', 
				ifnull(I.INDnombre,0) AS 'nombre', ifnull(I.INDobjetivo,'') as 'objetivo', ifnull(I.INDresponsable,'') as 'responsable', 
				ifnull(I.INDunidadMed,'') AS 'unidadMed', ifnull(I.INDcondMenor, 0) as 'condMenor', ifnull(I.INDcodMayor, 0) as 'condMayor'
		from INDICADORES I
		where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador;
	end if;
	if tipo=8 then
		delete from HISTORIAL where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador and HISTcod=codHistorial;
	end if;
END//


DELIMITER ;
DROP PROCEDURE IF EXISTS SP_setIndicadores;

DELIMITER //
create procedure SP_setIndicadores
(
	tipo int,
	usuario varchar(10),
	codProceso int,
	codIndicador int,
	identificador varchar(5),
	objetivo varchar(300),
	nombre varchar(300),
	formula varchar(300),
	unidadMed varchar(100),
	lineaBase decimal(10,3),
	meta decimal(9,2),
	frecMedicion varchar(50),
	responsable varchar(200),
	iniciativas varchar(1000),
	codHistorial int,
	periodo varchar(50),
	valor decimal(9,2),
	color varchar(20),
	condMenor decimal(9,2),
	condMayor decimal(9,2)
) BEGIN
	if tipo=2 then
		select IFNULL(max(INDcod)+1, 1) into codIndicador from INDICADORES where USERcod=usuario and PROCcod=codProceso;
		select concat('IND0', cast(codIndicador as char(1)) ) into  identificador;
		insert into INDICADORES (USERcod, PROCcod, INDcod, INDidentificador, INDnombre, INDformula, INDunidadMed, INDmeta, 
				INDfrecMedicion, INDobjetivo, INDresponsable, INDiniciativas)
		values (usuario, codProceso, codIndicador, identificador, nombre, formula, unidadMed, meta, frecMedicion, '', '', '' );
	 end if;
	if tipo=5 then
		if (select count(*) from HISTORIAL where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador and HISTperiodo=periodo)>0 then
			select 'false' as 'rpta';
		else
			select INDcondMenor, INDcodMayor into condMenor, condMayor from INDICADORES where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador;
			if condMayor is null or condMenor is null then
				select 'false2' as 'rpta';
			else
				select IFNULL(max(HISTcod)+1, 1) into codHistorial from HISTORIAL where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador;
				select (getColor(codIndicador, codProceso, usuario, valor)) into color;
				insert into HISTORIAL (USERcod, PROCcod,INDcod, HISTcod, HISTperiodo, HISTvalor, HISTcolor)
					values(usuario, codProceso, codIndicador, codHistorial, periodo, valor, color);
				select 'true' as 'rpta';
			end if;
		end if;
	 end if;
	if tipo=7 then
		update INDICADORES set INDformula=formula, INDiniciativas=iniciativas, INDobjetivo=objetivo,
						INDlineaBase=lineaBase, INDmeta=meta, INDnombre=nombre, INDresponsable=responsable,
						INDunidadMed=unidadMed, INDcondMenor=condMenor, INDcodMayor=condMayor
		where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador;
	 end if;
END//


DELIMITER ;
DROP FUNCTION IF EXISTS getColor;

DELIMITER //
create function getColor(codIndicador int, codProceso int, usuario varchar(10), valor int)
	returns varchar(20)
 begin
	declare condMenor decimal(9,2);
	declare condMayor decimal(9,2);
	declare color varchar(20);
	select INDcondMenor, INDcodMayor INTO condMenor, condMayor from INDICADORES 
		where USERcod=usuario and PROCcod=codProceso and INDcod=codIndicador;
	if valor<condMenor then
		set color='red';
	else
		if valor>=condMenor and valor<condMayor then
			set color='yellow';
		else
			set color='green';
		end if;
	end if;
	return color;
 end//


DELIMITER ;
DROP FUNCTION IF EXISTS getIdentificador;

DELIMITER //
create function getIdentificador(codIndicador int, codProceso int, usuario varchar(10), cont int) 
	returns varchar(5)
BEGIN
	declare proceso varchar(100);
	declare aux varchar(100);
	declare indicador varchar(5);
	-- select concat('I', PROCcod) into indicador;
	select PROCnombre into proceso from PROCESO where USERcod=usuario and PROCcod=codProceso;
	select substring(proceso, 0, 3) into indicador;
	select substring(proceso, CHARINDEX(' ', proceso), (len(proceso)-CHARINDEX(' ', proceso)+1)) into proceso;
	if(len(proceso)>0 and cont<=3) then
		select substring(indicador, 0, 3-cont) into indicador;
		select substring(proceso, CHARINDEX(' ', proceso), (len(proceso)-CHARINDEX(' ', proceso)+1)) into proceso;
	end if;
	return indicador;
end//

DELIMITER ;


