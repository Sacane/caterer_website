CREATE TABLE client(
    num_client serial PRIMARY KEY,
    nom_client VARCHAR(100) NOT NULL,
    prenom VARCHAR(25),
    adresse VARCHAR(100) NOT NULL,
    telephone VARCHAR(25) NOT NULL, --on utilise un varchar au cas où un numero non français est entré +...
    numCarte VARCHAR(25) NOT NULL,
    num_crypto VARCHAR(25) NOT NULL
);

CREATE TABLE plat(
    id_plat serial PRIMARY KEY,
    nom_plat varchar(100) NOT NULL,
    prix_TTC float NOT NULL,
    categorie varchar(100) NOT NULL, --entrée, plat principale, déssert
    description Text NOT NULL,
    lienImg VARCHAR(1000) NOT NULL
);

CREATE TABLE label(
    id_label serial PRIMARY KEY,
    nom_label VARCHAR(100) NOT NULL

);

CREATE TABLE ingredient(
    id_ingre serial PRIMARY KEY,
    nom_ingre VARCHAR(100) NOT NULL,
    stock float NOT NULL,
    localite boolean NOT NULL -- après correction rajout de la colonne localite pour renseigner si oui ou non le plat ou l'ingrédient est local.

);

CREATE TABLE allergene(
    id_allergene serial PRIMARY KEY,
    nom_aller VARCHAR(100)

);

CREATE TABLE grossiste(
    id_grossiste int PRIMARY KEY,
    nom_grossiste VARCHAR(100),
    telephone VARCHAR(25) NOT NULL
);

CREATE TABLE traiteur(
  id_traiteur int PRIMARY KEY,
  nom_traiteur varchar(25) NOT NULL,
  prenom_traiteur varchar(25) NOT NULL
);

CREATE TABLE commander(
  num_client int REFERENCES client(num_client) ON DELETE SET DEFAULT ON UPDATE CASCADE,  --DEFAULT --> Quand le client a fini sa commande, on le preserve tout de même dans l'historique de la bdd.
  id_plat int REFERENCES plat(id_plat) ON DELETE SET DEFAULT ON UPDATE CASCADE,  --De même on préfèrera préservera l'historique des plats commandé selon les clients.
  quantite float CHECK (quantite>0),
  livraison boolean NOT NULL,
  etat varchar(100) NOT NULL,
  date_livraison date,
  PRIMARY KEY (num_client, id_plat)
);

CREATE TABLE labeliser(
  id_label int REFERENCES label(id_label) ON DELETE CASCADE ON UPDATE CASCADE,
  id_ingre int REFERENCES ingredient(id_ingre) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (id_label, id_ingre)

);

CREATE TABLE contenir(
  id_allergene int REFERENCES allergene(id_allergene) ON DELETE CASCADE ON UPDATE CASCADE,
  id_ingre int REFERENCES ingredient(id_ingre) ON DELETE CASCADE ON UPDATE CASCADE,
  PRIMARY KEY (id_allergene, id_ingre)
);

CREATE TABLE composer(
  id_plat int REFERENCES plat(id_plat) ON DELETE CASCADE ON UPDATE CASCADE,
  id_ingre int REFERENCES ingredient(id_ingre) ON DELETE CASCADE ON UPDATE CASCADE,
  quantite float CHECK (quantite>0) NOT NULL, --l'unité depend de l'ingredient ex: 3 oeufs, 100 g de chocolat.
  PRIMARY KEY (id_plat, id_ingre)
);

CREATE TABLE approvisionner(
  id_ingre int REFERENCES ingredient(id_ingre) ON DELETE CASCADE ON UPDATE CASCADE,
  id_grossiste int REFERENCES grossiste(id_grossiste) ON DELETE CASCADE ON UPDATE CASCADE,
  date_livraison timestamp,
  quantite float CHECK (quantite>0) NOT NULL,
  PRIMARY KEY (id_ingre, id_grossiste)
);


/*INSERT INTO client(nom_client, prenom, adresse, telephone) VALUES('RAMAROSON RAKOTOMIHAMINA', 'Johan', '33 rue des hauts de chantereine', '0612345684');
INSERT INTO client(nom_client, prenom, adresse, telephone) VALUES('OSAJ', 'XHAVIT', '1 rue andré chenier', '0712345678');*/

