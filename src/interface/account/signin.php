<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../classes/Connection.php");
include_once("../../classes/User.php");
include_once("../../classes/Player.php");

$con = new Connection();
$user = new User();
$result;

if (isset($_POST['username_signin'])) {
    $con->setConnection();
    $result = $user->signIn($_POST['username_signin'], $_POST['password_signin'], $con->getConnection());

    unset($_POST['username_signin']);
    unset($_POST['password_signin']);

    if ($result == 1) {
        $_SESSION['signinOK'] = "No";
        header("Location: " . $_SERVER['PHP_SELF']);
    } else {
        $_SESSION['user_name'] = $result['user_name'];
        $_SESSION['signinOK'] = "Yes";

        $player = new Player();
        $player->setSessionID();
        $_SESSION['session_id'] = $player->getSessionID();
        
        if(isset($_SESSION['game_redirect'])) {
            $game = $_SESSION['game_redirect'];
            unset($_SESSION['game_redirect']);
            switch($game) {
                case "brainy_game":
                    header("Location: ../games/brainy/brainy_index.php");
                    break;
                case "lucky_game":
                    header("Location: ../games/lucky/lucky_index.php");
                    break;
                case "spell_game":
                    header("Location: ../games/spell/spell_index.php");
                    break;
            }
        } else {
            header("Location: ../games/main_index.php");
        }
    }

    die;
}

// include("../../utils/connection.php");
// include("../../utils/account_functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <link href="../../../asset/design.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
</head>

<body class="wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <aside class="col-sm-4">
                <div class="card">
                    <article class="card-body" style="margin: 6px;">
                        <a href="signup.php" class="float-right btn btn-outline-primary">Sign up</a>
                        <h4 class="card-title mb-4 mt-1">Sign in</h4>
                        <hr>
                        <?php 
                        if (isset($_SESSION['signinOK']) && $_SESSION['signinOK'] == "No") {
                            $_SESSION['signinOK'] = "Reset";
                            echo "<p class='text-danger text-center'>Wrong username or password</p>";
                        }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label>Your username</label>
                                <input name="username_signin" class="form-control" placeholder="Username" type="text" maxlength="20" required>
                            </div>
                            <div class="form-group">
                                <label>Your password</label>
                                <input name="password_signin" class="form-control" placeholder="******" type="password" minlength="6" maxlength="20" required>
                            </div>
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block"> Login </button>
                            </div>
                        </form>
                    </article>
                </div>
            </aside>
        </div>
    </div>
</body>

</html>