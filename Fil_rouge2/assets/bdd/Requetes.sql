-- Ranger tous les exemplaires "1" de la série 3 dans l'emplacement "E01" de la bibliothèque 1
UPDATE exemplaire
SET idEmplacement = (SELECT idEmplacement
FROM emplacement
WHERE idBibli = 1
AND Code_emplacement = "E01")
WHERE ID_exemplaire IN
(SELECT ID_exemplaire
FROM (SELECT * FROM exemplaire e) AS e
JOIN album a ON e.ISBN = a.ISBN
WHERE idEmplacement IS NULL
AND a.idSerie = 3
AND ID_exemplaire LIKE "%_1");

-- Retirer tous les exemplaires de la série 6 des emplacements "E01" des bibliothèques 2,3,4,5,6
UPDATE exemplaire
SET idEmplacement = null
WHERE ID_exemplaire IN
(SELECT ID_exemplaire
FROM (select * from exemplaire) AS e
JOIN album a ON e.ISBN = a.ISBN
WHERE idEmplacement IN (SELECT idEmplacement
FROM emplacement
WHERE idBibli IN (2,3,4,5,6)
AND Code_emplacement = "E01")
AND idSerie = 6);

-- Afficher serie avec exemplaire sans emplacement
SELECT e.ID_exemplaire, e.ISBN, a.idSerie
FROM (SELECT * FROM exemplaire e) AS e
JOIN album a ON e.ISBN = a.ISBN
WHERE idEmplacement IS NULL
group by idSerie

-- Afficher exemplaires sans emplacement (à ranger)
SELECT e.ID_exemplaire, e.ISBN, a.idSerie
FROM (SELECT * FROM exemplaire e) AS e
JOIN album a ON e.ISBN = a.ISBN
WHERE idEmplacement IS NULL
order by idSerie

-- Afficher exemplaires sans emplacement dans une série donnée


-- Afficher les emplacements libres
SELECT idBibli, CODE_emplacement
FROM emplacement e 
WHERE NOT EXISTS (SELECT idEmplacement from exemplaire ex WHERE ex.idEmplacement = e.idEmplacement)

-- Afficher les emplacements d'un album
SELECT idBibli, Code_emplacement
FROM emplacement
WHERE idEmplacement IN (SELECT idEmplacement FROM
                        exemplaire where id_exemplaire = 9782012788114)

-- Afficher les albums d'une série présents dans une bibiothèque donnée
-- Exemple pour la série 2 dans la biliothèque 1
SELECT Titre_album, a.ISBN
FROM album a
JOIN exemplaire e ON a.ISBN = e.ISBN
WHERE a.idSerie = 2
AND e.idEmplacement IN (select idEmplacement from emplacement where idBibli = 1)

-- Afficher les séries présentes dans chaque emplacement
SELECT DISTINCT e.idEmplacement, a.idSerie
from album a
JOIN exemplaire e on a.isbn = e.isbn
WHERE idEmplacement IS NOT NULL
order by e.idEmplacement

-- Afficher les emplacements d'une série et les exemplaires contenus dans chacun de ces emplacements
select s.Nom_serie, a.Titre_album, e.id_exemplaire, em.idBibli, em.Code_emplacement
from emplacement em
JOIN exemplaire e on em.idEmplacement = e.idEmplacement
JOIN album a ON e.isbn = a.isbn
JOIN serie s ON a.idSerie = s.idSerie
where a.idSerie = 2
order by idBibli

-- Afficher les emplacements d'une série dans une bibliothèque donnée
select s.Nom_serie, em.Code_emplacement
from emplacement em
JOIN exemplaire e on em.idEmplacement = e.idEmplacement
JOIN album a ON e.isbn = a.isbn
JOIN serie s ON a.idSerie = s.idSerie
where a.idSerie = 2
AND idBibli = 3



-- Jeux d'essai à tester
-- 1 : Nouvel exemplaire reçu par une bibiothèque donnée. Afficher les emplacements possibles
-- (emplacements de la série dans la bibli ou nouvel emplacement dans la bibli)


-- 2 Nouvel album reçu une bibiothèque donnée. Afficher les emplacements possibles
-- (emplacements de la série dans la bibli ou nouvel emplacement dans la bibli)

-- 3 Echange d'exemplaires entre bibliothèque


-- 4 Modifier l'emplacement de toute une série. Attention une seule série par emplacement donc
-- reset à null l'emplacement de l'autre série 


16
17
18
22
23
24