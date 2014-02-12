<table border=1>
	<tr>
		<td>1</td>
		<td>2</td>
		<td>3</td>
	</tr>
	<tr>
		<td>2</td>
		<td>4</td>
		<td>6</td>
	</tr>
</table>

<?php
$filas=5;
$columnas=4;

echo "<table border=1>";
for($i=0;$i<=$filas;$i++)
{
	echo "<tr>";
	for($m=0;$m<=$columnas;$m++)
	{
		if ($i==0 && $m==0)
			echo "<td>-</td>";
		else if ($i==0)
			echo "<td>$m</td>";
		else if ($m==0)
			echo "<td>$i</td>";
		else
			echo "<td>".$i*$m."</td>";		
	}
	echo "</tr>"; 
}
echo "</table>";














