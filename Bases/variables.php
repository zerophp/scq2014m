<?php

const asd=45;

echo "<pre>";
//print_r($_SERVER);
echo "</pre>";

echo $_SERVER['DOCUMENT_ROOT'];

echo "<hr/>";

$nombre = "Sebastian";
define ("NOMBRE", "Benjamin");

echo NOMBRE;


echo "<hr/>";

@include ("kaka.php");


echo 5*2/3*4-8/2*3/2+2;
echo "<br/>";
echo 5*(2/3)*(4-8)/2*(3/2)+2;

echo "<hr/>";

echo 5<<2;
echo "<br/>";
echo 20>>6;
