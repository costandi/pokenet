/* USER */
insert into User (userName, userMDP, qtteThune, dateDeconnexion, dejaJoue)
	values ("root", "cHeA7aUmZS+UW/STRphyTw==", 9999, 0, 0);
/* FIN USER */

/* SAC */
insert into Sac(Pokeball, Potion)
	values (99,99);
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

insert into Pokedex (nom)
	values ("Chenipan");

insert into Pokedex (nom)
	values ("Chrysacier");

insert into Pokedex (nom)
	values ("Papilusion");

insert into Pokedex (nom)
	values ("Aspicot");

insert into Pokedex (nom)
	values ("Coconfort");

insert into Pokedex (nom)
	values ("Dardargnan");

insert into Pokedex (nom)
	values ("Roucool");

insert into Pokedex (nom)
	values ("Roucoups");

insert into Pokedex (nom)
	values ("Roucarnage");

insert into Pokedex (nom)
	values ("Rattata");

insert into Pokedex (nom)
	values ("Rattatac");

insert into Pokedex (nom)
	values ("Piafabec");

insert into Pokedex (nom)
	values ("Rapasdepic");

insert into Pokedex (nom)
	values ("Abo");

insert into Pokedex (nom)
	values ("Arbok");

insert into Pokedex (nom)
	values ("Pikachu");

insert into Pokedex (nom)
	values ("Raichu");

insert into Pokedex (nom)
	values ("Sabelette");

insert into Pokedex (nom)
	values ("Sablaireau");

insert into Pokedex (nom)
	values ("Nidoran F.");

insert into Pokedex (nom)
	values ("Nidorina");

insert into Pokedex (nom)
	values ("Nidoqueen");

insert into Pokedex (nom)
	values ("Nidoran M.");

insert into Pokedex (nom)
	values ("Nidorino");

insert into Pokedex (nom)
	values ("Nidoking");

insert into Pokedex (nom)
	values ("Mélofée");

insert into Pokedex (nom)
	values ("Mélodelfe");

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

insert into Type(nomT)
	values ("Fee");

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
	values("Pistolet à O", 3, 7);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Fouet lianes", 4, 2);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Eclair", 5, 4);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Laser Glace", 6, 8);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Balayage", 7, 10);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Pic venin", 8, 2);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Seisme", 9, 13);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Aeropique", 10, 7);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Psycho", 11, 8);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Taillade", 12, 5);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Eboulement", 13, 9);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Lechouille", 14, 6);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Ouragan", 15, 9);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Morsure", 16, 8);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Queue de fer", 17, 8);

insert into Attaque (nomAtk, typeAtk, degats)
	values("Vent féerique", 18, 9);
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
/*insert into Pokemon (IDPkd_, niveau, PV, etat, KO, vitesse, sauvage)
	values (7, 5, 100, -1, FALSE, 2, FALSE);


insert into Pokemon (IDPkd_, niveau, PV, etat, KO, vitesse, sauvage)
	values (4, 5, 100, -1, FALSE, 2, FALSE);


insert into Pokemon (IDPkd_, niveau, PV, etat, KO, vitesse, sauvage)
	values (7, 5, 100, -1, FALSE, 2, FALSE);*/
/* FIN POKEMON */

/* POATK */
/*insert into PoAtk
	values (1, 2);

insert into PoAtk
	values (1, 4);

insert into PoAtk
	values (1, -1);	

insert into PoAtk
	values (2, 3);

insert into PoAtk
	values (3, 1);*/
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

/*---------------------------------*/

insert into PoType
	values (10, 12);

insert into PoType
	values (11, 12);

insert into PoType
	values (12, 12);

insert into PoType
	values (12, 10);

/*---------------------------------*/

insert into PoType
	values (13, 12);

insert into PoType
	values (13, 8);

insert into PoType
	values (14, 12);

insert into PoType
	values (14, 8);

insert into PoType
	values (15, 12);

insert into PoType
	values (15, 8);

/*---------------------------------*/

insert into PoType
	values (16, 1);

insert into PoType
	values (16, 10);

insert into PoType
	values (17, 1);

insert into PoType
	values (17, 10);

insert into PoType
	values (18, 1);

insert into PoType
	values (18, 10);

/*---------------------------------*/

insert into PoType
	values (19, 1);

insert into PoType
	values (20, 1);

/*---------------------------------*/

