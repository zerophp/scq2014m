<form method="post" enctype="multipart/form-data">
	<ul>
		<li>
			Id: <input type="hidden" name="id" value="<?=isset($usuario['id'])?$_GET['id']:'-';?>"/>
		</li>
		<li>
			Nombre: <input type="text" name="name" value="<?=isset($usuario['name'])?$usuario['name']:'';?>"/>
		</li>
		<li>
			Apellidos: <input type="text" name="lastname" value="<?=isset($usuario['lastname'])?$usuario['lastname']:'';?>"/>
		</li>
		<li>
			Email: <input type="text" name="email" value="<?=isset($usuario['email'])?$usuario['email']:'';?>"/>
		</li>
		<li>
			Password: <input type="password"  name="password"/>
		</li>
		<li>
			Descripcion: <textarea rows="10" cols="10" name="description"><?=isset($usuario['description'])?$usuario['description']:'';?></textarea>
		</li>
		<li>
			Ciudad: <select name="cities">
			<option value="santiago" <?=(isset($usuario['cities'])&&$usuario['cities']=='santiago')?'selected':'';?>>Santiago</option>
			<option value="vigo" <?=(isset($usuario['cities'])&&$usuario['cities']=='vigo')?'selected':'';?>>Vigo</option>
			<option value="acoruña" <?=(isset($usuario['cities'])&&$usuario['cities']=='acoruña')?'selected':'';?>>A Coruña</option>
			</select>
		</li>
		
		<li>
			Sexo: 
			Otros: <input type="radio" value="o" name="gender" <?=(isset($usuario['gender'])&&$usuario['gender']=='o')?'checked':'';?>/>
			Mujer: <input type="radio" value="m" name="gender" <?=(isset($usuario['gender'])&&$usuario['gender']=='m')?'checked':'';?>/>
			Hombre: <input type="radio" value="h" name="gender" <?=(isset($usuario['gender'])&&$usuario['gender']=='h')?'checked':'';?>/>
		</li>
		<li>
			Mascotas: 
			Gato <input type="checkbox" value="gato" name="pets[]" <?=(isset($usuario['pets'])&&in_array('gato', $usuario['pets']))?'checked':'';?>/>
			Perro <input type="checkbox" value="perro" name="pets[]" <?=(isset($usuario['pets'])&&in_array('perro', $usuario['pets']))?'checked':'';?>/>
			Tigre <input type="checkbox" value="tigre" name="pets[]" <?=(isset($usuario['pets'])&&in_array('tigre', $usuario['pets']))?'checked':'';?>/>
			Lobo <input type="checkbox" value="lobo" name="pets[]" <?=(isset($usuario['pets'])&&in_array('lobo', $usuario['pets']))?'checked':'';?>/>
		</li>
		<li>
			Idiomas: 
			<select multiple name="languages[]">
			<option value="english" <?=(isset($usuario['languages'])&&in_array('english', $usuario['languages']))?'selected':'';?>>English</option>
			<option value="galego" <?=(isset($usuario['languages'])&&in_array('galego', $usuario['languages']))?'selected':'';?>>Galego</option>
			<option value="spanish" <?=(isset($usuario['languages'])&&in_array('spanish', $usuario['languages']))?'selected':'';?>>Español</option>
			</select>
		</li>
		<li>
			Foto: <input type="file" name="photo"/>
			<?php 
			if(isset($usuario['photo']))
			{
				echo "<img width=\"100px\" src=\"".$usuario['photo']."\"/>";
				echo "<input type=\"hidden\" name=\"photo\" value=\"".$usuario['photo']."\"/>";	
			}
			?>
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