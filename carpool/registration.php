<?php

include 'libaries.php';
include 'sqlconn.php';

if(isset($_POST['confirm'])) {
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname'])
        && isset($_POST['lastname'])&& isset($_POST['dob'])&& isset($_POST['contactnum'])
        && isset($_POST['address']) && isset($_POST['creditcardno']) && isset($_POST['securitycode'])
        && isset($_POST['cardholderName'])) {

        $userName = $_POST['username'];
        $password = $_POST['password'];
        $firstName = $_POST['firstname'];
        $lastName = $_POST['lastname'];
        $dateOfBirth = $_POST['dob'];
        $contactNum = $_POST['contactnum'];
        $address = $_POST['address'];
        $creditCardNum = $_POST['creditcardno'];
        $securityCode = $_POST['securitycode'];
        $cardHolderName = $_POST['cardholderName'];

        //================================================================
        //Create a pop-out message to double-check all information to be added:
        //$msg = " ".$userName." ".$password." ".$firstName." ".$lastName." ".$dateOfBirth." "
        //    .$contactNum." ".$address." ".$creditCardNum." ".$securityCode." ".$cardHolderName;
        //echo "<script type='text/javascript'>alert('$msg');</script>";
        //================================================================

        // TO DO: Add SQL queries to add information into database

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
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
<!-- End include -->
<div class="large-12 columns">
    <form method = post action="registration.php">
        <div class="row  primary-background-translucent">
            <div class="large-8 columns">
                <div class="row">
                    <p>REGISTRATION</p>
                    <div class="large-6 columns">
                        <p><u>Profile Information</u></p>
                        <input type="text" name="username" placeholder="Username" />
                        <input type="text" name="password" placeholder="Password" />
                        <input type="text" name="firstname" placeholder="First Name" />
                        <input type="text" name="lastname" placeholder="Last Name" />
                        <input type="text" name="dob" placeholder="Birth Date" />
                        <input type="text" name="contactnum" placeholder="Contact Number" />
                        <input type="text" name="address" placeholder="Address" />
                    </div>
                    <div class="large-6 columns">
                        <p><u>Payment Information</u></p>
                        <input type="text" name="creditcardno" placeholder="Credit Card Number" />
                        <input type="text" name="securitycode" placeholder="Security Code" />
                        <input type="text" name="cardholderName" placeholder="Card Holder Name" />
                        <input type="submit" id="confirm" name="confirm" class="tiny button" value="CONFIRM" />
                    </div>
                </div>
            </div>
            <div class="large-4 columns">
                <p>Some privacy and disclaimer text here.</p>
            </div>
        </div>
    </form>


</div>
</body>
</html>
