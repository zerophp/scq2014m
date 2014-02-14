<?php

//Debugs
echo "<pre>GET: ";
print_r($_GET);
echo "</pre>";

echo "<pre>POST: ";
print_r($_POST);
echo "</pre>";

echo "<pre>FILES: ";
print_r($_FILES);
echo "</pre>";


include ('functions.php');

// Inyectar nombre_final en post.

$photo_name = renameFile($_FILES['photo']['name'],  
					$_SERVER['DOCUMENT_ROOT']);
$destino = $_SERVER['DOCUMENT_ROOT'];

$_POST[]= $photo_name;

// Subir la foto
uploadFile($photo_name, $destino, $_FILES['photo']);

insert2Txt($_POST, 'usuarios.txt');

// Saltar a tabla de usuarios
// header('Location: http://formularios.local/usuarios.php');
header('Location: /usuarios.php');
// header('Location: usuarios.php');




