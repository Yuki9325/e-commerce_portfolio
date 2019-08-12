<?php

class Config {
    private $servername = "localhost";
    private $username = "root";
    private $password = "root";
    private $database = "portfolio";

    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        if($this->conn->connect_error) {
            die("Error: " . $this->conn->connect_error);
        }
    }

    public function redirect($url) {
        echo "<script>window.location.replace('$url');</script>";
    }
}