INSERT INTO plat(nom_plat, prix_ttc, categorie, description, lienImg)
VALUES('Fondant au chocolat', 4.5, 'dessert', 'Un fondant au chocolat est un gateau ayant un coeur liquide et qui fond dans la bouche.', 'https://static.cuisineaz.com/400x320/i75546-fondant-au-chocolat-de-delphine.jpg');
INSERT INTO plat(nom_plat, prix_ttc, categorie, description, lienImg)
VALUES('Spaghetti bio', 8.5, 'plat principale', 'Plat italien à base de pates bio.', 'https://files.meilleurduchef.com/mdc/photo/recette/spaghetti-ail/spaghetti-ail-640.jpg');
INSERT INTO plat(nom_plat, prix_ttc, categorie, description, lienImg)
VALUES('Tiramisu', 5, 'dessert', 'Tiramisu au cafe noir et cacao.', 'https://static.cuisineaz.com/400x320/i136824-tiramisu-au-cacao-et-au-cafe.jpeg');
INSERT INTO plat(nom_plat, prix_ttc, categorie, description, lienImg)
VALUES('Pizza pepperoni', 7, 'plat principale', 'Pizza a patte epaisse.', 'https://www.atelierdeschefs.com/media/recette-e30299-pizza-pepperoni-tomate-mozza.jpg');
INSERT INTO plat(nom_plat, prix_ttc, categorie, description, lienImg)
VALUES('Salade feta', 3.5, 'entree', 'Salade a base de Feta, celebre fromage originaire de Grece.', 'https://static.cuisineaz.com/400x320/i32591-salade-a-la-feta-et-au-jambon.jpg');
INSERT INTO plat(nom_plat, prix_ttc, categorie, description, lienImg)
VALUES('Verrines surimi, crevettes', 4, 'entree', 'Verrine au surimi, crevette, aux petits pois et mais.', 'https://assets.afcdn.com/recipe/20191129/103143_w350h250c1cx2136cy1424.jpg');
INSERT INTO plat(nom_plat, prix_TTC, categorie, description, lienImg)
VALUES('Chevre en feuillete', 3, 'entree', 'Pate feuillete avec du fromage de chevre et du basilic.', 'https://assets.afcdn.com/recipe/20160805/54703_w420h344c1cx2000cy3000.jpg');
INSERT INTO plat(nom_plat, prix_TTC, categorie, description, lienImg)
VALUES('Poulet basquaise', 8, 'plat principale', 'Poulet avec des legumes au couleur du pays Basque.', 'https://assets.afcdn.com/recipe/20170614/69328_w420h344c1cx2000cy3000.jpg');
INSERT INTO plat(nom_plat, prix_TTC, categorie, description, lienImg)
VALUES('Tarte aux pommes alsacienne', 5, 'dessert', 'Tarte aux pommes à l alsacienne.', 'https://assets.afcdn.com/recipe/20191119/102677_w350h250c1cx4330cy2886cxt0cyt0cxb8660cyb5773.jpg');
INSERT INTO plat(nom_plat, prix_TTC, categorie, description, lienImg)
VALUES('Tarte chocolat-poire', 5, 'dessert', 'Tarte aux chocolat et à la poire.', 'https://assets.afcdn.com/recipe/20171024/73829_w420h344c1cx2592cy1728cxt0cyt0cxb5184cyb3456.jpg');
INSERT INTO plat(nom_plat, prix_TTC, categorie, description, lienImg)
VALUES('Tapillote de saumon à la mozzarella', 9, 'plat principale', 'Pavé de saumon avec de la mozzarella et des herbes de provence.', 'https://assets.afcdn.com/recipe/20180518/79162_w420h344c1cx2000cy3000cxt0cyt0cxb4000cyb6000.jpg');
INSERT INTO plat(nom_plat, prix_TTC, categorie, description, lienImg)
VALUES('Tatin de magret de canard au foie gras', 7, 'entree', 'Magret de canard fume au foie gras.', 'https://assets.afcdn.com/recipe/20130122/64052_w420h344c1cx876cy823.jpg');

INSERT INTO label(nom_label) VALUES('Label_rouge');
INSERT INTO label(nom_label) VALUES('A.O.C');
INSERT INTO label(nom_label) VALUES('BIO');

INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('chocolat', 10000, 'TRUE'); --1
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('sucre', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('oeufs', 100, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('spaghetti', 10, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('sel', 10000, 'FALSE'); --5
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('creme fraiche', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('eau', 100, 'FALSE'); --On va considérer que l'eau est en nombre illimité, ici 100 désigne 100 litres, on réapprovisionnera a chaque fois.
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('mascarpone', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('bisuit à la cuillère', 100, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('sachet de sucre vanille', 100, 'FALSE'); --10
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('sucre roux', 10000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('cafe noir', 1000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('cacao', 10000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('farine', 10000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('huile d olive', 10000, 'TRUE'); --15
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('sachet de levure boulangère', 100, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('fromage feta', 10000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('concombre', 100, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('tomate', 100, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('poivron rouge', 50, 'TRUE'); --20
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('olive noire', 1000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('vinaigre', 10000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('batonnêt de surimi', 10000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('petits pois', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('crevette', 100, 'FALSE'); --25
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('botte de persil', 50, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('mayonnaise', 10000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('maïs', 10000, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('fromage de chevre', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('pate feuillete', 100, 'TRUE'); --30
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('basilic', 100, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('poulet', 50, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('oignons', 100, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('gousses d ail', 100, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('vin blanc', 10000, 'TRUE'); --35
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('bouquet garni', 100, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('poivre', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('pommes', 100, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('pate brisee', 100, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('creme fraiche', 10000, 'TRUE'); --40
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('poivre', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('pepperoni', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('pate sable', 100, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('lait', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('poire', 100, 'TRUE'); --45
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('pave de saumon', 20, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('boule de mozzarella', 50, 'FALSE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('herbe de provence', 1000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('magret de canard', 20, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('tranche de pain de mie', 1000, 'TRUE'); --50
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('tranche de foie gras', 50, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('alcool de pomme', 10000, 'TRUE');
INSERT INTO ingredient(nom_ingre, stock, localite) VALUES('beurre', 10000, 'TRUE');

INSERT INTO allergene(nom_aller) VALUES('gluten');
INSERT INTO allergene(nom_aller) VALUES('oeufs');
INSERT INTO allergene(nom_aller) VALUES('lait');
INSERT INTO allergene(nom_aller) VALUES('cafeine');
INSERT INTO allergene(nom_aller) VALUES('anhydride sulfureux et sulfites');

INSERT INTO grossiste VALUES(1, 'Samy', '0600000000');

INSERT INTO traiteur(id_traiteur, nom_traiteur, prenom_traiteur) VALUES(1, 'Dupond', 'Pierre');

/*INSERT INTO commander VALUES(1, 1, 1, 'TRUE', 'en cours de preparation', '22/11/2019');
INSERT INTO commander VALUES(2, 2, 2, 'FALSE', 'livré', '21/11/2019');*/

INSERT INTO labeliser VALUES(1, 3);
INSERT INTO labeliser VALUES(2, 4);
INSERT INTO labeliser VALUES(2, 9);
INSERT INTO labeliser VALUES(3, 12);
INSERT INTO labeliser VALUES(1, 14);
INSERT INTO labeliser VALUES(3, 15);
INSERT INTO labeliser VALUES(3, 18);
INSERT INTO labeliser VALUES(3, 19);
INSERT INTO labeliser VALUES(3, 20);
INSERT INTO labeliser VALUES(3, 21);
INSERT INTO labeliser VALUES(3, 24);
INSERT INTO labeliser VALUES(3, 26);
INSERT INTO labeliser VALUES(2, 29);
INSERT INTO labeliser VALUES(3, 29);
INSERT INTO labeliser VALUES(3, 31);
INSERT INTO labeliser VALUES(1, 32);
INSERT INTO labeliser VALUES(2, 32);
INSERT INTO labeliser VALUES(3, 32);
INSERT INTO labeliser VALUES(3, 33);
INSERT INTO labeliser VALUES(3, 34);
INSERT INTO labeliser VALUES(2, 35);
INSERT INTO labeliser VALUES(3, 36);
INSERT INTO labeliser VALUES(3, 38);
INSERT INTO labeliser VALUES(2, 40);
INSERT INTO labeliser VALUES(3, 40);
INSERT INTO labeliser VALUES(2, 42);
INSERT INTO labeliser VALUES(2, 44);
INSERT INTO labeliser VALUES(3, 44);
INSERT INTO labeliser VALUES(3, 45);
INSERT INTO labeliser VALUES(1, 46);
INSERT INTO labeliser VALUES(2, 47);
INSERT INTO labeliser VALUES(1, 49);
INSERT INTO labeliser VALUES(2, 49);
INSERT INTO labeliser VALUES(3, 49);
INSERT INTO labeliser VALUES(1, 51);
INSERT INTO labeliser VALUES(2, 51);
INSERT INTO labeliser VALUES(3, 51);
INSERT INTO labeliser VALUES(2, 52);
INSERT INTO labeliser VALUES(3, 52);
INSERT INTO labeliser VALUES(3, 53);

INSERT INTO contenir VALUES(1, 4);
INSERT INTO contenir VALUES(2, 3);
INSERT INTO contenir VALUES(3, 9);
INSERT INTO contenir VALUES(4, 12);
INSERT INTO contenir VALUES(1, 14);
INSERT INTO contenir VALUES(3, 17);
INSERT INTO contenir VALUES(5, 23);
INSERT INTO contenir VALUES(5, 25);
INSERT INTO contenir VALUES(2, 27);
INSERT INTO contenir VALUES(3, 29);
INSERT INTO contenir VALUES(1, 30);
INSERT INTO contenir VALUES(3, 40);
INSERT INTO contenir VALUES(3, 44);
INSERT INTO contenir VALUES(5, 46);
INSERT INTO contenir VALUES(3, 47);
INSERT INTO contenir VALUES(1, 50);
INSERT INTO contenir VALUES(3, 53);

INSERT INTO composer VALUES(1, 1, 600);
INSERT INTO composer VALUES(1, 2, 200);
INSERT INTO composer VALUES(1, 3, 8);
INSERT INTO composer VALUES(2, 4, 1);
INSERT INTO composer VALUES(2, 5, 100);
INSERT INTO composer VALUES(2, 6, 100);
INSERT INTO composer VALUES(2, 7, 0.5);
INSERT INTO composer VALUES(3, 8, 250);
INSERT INTO composer VALUES(3, 9, 24);
INSERT INTO composer VALUES(3, 10, 1);
INSERT INTO composer VALUES(3, 11, 100);
INSERT INTO composer VALUES(3, 12, 50);
INSERT INTO composer VALUES(3, 13, 30);
INSERT INTO composer VALUES(4, 14, 450);
INSERT INTO composer VALUES(4, 5, 10);
INSERT INTO composer VALUES(4, 15, 45);
INSERT INTO composer VALUES(4, 16, 1);
INSERT INTO composer VALUES(4, 7, 0.25);
INSERT INTO composer VALUES(4, 42, 100);
INSERT INTO composer VALUES(5, 17, 200);
INSERT INTO composer VALUES(5, 18, 2);
INSERT INTO composer VALUES(5, 19, 2);
INSERT INTO composer VALUES(5, 20, 0.5);
INSERT INTO composer VALUES(5, 21, 10);
INSERT INTO composer VALUES(5, 15, 45);
INSERT INTO composer VALUES(5, 22, 30);
INSERT INTO composer VALUES(6, 23, 400);
INSERT INTO composer VALUES(6, 24, 300);
INSERT INTO composer VALUES(6, 25, 6);
INSERT INTO composer VALUES(6, 26, 1);
INSERT INTO composer VALUES(6, 3, 2);
INSERT INTO composer VALUES(6, 27, 15);
INSERT INTO composer VALUES(6, 28, 140);
INSERT INTO composer VALUES(7, 29, 200);
INSERT INTO composer VALUES(7, 30, 1);
INSERT INTO composer VALUES(7, 3, 1);
INSERT INTO composer VALUES(7, 31, 1);
INSERT INTO composer VALUES(8, 32, 1);
INSERT INTO composer VALUES(8, 19, 6);
INSERT INTO composer VALUES(8, 20, 6);
INSERT INTO composer VALUES(8, 33, 3);
INSERT INTO composer VALUES(8, 34, 3);
INSERT INTO composer VALUES(8, 35, 200);
INSERT INTO composer VALUES(8, 36, 1);
INSERT INTO composer VALUES(8, 15, 90);
INSERT INTO composer VALUES(8, 5, 20);
INSERT INTO composer VALUES(8, 37, 10);
INSERT INTO composer VALUES(9, 38, 3);
INSERT INTO composer VALUES(9, 39, 1);
INSERT INTO composer VALUES(9, 3, 2);
INSERT INTO composer VALUES(9, 40, 250);
INSERT INTO composer VALUES(9, 2, 100);
INSERT INTO composer VALUES(9, 10, 1);
INSERT INTO composer VALUES(10, 43, 1);
INSERT INTO composer VALUES(10, 1, 80);
INSERT INTO composer VALUES(10, 44, 30);
INSERT INTO composer VALUES(10, 3, 3);
INSERT INTO composer VALUES(10, 40, 90);
INSERT INTO composer VALUES(10, 2, 70);
INSERT INTO composer VALUES(10, 45, 2);
INSERT INTO composer VALUES(11, 46, 2);
INSERT INTO composer VALUES(11, 47, 1);
INSERT INTO composer VALUES(11, 19, 2);
INSERT INTO composer VALUES(11, 48, 20);
INSERT INTO composer VALUES(11, 31, 2);
INSERT INTO composer VALUES(11, 41, 10);
INSERT INTO composer VALUES(11, 5, 20);
INSERT INTO composer VALUES(11, 15, 30);
INSERT INTO composer VALUES(11, 21, 20);
INSERT INTO composer VALUES(11, 34, 2);
INSERT INTO composer VALUES(12, 38, 1);
INSERT INTO composer VALUES(12, 49, 4);
INSERT INTO composer VALUES(12, 50, 1);
INSERT INTO composer VALUES(12, 51, 1);
INSERT INTO composer VALUES(12, 52, 5);
INSERT INTO composer VALUES(12, 53, 15);

INSERT INTO approvisionner VALUES(3, 1, '22/11/2019', 10);
INSERT INTO approvisionner VALUES(4, 1, '22/11/2019', 10);
