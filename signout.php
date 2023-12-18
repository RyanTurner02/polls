<?php

// if the user has a cookie, then remove it
if (isset($_COOKIE["user_token"])) {
    setcookie("user_token", "", time() - 3600, "/");
}

header("Location: index.php");
exit;
