<?php


    $host = "localhost";
    $usuario = "root";
    $senha = "";
    $db = "u765172260_axolote";

    $con = new mysqli($host, $usuario, $senha, $db);

//estabelece conexão com banco de dados
class Conectar extends PDO {//php data object

    private $host = "localhost";
    private $usuario = "root";
    private $senha = "";
    private $db = "u765172260_axolote";

    public function __construct() {
        parent::__construct("mysql:host=$this->host;dbname=$this->db", "$this->usuario", "$this->senha");
    }

}
