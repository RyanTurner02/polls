<?php

if (isset($_POST["sign-up"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    createAccount($name, $username, $email, $password);
}

function createAccount($name, $username, $email, $password)
{
    $fileName = "config.ini";
    $sampleFileName = "config-sample.ini";

    if (!file_exists($fileName)) {
        throw new Exception("\"$fileName\" not found. See \"$sampleFileName\" for more details.");
    }

    $configArr = parse_ini_file($fileName);
    $mysqli = mysqli_connect($configArr["hostname"], $configArr["username"], $configArr["password"], $configArr["database"]);

    // check if username already exists
    $statement = $mysqli->prepare("SELECT username FROM account WHERE username=?");
    $statement->bind_param("s", $username);
    $statement->execute();

    $result = $statement->get_result();

    if (mysqli_num_rows($result) != 0) {
        header("Location: signup.html?error=account+already+exists");
        exit;
    }

    // create account
    $statement = $mysqli->prepare("INSERT INTO account(name, username, email, password) VALUES(?, ?, ?, ?)");
    $statement->bind_param("ssss", $name, $username, $email, $password);
    $statement->execute();

    header("Location: index.html");
    exit;
}
