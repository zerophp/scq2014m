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

function getUser($iduser,$config)
{
	$sql="SELECT users.*,
					 cities.name as city,
					 genders.name as gender,
					 users.photo
			  FROM users, genders, cities
			  WHERE users.genders_idgender = genders.idgender AND
					users.cities_idcity = cities.idcity AND
					users.iduser = ".$iduser;

	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	while ($row=mysqli_fetch_assoc($result))
	{
		$row['pets']=explode('|',getPets($row['iduser'], $config));
		$row['languages']=explode('|',getLanguages($row['iduser'], $config));
		$rows[]=$row;
	}

	return $rows[0];
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


function deleteUser($iduser, $config)
{
	deleteUserPets($iduser, $config);
	deleteUserLanguages($iduser, $config);
	$sql = "DELETE FROM users WHERE iduser = ".$iduser;

	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	return $result;
}

function deleteUserPets($iduser, $config)
{
	$sql = "DELETE FROM users_has_pets 
			WHERE users_iduser = ".$iduser;
	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	return $result;
}

function deleteUserLanguages($iduser, $config)
{
	$sql = "DELETE FROM users_has_languages 
			WHERE users_iduser = ".$iduser;
	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	return $result;
}

function updateUser($iduser, $data, $config)
{
	$sql = "UPDATE users SET";
	foreach($data as $key => $value)
	{
		$sql.=$key."='".$value."',";
	} 
			echo $sql;
			die;

	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	return $result;
}


function findFields($tablename, $data, $config)
{
	$sql = "DESCRIBE ".$tablename;
	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	while ($row=mysqli_fetch_assoc($result))
	{
		$fields[]=$row['Field'];
		if($row['Key']=='PRI')
			$pkey = $row['Field'];
	}
	
	foreach($data as $key => $value)
	{
		if (!in_array($key, $fields))
			unset($data[$key]);
	}
	unset($data[$pkey]);
	return array($pkey, $data);
}

function update($tablename, $data, $id, $config)
{
	$fields= findFields($tablename, $data, $config);
	$sql = "UPDATE ".$tablename." SET " ;
	foreach($fields[1] as $key => $value)
	{
		$sql.=$key."='".$value."',";
	}
	$sql=substr($sql, 0, strlen($sql)-1);
	$sql.=" WHERE ".$fields[0].' = '.$id;
	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	return $result;	
}

function insert($tablename, $data, $id, $config)
{
	$fields= findFields($tablename, $data, $config);
	$sql = "INSERT INTO ".$tablename." SET " ;	
	foreach($fields[1] as $key => $value)
	{
		$sql.=$key."='".$value."',";
	}
	$sql=substr($sql, 0, strlen($sql)-1);
	//$sql.=" WHERE ".$fields[0].' = '.$id;
	$link=connectDB($config);
	selectDB($link, $config);
	$result=mysqli_query($link, $sql);
	return $result;
}











