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





// Averiguar el nombre de la foto
$photo_name = $_FILES['photo']['name'];
$destino = $_SERVER['DOCUMENT_ROOT'];
$partes_ruta = pathinfo($destino."/".$photo_name);



//Mientras que el nombre del fichero exista en destino
$a=0;
while(file_exists($destino."/".$photo_name))
{
	// Aumentar nombre de fichero
	$a++;
	// Hasta obtener un nombre valido
	$photo_name=$partes_ruta['filename'].
				"_".
				$a.
				".".
				$partes_ruta['extension'];
}

// Inyectar nombre_final en post.
$_POST[]=$photo_name;

// Separar por comas
$data=implode(',',$_POST)."\n";

// Subir la foto
move_uploaded_file($_FILES['photo']['tmp_name'],
		$destino."/".$photo_name
);


// Escribir(agregar) a un archivo de texto
file_put_contents('usuarios.txt', $data, FILE_APPEND);




