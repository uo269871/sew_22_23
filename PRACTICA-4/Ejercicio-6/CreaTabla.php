<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<title>Crea tabla en bbdd</title>
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
			<li><a href="InsertarDatos.php" title="Insertar Datos de prueba de usabilidad">Insertar datos de prueba de usabilidad</a></li>
			<li><a href="BuscarDatos.php" title="Buscar Datos Introducidos">Buscar datos introducidos</a></li>
			<li><a href="ActualizarDatos.php" title="Actualizar Datos Introducidos">Actualizar datos introducidos</a></li>
			<li><a href="EliminarDatos.php" title="Eliminar Datos Introducidos">Eliminar datos introducidos</a></li>
			<li><a href="GenerarInforme.php" title="Generar informe de datos">Generar informe de datos</a></li>
			<li><a href="CargarDatos.php" title="Cargar datos desde archivo local">Cargar datos desde archivo local</a></li>
			<li><a href="ExportarDatos.php" title="Exportar datos a fichero">Exportar datos a fichero</a></li>
		</ul>
	</nav>
	<h1>Crear tabla de nombre PruebasUsabilidad</h1>
	<form action='#' method='post'>
		<input type='submit' name='generaTabla' value='Crear tabla' />
	</form>
	<?php
	require('BaseDatos.php');
	$data = new BaseDatos();

	if (count($_POST) > 0)
		if (isset($_POST['generaTabla']))
			$data->crearTabla();
	?>
</body>

</html>