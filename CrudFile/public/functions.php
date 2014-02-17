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

/**
 * Read user by id from txt file
 * @param unknown $id
 * @return array
 */
function getUserData($id)
{
	// Tomar id
	// Leer en un string el archivo txt
	$data = file_get_contents('usuarios.txt');
	// Convertir el string en array
	$data = explode("\n",$data);
	
	// Leer la fila id
	// Convertir la fila en array usuario
	$usuario=explode(',',$data[$id]);
	foreach($usuario as $key => $value)
	{
		if(strpos($value, '|'))
		{
			$arrayout[]=explode('|',$value);
		}
		else
		{
			$arrayout[]=$value;
		}	
		
	}
	
	// Mapeo de datos al array asociativo
	$arrayout['id']=$arrayout['0'];
	$arrayout['name']=$arrayout['1'];
	$arrayout['lastname']=$arrayout['2'];
	$arrayout['email']=$arrayout['3'];
	$arrayout['password']=$arrayout['4'];
	$arrayout['description']=$arrayout['5'];
	$arrayout['cities']=$arrayout['6'];
	$arrayout['gender']=$arrayout['7'];
	$arrayout['pets']=is_array($arrayout['8'])?$arrayout['8']:array($arrayout['8']);
	$arrayout['languages']=is_array($arrayout['9'])?$arrayout['9']:array($arrayout['9']);
	$arrayout['photo']=$arrayout['11'];
	
	return $arrayout;
	// Retornar el array
}










