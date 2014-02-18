<?php

include ('../application/models/models_txtfile.php');
include ('../application/models/models_uploadfile.php');

$config = parse_ini_file('../application/configs/settings.ini');

if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';



switch ($action)
{
	case 'update':
		if ($_POST)
		{
			$data=getArrayFromTxt($config['file']);
			$arrayout=getUserLine($_POST);
			$arrayuser=mapUser2File($arrayout);
			$usuario = implode(',',$arrayuser);
			// Modificar la linea del usuario con la linea valida
			$data[$arrayout['id']]=$usuario;
			wrt2File('usuarios.txt', $data);
			// TODO: Implementar cambiar imagen
			// Saltar a tabla de usuarios
			header('Location: /usuarios.php');
		}
		else
		{
			// Tomar el id
			$usuario=getUserData($_GET['id']);			
			// Pasarla al formulario
			ob_start();
				include('../application/views/usuarios/insert.php');
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
			$_POST[]= $photo_name;			
			uploadFile($photo_name, $destino, $_FILES['photo']);
			insert2Txt($_POST, $config['file']);			
			// Saltar a tabla de usuarios
			// header('Location: http://formularios.local/usuarios.php');
			header('Location: /usuarios.php');
			// header('Location: usuarios.php');
		}
		else
		{
			ob_start();
			include('../application/views/usuarios/insert.php');
			$content=ob_get_contents();
			ob_end_clean();
		}		
	break;
	
	case 'delete':
		if($_POST)
		{			
			if($_POST['borrar']=="Si")
			{
				$data=getArrayFromTxt($config['file']);
				unset($data[$_POST['id']]);
				// TODO: delete image
				wrt2File('usuarios.txt', $data);				
			}
			header('Location: /usuarios.php');
		}
		else
		{
			$usuario=getUserData($_GET['id']);
			ob_start();
				include('../application/views/usuarios/delete.php');	
				$content=ob_get_contents();
			ob_end_clean();
		}		
	break;
	
	case 'select':
		// Leer archivo de texto y guardar datos en un string
		$archivostring = file_get_contents($config['file']);
		// Separar string por lineas en un array filas
		$filas = explode("\n",$archivostring);
		ob_start();
			include ('../application/views/usuarios/select.phtml');
			$content=ob_get_contents();
		ob_end_clean();
	break;
	
	default:
	break;
}

// Include Layuout
include('../application/views/layouts/layout.phtml');




