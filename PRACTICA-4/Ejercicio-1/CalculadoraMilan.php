<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8"/>
		<title>Calculadora Milan</title>
		<meta name="description" content="Calculadora Milan. Ejercicio 1">
		<meta name="keywords" content="calculadora,calculo,matematicas">
		<meta name="author" content="Miguel Menéndez Rodríguez">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="CalculadoraMilan.css"/>
	</head>    
	<body>
		<h1>Calculadora Milan</h1>
			<?php
				class CalculadoraMilan {
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

				if (!isset($_SESSION['calculadoraM']))
				  $_SESSION['calculadoraM']=new CalculadoraMilan();
				$calculadora = $_SESSION['calculadoraM'];
				
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
			
				echo "<label for='pantalla'>Pantalla</label>
				<form action='CalculadoraMilan.php' method='post' name='Calculadora'>
					<input type='text' id='pantalla' value='$calculadora->console' disabled />
					<!--Fila 1-->
        			<input type='submit'  name='C' value ='C'/>
        			<input type='submit'  name='CE' value ='CE'/>
        			<input type='submit'  name='±' value ='±'/>
        			<input type='submit'  name='√' value ='√'/>
        			<input type='submit'  name='%' value ='%'/>
			
        			<!--Fila 2-->  
        			<input type='submit'  name='7' value ='7'/>
        			<input type='submit'  name='8' value ='8'/>
        			<input type='submit'  name='9' value ='9'/>
        			<input type='submit'  name='*' value ='*'/>
        			<input type='submit'  name='/' value ='/'/>
			
        			<!--Fila 3-->  
        			<input type='submit'  name='4' value ='4'/>
        			<input type='submit'  name='5' value ='5'/>
        			<input type='submit'  name='6' value ='6'/>
        			<input type='submit'  name='-' value ='.'/>
        			<input type='submit'  name='mrc' value ='mrc'/>
			
        			<!--Fila 4--> 
        			<input type='submit'  name='1' value ='1'/>
        			<input type='submit'  name='2' value ='2'/>
        			<input type='submit'  name='3' value ='3'/>
        			<input type='submit'  name='+' value ='+'/>
        			<input type='submit'  name='m-' value ='m-'/>
			
        			<!--Fila 5--> 
        			<input type='submit'  name='0' value ='0'/>
        			<input type='submit'  name='.' value ='.'/>
        			<input type='submit'  name='=' value ='='/>
			
        			<input type='submit'  name='m+' value ='m+'/>
				</form>"; 
			?> 
	</body> 
</html> 