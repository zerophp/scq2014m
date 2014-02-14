<?php


if(isset($_GET['action']))
	$action=$_GET['action'];
else
	$action='select';



switch ($action)
{
	case 'update':
		echo "esto es update";
	break;
	
	case 'insert':
		echo "esto es insert";
		include('formulario.php');
	break;
	
	case 'delete':
		echo "esto es delete";
	break;
	
	case 'select':
		echo "esto es select";
		include ('select.php');		
	break;
	
	default:
	break;
}