insert into PoType
	values (21, 1);

insert into PoType
	values (21, 10);

insert into PoType
	values (22, 1);

insert into PoType
	values (22, 10);

/*---------------------------------*/

insert into PoType
	values (23, 8);

insert into PoType
	values (24, 8);

/*---------------------------------*/

insert into PoType
	values (25, 5);

insert into PoType
	values (26, 5);

/*---------------------------------*/

insert into PoType
	values (27, 9);

insert into PoType
	values (28, 9);

/*---------------------------------*/

insert into PoType
	values (29, 8);

insert into PoType
	values (30, 8);

insert into PoType
	values (31, 8);

insert into PoType
	values (31, 9);

/*---------------------------------*/

insert into PoType
	values (32, 8);

insert into PoType
	values (33, 8);

insert into PoType
	values (34, 8);

insert into PoType
	values (34, 9);

/*---------------------------------*/

insert into PoType
	values (35, 18);

insert into PoType
	values (36, 18);

/* FIN POTYPE */


/* EQUIPE */
/*insert into Equipe
	values (1, 1, 1);

insert into Equipe
	values (1, 2, 2);

insert into Equipe
	values (1, 3, 3);

insert into Equipe
	values (2, 4, 1);

insert into Equipe
	values (2, 5, 2);*/
/* FIN EQUIPE */

/* POATKPOSSIBLE */

/* bulbizarre */
insert into PoAtkPossible
	values (1, 2);
insert into PoAtkPossible
	values (1, 5);
insert into PoAtkPossible
	values (1, 9);
insert into PoAtkPossible
	values (1, 17);

/* herbizarre */
insert into PoAtkPossible
	values (2, 2);
insert into PoAtkPossible
	values (2, 5);
insert into PoAtkPossible
	values (2, 9);
insert into PoAtkPossible
	values (2, 17);

/* florizarre */
insert into PoAtkPossible
	values (3, 2);
insert into PoAtkPossible
	values (3, 5);
insert into PoAtkPossible
	values (3, 9);
insert into PoAtkPossible
	values (3, 17);


/* salameche */
insert into PoAtkPossible
	values (4, 1);
insert into PoAtkPossible
	values (4, 3);
insert into PoAtkPossible
	values (4, 17);

/* reptincel */
insert into PoAtkPossible
	values (5, 1);
insert into PoAtkPossible
	values (5, 3);
insert into PoAtkPossible
	values (5, 17);

/* dracaufeu */
insert into PoAtkPossible
	values (6, 1);
insert into PoAtkPossible
	values (6, 3);
insert into PoAtkPossible
	values (6, 17);
insert into PoAtkPossible
	values (6, 11);

/* carapuce */
insert into PoAtkPossible
	values (7, 1);
insert into PoAtkPossible
	values (7, 4);
insert into PoAtkPossible
	values (7, 7);
insert into PoAtkPossible
	values (7, 17);

/* carabaffe */
insert into PoAtkPossible
	values (8, 1);
insert into PoAtkPossible
	values (8, 4);
insert into PoAtkPossible
	values (8, 7);
insert into PoAtkPossible
	values (8, 17);

/* tortank */
insert into PoAtkPossible
	values (9, 1);
insert into PoAtkPossible
	values (9, 4);
insert into PoAtkPossible
	values (9, 7);
insert into PoAtkPossible
	values (9, 17);

/* chenipan */
insert into PoAtkPossible
	values (10, 2);
insert into PoAtkPossible
	values (10, 9);
insert into PoAtkPossible
	values (10, 13);

/* chrisacier */
insert into PoAtkPossible
	values (11, 2);
insert into PoAtkPossible
	values (11, 9);
insert into PoAtkPossible
	values (11, 13);

/* papilusion */
insert into PoAtkPossible
	values (12, 2);
insert into PoAtkPossible
	values (12, 9);
insert into PoAtkPossible
	values (12, 13);

/* aspicot */
insert into PoAtkPossible
	values (13, 2);
insert into PoAtkPossible
	values (13, 9);
insert into PoAtkPossible
	values (13, 13);

/* coconfort */
insert into PoAtkPossible
	values (14, 2);
insert into PoAtkPossible
	values (14, 9);
insert into PoAtkPossible
	values (14, 13);

/* dardargnan */
insert into PoAtkPossible
	values (15, 2);
