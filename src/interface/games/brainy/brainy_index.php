<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../../classes/Constants.php");

$game_name = Constants::brainy_name;

if (!isset($_SESSION['session_id'])) {
    header("Location: ../../account/signin.php");
    $_SESSION['game_redirect'] = $game_name;
    die;
}

include_once("../../../classes/Connection.php");
include_once("../../../classes/GamePlatform.php");

$game = new GamePlatform();
$game->pickGame($game_name);
$game = new Memory();
$game->unsetPicks();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Brainy!</title>
    <link href="../../../../asset/design.css" rel="stylesheet">
    <link href="../../../../asset/button.css" rel="stylesheet">
    <link href="../../../../asset/button_back.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body>
    <div class="wrapper" style="background: url('https://www.toptal.com/designers/subtlepatterns/patterns/darkness.png');">
        <div class="container">
            <div class="row justify-content-center">
                <aside class="col-sm-6">

                    <div class="card shadow" style="position:relative; text-align:center">
                        <article class="card-body">
                            <h1 class="card-title text-center mb-4 mt-1">🤓 Brainy! 🃏</h1>
                            <hr style="margin-bottom: 30px;">
                            <h4 class="text-dark text-center">🥱 10 attempts</h4>
                            <h4 class="text-dark text-center">🔎 4 matching cards</h4>
                            <div class="form-group" style="margin-top: 20px;">
                                <div class="row justify-content-center">
                                    <div ontouchstart="">
                                        <div class="button_back">
                                            <a href="../main_index.php" style="color: white; font-weight: bold;">Back</a>
                                        </div>
                                    </div>
                                    <div ontouchstart="">
                                        <div class="button">
                                            <a href="brainy_play.php" style="color: white; font-weight: bold;">Start</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>

                    </div>
                </aside>
            </div>
        </div>
    </div>
    <div class="navbar fixed-bottom" style="color: white;">
        <?php
        $id = isset($_SESSION['session_id']) ? "ID: " . $_SESSION['session_id'] : '';
        echo $id;
        ?>
    </div>
</body>

</html>