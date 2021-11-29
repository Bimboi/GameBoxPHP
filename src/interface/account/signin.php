<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("../../classes/Constants.php");

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
                        <a href="signup.php" class="float-right btn btn-outline-primary">Sign up</a>
                        <h4 class="card-title mb-4 mt-1">Sign in</h4>
                        <hr>
                        <?php
                        if (isset($_SESSION['sign_in_error_visible']) && $_SESSION['sign_in_error_visible'] == Constants::yes) {
                            $_SESSION['sign_in_error_visible'] = Constants::no;
                            echo "<p class='text-danger text-center'>Incorrect username or password</p>";
                        }
                        ?>
                        <form method="POST" action="signin_auth.php">
                            <div class="form-group">
                                <label>Your username</label>
                                <input name="username_signin" class="form-control" placeholder="Username" type="text" maxlength="20" autocomplete="off" onkeypress="return event.charCode != 32" required>
                            </div>
                            <div class="form-group">
                                <label>Your password</label>
                                <input name="password_signin" class="form-control" placeholder="Password" type="password" maxlength="20" required>
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