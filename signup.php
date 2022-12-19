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
        header("Location: signup.php?error=account+already+exists");
        exit;
    }

    // create account
    $statement = $mysqli->prepare("INSERT INTO account(name, username, email, password) VALUES(?, ?, ?, ?)");
    $statement->bind_param("ssss", $name, $username, $email, $password);
    $statement->execute();

    header("Location: index.html");
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/validation.js" defer></script>
</head>
<body>
<div class="header navbar">
    <div class="d-flex flex-row">
        <a class="navbar-brand p-1" href="index.html">Polls</a>
        <a class="p-2" href="create.html">Create Poll</a>
    </div>
    <div class="d-flex flex-row">
        <a class="p-2" href="login.php">Login</a>
        <a class="p-2" href="signup.php">Sign up</a>
    </div>
</div>

<div class="container mb-3">
    <form action="" method="post" name="signup-form">
        <h1 class="text-center mb-3">Create an account.</h1>

        <div class="row mb-3">
            <label class="col-form-label col-sm-2" for="name">Name</label>
            <div class="col-sm-10">
                <input class="form-control" id="name" name="name" placeholder="Name" required>
                <div class="invalid-feedback text-muted" id="name-validation">
                    <p class="mb-0">Name must be at most 50 characters.</p>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-form-label col-sm-2" for="username">Username</label>
            <div class="col-sm-10">
                <input class="form-control" id="username" name="username" placeholder="Username" required>
                <div class="invalid-feedback text-muted" id="username-validation">
                    <p class="mb-0">Username is taken</p>
                </div>
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-form-label col-sm-2" for="email">Email (optional)</label>
            <div class="col-sm-10">
                <input class="form-control" id="email" name="email" placeholder="Email">
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-form-label col-sm-2" for="password">Password</label>
            <div class="col-sm-10">
                <input class="form-control" id="password" name="password" type="password" placeholder="Password"
                       required>
                <div class="invalid-feedback text-muted" id="password-validation">
                    <p class="mb-0">Password must contain:</p>
                    <ul>
                        <li>At least 8 characters.</li>
                        <li>At least 1 lowercase character.</li>
                        <li>At least 1 uppercase character.</li>
                        <li>At least 1 number and special character.</li>
                    </ul>
                </div>
            </div>
        </div>

        <input class="btn btn-primary" id="submit" name="sign-up" type="submit" value="Sign up">
    </form>
</div>
</body>
</html>