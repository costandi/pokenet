
create table Etat (
	ID_Et int not null primary key auto_increment,
	Nom_Et varchar(20) not null
);

create table Type (
	ID_T int not null primary key auto_increment,
	Nom_T varchar(30) not null
);

create table Sac (
	ID_Sac int not null primary key,
	Pokeball int not null default 0,
	Potion int not null default 0
);


create table Attaques (
	ID_ATK int not null primary key auto_increment,
	Nom_ATK varchar(30) not null,
	Type int not null references Type(ID_T),
	Degats int not null
);



create table Pokedex (
	ID_Pkd int not null primary key auto_increment,
	Nom varchar(30) not null,
	Type int not null references Type(ID_T),
	Type2 int references Type(ID_T)
);



 create table Pokemon (
 	ID_Pkm int not null auto_increment primary key,
 	ID_Pkd int not null references Pokedex(ID),
 	Atk1 int not null references Attaques(ID_ATK),
 	Atk2 int references Attaques(ID_ATK),
 	Atk3 int references Attaques(ID_ATK),
 	Atk4 int references Attaques(ID_ATK),
 	Niveau int not null,
 	PV int not null,
 	Etat int not null references Etat(ID_Etat),
 	KO int not null,
 	vitesse int not null,
 	sauvage int not null
 );


create table Equipe (
	ID_Eq int not null primary key,
	PKM1 int references Pokemon(ID_Pkm),
	PKM2 int references Pokemon(ID_Pkm),
	PKM3 int references Pokemon(ID_Pkm),
	PKM4 int references Pokemon(ID_Pkm),
	PKM5 int references Pokemon(ID_Pkm),
	PKM6 int references Pokemon(ID_Pkm)
);


create table User (
	ID_D int not null primary key auto_increment,
	UserName varchar(40) not null,
	User_MDP varchar(40) not null,
	NumEq int not null references Equipe(ID_Eq),
	NumSac int not null references Sac(ID_Sac),
	QteThune int not null
);
