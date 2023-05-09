create table titles(
    idTitles SERIAL primary key,
    name VARCHAR(50),
    importance int,
    input VARCHAR(50)
);

insert into titles values(default,'Nom de la societe',1,'text'),
			 (default,'Objet de la societe',1,'text'),
			 (default,'Adresse',1,'text'),
			(default,'Numero de telephone',1,'text'),
			(default,'Email',1,'email'),
			(default,'Siege',1,'text'),
			(default,'Capital',1,'number'),
			(default,'Devise de tenue de Compte',1,NULL),
			(default,'Devise Equivalence',1,NULL),
			(default,'Date de creation',1,'date')
;

create type etat as Enum ('0','1');

create table titleValues(
    idValues VARCHAR(50) primary key,
    values VARCHAR(100),
    idTitles INTEGER,
    Etat Etat,
    foreign key (idTitles) references titles(idtitles)
);

create table admin(
    idAdmin SERIAL,
    email VARCHAR(50),
    pass VARCHAR(50),
    name VARCHAR(50)
);

insert into admin values(default,'yohanrabepro@gmail.com','admin','admin');

create table employe(
	idEmp VARCHAR(50) primary key,
	nom VARCHAR(50),
	prenom VARCHAR(50),
	dtn DATE,
	telephone VARCHAR(50),
	manager VARCHAR(50),
	poste VARCHAR(50)
);

create table PCG(
  	id SERIAL primary key,
  	numero INTEGER,
  	intitule VARCHAR(100)
);

create table codeJournal(
	id SERIAL primary key,
	numero VARCHAR(20),
	intitule VARCHAR(100)
);

insert into codeJournal values(default,'AC','Achat'),
(default,'VE','Vente'),
(default,'BNI','Banque'),
(default,'OD','Operation diverse'),
(default,'AN','A nouveaux');


create table codetier(
	id SERIAL primary key,
	numero VARCHAR(20),
	intitule VARCHAR(100)
);

create table exercice(
	idExo SERIAL primary key,
	debut DATE,
	fin DATE
);

insert into exercice values(default,'2023-01-01','2023-12-31');

create table journal(
	id SERIAL primary  key,
	idcode INTEGER,
	idExercice INTEGER,
	dateDebut DATE,
	dateCloture DATE,
	foreign key (idcode) references codejournal(id),
	foreign key (idExercice) references exercice(idexo)
);

create table reference(
	idRef SERIAL primary key,
	code VARCHAR(50),
	intitule VARCHAR(100)
);

insert into reference values(default,'AC','Avoir client'),
(default,'AF','Avoir fournisseur'),
(default,'BE','Borderau escompte'),
(default,'CH','Cheque'),
(default,'FC','Facture client'),
(default,'FF','Facture fournisseur'),
(default,'LC','Lettre de change'),
(default,'PC','Piece de caisse'),
(default,'RL','Releve'),
(default,'SA','Salaire'),
(default,'VI','Virement');

create table devise(
	iddevise SERIAL primary key,
	intitule VARCHAR(50),
	typeDevise INTEGER
);

insert into devise values(default,'Ariary',0),
(default,'Euro',1),
(default,'Dollars',1);

create table detailDevise(
	iddetailDevise SERIAL primary key,
	iddevise INTEGER,
	valeur FLOAT,
	jour DATE,
	foreign key (iddevise) references devise(iddevise)
);

insert into detailDevise values(default,2,4800,NOW()),
(default,3,4500,NOW());

create table Ecriture(
	idEcriture SERIAL primary key,
	dateEcriture date,
	idjournal INTEGER,
	reference VARCHAR(100),
	idpcg INTEGER NOT NULL,
	idtier INTEGER, 
	libelle VARCHAR(200),
	iddevise INTEGER default 1,
	montantDevise FLOAT,
	debit FLOAT,
	credit FLOAT,
	foreign key (idjournal) references journal(id),
	foreign key (idpcg) references pcg(id),
	foreign key (idtier) references codetier(id),
	foreign key (iddevise) references devise(iddevise)
);

select Ecriture.*,pcg.intitule as pcg,codetier.intitule as tier,devise.intitule as devise from Ecriture 
join pcg on Ecriture.idpcg=pcg.id 
join codetier on Ecriture.idtier=codetier.id
join devise on devise.iddevise=Ecriture.iddevise
;

select idjournal,sum(debit) as debit,sum(credit) as credit from Ecriture group by idjournal having idjournal=1; 

select pcg.numero,pcg.intitule,sum(debit) as debit,sum(credit) as credit from Ecriture join pcg on pcg.id=Ecriture.idpcg group by pcg.numero,pcg.intitule;

create table property(
	idProp SERIAL primary key,
	debutNumero INTEGER,
	prop VARCHAR(50)
);

insert into property values(default,21,'actif'),
						   (default,40,'passif');