<?php

$username = $_POST["username"];
$password = $_POST["password"];
$rememberMe = $_POST["remember-me"];

login($username, $password, $rememberMe);

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
    $statement = $mysqli->prepare("SELECT username, email, `password` FROM account WHERE (username=? OR email=?) AND password=?;");
    $statement->bind_param("sss", $username, $username, $password);
    $statement->execute();

    $result = $statement->get_result();

    if (mysqli_num_rows($result) == 0) { // check for user not found (empty row)
        header("Location: login.html");
    } else { // user found (row is not empty)
        $cookieName = "user_session";
        $cookieValue = "value";
        $cookiePath = "/";

        if ($rememberMe == 1) {
            $cookieExpiration = time() + 60 * 60 * 24 * 30; // set the expiration for 30 days
        } else {
            $cookieExpiration = time() + 60 * 60 * 24 * 7; // set the expiration for 7 days
        }

        setcookie($cookieName, $cookieValue, $cookieExpiration, $cookiePath);

        header("Location: index.html");
        exit;
    }
}
