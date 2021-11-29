<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../classes/Connection.php");
include_once("../../classes/User.php");
include_once("../../classes/Constants.php");

if (isset($_POST['username_signup']) and isset($_POST['password_signup'])) {
    $user = new User($_POST['username_signup'], $_POST['password_signup']);

    unset($_POST['username_signup']);
    unset($_POST['password_signup']);

    $con = new Connection();
    $con_result = $con->checkConnection();

    if ($con_result instanceof mysqli) {
        $sign_up_result = $user->signUp($con_result);
        if ($sign_up_result) {
            $_SESSION['sign_up_error_visible'] = Constants::no;
            header("Location: signin.php");
            die;
        } else {
            $_SESSION['sign_up_error_visible'] = Constants::yes;
        }
    } else {
        echo "<script>alert('" . $con_result . "');</script>";
        // header("Location: " . $_SERVER['PHP_SELF']);
    }
}

// include("../../utils/connection.php");
// include("../../utils/account_functions.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="../../../asset/design.css" rel="stylesheet">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body class="wrapper">
    <div class="container">
        <div class="row justify-content-center">
            <aside class="col-sm-4">

                <div class="card">
                    <article class="card-body" style="margin: 6px;">
                        <h4 class="card-title text-center mb-4 mt-1">Sign up</h4>
                        <hr>
                        <?php
                        if (isset($_SESSION['sign_up_error_visible']) && $_SESSION['sign_up_error_visible'] == Constants::yes) {
                            $_SESSION['sign_up_error_visible'] == Constants::no;
                            echo "<p class='text-danger text-center'>Username already exists</p>";
                        }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                    </div>
                                    <input name="username_signup" class="form-control" placeholder="Username" type="text" minlength="4" maxlength="15" autocomplete="off" onkeypress="return event.charCode != 32" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                    </div>
                                    <input name="password_signup" class="form-control" placeholder="Password" type="password" minlength="8" maxlength="15" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-block">Create</button>
                            </div>
                            <p class="text-center"><a href="signin.php" class="btn">Already have an account?</a></p>
                        </form>
                    </article>
                </div>
            </aside>
        </div>
    </div>
</body>

</html>