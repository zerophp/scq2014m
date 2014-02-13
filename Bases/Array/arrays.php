<?php
$persona = array ();
//$persona=[];
$persona[1]="Agustin";
$persona['Apellidos']="Calderon";
$persona = array ('nombre'=>"Agustin",
				  'apellido'=>"Calderon",
				'edad'=>23,
				'ciudad'=>'santiago',
				8,
				'mas',
				'33'=>'otro mas',
				'y este',
				1,2=>'otro raro',
				1.2=>'que da?',
				2.9=>'mas alto',
				2.1=>'sobreescribe?',
				'direccion'=>array(1,
								 'Rua da Rosa',
								'santiago')
		
);

echo $persona['edad'];

echo "<pre>";
print_r($persona);
echo "</pre>";


foreach ($persona as $key => $value)
{
	echo $key.": ".$value;
// 	echo $key.": ".print_r($value);
	echo "<br/>";
}

foreach ($persona as $per)
{
	echo $per;
	echo "<br/>";
}

echo "<hr/>";

echo implode(',',$persona);



