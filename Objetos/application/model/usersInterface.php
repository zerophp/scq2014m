<?php

interface usersInterface
{
	public function getUsers($config);
	public function getUser($iduser,$config);
	public function getPets($iduser, $config);
	public function getLanguages($iduser, $config);
	public function deleteUser($iduser, $config);
	public function deleteUserPets($iduser, $config);
	public function deleteUserLanguages($iduser, $config);
	public function updateUser($iduser, $data, $config);	
}