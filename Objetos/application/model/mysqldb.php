<?php

class mysqlDb
{
	function connectDB($config)
	{
		// Conectar a la DBMS
		$link=mysqli_connect($config['host'],
				$config['user'],
				$config['password']
		);
		return $link;
	}
	
	function selectDB($link, $config)
	{
		mysqli_select_db($link, $config['db']);
		mysqli_set_charset ($link, 'utf8');
		mysqli_query($link, "SET NAMES utf8");
		return;
	}
	
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