<?php

include ('functions.php');

if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';



switch ($action)
{
	case 'update':
		echo "esto es update";
		if ($_POST)
		{
			$data=getArrayFromTxt('usuarios.txt');
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
			include('formulario.php');
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
			insert2Txt($_POST, 'usuarios.txt');			
			// Saltar a tabla de usuarios
			// header('Location: http://formularios.local/usuarios.php');
			header('Location: /usuarios.php');
			// header('Location: usuarios.php');
		}
		else
		{
			echo "esto es insert";
			include('formulario.php');
		}		
	break;
	
	case 'delete':
		echo "esto es delete";
	break;
	
	case 'select':
		echo "esto es select";
		// Leer archivo de texto y guardar datos en un string
		$archivostring = file_get_contents('usuarios.txt');
		// Separar string por lineas en un array filas
		$filas = explode("\n",$archivostring);
		echo "<a href=\"/usuarios.php?action=insert\">Insertar Usuario</a>";
		echo "<br/>";
		
		// Dibujo la tabla
		echo "<table border=1>";
		// Para cada fila
		foreach($filas as $key => $fila)
		{
			// Dibujo la fila
			echo "<tr>";
			// Separar el string de filas en array columnas
			$columnas = explode(',',$fila);
			
			$image = array_pop($columnas);
			
			// Para cada columna
			foreach ($columnas as $columna)
			{
				// Dibujar columna
				echo "<td>";
				// Poner contenido
				echo $columna;
				echo "</td>";		
			}
				// Mostrar imagen
				echo "<td>";
				echo "<img width=\"100px\" src=\"".$image."\"/>";		
				echo "</td>";
				
				// Mostrar opciones
				echo "<td>";
				echo "<a href=\"/usuarios.php?action=update&id=".$key."\">Update</a>";
				echo "&nbsp;";
				echo "<a href=\"/usuarios.php?action=delete\">Delete</a>";
				echo "</td>";
				
				
			echo "</tr>";
		}
		echo "</table>";		
	break;
	
	default:
	break;
}