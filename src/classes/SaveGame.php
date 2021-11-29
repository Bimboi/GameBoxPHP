<?php

class SaveGame {
    private $db_connection;

    function __construct($con)
    {
        $this->db_connection = $con;
    }

    function __call($func_name, $args)
    {
        switch ($func_name) {
            case 'memory':
                $this->record_memory_game($args[0], $args[1], $args[2], $args[3]);
                break;
            case 'lucky':
                $this->record_lucky_game($args[0], $args[1], $args[2], $args[3]);
                break;
            case 'spell':
                $this->record_spell_me_game($args[0], $args[1], $args[2], $args[3], $args[4]);
                break;
        }
    }

    function record_memory_game($game_id, $user_id, $result, $attempts)
    {
        $query = "insert into brainy_records (game_id,user_id,result,attempt) values ('$game_id','$user_id','$result','$attempts')";

        mysqli_query($this->db_connection, $query);
    }

    function record_lucky_game($game_id,$user_id, $result, $attempts)
    {
        $query = "insert into lucky_guess_records (game_id,user_id,result,attempt) values ('$game_id','$user_id','$result','$attempts')";

        mysqli_query($this->db_connection, $query);
    }

    function record_spell_me_game($game_id, $user_id, $result, $difficulty, $time_spent)
    {
        $query = "insert into spell_me_records (game_id,user_id,result,difficulty,time_spent) values ('$game_id','$user_id','$result','$difficulty','$time_spent')";

        mysqli_query($this->db_connection, $query);
    }
}
