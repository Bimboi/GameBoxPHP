<?php

class Player extends User {
    private $session_id;
    private $name = $_SESSION['user_name'];

    function setSessionID() {
        $this->session_id = date('Ymdhis') . $this->name;
    }

    function getSessionID() {
        return $this->session_id;
    }
}
?>