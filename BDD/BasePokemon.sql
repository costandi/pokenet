
create table Etat (
	IDEt int not null primary key auto_increment,
	nomEt varchar(20) not null
);

create table Type (
	IDT int not null primary key auto_increment,
	nomT varchar(30) not null
);

create table Sac (
	IDSac int not null primary key auto_increment,
	pokeball int not null,
	potion int not null
);


create table Attaque (
	IDAtk int not null primary key auto_increment,
	nomAtk varchar(30) not null,
	typeAtk int not null references Type(IDT),
	degats int not null
);



create table Pokedex (
	IDPkd int not null primary key auto_increment,
	nom varchar(30) not null
);



create table Pokemon (
	IDPkm int not null auto_increment primary key,
	IDPkd_ int not null references Pokedex(IDPkd),
	niveau int not null,
	PV int not null,
	etat int not null references Etat(IDEt),
	KO boolean not null,
	vitesse int not null,
	sauvage boolean not null
);


create table Equipe (
	IDEq int not null auto_increment,
	IDPkmEq int references Pokemon(IDPkm),
	primary key (IDEq, IDPkmEQ)
);


create table User (
	IDD int not null primary key auto_increment,
	userName varchar(40) not null,
	userMDP varchar(40) not null,
	qtteThune int not null
);

create table PoAtk (
	IDPkmPA int references Pokemon(IDPkm),
	IDAtkPA int references Attaque(IDAtk),
	PRIMARY KEY(IDPkmPA, IDAtkPA)
);

create table PoType (
	IDPkdPT int references Pokedex(IDPkd),
	IDTypePT int references Type(IDT),
	PRIMARY KEY(IDPkdPT, IDTypePT)
);



create table PC (
	IDPC int not null auto_increment,
	PCPkm int not null references Pokemon(IDPkm),
	primary key (IDPC, PCPkm)

);