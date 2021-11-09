<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['session_id']) && !isset($_SESSION['game_session_id'])) {
    header("Location: ../../account/signin.php");
    $_SESSION['game_redirect'] = "lucky game";
    die;
}

include_once("../../../classes/Connection.php");
include_once("../../../classes/GamePlatform.php");

if (isset($_SESSION['game_result'])) {
    $gp = new GamePlatform();
    $con = new Connection();
    $con->setConnection();
    
    if($_SESSION['game_result'] == "won"){
        $gp->recordGame($con->getConnection(), $_SESSION['selected_game'], $_SESSION['user_name'], "won");
    } else {
        $gp->recordGame($con->getConnection(), $_SESSION['selected_game'], $_SESSION['user_name'], "lost");
    }
    unset($_SESSION['game_session_id']);
} else {
    header("Location: lucky_index.php");
    $game = new Guessing();
    $game->unsetGameVariables();
    unset($_SESSION['game_session_id']);
    die;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Lucky Number Chicken Dinner</title>
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
                        <h1 class="card-title text-center mb-4 mt-1">🔥 Lucky Number 🔥</h1>
                        <hr>
                        <?php
                        if($_SESSION['game_result'] == "won") {
                            echo "<p>Congratulations! You won " . $_SESSION['user_name'] . "! 😭🥳</p>";
                            echo "<p>Number of attempts: " . $_SESSION['attempts'] . "</p>";
                        } else {
                            echo "<p>You lost " . $_SESSION['user_name'] . " 😵‍💫";
                            echo "<p>🙊 The answer is " . $_SESSION['answer_lucky'] . " 🤯</p>";
                            echo "</br>Keep it up next time gamer!</p>";
                        }
                        unset($_SESSION['game_result']);
                        ?>
                        <p><a href="lucky_index.php">Start another game?</a>
                    </article>
                </div>
            </aside>
        </div>
    </div>
</body>

</html>

<?php
$game = new Guessing();
$game->unsetGameVariables();
?>