<?php

include_once("GameBox.php");
include_once("GameSession.php");
include_once("SaveGame.php");

class GamePlatform
{
    private $game;
    private $saveGame;

    function pickGame($selected_game)
    {
        $this->game = new GameBox();
        $this->game->setGame($selected_game);
    }

    function recordGame($con, $selected_game, $username, $result)
    {
        $this->saveGame = new SaveGame($con);
        $id = $_SESSION['game_session_id'];

        switch ($selected_game) {
            case 'memory':
                $this->saveGame->memory($username, $id, $_SESSION['attempts'], $result);
                break;
            case 'lucky':
                $this->saveGame->lucky($username, $id, $_SESSION['attempts'], $result);
                break;
            case 'spell':
                $this->saveGame->spell($username, $id, $_SESSION['difficulty'], $_SESSION['time_spent'], $result);
                break;
        }
    }

    function getBrainyScores($con)
    {
        $query = "select user_name, attempt, date_created from brainy_records 
                where result = 'won' order by attempt, date_created ASC LIMIT 20";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
    
            echo "<table border=1 style='border-collapse:collapse;'>
            <tr>
                <center>
                <th style='width: 80px'><b>RANK</b></th>
                <th style='width: 215px'><b>NAME</b></th>
                <th style='width: 135px'><b>ATTEMPTS</b></th>
                <th style='width: 135px'><b>DATE</b></th>
                </center>
            </tr>";
    
            $x = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . ++$x . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['attempt'] . "</td>";
                echo "<td>" . $row['date_created'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    function getLuckyScores($con)
    {
        $query = "select user_name, attempt, date_created from lucky_guess_records 
                where result = 'won' order by attempt, date_created ASC LIMIT 20";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            echo "<table border=1 style='border-collapse:collapse;'>
            <tr>
                <center>
                <th style='width: 80px'><b>RANK</b></th>
                <th style='width: 215px'><b>NAME</b></th>
                <th style='width: 135px'><b>ATTEMPTS</b></th>
                <th style='width: 135px'><b>DATE</b></th>
                </center>
            </tr>";

            $x = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . ++$x . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['attempt'] . "</td>";
                echo "<td>" . $row['date_created'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }

    function getSpellMeScores($con, $difficulty)
    {
        $query = "select user_name, timeSpent, date_created from spell__records 
                where result = 'won', difficulty = '$difficulty' order by timeSpent, date_created ASC LIMIT 20";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            echo "<table border=1 style='border-collapse:collapse;'>
            <tr>
                <center>
                <th style='width: 80px'><b>RANK</b></th>
                <th style='width: 215px'><b>NAME</b></th>
                <th style='width: 135px'><b>TIME SPENT</b></th>
                <th style='width: 135px'><b>DATE</b></th>
                </center>
            </tr>";

            $x = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . ++$x . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['timeSpent'] . "</td>";
                echo "<td>" . $row['date_created'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        }
    }
}
