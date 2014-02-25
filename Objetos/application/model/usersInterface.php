<?php

interface model_usersInterface
{
	public function getUsers();
	public function getUser($iduser);
	public function insertUser($tablename,$data,$id,$config);
	public function updateUser($tablename, $data, $id, $config);
	public function deleteUser($iduser, $config);
		
}