<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<title>Cargar datos desde csv local</title>
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
			<li><a href="InsertarDatos.php" title="Insertar Datos de prueba de usabilidad">Insertar datos de prueba de usabilidad</a></li>
			<li><a href="BuscarDatos.php" title="Buscar Datos Introducidos">Buscar datos introducidos</a></li>
			<li><a href="ActualizarDatos.php" title="Actualizar Datos Introducidos">Actualizar datos introducidos</a></li>
			<li><a href="EliminarDatos.php" title="Eliminar Datos Introducidos">Eliminar datos introducidos</a></li>
			<li><a href="GenerarInforme.php" title="Generar informe de datos">Generar informe de datos</a></li>
			<li><a href="ExportarDatos.php" title="Exportar datos a fichero">Exportar datos a fichero</a></li>
		</ul>
	</nav>
	<h1>Cargar datos desde un csv local</h1>
	<form action='#' method='post' enctype='multipart/form-data'>
		<label for="file"></label>
		<input id ="file" type='file' name='archivo' />
		<input type='submit' name='cargar' value='Cargar' />
	</form>
	<?php
	require('BaseDatos.php');
	$base = new BaseDatos();

	if (count($_POST) > 0)
		if (isset($_POST['cargar']))
			$base->cargarDatos();
	?>
</body>

</html>