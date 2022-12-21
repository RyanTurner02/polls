<?php



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create a Poll</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="header navbar">
    <div class="d-flex flex-row">
        <a class="navbar-brand p-1" href="index.php">Polls</a>
        <a class="p-2" href="create.php">Create Poll</a>
    </div>
    <div class="d-flex flex-row">
        <a class="p-2" href="login.php">Login</a>
        <a class="p-2" href="signup.php">Sign up</a>
    </div>
</div>

<div class="container mb-3">
    <h1 class="text-center">Create a Poll</h1>
    <form action="" method="post" name="create-poll-form">
        <div class="row mb-3" id="poll-title">
            <label class="col-form-label col-sm-2" for="title">Poll Title</label>
            <div class="col-sm-10">
                <input class="form-control" id="title" required>
            </div>
        </div>

        <div id="poll-options">
            <div class="option row mb-3">
                <label class="col-form-label col-sm-2" for="option1">Option 1</label>
                <div class="col-sm-10">
                    <input class="form-control" id="option1" required>
                </div>
            </div>

            <div class="option row mb-3">
                <label class="col-form-label col-sm-2" for="option2">Option 2</label>
                <div class="col-sm-10">
                    <input class="form-control" id="option2" required>
                </div>
            </div>
        </div>

        <input class="btn btn-primary " id="add" type="button" value="Add option">
        <input class="btn btn-primary" id="create" type="submit" value="Create poll">
    </form>
</div>
</body>
</html>