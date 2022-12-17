<?php

$name = $_POST["name"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

if (hasValidInfo()) {
    createAccount($name, $username, $email, $password);
}

function createAccount($name, $username, $email, $password)
{
    $mysqli = mysqli_connect("", "", "", "");

    $statement = $mysqli->prepare("INSERT INTO account(name, username, email, password) VALUES(?, ?, ?, ?)");
    $statement->bind_param("ssss", $name, $username, $email, $password);
    $statement->execute();

    header("Location: index.html");
    exit;
}

function hasValidInfo()
{
    return nameIsValid() && usernameIsValid() && emailIsValid() && passwordIsValid();
}

function nameIsValid()
{
    return true;
}

function usernameIsValid()
{
    return true;
}

function emailIsValid()
{
    return true;
}

function passwordIsValid()
{
    return true;
}
