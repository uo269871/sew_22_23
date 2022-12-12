<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<title>Inserta datos en tabla de la bbdd</title>
	<meta name="description" content="Gestión BBDD con PHP. Ejercicio 6">
	<meta name="keywords" content="bbdd, sql, php">
	<meta name="author" content="Miguel Menendez Rodriguez">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="Ejercicio6.css" rel="stylesheet" />
</head>

<body>
	<h1>Gestión BBDD MySQL con PHP</h1>
	<h2>Menú para gestionar la BBDD:</h2>
	<nav>
		<ul>
			<li><a href="Ejercicio6.html" title="Menú principal">Menú principal</a></li>
			<li><a href="CreaBBDD.php" title="Crear Base de Datos">Crear Base de Datos</a></li>
			<li><a href="CreaTabla.php" title="Crear Tabla">Crear una tabla</a></li>
			<li><a href="BuscarDatos.php" title="Buscar Datos Introducidos">Buscar datos introducidos</a></li>
			<li><a href="ActualizarDatos.php" title="Actualizar Datos Introducidos">Actualizar datos introducidos</a></li>
			<li><a href="EliminarDatos.php" title="Eliminar Datos Introducidos">Eliminar datos introducidos</a></li>
			<li><a href="GenerarInforme.php" title="Generar informe de datos">Generar informe de datos</a></li>
			<li><a href="CargarDatos.php" title="Cargar datos desde archivo local">Cargar datos desde archivo local</a></li>
			<li><a href="ExportarDatos.php" title="Exportar datos a fichero">Exportar datos a fichero</a></li>
		</ul>
	</nav>
	<h1>Complete los datos a insertar en la tabla PruebasUsabilidad</h1>
	<form action='#' method='post'>
		<label for="nombre">Nombre: </label>
		<input id="nombre" type="text" placeholder="Miguel" name="nombre" required>
		<br>
		<label for="apellidos">Apellidos: </label>
		<input id="apellidos" type="text" placeholder="Menendez Rodriguez" name="apellidos" required>
		<br>
		<label for="correo">Email: </label>
		<input id="correo" type="email" placeholder="UO269871@uniovi.es" name="email" required>
		<br>
		<label for="telefono">Teléfono: </label>
		<input id="telefono" type="tel" pattern="[0-9]{9}" placeholder="987654321" name="telefono" required>
		<br>
		<label for="edad">Edad: </label>
		<input id="edad" type="number" placeholder="21" name="edad" required>
		<fieldset>
			<legend> Sexo </legend>
			<input id="masculino" type="radio" name="sexo" value="Masculino" checked>
			<label for="masculino">Masculino</label>
			<br>
			<input id="femenino" type="radio" name="sexo" value="Femenino">
			<label for="femenino">Femenino</label>
		</fieldset>
		<label for="pericia">Pericia: </label>
		<select id="pericia" name="pericia">
			<option value="0" selected>0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>
		<br>
		<label for="tiempo">Tiempo: </label>
		<input id="tiempo" type="number" placeholder="60" name="tiempo" required>
		<br>
		<fieldset>
			<legend> ¿Realizado correctamente? </legend>
			<input id="si" type="radio" name="correcta" value="Si" checked>
			<label for="si">Si</label>
			<input id="no" type="radio" name="correcta" value="No">
			<label for="no">No</label>
		</fieldset>
		<label for="comentarios">Escribe tu comentario: </label>
		<textarea id="comentarios" name="comentarios" placeholder="..." required></textarea>
		<br>
		<label for="propuestas">Propuestas: </label>
		<textarea id="propuestas" name="propuestas" placeholder="..." required></textarea>
		<br>
		<label for="valoracion">Valoración: </label>
		<select id="valoracion" name="valoracion">
			<option value="0" selected>0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>
		<br>
		<button type="submit" name="insertar">Insertar</button>
	</form>

	<?php
	require('BaseDatos.php');
	$base = new BaseDatos();

	if (count($_POST) > 0)
		if (isset($_POST['insertar']))
			$base->insertarDatos();
	?>
</body>

</html>