<?php

class model_users_mappers_db_users extends model_mapper_db
{
	
	
	public function getUsers()
	{
		$sql="SELECT users.iduser,
					 users.username,
					 cities.name as city,
					 genders.name as gender,
					 users.photo
			  FROM users, genders, cities
			  WHERE users.genders_idgender = genders.idgender AND
					users.cities_idcity = cities.idcity";
			
		$result=mysqli_query($this->link, $sql);
		while ($row=mysqli_fetch_assoc($result))
		{
			$row['pets']=$this->getPets($row['iduser']);
			$row['languages']=$this->getLanguages($row['iduser']);
			$rows[]=$row;
		}
		return $rows;
	}
	
	public function getUser($iduser)
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
	
	
	
	public function getPets($iduser)
	{
		$sql = "SELECT  GROUP_CONCAT(pets.name SEPARATOR '|') as pets
			FROM pets
			INNER JOIN users_has_pets ON
				  users_has_pets.pets_idpet = pets.idpet
			WHERE users_has_pets.users_iduser = ".$iduser;
	
		$result=mysqli_query($this->link, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row['pets'];
	}
	
	public function getLanguages($iduser)
	{
		$sql = "SELECT  GROUP_CONCAT(languages.name SEPARATOR '|') as languages
			FROM languages
			INNER JOIN users_has_languages ON
				  users_has_languages.languages_idlanguage = languages.idlanguage
			WHERE users_has_languages.users_iduser = ".$iduser;
	
		$result=mysqli_query($this->link, $sql);
		$row = mysqli_fetch_assoc($result);
		return $row['languages'];
	}
	
	
	public function deleteUser($iduser, $config)
	{
		deleteUserPets($iduser, $config);
		deleteUserLanguages($iduser, $config);
		$sql = "DELETE FROM users WHERE iduser = ".$iduser;
	
		$link=connectDB($config);
		selectDB($link, $config);
		$result=mysqli_query($link, $sql);
		return $result;
	}
	
	public function deleteUserPets($iduser, $config)
	{
		$sql = "DELETE FROM users_has_pets
			WHERE users_iduser = ".$iduser;
		$link=connectDB($config);
		selectDB($link, $config);
		$result=mysqli_query($link, $sql);
		return $result;
	}
	
	public function deleteUserLanguages($iduser, $config)
	{
		$sql = "DELETE FROM users_has_languages
			WHERE users_iduser = ".$iduser;
		$link=connectDB($config);
		selectDB($link, $config);
		$result=mysqli_query($link, $sql);
		return $result;
	}
	
	public function updateUser($iduser, $data, $config)
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
}

class model_users_mappers_db_pets