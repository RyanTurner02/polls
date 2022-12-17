<?php

$name = $_POST["name"];
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["password"];

echo "Name: $name" . "<br>";
echo "Username: $username" . "<br>";
echo "Email: $email" . "<br>";
echo "Password: $password" . "<br>";

if(!hasValidInfo()) {
    // break
}

connectToDatabase();

function connectToDatabase() {
}

function hasValidInfo() {
    return nameIsValid() && usernameIsValid() && emailIsValid() && passwordIsValid();
}

function nameIsValid() {
    return true;
}

function usernameIsValid() {
    return true;
}

function emailIsValid() {
    return true;
}

function passwordIsValid() {
    return true;
}
