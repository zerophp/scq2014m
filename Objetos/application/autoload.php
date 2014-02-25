<?php

function __autoload($name)
{
	$path = explode('_',$name);
	$path = implode('/',$path);
	
	include ('../application/'.$path.'.php');	
}