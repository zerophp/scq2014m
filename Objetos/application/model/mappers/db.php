<?php

class model_mappers_db
{
	private $config;
	public $link;
	
	public function __construct($config)
	{
		$this->config = $config;
		$this->link = $this->connectDB();
		$this->selectDB();
		return $this->link;
	}
	
	protected function connectDB()
	{
		// Conectar a la DBMS
		$link=mysqli_connect($this->config['host'],
				$this->config['user'],
				$this->config['password']
		);
		return $link;
	}
	
	function selectDB()
	{
		mysqli_select_db($this->link, $this->config['db']);
		mysqli_set_charset ($this->link, 'utf8');
		mysqli_query($this->link, "SET NAMES utf8");
		return;
	}
	
	function findFields($tablename, $data, $config)
	{
		$sql = "DESCRIBE ".$tablename;
		$result=mysqli_query($this->link, $sql);
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
		$fields= $this->findFields($tablename, $data, $config);
		$sql = "UPDATE ".$tablename." SET " ;
		foreach($fields[1] as $key => $value)
		{
			$sql.=$key."='".$value."',";
		}
		$sql=substr($sql, 0, strlen($sql)-1);
		$sql.=" WHERE ".$fields[0].' = '.$id;
		
		$result=mysqli_query($this->link, $sql);
		return $result;	
	}
	
	function insert($tablename, $data, $id, $config)
	{
		$fields=  $this->findFields($tablename, $data, $config);
		$sql = "INSERT INTO ".$tablename." SET " ;	
		foreach($fields[1] as $key => $value)
		{
			$sql.=$key."='".$value."',";
		}
		$sql=substr($sql, 0, strlen($sql)-1);
		//$sql.=" WHERE ".$fields[0].' = '.$id;
		
		$result=mysqli_query($this->link, $sql);
		return $result;
	}
}