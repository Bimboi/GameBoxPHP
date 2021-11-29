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

include_once("../../../classes/Connection.php");
include_once("../../../classes/GamePlatform.php");

if (isset($_SESSION['game_result'])) {
    $con = new Connection();
    $con_result = $con->checkConnection();

    if ($con_result instanceof mysqli) {
        $game = $_SESSION['selected_game'];
        $platform = new GamePlatform();
        $platform->recordGame($con_result, $game);
        unset($_SESSION['game_session_id']);
        unset($_SESSION['selected_game']);
    } else {
        header("Location: lucky_index.php");
        $game = new Guessing();
        $game->unsetGameVariables();
        unset($_SESSION['game_session_id']);
        unset($_SESSION['game_result']);
        unset($_SESSION['selected_game']);
        die;
    }
} else {
    header("Location: spell_index.php");
    $game = new Spelling();
    $game->unsetGameVariables();
    unset($_SESSION['game_session_id']);
    unset($_SESSION['selected_game']);
    die;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Spell Me Chicken Dinner</title>
    <link href="../../../../asset/design.css" rel="stylesheet">
    <link href="../../../../asset/button.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body class="wrapper" style="background: url('https://www.toptal.com/designers/subtlepatterns/patterns/geometry2.png');">
    <div class="container">
        <div class="row justify-content-center">
            <aside class="col-sm-6">
                <div class="card shadow" style="position:relative; text-align:center">
                    <article class="card-body">
                        <h1 class="card-title text-center mb-4 mt-1">🔥 Spell Me 🔥</h1>
                        <hr>
                        <?php
                        if ($_SESSION['game_result'] == Constants::won) {
                            echo "<p>Congratulations! You won " . $_SESSION['user_name'] . "! 😭🥳</p>";
                            echo "<p>⏰ Time spent: " . $_SESSION['time_spent'] . "s</p>";
                        } else {
                            echo "<p>😵‍💫 You lost " . $_SESSION['user_name'];
                            echo "<p>🤯 Number of correct words: " . $_SESSION['spell_score'] . "</p>";
                            echo "<p>⏰ Time spent: " . $_SESSION['time_spent'] . "s</p>";
                            echo "</br>Keep it up next time gamer!</p>";
                        }
                        $game = new Spelling();
                        $game->unsetGameVariables();
                        unset($_SESSION['game_result']);
                        ?>
                        <p><a href="spell_index.php">Start another game?</a>
                    </article>
                </div>
            </aside>
        </div>
    </div>
</body>

</html>