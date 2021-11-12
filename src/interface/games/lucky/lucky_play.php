<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['session_id']) && !isset($_SESSION['game_session_id'])) {
    header("Location: ../../account/signin.php");
    $_SESSION['game_redirect'] = "lucky_game";
    die;
}

if (isset($_SESSION['answer_lucky']) && $_SESSION['answer_lucky'] == "Finished") {
    $_SESSION['answer_lucky'] = "";
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
    <link href="../../../../asset/button.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body class="wrapper" style="background: url('https://www.toptal.com/designers/subtlepatterns/patterns/bananas.png');">
    <div class="container">
        <div class="row justify-content-center">
            <aside class="col-sm-6">

                <div class="card shadow" style="position:relative; text-align:center">
                    <article class="card-body">
                        <h1 class="card-title text-center mb-4 mt-1">😱 Lucky Number 🙈</h1>
                        <hr>
                        <p>We have selected a random number between 1 - 50.
                            </br>See if you can guess it.</p>
                        <form method="POST" action="lucky_play.php" style="margin-bottom: 10px;">
                            <div>
                                <label for="guessField">Enter a guess: </label>
                                <input type="number" min="1" max="50" oninput="validity.valid||(value='');" id="guessField" name="guess" required>
                                <input type="submit" value="Submit guess" class="guessSubmit" id="submitguess">
                            </div>
                        </form>
                        <?php
                        $game = new Guessing();
                        $game->checkMatch();
                        ?>
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