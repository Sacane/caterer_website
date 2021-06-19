CREATE TABLE traiteur(
  id_traiteur int PRIMARY KEY,
  nom_traiteur varchar(25) NOT NULL,
  prenom_traiteur varchar(25) NOT NULL
);

INSERT INTO traiteur(id_traiteur, nom_traiteur, prenom_traiteur) VALUES(1, 'Dupond', 'Pierre');
