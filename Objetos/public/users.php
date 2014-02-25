<?php

$config = parse_ini_file('../application/configs/settings.ini', TRUE);
include ('../application/autoload.php');

if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';

switch ($action)
{
	case 'update':
		if ($_POST)
		{
			$obj = new model_users($config['database']);
			$obj->updateUser('users', $_POST, $_POST['iduser'],$config['database']);
			// TODO: Implementar cambiar imagen
			header('Location: /users.php');
		}
		else
		{
			$obj = new model_users($config['database']);
			$usuario=$obj->getUser($_GET['id'], $config['database']);
			ob_start();
				include('../application/views/users/insert.php');
				$content=ob_get_contents();
			ob_end_clean();
		}
	break;

	case 'insert':
		if ($_POST)
		{
			$obj = new model_users($config['database']);
			$obj->insertUser('users', $_POST, $_POST['iduser'],$config['database']);
			header('Location: /users.php');
		}
		else
		{
			ob_start();
			include('../application/views/users/insert.php');
			$content=ob_get_contents();
			ob_end_clean();
		}
	break;

	case 'delete':
		if($_POST)
		{
			if($_POST['borrar']=="Si")
			{
				$obj = new model_users($config['database']);
				$obj->deleteUser($_POST['id'],$config['database']);
				// TODO: delete image				
			}
			header('Location: /users.php');
		}
		else
		{	
			$obj = new model_users($config['database']);
			$usuario=$obj->getUser($_GET['id'], $config['database']);
			ob_start();
				include('../application/views/users/delete.php');
				$content=ob_get_contents();
			ob_end_clean();
		}
	break;

	case 'select':
		$obj = new model_users($config['database']);
		$filas = $obj->getUsers();
		ob_start();
			include ('../application/views/users/select.phtml');
			$content=ob_get_contents();
		ob_end_clean();
	break;

	default:
	break;
}

// Include Layuout
include('../application/views/layouts/layout.phtml');




