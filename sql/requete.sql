
--requête qui selectionne le nom des plats, son prix et la quantité de plats commandé du même nom_plat.

SELECT nom_plat, prix_ttc, quantite
FROM commander 
NATURAL JOIN plat

--requete qui affiche les ingredients qui composent un plat X
SELECT nom_ingre
FROM ingredient NATURAL JOIN composer
WHERE id_plat = 3; --À la place du 3 tu mets le plat que le mec aura choisi

--requete qui affiche tous les plats dons tous les ingredients sont locaux


SELECT nom_plat, prix_ttc, lienimg, description
FROM plat
WHERE id_plat in (
  SELECT R.plat1
  FROM (
    SELECT count(id_ingre) AS C1, id_plat AS plat1
    FROM ingredient NATURAL JOIN composer
    WHERE localite = 't'
    GROUP BY id_plat
      ) R,
      (
        SELECT count(id_ingre) AS C2, id_plat AS plat2
        FROM composer
        GROUP BY id_plat
      ) T
  WHERE R.C1 = T.C2 AND R.plat1 = T.plat2
);


--requete qui liste tous les plats qui contiennent les ingrédients de label 'id_label'

SELECT DISTINCT nom_plat
FROM plat NATURAL JOIN composer NATURAL JOIN ingredient
WHERE id_ingre IN (
  SELECT DISTINCT id_ingre
  FROM ingredient NATURAL JOIN labeliser NATURAL JOIN label
  WHERE id_label = 3 -- à la place de 3 il faut mettre le id_label que tu veux 1 = 'label rouge', 2 = 'A.O.C' et 3 = 'BIO'
);



--requete qui liste tous les plats dont les ingrédients qui ne contiennent pas les allergènes de (id allergene)

SELECT nom_plat
FROM plat
WHERE nom_plat NOT IN (
  SELECT nom_plat
  FROM plat NATURAL JOIN composer
  WHERE id_ingre IN (
    SELECT id_ingre
    FROM ingredient NATURAL JOIN contenir
    WHERE id_allergene = 1 -- à la place du 3 tu mets le id_allergene que tu veux 1 = 'gluten', 2 = 'oeufs', 3 = 'lait', 4 = 'caféine' et 5 = 'crustacés sulfites'
  )
);


