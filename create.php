<?php

if (isset($_POST["create-poll"])) {
    $pollTitle = $_POST["poll-title"];
    $numOptions = $_POST["num-options"];
    $option1 = $_POST["option1"];
    $option2 = $_POST["option2"];
    $option3 = $_POST["option3"];
    $option4 = $_POST["option4"];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a Poll</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/jquery-3.6.3.js" defer></script>
    <script src="js/create-poll-viewer.js" defer></script>
</head>
<body>
<div class="header navbar">
    <div class="d-flex flex-row">
        <a class="navbar-brand p-1" href="index.php">Polls</a>
        <a class="p-2" href="create.php">Create Poll</a>
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

<div class="container mb-3">
    <h1 class="text-center">Create a Poll</h1>
    <form action="" method="post" name="create-poll-form">
        <div class="option row mb-3">
            <label class="col-form-label col-sm-2" for="poll-title">Poll Title</label>
            <div class="col-sm-10">
                <input class="form-control" id="poll-title" name="poll-title" placeholder="Poll Title" required>
            </div>
        </div>

        <div class="option row mb-3">
            <label class="col-form-label col-sm-2" for="num-options">Number of Options</label>
            <div class="col-sm-10">
                <select class="form-select" id="num-options" name="num-options">
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                </select>
            </div>
        </div>

        <div class="option row mb-3" id="option1-div">
            <label class="col-form-label col-sm-2" for="option1">Option 1</label>
            <div class="col-sm-10">
                <input class="form-control" id="option1" name="option1" placeholder="Option 1" required>
            </div>
        </div>

        <div class="option row mb-3" id="option2-div">
            <label class="col-form-label col-sm-2" for="option2">Option 2</label>
            <div class="col-sm-10">
                <input class="form-control" id="option2" name="option2" placeholder="Option 2" required>
            </div>
        </div>

        <div class="option row mb-3" id="option3-div">
            <label class="col-form-label col-sm-2" for="option3">Option 3</label>
            <div class="col-sm-10">
                <input class="form-control" id="option3" name="option3" placeholder="Option 3">
            </div>
        </div>

        <div class="option row mb-3" id="option4-div">
            <label class="col-form-label col-sm-2" for="option4">Option 4</label>
            <div class="col-sm-10">
                <input class="form-control" id="option4" name="option4" placeholder="Option 4">
            </div>
        </div>

        <input class="btn btn-primary" id="create" name="create-poll" type="submit" value="Create poll">
    </form>
</div>
</body>
</html>