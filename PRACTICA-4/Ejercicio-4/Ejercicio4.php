<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<title>Ejercicio 4</title>
	<meta name="description" content="Datos del precio del petroleo. Ejercicio 3">
	<meta name="keywords" content="petroleo,api,precio,dolar">
	<meta name="author" content="Miguel Menéndez Rodríguez">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="Ejercicio4.css">
</head>

<body>
	<h1>Datos del precio del petroleo <a href="https://commodities-api.com">Commodities-api</a></h1>
	<section>
		<h2>Precio del petróleo</h2>
			<?php
			    $endpoint = 'latest';
			    $access_key = '2dh9t30k4zjygby10ho7eh7raohwf6kegnj5dnb0626d83wzg9fq47i73du6';

			    $ch = curl_init('https://commodities-api.com/api/'.$endpoint.'?access_key='.$access_key.'');
			    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			    $json = curl_exec($ch);
			    curl_close($ch);

			    $exchangeRates = json_decode($json, true);

			    echo "<table>
			    	    <tr>
			    	    	<th>Tipo de petróleo</th>
			    	    	<th>Precio</th>
			    	    </tr>
			    	    <tr>
			    	    	<td>Barril de petróleo Brent</td>
			    	    	<td>" . 1/$exchangeRates['data']['rates']['BRENTOIL'] . "$</td>
			    	    </tr>
			    	    <tr>
			    	    	<td>Barril de petróleo crudo</td>
			    	    	<td>" . 1/$exchangeRates['data']['rates']['WTIOIL'] . "$</td>
			    	    </tr>
			        </table>";
			?>
	</section>
</body>

</html>