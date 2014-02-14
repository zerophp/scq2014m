<form action="procesar.php" method="post" 
	  enctype="multipart/form-data">
<ul>
<li>
Id: <input type="hidden" value="1" name="id"/>
</li>
<li>
Nombre: <input type="text" name="name"/>
</li>
<li>
Apellidos: <input type="text" name="lastname"/>
</li>
<li>
Email: <input type="text" name="email"/>
</li>
<li>
Password: <input type="password"  name="password"/>
</li>
<li>
Descripcion: <textarea rows="10" cols="10" name="description"></textarea>
</li>
<li>
Ciudad: <select name="cities">
<option value="santiago">Santiago</option>
<option value="vigo">Vigo</option>
<option value="acoruña">A Coruña</option>
</select>
</li>

<li>
Sexo: 
Otros: <input type="radio" value="o" name="gender"/>
Mujer: <input type="radio" value="m" name="gender"/>
Hombre: <input type="radio" value="h" name="gender"/>
</li>
<li>
Mascotas: 
Gato <input type="checkbox" value="gato" name="pets[]"/>
Perro <input type="checkbox" value="perro" name="pets[]"/>
Tigre <input type="checkbox" value="tigre" name="pets[]"/>
Lobo <input type="checkbox" value="lobo" name="pets[]"/>
</li>
<li>
Idiomas: 
<select multiple name="languages[]">
<option value="english">English</option>
<option value="galego">Galego</option>
<option value="spanish">Español</option>
</select>
</li>
<li>
Foto: <input type="file" name="photo"/>
</li>

<li>
Submit: <input type="submit" name="submit"/>
</li>
<li>
Reset: <input type="reset" name="reset"/>
</li>
<li>
Button: <input type="button" name="button" value="Un boton"/>
</li>

</ul>
</form>