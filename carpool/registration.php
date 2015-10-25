<?php

include 'libaries.php';
include 'sqlconn.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link rel="stylesheet" href="./foundation/css/foundation.css" />
    <link rel="stylesheet" href="./css/customise.css" />
    <?php
    include 'includes/datepicker.html';
    ?>

    <script src="js/registration.js"></script>
</head>
<body>

<?php
include 'includes/navbar.php';
?>

<div class="large-12 columns">
    <div class="row  primary-background-translucent">
        <div class="large-8 columns">
            <div class="row">
                <p>REGISTRATION</p>
                <div class="large-6 columns">
                    <p><u>Profile Information</u></p>
                    <input type="text" id="idusername" name="username" placeholder="Email Address" />
                    <input type="password" id="idpassword" name="password" placeholder="Password" />
                    <input type="text" id="idfirstname" name="firstname" placeholder="First Name" />
                    <input type="text" id="idlastname" name="lastname" placeholder="Last Name" />
                    <input type="text" id="iddob" name="dob" placeholder="Birth Date" class="datepicker"/>
                    <input type="text" id="idcontactnum" name="contactnum" placeholder="Contact Number" />
                    <input type="text" id="idaddress" name="address" placeholder="Address (Postal Code)" />
                </div>
                <div class="large-6 columns">
                    <p><u>Payment Information</u></p>
                    <input type="text" id="idcreditcardno" name="creditcardno" placeholder="Credit Card Number" />
                    <input type="text" id="idsecurityno" name="securitycode" placeholder="Security Code" />
                    <input type="text" id="idcardholder" name="cardholderName" placeholder="Card Holder Name" />
                    <input type="submit" id="confirm" name="confirm" class="tiny button" value="SUBMIT" />
                </div>
            </div>
        </div>
        <div class="large-4 columns">
            <p>Some privacy and disclaimer text here.</p>
        </div>
    </div>
</div>

<div id="registrationPopup">
    <div id="registrationText">
    </div>
</div>

</body>
</html>