insert into PoAtkPossible
	values (15, 9);
insert into PoAtkPossible
	values (15, 13);
insert into PoAtkPossible
	values (15, 11);

/* roucool */
insert into PoAtkPossible
	values (16, 1);
insert into PoAtkPossible
	values (16, 11);

/* roucoups */
insert into PoAtkPossible
	values (17, 1);
insert into PoAtkPossible
	values (17, 11);

/* roucarnage */
insert into PoAtkPossible
	values (18, 1);
insert into PoAtkPossible
	values (18, 11);

/* rattata */
insert into PoAtkPossible
	values (19, 2);
insert into PoAtkPossible
	values (19, 17);

/* rattatac */
insert into PoAtkPossible
	values (20, 2);
insert into PoAtkPossible
	values (20, 17);

/* piafabec */
insert into PoAtkPossible
	values (21, 1);
insert into PoAtkPossible
	values (21, 11);

/* rapasdepic */
insert into PoAtkPossible
	values (22, 1);
insert into PoAtkPossible
	values (22, 11);

/* abo */
insert into PoAtkPossible
	values (23, 2);
insert into PoAtkPossible
	values (23, 8);
insert into PoAtkPossible
	values (23, 16);

/* arbok */
insert into PoAtkPossible
	values (24, 2);
insert into PoAtkPossible
	values (24, 8);
insert into PoAtkPossible
	values (24, 16);

/* pikachu */
insert into PoAtkPossible
	values (25, 1);
insert into PoAtkPossible
	values (25, 2);
insert into PoAtkPossible
	values (25, 6);
insert into PoAtkPossible
	values (25, 17);
insert into PoAtkPossible
	values (25, 18);

/* raichu */
insert into PoAtkPossible
	values (26, 1);
insert into PoAtkPossible
	values (26, 2);
insert into PoAtkPossible
	values (26, 6);
insert into PoAtkPossible
	values (26, 17);
insert into PoAtkPossible
	values (26, 18);

/* sablette */
insert into PoAtkPossible
	values (27, 1);
insert into PoAtkPossible
	values (27, 2);
insert into PoAtkPossible
	values (27, 10);
insert into PoAtkPossible
	values (27, 13);
insert into PoAtkPossible
	values (27, 14);
insert into PoAtkPossible
	values (27, 16);
insert into PoAtkPossible
	values (27, 17);

/* sablaireau */
insert into PoAtkPossible
	values (28, 1);
insert into PoAtkPossible
	values (28, 2);
insert into PoAtkPossible
	values (28, 10);
insert into PoAtkPossible
	values (28, 13);
insert into PoAtkPossible
	values (28, 14);
insert into PoAtkPossible
	values (28, 16);
insert into PoAtkPossible
	values (28, 17);

/* nidoran f. */
insert into PoAtkPossible
	values (29, 1);
insert into PoAtkPossible
	values (29, 8);
insert into PoAtkPossible
	values (29, 9);

/* nidorina */
insert into PoAtkPossible
	values (30, 1);
insert into PoAtkPossible
	values (30, 8);
insert into PoAtkPossible
	values (30, 9);

/* nidoqueen */
insert into PoAtkPossible
	values (31, 1);
insert into PoAtkPossible
	values (31, 8);
insert into PoAtkPossible
	values (31, 9);

/* nidoran m. */
insert into PoAtkPossible
	values (32, 1);
insert into PoAtkPossible
	values (32, 8);
insert into PoAtkPossible
	values (32, 9);

/* nidorino */
insert into PoAtkPossible
	values (33, 1);
insert into PoAtkPossible
	values (33, 8);
insert into PoAtkPossible
	values (33, 9);

/* nidoking */
insert into PoAtkPossible
	values (34, 1);
insert into PoAtkPossible
	values (34, 8);
insert into PoAtkPossible
	values (34, 9);

/* melofee */
insert into PoAtkPossible
	values (35, 2);
insert into PoAtkPossible
	values (35, 8);
insert into PoAtkPossible
	values (35, 12);
insert into PoAtkPossible
	values (35, 19);

/* melodelfe */
insert into PoAtkPossible
	values (36, 2);
insert into PoAtkPossible
	values (36, 8);
insert into PoAtkPossible
	values (36, 12);
insert into PoAtkPossible
	values (36, 19);

/* FIN POATKPOSSIBLE */