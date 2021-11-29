<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../../classes/Constants.php");

$game_name = Constants::spell_name;

if (!isset($_SESSION['session_id'])) {
    header("Location: ../../account/signin.php");
    $_SESSION['game_redirect'] = $game_name;
    die;
} else if (isset($_SESSION['selected_game'])) {
    if ($_SESSION['selected_game'] != $game_name) {
        header("Location: spell_index.php");
        die;
    }
} else {
    header("Location: spell_index.php");
    die;
}

include_once("../../../classes/Game.php");
include_once("../../../classes/Spelling.php");

if (isset($_POST["game_mode"])) {
    $game = new Spelling();
    $game->setDifficulty($_POST["game_mode"]);
    unset($_POST["game_mode"]);
} else {
    header("Location: spell_index.php");
    die;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Spell Me</title>
    <link href="../../../../asset/design.css" rel="stylesheet" type="text/css">
    <link href="../../../../asset/button.css" rel="stylesheet" type="text/css">
    <link href="../../../../asset/button_back.css" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>
        var timer;
        var timeLeft = 120;

        function gameOver() {
            cancelInterval(timer);
            $('#timer').html("Time is up!");
        }

        function updateTimer() {
            timeLeft = timeLeft - 1;
            if (timeLeft >= 0) {
                $('#timer').html(timeLeft);
                $('#timer_input').val(timeLeft);
            } else {
                gameOver();
            }
        }

        function start() {
            timer = setInterval(updateTimer, 1000);
            updateTimer();
        }

        function changeClass(name_input, word, row_id, index) {
            var id_index_0 = "";
            var id_index_1 = "";

            if (index == 0) {
                id_index_0 = row_id + "_col_0";
                id_index_1 = row_id + "_col_1";
            } else {
                id_index_0 = row_id + "_col_1";
                id_index_1 = row_id + "_col_0";
            }

            var ref_input = document.getElementById(name_input);
            var ref_td_0 = document.getElementById(id_index_0);
            var ref_td_1 = document.getElementById(id_index_1);
            var color = window.getComputedStyle(ref_td_0, null)['backgroundColor'];

            ref_input.value = word;

            if (color == "rgb(255, 165, 0)") {
                ref_td_0.className = 'spell_me_checked';
                ref_td_1.className = 'spell_me_unchecked';
            } else if (color == "rgb(135,206,250)") {
                ref_td_0.className = 'spell_me_unchecked';
                ref_td_1.className = 'spell_me_checked';
            }
        }
        setTimeout(function() {
            start();
        }, 800);
    </script>
</head>

<body class="wrapper" style="background: url('https://www.toptal.com/designers/subtlepatterns/patterns/geometry2.png');">
    <div class="container">
        <div class="row justify-content-center">
            <aside class="col-sm-10">
                <div class="card shadow" style="position:relative; text-align:center;">
                    <article class="card-body">
                        <h1 class="card-title text-center mb-4 mt-1">📖 Spell Me 🧙</h1>
                        <hr>
                        <h4 class="py-3">Find the correct words.</h4>
                        <p id="message">You have: <span id="timer">120</span> seconds remaining!</p>
                        <center>
                            <form id="spell_form" method='POST' action='spell_process.php'>
                                <input type="hidden" id="timer_input" name="time_left" value="100">
                                <table class="spell_me_table">
                                    <?php
                                    for ($x = 0; $x <= 4; $x++) {
                                        $name_input = "picked_word_" . $x;
                                        $name_session = "words_" . $x + 1;
                                        $name_td_row_id = "id_row_" . $x;
                                        $name_td_id_1 = "id_row_" . $x . "_col_0";
                                        $name_td_id_2 = "id_row_" . $x . "_col_1";
                                        $name_radio_id_1 = "label_row_" . $x . "_col_0";
                                        $name_radio_id_2 = "label_row_" . $x . "_col_1";
                                        $name_word_1 = $_SESSION[$name_session][0];
                                        $name_word_2 = $_SESSION[$name_session][1];

                                        echo "<input type='hidden' id='" . $name_input . "' name='" . $name_input . "' value=''/>";
                                        echo "<tr>
                                                <td class='spell_me_unchecked' id='" . $name_td_id_1 . "' onclick='changeClass(\"" . $name_input . "\", \"" . $name_word_1 . "\", \"" . $name_td_row_id . "\", 0)'>
                                                    <h4>" . $name_word_1 . "</h4>
                                                </td>
                                                <td class='spell_me_unchecked' id='" . $name_td_id_2 . "' onclick='changeClass(\"" . $name_input . "\", \"" . $name_word_2 . "\", \"" . $name_td_row_id . "\", 1)'>
                                                    <h4>" . $name_word_2 . "</h4>
                                                </td>
                                            </tr>";
                                    }
                                    ?>
                                </table>
                                <br>
                                <hr>
                                <div class="row justify-content-center">
                                    <div ontouchstart="">
                                        <div class="button_back">
                                            <a href="spell_index.php" style="color: white; font-weight: bold;">Quit</a>
                                        </div>
                                    </div>
                                    <div ontouchstart="">
                                        <div class="button">
                                            <a href="#" onclick="document.getElementById('spell_form').submit();" style="color: white; font-weight: bold;">Submit Answers</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </center>
                    </article>
                </div>
            </aside>
        </div>
    </div>
    <div class="navbar fixed-bottom" style="color: black;">
        <?php
        $id = isset($_SESSION['session_id']) ? "ID: " . $_SESSION['session_id'] : '';
        echo $id;
        ?>
    </div>
</body>

</html>