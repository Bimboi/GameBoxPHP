<?php

class Player extends User {
    private $session_id;
    private $name;

    function __construct($name)
    {
        $this->name = $name;
    }

    function setSessionID() {
        $this->session_id =  $this->name . $this->random_num(3);
    }

    function getSessionID() {
        return $this->session_id;
    }

    function recordSession($con, $user_id) {
        $this->setSessionID();
        
        $query = "insert into user_logs (session_id, user_id) values ('$this->session_id', '$user_id')";

        $query_result = mysqli_query($con, $query);

        if ($query_result) {
            return $this->session_id;
        } else {
            return false;
        }
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