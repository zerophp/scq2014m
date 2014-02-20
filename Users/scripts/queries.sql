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

