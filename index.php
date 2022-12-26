<?php

function echoPoll($row)
{
    $title = $row["title"];
    $option1 = $row["option1"];
    $option2 = $row["option2"];
    $option3 = $row["option3"];
    $option4 = $row["option4"];
    $option1Votes = $row["option1_votes"];
    $option2Votes = $row["option2_votes"];
    $option3Votes = $row["option3_votes"];
    $option4Votes = $row["option4_votes"];
    $likes = $row["likes"];

    echo '<div class="poll">';
    echo "<h1 class='text-center'>$title</h1>";

    echo '<div class="row mb-3">';
    echo '<button class="btn btn-outline-dark" id="first-option">' . $option1 . '</button>';
    echo '</div>';

    echo '<div class="row mb-3">';
    echo '<button class="btn btn-outline-dark" id="second-option">' . $option2 . '</button>';
    echo '</div>';

    if (!empty($option3)) {
        echo '<div class="row mb-3">';
        echo '<button class="btn btn-outline-dark" id="third-option">' . $option3 . '</button>';
        echo '</div>';
    }

    if (!empty($option4)) {
        echo '<div class="row mb-3">';
        echo '<button class="btn btn-outline-dark" id="fourth-option">' . $option4 . '</button>';
        echo '</div>';
    }

    echo '<div class="mb-3 d-flex justify-content-end">';
    echo '<button class="btn btn-danger" id="like-button">' . $likes . ' likes</button>';
    echo '</div>';

    echo "<hr>";
    echo '</div>';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Polls</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="header navbar">
    <div class="d-flex flex-row">
        <a class="navbar-brand p-1" href="index.php">Polls</a>
        <?php
        // display poll creation option is user is logged in
        if (isset($_COOKIE["user_token"])) {
            echo '<a class="p-2" href="create.php">Create Poll</a>';
        }
        ?>
    </div>
    <div class="d-flex flex-row">
        <?php

        if (isset($_COOKIE["user_token"])) { // user is logged in
            echo '<a class="p-2" href="myprofile.php">My Profile</a>';
            echo '<a class="p-2" href="signout.php">Sign out</a>';
        } else { // user is not logged in
            echo '<a class="p-2" href="login.php">Login</a>';
            echo '<a class="p-2" href="signup.php">Sign up</a>';
        }

        ?>
    </div>
</div>

<div class="container">
    <?php

    // connect to the database
    $fileName = "config.ini";
    $sampleFileName = "config-sample.ini";

    if (!file_exists($fileName)) {
        throw new Exception("\"$fileName\" not found. See \"$sampleFileName\" for more details.");
    }

    $configArr = parse_ini_file($fileName);
    $mysqli = mysqli_connect($configArr["hostname"], $configArr["username"], $configArr["password"], $configArr["database"]);

    // get the newest polls
    $statement = $mysqli->prepare("SELECT * FROM poll ORDER BY poll_id DESC");
    $statement->execute();
    $result = $statement->get_result();

    // echo each poll into the webpage
    while ($row = mysqli_fetch_assoc($result)) {
        echoPoll($row);
    }

    ?>
</div>

<div class="container">
</div>
</body>
</html>