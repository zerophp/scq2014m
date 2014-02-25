<?php

class model_mapper_db
{
	function findFields($tablename, $data, $config)
	{
		$sql = "DESCRIBE ".$tablename;
		$link=connectDB($config);
		selectDB($link, $config);
		$result=mysqli_query($link, $sql);
		while ($row=mysqli_fetch_assoc($result))
		{
			$fields[]=$row['Field'];
			if($row['Key']=='PRI')
				$pkey = $row['Field'];
		}
		
		foreach($data as $key => $value)
		{
			if (!in_array($key, $fields))
				unset($data[$key]);
		}
		unset($data[$pkey]);
		return array($pkey, $data);
	}
	
	function update($tablename, $data, $id, $config)
	{
		$fields= findFields($tablename, $data, $config);
		$sql = "UPDATE ".$tablename." SET " ;
		foreach($fields[1] as $key => $value)
		{
			$sql.=$key."='".$value."',";
		}
		$sql=substr($sql, 0, strlen($sql)-1);
		$sql.=" WHERE ".$fields[0].' = '.$id;
		$link=connectDB($config);
		selectDB($link, $config);
		$result=mysqli_query($link, $sql);
		return $result;	
	}
	
	function insert($tablename, $data, $id, $config)
	{
		$fields= findFields($tablename, $data, $config);
		$sql = "INSERT INTO ".$tablename." SET " ;	
		foreach($fields[1] as $key => $value)
		{
			$sql.=$key."='".$value."',";
		}
		$sql=substr($sql, 0, strlen($sql)-1);
		//$sql.=" WHERE ".$fields[0].' = '.$id;
		$link=connectDB($config);
		selectDB($link, $config);
		$result=mysqli_query($link, $sql);
		return $result;
	}
}