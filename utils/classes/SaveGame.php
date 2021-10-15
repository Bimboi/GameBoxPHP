<?php

class SaveGame {
    private $db_connection;

    function __construct($con)
    {
        $this->db_connection = $con;
    }

    function __call($game_name, $args)
    {
        switch ($game_name) {
            case "memory":
                $this->record_memory_game($args[0], $args[1], $args[2], $args[3]);
                break;
            case "lucky":
                $this->record_lucky_game($args[0], $args[1], $args[2], $args[3]);
                break;
            case "spell":
                $this->record_spell_me_game($args[0], $args[1], $args[2], $args[3], $args[4]);
                break;
        }
    }

    function record_memory_game($user_name, $game_id, $attempts, $result)
    {
        $query = "insert into brainy_records (game_id,user_name,result,attempt) values ('$game_id','$user_name','$result','$attempts')";

        mysqli_query($this->db_connection, $query);
    }

    function record_lucky_game($user_name, $game_id, $attempts, $result)
    {
        $query = "insert into lucky_guess_records (game_id,user_name,result,attempt) values ('$game_id','$user_name','$result','$attempts')";

        mysqli_query($this->db_connection, $query);
    }

    function record_spell_me_game($user_name, $game_id, $difficulty, $timeSpent, $result)
    {
        $query = "insert into spell_me_records (game_id,user_name,result,difficulty,timeSpent) values ('$game_id','$user_name','$result','$difficulty','$timeSpent')";

        mysqli_query($this->db_connection, $query);
    }
}
