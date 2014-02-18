¿Seguro que deseas borrar el usuario?
<form method="post" enctype="multipart/form-data">
<ul>
<li>
Id: <input type="hidden" name="id" value="<?=isset($usuario['id'])?$_GET['id']:'-';?>"/>
</li>
<li>
Nombre: <?=isset($usuario['name'])?$usuario['name']:'';?>
</li>
<li>
Apellidos: <?=isset($usuario['lastname'])?$usuario['lastname']:'';?>
</li>


<li>
Si: <input type="submit" name="borrar" value="Si"/>
</li>
<li>
No: <input type="submit" name="borrar" value="No"/>
</li>


</ul>
</form>