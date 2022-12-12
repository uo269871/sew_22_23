<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<title>Ejercicio 7</title>
	<meta name="description" content="Ejercicio 7">
	<meta name="keywords" content="bbdd, sql, php">
	<meta name="author" content="Miguel Menendez Rodriguez">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="Ejercicio7.css" rel="stylesheet" />
</head>

<body>
	<h1>Gestión Mueblería</h1>
	<h2>Menú para gestionar la mueblería:</h2>
	<nav>
		<ul>
			<li><a href="Ejercicio7.html" title="Menú principal">Menú principal</a></li>
			<li><a href="DatosCliente.php" title="Mirar ventas de un cliente">Mirar ventas de un cliente</a></li>
			<li><a href="DatosVendedor.php" title="Mirar ventas de un vendedor">Mirar ventas de un vendedor</a></li>
		</ul>
	</nav>
	<h1>Mirar vendedores de una tienda</h1>
	<form action='#' method='post'>
		<label for="id">Introduzca el id de la tienda a mostrar:</label>
		<input id="id" type="number" name='id' />
		<input type='submit' name='buscar' value='Buscar' />
	</form>
	<?php
	require('BaseDatos.php');
	$base = new BaseDatos();
	if (count($_POST) > 0)
		if (isset($_POST['buscar']))
			$base->buscarDatosTienda();
	?>
</body>

</html>