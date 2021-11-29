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

    function recordGame($con, $selected_game)
    {
        $this->saveGame = new SaveGame($con);
        switch ($selected_game) {
            case Constants::brainy_name:
                $this->saveGame->memory($_SESSION['game_session_id'], $_SESSION['user_id'], $_SESSION['game_result'], $_SESSION['attempts']);
                break;
            case Constants::lucky_name:
                $this->saveGame->lucky($_SESSION['game_session_id'], $_SESSION['user_id'], $_SESSION['game_result'], $_SESSION['attempts']);
                break;
            case Constants::spell_name:
                $this->saveGame->spell($_SESSION['game_session_id'], $_SESSION['user_id'], $_SESSION['game_result'], $_SESSION['difficulty'], $_SESSION['time_spent']);
                break;
        }
    }

    function getBrainyScores($con)
    {
        $query = "select u.user_name, r.attempt, r.datetime_saved from brainy_records r inner join users u on r.user_id = u.user_id
                where r.result = 'won' order by r.attempt, r.datetime_saved ASC LIMIT 20";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<table border=1 style='border-collapse:collapse;'>
            <tr>
                <center>
                <th style='width: 80px'><b>RANK</b></th>
                <th style='width: 250px'><b>USERNAME</b></th>
                <th style='width: 135px'><b>ATTEMPTS</b></th>
                <th style='width: 135px'><b>DATETIME</b></th>
                </center>
            </tr>";

            $x = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . ++$x . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['attempt'] . "</td>";
                echo "<td>" . $row['datetime_saved'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<center><i>No one won</i></center>";
        }
    }

    function getLuckyScores($con)
    {
        $query = "select u.user_name, r.attempt, r.datetime_saved from lucky_guess_records r inner join users u on r.user_id = u.user_id
                where r.result = 'won' order by r.attempt, r.datetime_saved ASC LIMIT 20";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            echo "<table border=1 style='border-collapse:collapse;'>
            <tr>
                <center>
                <th style='width: 80px'><b>RANK</b></th>
                <th style='width: 250px'><b>USERNAME</b></th>
                <th style='width: 135px'><b>ATTEMPTS</b></th>
                <th style='width: 135px'><b>DATETIME</b></th>
                </center>
            </tr>";

            $x = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . ++$x . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['attempt'] . "</td>";
                echo "<td>" . $row['datetime_saved'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<center><i>No one won</i></center>";
        }
    }

    function getSpellMeScores($con, $difficulty)
    {
        $query = "select u.user_name, r.time_spent, r.datetime_saved from spell_me_records r inner join users u on r.user_id = u.user_id
                where r.result = 'won' and r.difficulty = '$difficulty' order by r.time_spent, r.datetime_saved ASC LIMIT 20";
        $result = mysqli_query($con, $query);

        if ($result && mysqli_num_rows($result) > 0) {

            echo "<table border=1 style='border-collapse:collapse;'>
            <tr>
                <center>
                <th style='width: 80px'><b>RANK</b></th>
                <th style='width: 215px'><b>USERNAME</b></th>
                <th style='width: 135px'><b>TIME SPENT<br>(in seconds)</b></th>
                <th style='width: 135px'><b>DATETIME</b></th>
                </center>
            </tr>";

            $x = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>" . ++$x . "</td>";
                echo "<td>" . $row['user_name'] . "</td>";
                echo "<td>" . $row['time_spent'] . "</td>";
                echo "<td>" . $row['datetime_saved'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<center><i>No one won</i></center>";
        }
    }
}
