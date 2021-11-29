<?php

if (!isset($_SESSION)) {
    session_start();
}

include_once("../../classes/Connection.php");
include_once("../../classes/User.php");
include_once("../../classes/Player.php");
include_once("../../classes/Constants.php");

if (isset($_POST['username_signin']) and isset($_POST['password_signin'])) {
    $user = new User($_POST['username_signin'], $_POST['password_signin']);

    unset($_POST['username_signin']);
    unset($_POST['password_signin']);

    $con = new Connection();
    $con_result = $con->checkConnection();

    if ($con_result instanceof mysqli) {
        $sign_in_result = $user->signIn($con_result);
        if ($sign_in_result) {
            $_SESSION['user_id'] = $sign_in_result['user_id'];
            $_SESSION['user_name'] = $sign_in_result['user_name'];
            $_SESSION['sign_in_error_visible'] = Constants::no;

            $player = new Player($sign_in_result['user_name']);
            $query_result = $player->recordSession($con_result, $sign_in_result['user_id']);

            if ($query_result) {
                $_SESSION['session_id'] = $query_result;

                if (isset($_SESSION['game_redirect'])) {
                    $game = $_SESSION['game_redirect'];
                    unset($_SESSION['game_redirect']);
                    switch ($game) {
                        case Constants::brainy_name:
                            header("Location: ../games/brainy/brainy_index.php");
                            break;
                        case Constants::lucky_name:
                            header("Location: ../games/lucky/lucky_index.php");
                            break;
                        case Constants::spell_name:
                            header("Location: ../games/spell/spell_index.php");
                            break;
                        default:
                            header("Location: signin.php");
                    }
                } else {
                    header("Location: ../games/main_index.php");
                }
                die;
            } else {
                unset($_SESSION['user_id']);
                unset($_SESSION['user_name']);
                echo "<script>alert('Cannot resolve to server');</script>";
            }
        } else {
            $_SESSION['sign_in_error_visible'] = Constants::yes;
        }
    } else {
        echo "<script>alert('" . $con_result . "');</script>";
    }
    header("Location: signin.php");
    die;
}
