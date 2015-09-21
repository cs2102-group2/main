<?php

include 'loadsession.php';
include 'sqlconn.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="./foundation/css/foundation.css" />
    <link rel="stylesheet" href="./css/customise.css" />
</head>
<body>
<nav class="top-bar" data-topbar="" role="navigation">
    <ul class="title-area">
        <ul class="title-area">
            <li class="name">
                <h1><a href="#">
                        <?php getProfileName() ?>
                    </a>
                </h1>
            </li>
        </ul>
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
<!-- End include -->
<div class="large-12 center-vertically columns">
    <div class="row">
        <div class="large-6 large-offset-3 columns text-center white-translucent">
            <h2>Your Account Balance:</h2>
            <p id="userCurrency">$11.00</p>
            <label id="topUpAmount">
                <select class="text-center">
                    <option class="placeholder" selected="selected" value= "" disabled="disabled">Select amount of credits to add</option>
                    <option value="5">+ SGD 5.00</option>
                    <option value="10">+ SGD 10.00</option>
                    <option value="15">+ SGD 15.00</option>
                    <option value="20">+ SGD 20.00</option>
                </select>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="large-6 large-offset-3 columns white-translucent">
            <a href="#" class="large-12 small button">PROCEED TO PAYMENT</a>
        </div>
    </div>
</div>
</body>
</html>
