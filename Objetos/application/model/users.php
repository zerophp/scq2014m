<?php

include ('usersInterface.php');
include ('mysqldb.php');

class users 
{
		
	private $link;
	
	public function __construct($config)
	{
		$obj = new mysqlDb($config);
		$this->link = $obj->link;
		$txt = 'model_users_mapper_'.$config['mapper'];
		$this->mapper = new $txt;
	}
	
	public function getUsers()
	{
		return $this->mapper->getUsers();				
	}
	
	public function getUser($iduser)
	{
		return $this->mapper->getUser($iduser);
	}
	public function deleteUser($iduser, $config)
	{
		return $this->mapper->deleteUser($iduser, $config);
	}			
}