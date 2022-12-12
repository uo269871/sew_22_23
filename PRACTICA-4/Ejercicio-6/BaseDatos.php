<?php

class BaseDatos
{
    private $servername;
    private $username;
    private $password;
    private $database;

    public function __construct()
    {
        $this->servername = "localhost";
        $this->username = "DBUSER2021";
        $this->password = "DBPSWD2021";
        $this->database = "baseDatos";
    }

    public function crearBaseDeDatos()
    {
        $transacc = new mysqli($this->servername, $this->username, $this->password);
        $consulta = "CREATE DATABASE IF NOT EXISTS baseDatos COLLATE utf8_spanish_ci";
        if ($transacc->query($consulta) === TRUE)
            echo "<p>Se creó la base de datos 'baseDatos'</p>";
        else {
            echo "<p>La base de datos ya existe o no se pudo crear</p>";
            exit();
        }
        $transacc->close();
    }

    public function crearTabla()
    {
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);

        $consulta = "CREATE TABLE IF NOT EXISTS PruebasUsabilidad (
                        id INT NOT NULL AUTO_INCREMENT,nombre VARCHAR(30), apellidos VARCHAR(30), email VARCHAR(30),
                        telefono VARCHAR(30), edad INT, sexo VARCHAR(30),
                        pericia INT, tiempo INT, correcta VARCHAR(3), comentarios VARCHAR(255),
						propuestas VARCHAR(255), valoracion INT,
                        PRIMARY KEY (id), CHECK (pericia BETWEEN 0 AND 10), CHECK (valoracion BETWEEN 0 AND 10))";

        if ($transacc->query($consulta) === TRUE)
            echo "<p>Se creó la tabla 'PruebasUsabilidad'</p>";
        else {
            echo "<p>La tabla ya existe o no se opudo crear</p>";
            exit();
        }
        $transacc->close();
    }

    public function insertarDatos()
    {
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $consultaInsercion = $transacc->prepare("INSERT INTO PruebasUsabilidad (nombre, apellidos, email, telefono, edad, sexo, pericia, tiempo, correcta, comentarios, propuestas, valoracion) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
        if ((empty($_POST['valoracion']) || empty($_POST['edad']) || empty($_POST['propuestas']) || empty($_POST['pericia'])
            || empty($_POST['correcta']) || empty($_POST['comentarios'])
            || empty($_POST['tiempo'])   || empty($_POST['sexo'] || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['email']) || empty($_POST['telefono']))))
            echo "<p>No se puede realizar la inserción, faltan campos por completar</p>";
        else {
            $consultaInsercion->bind_param(
                'ssssisiisssi',
                $_POST["nombre"],
                $_POST["apellidos"],
                $_POST["email"],
                $_POST["telefono"],
                $_POST["edad"],
                $_POST["sexo"],
                $_POST["pericia"],
                $_POST["tiempo"],
                $_POST["correcta"],
                $_POST["comentarios"],
                $_POST["propuestas"],
                $_POST["valoracion"]
            );
            $consultaInsercion->execute();
            echo "<p>Inserción realizada correctamente</p>";
            $consultaInsercion->close();
        }
        $transacc->close();
    }

    public function buscarDatos()
    {
        if (empty($_POST['id']))
            echo "<p>Introduzca id</p>";
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $consulta = $transacc->prepare("SELECT * FROM PruebasUsabilidad WHERE id = ?");
        $consulta->bind_param('i', $_POST["id"]);
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows >= 1) {
            echo "<h2>Datos de la prueba de usabilidad con id solicitado:</h2>";
            echo "<ul>";
            while ($row = $resultado->fetch_assoc()) {
                echo "<li>Edad del usuario que realizó la prueba: " . $row["nombre"] . "</li>";
                echo "<li>Edad del usuario que realizó la prueba: " . $row["apellidos"] . "</li>";
                echo "<li>Edad del usuario que realizó la prueba: " . $row["email"] . "</li>";
                echo "<li>Edad del usuario que realizó la prueba: " . $row["telefono"] . "</li>";
                echo "<li>Edad del usuario que realizó la prueba: " . $row["edad"] . "</li>";
                echo "<li>Sexo del usuario que realizó la prueba: " . $row["sexo"] . "</li>";
                echo "<li>¿Prueba realizada correctamente? " . $row["correcta"] . "</li>";
                echo "<li>Tiempo empleado en la prueba: " . $row["tiempo"] . "</li>";
                echo "<li>Pericia mostrada: " . $row["pericia"] . "</li>";
                echo "<li>Valoración de la aplicación: " . $row["valoracion"] . "</li>";
                echo "<li>Propuestas de mejora de la aplicación: " . $row["propuestas"] . "</li>";
                echo "<li>Comentarios extras: " . $row["comentarios"] . "</li>";
            }
            echo "</ul>";
        }
        $consulta->close();
        $transacc->close();
    }

    public function actualizarDatos()
    {
        if (empty($_POST['id']))
            echo "<p>Introduzca id</p>";
        else {
            $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
            $consulta = $transacc->prepare("UPDATE PruebasUsabilidad SET nombre = ?, apellidos = ?, email = ?, telefono = ?, edad = ?, sexo = ?, pericia = ?, tiempo = ?, correcta = ?, comentarios = ?, propuestas = ?, valoracion = ? WHERE id=?");
            if (
                empty($_POST['edad']) || empty($_POST['sexo']) || empty($_POST['pericia']) || empty($_POST['tiempo'])
                || empty($_POST['correcta']) || empty($_POST['comentarios'])
                || empty($_POST['propuestas']) || empty($_POST['valoracion']) || empty($_POST['nombre']) || empty($_POST['apellidos']) || empty($_POST['email']) || empty($_POST['telefono'])
            )
                echo "<p>No se puede realizar la actualización, faltan campos por completar</p>";
            else {
                $consulta->bind_param(
                    'ssssisiisssii',
                    $_POST["nombre"],
                    $_POST["apellidos"],
                    $_POST["email"],
                    $_POST["telefono"],
                    $_POST["edad"],
                    $_POST["sexo"],
                    $_POST["pericia"],
                    $_POST["tiempo"],
                    $_POST["correcta"],
                    $_POST["comentarios"],
                    $_POST["propuestas"],
                    $_POST["valoracion"],
                    $_POST["id"]
                );
                $consulta->execute();
                $consulta->close();
                echo "<p>Actualización realizada correctamente</p>";
            }
            $transacc->close();
        }
    }

    public function borrarDatos()
    {
        if (empty($_POST['id']))
            echo "<p>Introduzca id</p>";
        else {
            $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
            $consulta = $transacc->prepare("DELETE FROM PruebasUsabilidad WHERE id=?");
            $consulta->bind_param('i', $_POST["id"]);
            $consulta->execute();
            $consulta->close();
            echo "<p>Eliminación realizada correctamente</p>";
            $transacc->close();
        }
    }

    public function generarInforme()
    {
        $totalUsuarios = $this->totalUsuarios();
        $edadMedia = $this->getMediaValor('edad');
        $porcentajeMasculino = ($this->getCountValor('WHERE sexo="masculino"') / $totalUsuarios) * 100;
        $porcentajeFemenino = ($this->getCountValor('WHERE sexo="femenino"') / $totalUsuarios) * 100;
        $periciaMedia = $this->getMediaValor('pericia');
        $puntuacionMedia = $this->getMediaValor('valoracion');
        $tiempoMedio = $this->getMediaValor('tiempo');
        if ($totalUsuarios > 0)
            $porcentajeCorrectas = ($this->getCountValor('WHERE correcta="si"') / $totalUsuarios) * 100;
        else $porcentajeCorrectas = 0;

        echo "<ul>";
        echo "<li>Edad media de los usuarios $edadMedia años</li>";
        echo "<li>Frecuencia del %  de cada tipo de sexo entre los usuarios
				<ul>
				<li>Masculino: $porcentajeMasculino%</li>
				<li>Femenino: $porcentajeFemenino%</li>
				</ul>
			</li>";
        echo "<li>Valor medio del nivel o pericia informática de los usuarios $periciaMedia</li>";
        echo "<li>Tiempo medio para la tarea $tiempoMedio</li>";
        echo "<li>Porcentaje de usuarios que han realizado la tarea correctamente $porcentajeCorrectas%</li>";
        echo "<li>Valor medio de la puntuación de los usuarios sobre la aplicación $puntuacionMedia</li>";
        echo "</ul>";
    }

    private function getMediaValor($a1)
    {
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $resultado =  $transacc->query('SELECT AVG(' . $a1 . ') AS valor FROM PruebasUsabilidad');
        $media = null;
        if ($resultado->num_rows > 0)
            while ($row = $resultado->fetch_assoc())
                $media = $row["valor"];
        $transacc->close();
        return $media;
    }

    private function getCountValor($a1)
    {
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $resultado =  $transacc->query('SELECT COUNT(*) AS contador FROM PruebasUsabilidad ' . $a1);
        $total = null;
        if ($resultado->num_rows > 0)
            while ($row = $resultado->fetch_assoc())
                $total = $row["contador"];
        $transacc->close();
        return $total;
    }

    private function totalUsuarios()
    {
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $nUsuarios =  $transacc->query('SELECT COUNT(*) AS cuenta FROM PruebasUsabilidad');
        $total = null;
        if ($nUsuarios->num_rows > 0)
            while ($row = $nUsuarios->fetch_assoc())
                $total = $row["cuenta"];
        $transacc->close();
        return $total;
    }

    public function cargarDatos()
    {
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $archivo = fopen($_FILES['archivo']['tmp_name'], 'rb');
        while (($datos = fgetcsv($archivo)) == true) {
            $consultaInsercion = $transacc->prepare("INSERT INTO PruebasUsabilidad VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $consultaInsercion->bind_param(
                'issssisiisssi',
                $datos[0],
                $datos[1],
                $datos[2],
                $datos[3],
                $datos[4],
                $datos[5],
                $datos[6],
                $datos[7],
                $datos[8],
                $datos[9],
                $datos[10],
                $datos[11],
                $datos[12]
            );
            $consultaInsercion->execute();
        }
        $consultaInsercion->close();
        echo "<p>Datos cargados correctamente</p>";
    }

    public function exportarDatos()
    {
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $datosExportar =  $transacc->query('SELECT * FROM PruebasUsabilidad');
        $cadenaParaExportar = "";
        if ($datosExportar->num_rows > 0) {
            while ($row = $datosExportar->fetch_assoc()) {
                $cadenaParaExportar .= $row['id'] . "," . $row['nombre'] . "," . $row['apellidos'] . "," . $row['email'] . "," . $row['telefono'] . "," . $row['edad'] . "," . $row['sexo'] . "," . $row['pericia'] . "," . $row['tiempo'] . "," . $row['correcta'] . "," . $row['comentarios'] . "," . $row['propuestas'] . "," . $row['valoracion'] . "\n";
            }
        }
        $transacc->close();
        file_put_contents("baseDatos_exported.csv", $cadenaParaExportar);
        echo "<p>Fichero csv generado correctamente</p>";
    }
}