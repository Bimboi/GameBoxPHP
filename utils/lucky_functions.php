<?php

if (isset($_POST['guess'])) {
    $attempt = (int) $_SESSION['attempts_lucky'];

    if ($attempt > 10) {
        header("Location: lucky_index.php");
        die;
    }

    $num1 = $_SESSION['answer_lucky'];
    $num2 = $_POST['guess'];

    $name = $_SESSION['user_name'];

    echo "<p>Attempt " . $attempt . "</p>";

    if ($num1 == $num2) {
        record_game($con, "won");
        $_SESSION['answer_lucky'] = "Finished";
        $_SESSION['win'] = "Lucky number";
        header("Location: lucky_win.php");
        die;
    } else {
        if ($num1 < $num2) {
            echo $num2 . " is wrong. </br>";
            echo $name . ". You should go lower.";
        }
        if ($num1 > $num2) {
            echo $num2 . " is wrong. </br>";
            echo $name . ". You should go higher.";
        }

        if ($attempt == 10) {
            record_game($con, "lost");
            echo "</br>";
            echo "<p>🙊 The answer is " . $_SESSION['answer_lucky'] . " 🤯</p>";
            echo "<p>You lost 😵‍💫";
            echo "</br>Keep it up next time gamer!</p>";
            echo '<p><a href="lucky_index.php">Start another game?</a>';
            $_SESSION['answer_lucky'] = "Finished";
        }
        $attempt += 1;
        $_SESSION['attempts_lucky'] = $attempt;
    }
}

function record_game($con, $result)
{
    $user_name = $_SESSION['user_name'];
    $game_id = game_lucky_id(15);
    $attempts = $_SESSION['attempts_lucky'];
    $query = "insert into lucky_guess_records (game_id,user_name,result,attempt) values ('$game_id','$user_name','$result','$attempts')";

    mysqli_query($con, $query);
}

function game_lucky_id($length)
{
    $text = "";
    if ($length < 5) {
        $length = 5;
    }

    $len = rand(4, $length);

    for ($i = 0; $i < $len; $i++) {
        # code...

        $text .= rand(0, 9);
    }

    $text .= "lucky";

    return $text;
}
