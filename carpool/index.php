<?php

include 'libaries.php';
include 'sqlconn.php';

if(isUserLoggedIn() == false) {
    redirectToLoginPage();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Homepage</title>
    <link rel="stylesheet" href="./foundation/css/foundation.css" />
    <link rel="stylesheet" href="./css/customise.css" />
    <?php
    include 'includes/datepicker.html';
    ?>
</head>
<body>

<?php
include 'includes/navbar.php';
?>

<div class="large-12 center-vertically columns">
    <form id="searchBox" method="post" action="search.php">
        <div class="row">
            <div class="large-4 columns">
                <input type="text" id ="departureSearch" name="departureSearch" placeholder="Departure"/>
            </div>
            <div class="large-4 columns">
                <input type="text" id ="destinationSearch" name="destinationSearch" placeholder="Destination"/>
            </div>
            <div class="large-2 columns">
                <input type="text" id ="dateSearch" name="dateSearch" placeholder="Date" class="datepicker"/>
            </div>
            <div class="large-2 columns">
                <input type="submit" id="search" name="search" class="tiny button" value="SEARCH" />
            </div>
        </div>
    </form>
</div>
</body>
</html>
