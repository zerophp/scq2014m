<?php

// include ('../application/models/models_txtfile.php');
include ('../application/model/model_uploadfile.php');

include ('../application/model/model_users.php');
$config = parse_ini_file('../application/configs/settings.ini', TRUE);

// echo "<pre>";
// print_r($config);
// echo "</pre>";

if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';



switch ($action)
{
	case 'update':
		if ($_POST)
		{
			update('users', $_POST, $_POST['iduser'],$config['database']);
			//updateUser($_POST['id'], $_POST, $config['database']);
			// TODO: Implementar cambiar imagen
			// Saltar a tabla de usuarios
			header('Location: /users.php');
		}
		else
		{
			$usuario=getUser($_GET['id'], $config['database']);
			// Pasarla al formulario
			ob_start();
				include('../application/views/users/insert.php');
				$content=ob_get_contents();
			ob_end_clean();
		}
		break;

	case 'insert':
		if ($_POST)
		{
			$photo_name = renameFile($_FILES['photo']['name'],
					$_SERVER['DOCUMENT_ROOT']);
			$destino = $_SERVER['DOCUMENT_ROOT'];
			// Inyectar nombre_final en post.
			if(isset($photo_name)&&$photo_name!=='')
				$_POST['photo']= $photo_name;
			uploadFile($photo_name, $destino, $_FILES['photo']);
			insert('users', $_POST, $_POST['iduser'],$config['database']);
			// Saltar a tabla de usuarios
			// header('Location: http://formularios.local/usuarios.php');
			header('Location: /users.php');
			// header('Location: usuarios.php');
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
				deleteUser($_POST['id'],$config['database']);
				// TODO: delete image				
			}
			header('Location: /users.php');
		}
		else
		{
			$usuario=getUser($_GET['id'], $config['database']);
			ob_start();
				include('../application/views/users/delete.php');
				$content=ob_get_contents();
			ob_end_clean();
		}
		break;

	case 'select':
		$filas=getUsers($config['database']);
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




