<?php

include 'loadsession.php';
include 'sqlconn.php';

if(isset($_POST['submit'])) {
    if (isset($_POST['departureLocation']) && isset($_POST['destinationLocation']) && isset($_POST['departureTime'])
        && isset($_POST['passengerPayment'])&& isset($_POST['carType'])&& isset($_POST['numOfSeats'])) {

        $departure = $_POST['departureLocation'];
        $destination = $_POST['destinationLocation'];
        $time = $_POST['departureTime'];
        $price = $_POST['passengerPayment'];
        $car = $_POST['carType'];
        $numOfSeats = $_POST['numOfSeats'];

        //================================================================
        //Create a pop-out message to double-check all information to be added:
        //$msg = "Departing from ".$departure." to ".$destination." at ".$time." for $".$price." by vehicle ".$car." with ".$numOfSeats." seats available";
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
    <title>Post Advertisement</title>
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
    <div class="large-6 large-offset-3 white-translucent full-length columns">
        <div class="large-12 columns">
            <div class="row">
                <form method="post" action="post.php">
                    <label>
                        Route
                        <div class="row journeyPoint">
                            <div class="large-8 columns">
                                <input type="text" name="departureLocation" placeholder="Departure" />
                            </div>
                            <div class="large-4 columns">
                                <input type="text" name="departureTime" placeholder="Departure Time" />
                            </div>
                        </div>
                        <div class="row journeyPoint">
                            <div class="large-8 columns">
                                <input type="text" name="destinationLocation" placeholder="Destination" />
                            </div>
                        </div>
                    </label>
                    <a href="#" class="large-12 columns tiny button">+ ADD MORE STOPS</a>

                    <div class="row collapse">
                        <div class="large-5 columns">
                            <label>
                                Payment
                                <div class="row collapse">
                                    <div class="large-2 left columns">
                                        <span class="prefix">SGD</span>
                                    </div>
                                    <div class="large-10 left columns">
                                        <input type="text" name="passengerPayment" placeholder="Price Per Passenger" />
                                    </div>
                                </div>
                            </label>
                            <label>
                                Car
                                <div class="row collapse">
                                    <div class="large-12 left columns">
                                        <!--Query to Get Car-->
                                        <select name="carType" class="text-center">
                                            <option class="placeholder" selected="selected" value= "" disabled="disabled">Choose your car:</option>
                                            <option value="BMW">BMW</option>
                                            <option value="Toyota">Toyota</option>
                                            <option value="Honda">Honda</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row collapse">
                                    <div class="large-12 left columns">
                                        <!--Query to Get Car Seats-->
                                        <select name="numOfSeats" class="text-center">
                                            <option class="placeholder" selected="selected" value= "" disabled="disabled">Seats Available:</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                        </select>
                                    </div>
                                </div>
                            </label>

                        </div>
                        <div class="large-6 large-offset-1 columns">
                            <label>
                                Additional Information (Maximum 500 characters)
                                <textarea name="additionalInfo" placeholder="Additional information you'd like your passengers to know." style="resize: vertical;"></textarea>
                            </label>
                        </div>
                    </div>
                    <input type="submit" name="submit" class="large-12 columns tiny button" value="SUBMIT"/>
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
