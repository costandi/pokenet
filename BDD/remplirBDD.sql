/* USER */
insert into User (UserName, User_MDP, QteThune, dateDeconnexion, dejaJoue)
	values ("root", "cHeA7aUmZS+UW/STRphyTw==", 500, 1557218898, true);
/* FIN USER */

/* SAC */
insert into Sac(Pokeball, Potion)
	values (5,5);
/* FIN SAC */

/* POKEDEX */
insert into Pokedex (nom)
	values ("Bulbizarre");

insert into Pokedex (nom)
	values ("Herbizarre");

insert into Pokedex (nom)
	values ("Florizarre");

insert into Pokedex (nom)
	values ("Salameche");

insert into Pokedex (nom)
	values ("Reptincel");

insert into Pokedex (nom)
	values ("Dracaufeu");

insert into Pokedex (nom)
	values ("Carapuce");

insert into Pokedex (nom)
	values ("Carabaffe");

insert into Pokedex (nom)
	values ("Tortank");
/* FIN POKEDEX */

/* TYPES */
insert into Type(nomT)
	values ("Normal");

insert into Type(nomT)
	values ("Feu");

insert into Type(nomT)
	values ("Eau");

insert into Type(nomT)
	values ("Plante");

insert into Type(nomT)
	values ("Electrik");

insert into Type(nomT)
	values ("Glace");

insert into Type(nomT)
	values ("Combat");

insert into Type(nomT)
	values ("Poison");

insert into Type(nomT)
	values ("Sol");

insert into Type(nomT)
	values ("Vol");

insert into Type(nomT)
	values ("Psy");

insert into Type(nomT)
	values ("Insecte");

insert into Type(nomT)
	values ("Roche");

insert into Type(nomT)
	values ("Spectre");

insert into Type(nomT)
	values ("Dragon");

insert into Type(nomT)
	values ("Ténèbres");

insert into Type(nomT)
	values ("Acier");

/* FIN TYPES */

/* ATTAQUES */
insert into Attaque
	values(-1, "OMAE WA MOU SHINDEIRU", 1, 100);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Griffe", 1, 6);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Charge", 1, 5);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Lance-flamme", 2, 8);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Coup D'Boule", 14, 7);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Yolo", 16, 2);
/* FIN ATTAQUES */

/* ETATS */
insert into Etat (nomEt)
	values ("Poison");


insert into Etat (nomEt)
	values ("Brûlé");


insert into Etat (nomEt)
	values ("Paralisé");


insert into Etat (nomEt)
	values ("Gelé");


insert into Etat (nomEt)
	values ("Endormi");

insert into Etat
	values (-1 ,"Sain");
/* FIN ETATS */

/* POKEMON */
insert into Pokemon (IDPkd_, niveau, PV, etat, KO, vitesse, sauvage)
	values (7, 5, 100, -1, FALSE, 2, FALSE);


insert into Pokemon (IDPkd_, niveau, PV, etat, KO, vitesse, sauvage)
	values (4, 5, 100, -1, FALSE, 2, FALSE);


insert into Pokemon (IDPkd_, niveau, PV, etat, KO, vitesse, sauvage)
	values (7, 5, 100, -1, FALSE, 2, FALSE);
/* FIN POKEMON */

/* POATK */
insert into PoAtk
	values (1, 2);

insert into PoAtk
	values (1, 4);

insert into PoAtk
	values (1, -1);	

insert into PoAtk
	values (2, 3);

insert into PoAtk
	values (3, 1);
/* FIN POATK */

/* POTYPE */
/*herbi----------------------------*/


insert into PoType
	values (1, 4); 

insert into PoType
	values (1, 8);

insert into PoType
	values (2, 4);

insert into PoType
	values (2, 8);

insert into PoType
	values (3, 4);

insert into PoType
	values (3, 8);

/*---------------------------------*/

insert into PoType
	values (4, 2);

insert into PoType
	values (5, 2);

insert into PoType
	values (6, 2);

insert into PoType
	values (6, 10);

/*---------------------------------*/

insert into PoType
	values (7, 3);

insert into PoType
	values (8, 3);

insert into PoType
	values (9, 3);
/* FIN POTYPE */


/* EQUIPE */
insert into Equipe
	values (1, 1, 1);

insert into Equipe
	values (1, 2, 2);

insert into Equipe
	values (1, 3, 3);

insert into Equipe
	values (2, 4, 1);

insert into Equipe
	values (2, 5, 2);
/* FIN EQUIPE */
