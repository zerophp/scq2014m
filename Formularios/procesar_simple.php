<?php

echo "<pre>GET: ";
print_r($_GET);
echo "</pre>";


echo "<pre>POST: ";
print_r($_POST);
echo "</pre>";

echo "<pre>FILES: ";
print_r($_FILES);
echo "</pre>";



// Separar por comas
$data=implode(',',$_POST)."\n";


// Escribir(agregar) a un archivo de texto
file_put_contents('usuarios.txt', $data, FILE_APPEND);


// Subir la foto
move_uploaded_file($_FILES['photo']['tmp_name'], 
				   $_SERVER['DOCUMENT_ROOT']."/".
				   $_FILES['photo']['name']
				);

