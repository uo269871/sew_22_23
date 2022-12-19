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
        $this->username = "DBUSER2022";
        $this->password = "DBPSWD2022";
        $this->database = "musica";
    }

    public function buscarDatosManager()
    {
        if (empty($_POST['id']))
            echo "<p>Introduzca id</p>";
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $consulta = $transacc->prepare("SELECT v.name as i FROM artist v, manager t WHERE v.artist_id = t.artist_id AND t.manager_id = ?");
        $consulta->bind_param('i', $_POST["id"]);
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows >= 1) {
            echo "<h2>Artistas del manager ". $_POST['id'].":</h2>";
            echo "<ul>";
            while ($row = $resultado->fetch_assoc()) {
                echo "<li>" . $row["i"] ."</li>";
            }
            echo "</ul>";
        }
        $consulta->close();
        $transacc->close();
    }

    public function buscarDatosArtista()
    {
        if (empty($_POST['id']))
            echo "<p>Introduzca id</p>";
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $consulta = $transacc->prepare("SELECT v.*, i.name as n FROM album v, artist c, label i WHERE v.label_id = i.label_id and v.artist_id = c.artist_id AND c.artist_id = ?");
        try{
            $consulta->bind_param('i', $_POST["id"]);
        }catch (Exception $e) {
            
        }
        
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows >= 1) {
            echo "<h2>Datos del artista " . $_POST['id']. ":</h2>";
            echo "<ul>";
            while ($row = $resultado->fetch_assoc()) {
                echo "<li>Album " .  $row["name"] ." de la discografica " . $row["n"] . "</li>";
            }
            echo "</ul>";
        }
        $consulta->close();
        $transacc->close();
    }

    public function buscarDatosAlbum()
    {
        if (empty($_POST['id']))
            echo "<p>Introduzca id</p>";
        $transacc = new mysqli($this->servername, $this->username, $this->password, $this->database);
        $consulta = $transacc->prepare("SELECT v.name as j FROM song v, album c WHERE v.album_id = c.album_id AND c.album_id = ?");
        try{
            $consulta->bind_param('i', $_POST["id"]);
        }catch (Exception $e) {
            
        }
        
        $consulta->execute();
        $resultado = $consulta->get_result();
        if ($resultado->num_rows >= 1) {
            echo "<h2>Datos del album " . $_POST['id']. ":</h2>";
            echo "<ul>";
            while ($row = $resultado->fetch_assoc()) {
                echo "<li>" .  $row["j"] ."</li>";
            }
            echo "</ul>";
        }
        $consulta->close();
        $transacc->close();
    }
}