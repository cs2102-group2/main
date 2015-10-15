<?php

include 'libaries.php';
include 'sqlconn.php'; // Connect to database

// If user is already logged in
if(isUserLoggedIn() == true) {
    redirectToHomePage();
}

// Attempt to log in
if(isset($_POST['login'])) {
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $userName = $_POST['username'];
        $pw = $_POST['password'];

        // Find username and password
        $query = "SELECT PROFILEID, FIRSTNAME, ACCBALANCE, CREDITCARDNUM FROM PROFILE WHERE Email='".$userName."' AND Password='".$pw."'";

        //  Store result of query
        $result = oci_parse($connect, $query);

        // Check if query fails
        $check = oci_execute($result, OCI_DEFAULT);
        if($check == false) {
            redirectToLoginPage();
            exit;
        }

        // Initialize session variables
        while($row = oci_fetch_array($result)) {
            initSessionVar($row);
            oci_free_statement($result);
            redirectToHomePage();
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

<?php
include 'includes/navbar.php';
?>

<div class="large-12 center-vertically">
    <div class="large-3 large-offset-8 columns primary-background-translucent">
        <div class="large-12"><br></div>
        <form method="post" action="login.php">
            <input type="text" name="username" placeholder="Username" />
            <input type="password" name="password" placeholder="Password" />
            <input type="submit" name="login" class="large-12 tiny button" value="LOGIN" />
            <br>
            <small><a href="#" class="right">Forget username/password?</a></small>
            <br>
            <br>
            <a href="registration.php" class="large-4 tiny button right">REGISTER</a>
        </form>
    </div>
</div>

</body>

</html>
