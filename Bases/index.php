<?php
echo "Hola Mundo";
echo "<br/>";
echo "Hola Agustin";
echo "\n";
echo "<br/>";
echo "Estamos en Santiago"." de Compostela";
print ("Hoy es miercoles");
// Comentario hasta el final de la linea

/* Comentario 
 * multilinea
 * pero el * inicial de la linea 
  no es obligatorio
  y esto sigue siendo comentario
 */

# esto tambien es comentario, 
// pero no se recomienda
/* porque si usais todos esto */
/* luego
 * no hay 
 * quien
 * lo entienda
 */

/**
 * Esto que es?
 * Es documentación 
 */


echo "<hr/>";


// Haciendo un include, requiere

 include ("otro.php");
//require ("otros.php");

echo "ha seguido";



echo "<hr/>";


$a = "Agustin";
echo $a;

?>
<?php echo $a;?>
<?=$a;?>
<?php 
echo "<hr/>";
var_dump($a);
echo "<hr/>";
echo gettype($a);



echo "<hr/>";
$b =9 ;

echo "Edad $b";

echo "Edad \"".$b."\"";

echo "Edad '".$b."'";

echo 'Edad $b';

echo $a[3];
































