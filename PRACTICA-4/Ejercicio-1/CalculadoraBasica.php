<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8"/>
		<title>Calculadora básica</title>
		<meta name="description" content="Calculadora básica. Ejercicio 1">
		<meta name="keywords" content="calculadora,calculo,matematicas">
		<meta name="author" content="Miguel Menéndez Rodríguez">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="CalculadoraBasica.css"/>
	</head>    
	<body>
		<h1>Calculadora Básica</h1>
			<?php
				class CalculadoraBasica {
					public $console;
					private $memory;
				
				public function __construct(){
					$this->console = "";
					$this->memory = 0;
				}
				public function getMemory(){
					return $this->memory;
				}
				public function getConsole(){
					return $this->console;
				}

				public function anadirCampoConsole($value){
					if ($this->getConsole() === "NaN" | $this->getConsole() === "Syntax Error" | $this->getConsole() === "Infinity"){
						$this->console = "";
					}        
					$this->console .= $value;
				}

				public function calcular(){
					try {
						$this->console = eval("return $this->console ;");
					} catch(Exception $e) {
						$this->console = "Syntax Error";
					}
				}

				public function memMostrar(){
					$this->console .= $this->getMemory();
					$this->memory = 0;
				}

				public function memSum(){
					$this->memory = $this->getMemory() + eval("return $this->console ;");
				}

				public function memSub(){
					$this->memory = $this->getMemory() - eval("return $this->console ;");
				}

				public function delete(){
					$this->console = "";
				}
			};

			if (!isset($_SESSION['calculadoraB']))
			  $_SESSION['calculadoraB']=new CalculadoraBasica();
			$calculadora = $_SESSION['calculadoraB'];

			if (count($_POST)>0)  {   
				if (isset($_POST['mrc']))
					$calculadora->memMostrar();
				elseif (isset($_POST['m-']))
					$calculadora->memSub();				
				elseif (isset($_POST['m+']))
					$calculadora->memSum();
				elseif(isset($_POST['0'])) 
					$calculadora->anadirCampoConsole("0"); 
				elseif(isset($_POST['1'])) 
					$calculadora->anadirCampoConsole("1"); 
				elseif (isset($_POST['2']))
					$calculadora->anadirCampoConsole("2"); 
				elseif (isset($_POST['3']))
					$calculadora->anadirCampoConsole("3");
				elseif (isset($_POST['4']))
					$calculadora->anadirCampoConsole("4");
				elseif (isset($_POST['5']))
					$calculadora->anadirCampoConsole("5");
				elseif (isset($_POST['6']))
					$calculadora->anadirCampoConsole("6");
				elseif (isset($_POST['7']))
					$calculadora->anadirCampoConsole("7");
				elseif (isset($_POST['8']))
					$calculadora->anadirCampoConsole("8");
				elseif (isset($_POST['9']))
					$calculadora->anadirCampoConsole("9");
				elseif (isset($_POST['/']))
					$calculadora->anadirCampoConsole("/");
				else if (isset($_POST['*']))
					$calculadora->anadirCampoConsole("*");
				elseif (isset($_POST['+']))
					$calculadora->anadirCampoConsole("+");
				elseif (isset($_POST['-']))
					$calculadora->anadirCampoConsole("-");
				elseif (isset($_POST['C']))
					$calculadora->delete();
				elseif (isset($_POST[',']))
					$calculadora->anadirCampoConsole(".");
				elseif (isset($_POST['=']))
					$calculadora->calcular();
			};

			echo "<form action='CalculadoraBasica.php' method='post' name='Calculadora'>
				<textarea title='pantalla' disabled>$calculadora->console</textarea>
				<button type='submit' name='mrc'>MRC</button>
				<button type='submit' name='m-'>M-</button>
				<button type='submit' name='m+'>M+</button>
				<button type='submit' name='/'>/</button>
				<button type='submit' name='7'>7</button>
				<button type='submit' name='8'>8</button>
				<button type='submit' name='9'>9</button>
				<button type='submit' name='*'>x</button>
				<button type='submit' name='4'>4</button>
				<button type='submit' name='5'>5</button>
				<button type='submit' name='6'>6</button>
				<button type='submit' name='-'>-</button>
				<button type='submit' name='1'>1</button>
				<button type='submit' name='2'>2</button>
				<button type='submit' name='3'>3</button>
				<button type='submit' name='+'>+</button>
				<button type='submit' name='0'>0</button>
				<button type='submit' name=','>.</button>
				<button type='submit' name='C'>C</button>
				<button type='submit' name='='>=</button>
			</form>";
			?>
	</body>
</html>