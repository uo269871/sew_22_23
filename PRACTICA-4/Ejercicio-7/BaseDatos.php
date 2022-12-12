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
        $this->database = "muebleria";
    }

    public function buscarDatosTienda()
    {
        if (empty($_POST['id']))
            echo "<p>Introduzca id</p>";
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $consulta = $transacc->prepare("SELECT v.nombre as i, v.direccion as d FROM vendedores v, tiendas t WHERE v.id = t.id AND t.id = ?");
        $consulta->bind_param('i', $_POST["id"]);
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows >= 1) {
            echo "<h2>Vendedores de la tienda ". $_POST['id'].":</h2>";
            echo "<ul>";
            while ($row = $resultado->fetch_assoc()) {
                echo "<li>Vendedor de nombre " . $row["i"] . " que vive en " . $row["d"]. "</li>";
            }
            echo "</ul>";
        }
        $consulta->close();
        $transacc->close();
    }

    public function buscarDatosCliente()
    {
        if (empty($_POST['id']))
            echo "<p>Introduzca id</p>";
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $consulta = $transacc->prepare("SELECT v.id as j, i.nombre as n FROM ventas v, clientes c, vendedores i WHERE v.clienteId = c.id AND c.id = ?");
        try{
            $consulta->bind_param('i', $_POST["id"]);
        }catch (Exception $e) {
            
        }
        
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows >= 1) {
            echo "<h2>Datos del cliente " . $_POST['id']. ":</h2>";
            echo "<ul>";
            while ($row = $resultado->fetch_assoc()) {
                echo "<li>Venta " .  $row["j"] ." realizada por " . $row["n"] . "</li>";
            }
            echo "</ul>";
        }
        $consulta->close();
        $transacc->close();
    }

    public function buscarDatosVendedor()
    {
        if (empty($_POST['id']))
            echo "<p>Introduzca id</p>";
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $consulta = $transacc->prepare("SELECT v.id as j, c.nombre as n FROM ventas v, clientes c, vendedores i WHERE v.vendedorId = i.id AND i.id = ?");
        try{
            $consulta->bind_param('i', $_POST["id"]);
        }catch (Exception $e) {
            
        }
        
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows >= 1) {
            echo "<h2>Datos del vendedor " . $_POST['id']. ":</h2>";
            echo "<ul>";
            while ($row = $resultado->fetch_assoc()) {
                echo "<li>Venta " .  $row["j"] ." realizada a " . $row["n"] . "</li>";
            }
            echo "</ul>";
        }
        $consulta->close();
        $transacc->close();
    }
}