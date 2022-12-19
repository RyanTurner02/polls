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

    if (mysqli_num_rows($result) == 0) { // check for empty row
        echo "Invalid Login";
    } else { // row is not empty
        while ($row = mysqli_fetch_row($result)) { // print row
            printf("%s %s %s\n", $row[0], $row[1], $row[2]);
        }
    }

//    header("Location: index.html");
//    exit;
}
