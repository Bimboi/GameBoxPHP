<?php

class Connection {
    private $_dbhost = "localhost";
    private $_dbuser = "root";
    private $_dbpass = "";
    private $_dbname = "mini_gamebox";
    private $_conn, $_msg;
    
    function __construct()
    {
        $this->_conn = mysqli_connect(
            $this->_dbhost, $this->_dbuser, $this->_dbpass, $this->_dbname
        );
    }

    function checkConnection() {
        if(!$this->_conn->connect_error) {            
            return $this->_conn;
        } else {
            $this->_msg = "Database connection failed: ";
            $this->_msg .= mysqli_connect_error();
            $this->_msg .= " : " . mysqli_connect_errno();
            return $this->_msg;
        }
    }
}
?>