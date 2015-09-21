<?php

include 'loadsession.php';
//include 'sqlconn.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
    <link rel="stylesheet" href="./foundation/css/foundation.css" />
    <link rel="stylesheet" href="./css/customise.css" />
</head>
<body>
<nav class="top-bar" data-topbar="" role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1><a href="#">
                    <?php getProfileName() ?>
                </a>
            </h1>
        </li>
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

<div class="large-12 columns">
    <br>
    <br>
    <div class="row">
        <!--Search-->
        <div class="large-4 primary-background-translucent full-length columns">
            <!--Query number of result-->
            <div class="large-12 text-center columns">
                <p id="availCarpool">100</p>
                <p>Available Carpool(s)</p>
            </div>
            <hr>
            <div class="large-12 right columns">
                <p>SORT BY:</p>
            </div>
            <div class="large-12 columns">
                <ul class="button-group round even-3">
                    <li><a href="#" class="tiny button ">PROXIMITY</a></li>
                    <li><a href="#" class="tiny button">TIME</a></li>
                    <li><a href="#" class="tiny button">PRICE</a></li>
                </ul>
            </div>
            <div class="large-12 right columns">
                <p>FIlTER BY:</p>
            </div>
            <div class="large-12 right columns">
                <!--Set Time Range too!-->
                <label>Time (08:00 - 12:00)
                    <div class="range-slider round" data-slider>
                        <span class="range-slider-handle" role="slider" tabindex="0"></span>
                        <span class="range-slider-active-segment"></span>
                        <input type="hidden">
                    </div>
                </label>
            </div>

            <div class="large-12 right columns">
                <!--Set Distance Range too!-->
                <label>Distance - Departure (2.3km - 40km)
                    <div class="range-slider round" data-slider>
                        <span class="range-slider-handle" role="slider" tabindex="0"></span>
                        <span class="range-slider-active-segment"></span>
                        <input type="hidden">
                    </div>
                </label>
                <label>Distance - Destination (2.3km - 40km)
                    <div class="range-slider round" data-slider>
                        <span class="range-slider-handle" role="slider" tabindex="0"></span>
                        <span class="range-slider-active-segment"></span>
                        <input type="hidden">
                    </div>
                </label>
            </div>

            <div class="large-12 right columns">
                <!--Set Price Range too!-->
                <label>Price (SGD 2.30 - SGD 5.00)
                    <div class="range-slider round" data-slider>
                        <span class="range-slider-handle" role="slider" tabindex="0"></span>
                        <span class="range-slider-active-segment"></span>
                        <input type="hidden">
                    </div>
                </label>
            </div>
        </div>

        <div class="large-8 white-translucent full-length columns">
            <form id="searchBox" method="post" action="search.php">
                <br>
                <div class="row">
                    <div class="large-4 columns">
                        <input type="text" name="departureSearch" placeholder="Departure" />
                    </div>
                    <div class="large-4 columns">
                        <input type="text" name="destinationSearch" placeholder="Destination" />
                    </div>
                    <div class="large-2 columns">
                        <input type="text" name="dateSearch" placeholder="Date" />
                    </div>
                    <div class="large-2 columns">
                        <input type="submit" id="search" name="search" class="tiny button" value="SEARCH" />
                    </div>
                </div>
            </form>
            <hr>
            <hr>
            <!--Set Users Query Here too!-->

            <div class="user large-12 right columns">
                <?php
                if(isset($_POST['search'])) {
                    if(isset($_POST['departureSearch']) && isset($_POST['destinationSearch']) && isset($_POST['dateSearch'])) {
                        $departure = $_POST['departureSearch'];
                        $destination = $_POST['destinationSearch'];
                        $date = $_POST['dateSearch'];

                        // TO DO: Add SQL queries and retrieve information from Database



                        // TO DO: Print out result with a LOOP
                        echo'<div class="row collapse">
                                <div class="large-4 columns">
                                    <a href="#">David</a>
                                    <br>
                                    <br>
                                    <br>
                                    <p>(User Profile Picture)</p>
                                </div>
                                <div class="large-4 columns">
                                    <!--<p>4 July 2015, 6:00 pm</p>-->
                                    <p>'.$date.', 6:00 pm</p>
                                    <p>Departure: '.$departure.'</p>
                                    <p class="smallFont">(30 km from your searched departure.)</p>
                                    <p>Destination: '.$destination.'</p>
                                    <p class="smallFont">(30 km from your searched departure.)</p>
                                </div>
                                <div class="large-4 columns">
                                    <p>SGD 5.00 / Passenger</p>
                                    <a href="#" class="radius button">3 / 4 SEATS AVAILABLE</a>
                                </div>
                            </div>';
                    }
                }
                ?>
            </div>
            <hr>
        </div>
    </div>
</div>
</body>
</html>
