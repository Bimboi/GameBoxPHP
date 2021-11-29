<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../../classes/Constants.php");

$game_name = Constants::lucky_name;

if (!isset($_SESSION['session_id'])) {
    header("Location: ../../account/signin.php");
    $_SESSION['game_redirect'] = $game_name;
    die;
} else if (isset($_SESSION['selected_game'])) {
    if ($_SESSION['selected_game'] != $game_name) {
        header("Location: lucky_index.php");
        die;
    }
} else {
    header("Location: lucky_index.php");
    die;
}

include_once("../../../classes/Game.php");
include_once("../../../classes/Guessing.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lucky Number</title>
    <link href="../../../../asset/design.css" rel="stylesheet">
    <link href="../../../../asset/button_back.css" rel="stylesheet">
    <link href="../../../../asset/button.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body class="wrapper" style="background: url('https://www.toptal.com/designers/subtlepatterns/patterns/bananas.png');">
    <div class="container">
        <div class="row justify-content-center">
            <aside class="col-sm-8">
                <div class="card shadow" style="position:relative; text-align:center">
                    <article class="card-body">
                        <h1 class="card-title text-center mb-4 mt-1">😱 Lucky Number 🙈</h1>
                        <hr>
                        <h4 style="margin-top: 10px">We have selected a random number between 1 - 50.
                            </br>See if you can guess it.</h4>
                        <br>
                        <form method="POST" id="form-1" action="lucky_play.php" style="margin-bottom: 20px;">
                            <div>
                                <label for="guessField"><h5>Enter your guess: </h5></label>
                                <input type="number" min="1" max="50" oninput="validity.valid||(value='');" id="guessField" name="guess" required>
                            </div>
                        </form>
                        <?php
                        $game = new Guessing();
                        $game->checkMatch();
                        ?>
                        <br>
                        <hr>
                        <div class="row justify-content-center">
                            <div ontouchstart="">
                                <div class="button_back">
                                    <a href="lucky_index.php" style="color: white; font-weight: bold;">Quit</a>
                                </div>
                            </div>
                            <div ontouchstart="">
                                <div class="button">
                                    <a href="#" onclick="document.getElementById('form-1').submit();" style="color: white; font-weight: bold;">Submit Guess</a>
                                </div>
                            </div>
                        </div>
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