<?php

class Connection {
    private $dbhost = "localhost";
    private $dbuser = "root";
    private $dbpass = "";
    private $dbname = "mini_gamebox";
    private $conn;
    
    function setConnection() {
        $this->conn = mysqli_connect(
            $this->dbhost, $this->dbuser, $this->dbpass, $this->dbname
        );
    }

    function getConnection() {
        return $this->conn;
    }

    function checkConnection() {
        if(!$this->conn) {
            if (isset($_SESSION['user_id'])) {
                unset($_SESSION['user_id']);
            }
            return 1; // error
        } else {
            return 0; // connection exist
        }
    }
}
?>