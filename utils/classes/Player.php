<?php

class Player extends User {
    private $session_id;
    private $name;

    function __construct()
    {
        $this->name = $_SESSION['user_name'];
    }

    function setSessionID() {
        $this->session_id =  $this->random_num(3) . $this->name;
    }

    function getSessionID() {
        return $this->session_id;
    }

    function random_num($length)
    {
        $text = "";

        for ($i = 0; $i < $length; $i++) {
            $text .= rand(0, 9);
        }

        $text .= date('Ymdhis');
        return $text;
    }
}
?>