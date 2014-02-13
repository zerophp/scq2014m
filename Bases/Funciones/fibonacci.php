F=0,1,1,2,3,5,8,13,21,34
<br/>
<?php
function fibonacci($max)
{
	echo "F=0,1,";
	
	$f1=0;
	$f2=1;
	$f3=$f1+$f2;
	while($f3<=$max)
	{
		echo $f3.',';
		$f1=$f2;
		$f2=$f3;
		$f3=$f1+$f2;
		
	}
	return;
}


echo fibonacci(45);