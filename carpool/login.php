<?php

// Start session to store variables across pages
session_start();

// Connect to database
include 'sqlconn.php';

// Attempt to log in
if(isset($_GET['login'])) {
    if(isset($_GET['username']) && isset($_GET['password'])) {
        $userName = $_GET['username'];
        $pw = $_GET['password'];

        // Query database to check whether username and password exist and matches
        $query = "SELECT * FROM PROFILE WHERE Email='".$userName."' AND Password='".$pw."'";

        //  Store result of select query
        $result = oci_parse($connect, $query);

        // Check if query fails
        $check = oci_execute($result, OCI_DEFAULT);
        if($check == false) {
            die();
        }

        // Initialize session variables
        while($row = oci_fetch_array($result)) {
            $_SESSION["USERID"] = $row[0];
            $_SESSION["NAME"] = $row[3];
            oci_free_statement($result);
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
            exit;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="./foundation/css/foundation.css" />
    <link rel="stylesheet" href="./css/customise.css" />
</head>

<body>

<nav class="top-bar" data-topbar="" role="navigation">
    <ul class="title-area">
        <li class="name"><h1><a href="#">Welcome</a></h1></li>
    </ul>
    <section class="top-bar-section">
        <ul class="right">
            <li class="has-form show-for-large-up"><a href="#" class="button">$</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a href="#" class="button">FIND RIDE</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a href="#" class="button">OFFER RIDE</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a href="#" class="button">LOGIN</a></li>
        </ul>
    </section>
</nav>

<div class="large-12 center-vertically">
    <div class="large-3 large-offset-8 columns primary-background-translucent">
        <div class="large-12"><br></div>
        <form>
            <input type="text" name="username" placeholder="Username" />
            <input type="password" name="password" placeholder="Password" />
            <input type="submit" name="login" class="large-12 tiny button" value="LOGIN" />
            <br>
            <small><a href="#" class="right">Forget username/password?</a></small>
            <br>
            <br>
            <a href="#" class="large-4 tiny button right">REGISTER</a>
        </form>
    </div>
</div>

</body>

</html>
