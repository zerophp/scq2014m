SELECT * FROM pets;
INSERT INTO pets SET name='lobo';
INSERT INTO pets (name) VALUES ('leon');
SELECT name FROM pets WHERE idpet=2;
SELECT name FROM pets WHERE name LIKE 'gato';
SELECT name FROM pets WHERE name LIKE 'l%';
UPDATE pets SET name='loro' WHERE idpet=2;
UPDATE pets SET name='lobo';
/* Comentarios */ 
DELETE FROM pets WHERE name LIKE 'loro';
DELETE FROM pets WHERE idpet=2;

SELECT users.name, pets.name
FROM users
INNER JOIN users_has_pets ON 
	users.iduser = users_has_pets.users_iduser
INNER JOIN pets ON
	pets_idpet = pets.idpet;


SELECT users.name, pets.name
FROM users
LEFT JOIN users_has_pets ON 
	users.iduser = users_has_pets.users_iduser
LEFT JOIN pets ON
	pets_idpet = pets.idpet;

SELECT users.*, languages.name, pets.name, 
	cities.name, genders.name
FROM users
LEFT JOIN users_has_languages ON 
	users.iduser = users_has_languages.users_iduser
LEFT JOIN languages ON
	languages_idlanguage = languages.idlanguage
LEFT JOIN users_has_pets ON 
	users.iduser = users_has_pets.users_iduser
LEFT JOIN pets ON
	pets_idpet = pets.idpet
LEFT JOIN cities ON
	idcity = users.cities_idcity
LEFT JOIN genders ON
	idgender = users.genders_idgender;

SELECT users.name, cities.name, genders.name
FROM users, genders, cities
WHERE users.genders_idgender = genders.idgender
AND users.cities_idcity = cities.idcity;

SELECT users.username, 
	   cities.name as city, 
	   genders.name as gender, 
	   users.photo
FROM users, genders, cities
WHERE users.genders_idgender = genders.idgender AND 
	  users.cities_idcity = cities.idcity;

SELECT  GROUP_CONCAT(pets.name SEPARATOR '|') as pets
FROM pets
INNER JOIN users_has_pets ON
users_has_pets.pets_idpet = pets.idpet
WHERE users_has_pets.users_iduser = 1;

SELECT  GROUP_CONCAT(languages.name SEPARATOR '|') as languages
FROM languages
INNER JOIN users_has_languages ON
users_has_languages.languages_idlanguage = languages.idlanguage
WHERE users_has_languages.users_iduser = 1;

SET NAMES utf8;