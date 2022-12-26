<?php

// redirect if user is already logged in
if (isset($_COOKIE["user_token"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $rememberMe = $_POST["remember-me"];

    login($username, $password, $rememberMe);
}

function login($username, $password, $rememberMe)
{
    $fileName = "config.ini";
    $sampleFileName = "config-sample.ini";

    if (!file_exists($fileName)) {
        throw new Exception("\"$fileName\" not found. See \"$sampleFileName\" for more details.");
    }

    $configArr = parse_ini_file($fileName);
    $mysqli = mysqli_connect($configArr["hostname"], $configArr["username"], $configArr["password"], $configArr["database"]);

    // check username and password
    $statement = $mysqli->prepare("SELECT user_id, username, email, `password` FROM account WHERE (username=? OR email=?) AND password=?;");
    $statement->bind_param("sss", $username, $username, $password);
    $statement->execute();

    $result = $statement->get_result();

    // redirect if the user is not found
    if (mysqli_num_rows($result) == 0) {
        header("Location: login.php?error=invalid+login");
        exit;
    }

    if ($rememberMe == 1) {
        $expirationDate = time() + 60 * 60 * 24 * 30; // set the expiration for 30 days
    } else {
        $expirationDate = time() + 60 * 60 * 24 * 7; // set the expiration for 7 days
    }

    $userToken = uniqid();
    setcookie("user_token", $userToken, $expirationDate, "/");

    // get user info and store it into an array
    $userInfo = mysqli_fetch_assoc($result);
    $userID = $userInfo["user_id"];

    // format the expiration date
    $expirationDate = date("Y-m-d H:i:s", $expirationDate);

    // store the session info in the session table
    $statement = $mysqli->prepare("INSERT INTO session(user_id, user_token, expiration_date) VALUES(?, ?, ?)");
    $statement->bind_param("iss", $userID, $userToken, $expirationDate);
    $statement->execute();

    header("Location: index.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="header navbar">
    <div class="d-flex flex-row">
        <a class="navbar-brand p-1" href="index.php">Polls</a>
    </div>
    <div class="d-flex flex-row">
        <a class="p-2" href="login.php">Login</a>
        <a class="p-2" href="signup.php">Sign up</a>
    </div>
</div>

<div class="container mb-3">
    <form action="" method="post" name="login-form">
        <h1 class="text-center mb-3">Welcome back.</h1>

        <div class="row mb-3">
            <label class="col-form-label col-sm-2" for="username">Username or Email</label>
            <div class="col-sm-10">
                <input class="form-control" id="username" name="username" placeholder="Username or Email">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-form-label col-sm-2" for="password">Password</label>
            <div class="col-sm-10">
                <input class="form-control" id="password" name="password" type="password" placeholder="Password">
            </div>
        </div>

        <div class="row mb-3">
            <label class="form-check-label col-sm-2" for="remember-me">Remember me</label>
            <div class="col-sm-10">
                <input type="hidden" name="remember-me" value="0">
                <input class="form-check-input" id="remember-me" name="remember-me" type="checkbox" value="1">
            </div>
        </div>

        <?php
        if (isset($_GET["error"])) {
            echo '<p class="text-danger mb-3">Invalid login credentials.</p>';
        }
        ?>

        <input class="btn btn-primary" id="login" name="login" type="submit" value="Login">
    </form>
</div>
</body>
</html>