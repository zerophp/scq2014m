<?php


// Leer archivo de texto y guardar datos en un string
$archivostring = file_get_contents('usuarios.txt');
// Separar string por lineas en un array filas
$filas = explode("\n",$archivostring);
echo "<a href=\"/usuarios.php?action=insert\">Insertar Usuario</a>";
echo "<br/>";

// Dibujo la tabla
echo "<table border=1>";
// Para cada fila
foreach($filas as $fila)
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
		echo "<a href=\"/usuarios.php?action=update\">Update</a>";
		echo "&nbsp;";
		echo "<a href=\"/usuarios.php?action=delete\">Delete</a>";
		echo "</td>";
		
		
	echo "</tr>";
}
echo "</table>";