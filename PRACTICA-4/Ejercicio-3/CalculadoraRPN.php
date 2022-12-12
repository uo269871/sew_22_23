<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8" />
	<title>Calculadora RPN</title>
	<meta name="description" content="Calculadora RPN. Ejercicio 3">
	<meta name="keywords" content="calculadora,rpn,calculo,matematicas">
	<meta name="author" content="Miguel Menéndez Rodríguez">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="CalculadoraRPN.css" />
</head>

<body>
	<h1>Calculadora RPN</h1>
	<?php
	class PilaLIFO
	{
		protected $pila;

		public function __construct()
		{
			$this->pila = array();
		}

		public function apilar($elemento)
		{
			array_unshift($this->pila, $elemento);
		}

		public function desapilar()
		{
			if ($this->isVacia()) {
				throw new RunTimeException('¡Pila vacía! No se pueden desapilar elementos');
			} else {
				return array_shift($this->pila);
			}
		}

		public function getUltimoElementoPila()
		{
			return current($this->pila);
		}

		public function isVacia()
		{
			return empty($this->pila);
		}

		public function getElementoAt($i)
		{
			return $this->pila[$i];
		}

		public function getSizePila()
		{
			return count($this->pila);
		}

		public function resetearPila()
		{
			$this->pila = array();
		}
	};

	class CalculadoraRPN
	{
		private $pila;
		public $valoresPila;
		public $consola;

		public function __construct()
		{
			$this->consola = "";
			$this->valoresPila = "";
			$this->pila = new PilaLIFO(8);
		}
		public function getconsola()
		{
			return $this->consola;
		}

		public function annadirCampoConsola($value)
		{
			$this->consola .= $value;
		}

		public function push()
		{
			if ($this->consola != "") {
				$this->pila->apilar($this->consola);
				$this->delete();
			}
			$this->estadoPila();
		}

		public function delete()
		{
			$this->consola = "";
		}

		public function deleteAll()
		{
			$this->consola = "";
			$this->pila->resetearPila();
			$this->estadoPila();
		}

		public function calculate($value)
		{
			if ($this->pila->getSizePila() >= 2) {
				$toEvaluate = floatval($this->pila->desapilar());
				switch ($value) {
					case "+":
						$toEvaluate = $toEvaluate + floatval($this->pila->desapilar());
						break;
					case "-":
						$toEvaluate = floatval($this->pila->desapilar()) - $toEvaluate;
						break;
					case "*":
						$toEvaluate = $toEvaluate * floatval($this->pila->desapilar());
						break;
					case "/":
						$toEvaluate = floatval($this->pila->desapilar()) / $toEvaluate;
						break;
					case "**":
						$toEvaluate = $toEvaluate ** floatval($this->pila->desapilar());
						break;
				}
				$this->pila->apilar($toEvaluate);
			}
			$this->estadoPila();
		}

		public function sqrt()
		{
			$number = $this->pila->desapilar();
			$this->pila->apilar(sqrt($number));
			$this->delete();
			$this->estadoPila();
		}

		public function logaritmo()
		{
			$number = $this->pila->desapilar();
			$this->pila->apilar(log($number));
			$this->delete();
			$this->estadoPila();
		}

		public function seno()
		{
			$number = $this->pila->desapilar();
			$this->pila->apilar(sin($number));
			$this->delete();
			$this->estadoPila();
		}

		public function coseno()
		{
			$number = $this->pila->desapilar();
			$this->pila->apilar(cos($number));
			$this->delete();
			$this->estadoPila();
		}

		public function tangente()
		{
			$number = $this->pila->desapilar();
			$this->pila->apilar(tan($number));
			$this->delete();
			$this->estadoPila();
		}

		public function estadoPila()
		{
			$this->valoresPila = "";
			for ($i = ($this->pila->getSizePila() - 1); $i >= 0; $i--) {
				$this->valoresPila .= $i . ": " . $this->pila->getElementoAt($i) . "\n";
			}
		}
	};

	if (!isset($_SESSION['calculadoraR']))
		$_SESSION['calculadoraR'] = new CalculadoraRPN();
	$calculadora = $_SESSION['calculadoraR'];

	if (count($_POST) > 0) {
		if (isset($_POST['sin']))
			$calculadora->seno();
		elseif (isset($_POST['cos']))
			$calculadora->coseno();
		elseif (isset($_POST['tan']))
			$calculadora->tangente();
		elseif (isset($_POST['log']))
			$calculadora->logaritmo();
		elseif (isset($_POST['sqrt']))
			$calculadora->sqrt();
		elseif (isset($_POST['7']))
			$calculadora->annadirCampoConsola("7");
		elseif (isset($_POST['8']))
			$calculadora->annadirCampoConsola("8");
		elseif (isset($_POST['9']))
			$calculadora->annadirCampoConsola("9");
		elseif (isset($_POST['/']))
			$calculadora->calculate("/");
		elseif (isset($_POST['4']))
			$calculadora->annadirCampoConsola("4");
		elseif (isset($_POST['5']))
			$calculadora->annadirCampoConsola("5");
		elseif (isset($_POST['6']))
			$calculadora->annadirCampoConsola("6");
		else if (isset($_POST['*']))
			$calculadora->calculate("*");
		elseif (isset($_POST['1']))
			$calculadora->annadirCampoConsola("1");
		elseif (isset($_POST['2']))
			$calculadora->annadirCampoConsola("2");
		elseif (isset($_POST['3']))
			$calculadora->annadirCampoConsola("3");
		elseif (isset($_POST['-']))
			$calculadora->calculate("-");
		elseif (isset($_POST['0']))
			$calculadora->annadirCampoConsola("0");
		elseif (isset($_POST[',']))
			$calculadora->annadirCampoConsola(".");
		elseif (isset($_POST['retroceso']))
			$calculadora->delete();
		elseif (isset($_POST['+']))
			$calculadora->calculate("+");
		elseif (isset($_POST['apilar']))
			$calculadora->push();
		elseif (isset($_POST['C']))
			$calculadora->deleteAll();
	};

	echo "<form action='CalculadoraRPN.php' method='post' name='Calculadora'>
				<textarea title='pila' disabled>$calculadora->valoresPila</textarea>
				<textarea title='pantalla' disabled>$calculadora->consola</textarea>
				<button type='submit' name='sqrt'>&#x221A;</button>
				<button type='submit' name='sin'>sin</button>
				<button type='submit' name='cos'>cos</button>
				<button type='submit' name='tan'>tan</button>
				<button type='submit' name='log'>log</button>
				<button type='submit' name='C'>AC</button>
				<button type='submit' name='apilar'>Apilar</button>
				<button type='submit' name='7'>7</button>
				<button type='submit' name='8'>8</button>
				<button type='submit' name='9'>9</button>
				<button type='submit' name='/'>/</button>
				<button type='submit' name='4'>4</button>
				<button type='submit' name='5'>5</button>
				<button type='submit' name='6'>6</button>
				<button type='submit' name='*'>x</button>
				<button type='submit' name='1'>1</button>
				<button type='submit' name='2'>2</button>
				<button type='submit' name='3'>3</button>
				<button type='submit' name='-' value='-'>-</button>
				<button type='submit' name='0'>0</button>
				<button type='submit' name=','>.</button>
				<button type='submit' name='retroceso'>&#x2190;</button>
				<button type='submit' name='+'>+</button>
			</form>";
	?>
</body>

</html>