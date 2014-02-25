<?php

interface usersInterface
{
	public function getUsers();
	public function getUser($iduser);
	public function getPets($iduser);
	public function getLanguages($iduser);
	public function deleteUser($iduser, $config);
	public function deleteUserPets($iduser, $config);
	public function deleteUserLanguages($iduser, $config);
	public function updateUser($iduser, $data, $config);	
}