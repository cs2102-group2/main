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
</head>
<body>
<nav class="top-bar" data-topbar="" role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1>
                <a href="#">
                    <?php getProfileName() ?>
                </a>
            </h1>
        </li>
    </ul>
    <section class="top-bar-section">
        <ul class="right">
            <li class="has-form show-for-large-up"><a href="payment.php" class="button">$</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a href="search.php" class="button">FIND RIDE</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a href="post.php" class="button">OFFER RIDE</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up">
                <?php
                if(isset($_SESSION["profileID"])) {
                    echo '<a href="loggedout.php" class="button">LOGGED OUT</a>';
                }
                else {
                    echo '<a href="login.php" class="button">LOGIN</a>';
                }
                ?>
            </li>
        </ul>
    </section>
</nav>

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
                <input type="text" id ="dateSearch" name="dateSearch" placeholder="Date"/>
            </div>
            <div class="large-2 columns">
                <input type="submit" id="search" name="search" class="tiny button" value="SEARCH" />
            </div>
        </div>
    </form>
</div>
</body>
</html>
