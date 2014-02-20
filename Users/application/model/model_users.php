<?php

function getUsers($config)
{	
	$sql="SELECT users.iduser,
					 users.username,
					 cities.name as city,
					 genders.name as gender,
					 users.photo
			  FROM users, genders, cities
			  WHERE users.genders_idgender = genders.idgender AND
					users.cities_idcity = cities.idcity";	
	
	$link=connectDB($config);
	selectDB($link, $config);	
	$result=mysqli_query($link, $sql);
	while ($row=mysqli_fetch_assoc($result))
	{
		$row['pets']=getPets($row['iduser'], $config);
		$row['languages']=getLanguages($row['iduser'], $config);
		$rows[]=$row;		
	}
	return $rows;
}



function getPets($iduser, $config)
{
	$sql = "SELECT  GROUP_CONCAT(pets.name SEPARATOR '|') as pets
			FROM pets
			INNER JOIN users_has_pets ON
				  users_has_pets.pets_idpet = pets.idpet
			WHERE users_has_pets.users_iduser = ".$iduser;
	
	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row['pets'];
}

function connectDB($config)
{
	// Conectar a la DBMS
	$link=mysqli_connect($config['host'],
						 $config['user'],
						 $config['password']
			);
	return $link;
}

function selectDB($link, $config)
{
	mysqli_select_db($link, $config['db']);
	mysqli_set_charset ($link, 'utf8');
	mysqli_query($link, "SET NAMES utf8");
	return;
}




function getLanguages($iduser, $config)
{
	$sql = "SELECT  GROUP_CONCAT(languages.name SEPARATOR '|') as languages
			FROM languages
			INNER JOIN users_has_languages ON
				  users_has_languages.languages_idlanguage = languages.idlanguage
			WHERE users_has_languages.users_iduser = ".$iduser;
	
	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	$row = mysqli_fetch_assoc($result);
	return $row['languages'];	
}

















