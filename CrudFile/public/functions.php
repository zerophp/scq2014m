<?php

/**
 * Rename file with a counter
 *  
 * @param string $original_name
 * @param string $path
 * @return string $final_name
 */
function renameFile($photo_name, $destino)
{
	// Averiguar el nombre de la foto
	$partes_ruta = pathinfo($destino."/".$photo_name);
		
	//Mientras que el nombre del fichero exista en destino
	$a=0;
	while(file_exists($destino."/".$photo_name))
	{
		// Aumentar nombre de fichero
		$a++;
		// Hasta obtener un nombre valido
		$photo_name=$partes_ruta['filename'].
		"_".$a.".".$partes_ruta['extension'];
	}	
	return $photo_name;
}

/**
 * Upload file to directory
 * @param string $name
 * @param string $path
 * @param array $fileData $_FILES data
 * @return null
 */
function uploadFile($name, $path, $fileData)
{
	// Subir la foto
	move_uploaded_file($fileData['tmp_name'],
						$path."/".$name
	);
	return null;
}

/**
 * Insert data into text file
 * @param array $data array with data
 * @param string $filename
 * @return null
 */
function insert2Txt($datafile, $filename)
{
	$arraysalida=array();
	// Para cada elemento del array POST
	foreach ($datafile as $value)
	{
		// Si no es array
		if(!is_array($value))
			// Enviar a arraysalida
			$arraysalida[]=$value;
		// Si es array
		else
			// Dividir por pipes y
			// enviar a arraysalida
			$arraysalida[]=implode('|',$value);
	}
	
	// Separar por comas
	$data=implode(',',$arraysalida)."\n";
		
	// Escribir(agregar) a un archivo de texto
	file_put_contents($filename, $data, FILE_APPEND);
	
	return null;
}



