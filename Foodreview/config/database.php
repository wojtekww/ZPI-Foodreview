<?php

class Database{

    private $host = "poleroplcczpi.mysql.db";
    private $db_name = "poleroplcczpi";
    private $username = "poleroplcczpi";
    private $password = "Zpichlopaki123";
    public $conn;

    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=".$this->db_name . ";charset=utf8", $this->username, $this->password);			
            //$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=".$this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: ".$exception->getMessage();
        }
        return $this->conn;
    }

}

/*
LOCALHOST


class Database{

    private $host = "localhost";
    private $db_name = "fr";
    private $username = "root";
    private $password = "";
    public $conn;

    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=".$this->db_name . ";charset=utf8", $this->username, $this->password);			
            //$this->conn = new PDO("mysql:host=" . $this->host . ";dbname=".$this->db_name, $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: ".$exception->getMessage();
        }
        return $this->conn;
    }

}*/

?>
