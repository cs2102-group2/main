<?php

include 'libaries.php';
include 'sqlconn.php';

$countMsg = "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Search</title>
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

<div class="large-12 columns">
    <br>
    <br>
    <div class="row">
        <div class="large-4 primary-background-translucent full-length columns">
            <div class="large-12 text-center columns">
            <br>
            <?php
            if(isset($_POST['search'])) {
                    if(isset($_POST['departureSearch']) && isset($_POST['destinationSearch']) && isset($_POST['dateSearch'])) {
                        $departure = strtoupper($_POST['departureSearch']);
                        $destination = strtoupper($_POST['destinationSearch']);
                        $date = $_POST['datepicker'];

                        $query = "SELECT COUNT(*)
                                  FROM TRIPS
                                  WHERE START_LOCATION = '".$departure."'
                                  AND END_LOCATION = '".$destination."'
                                  AND TRIP_DATE = '".$date."'";

                        $result = oci_parse($connect, $query);

                        $check = oci_execute($result, OCI_DEFAULT);
                        if($check == false) {
                            redirectToSearchPage();
                            exit;
                        }

                        while($row = oci_fetch_array($result)) {
                            echo'<p id="availCarpool">'.$row[0].'</p>';
                        }
                    }
                }
            ?>
                <p>Available Carpool(s)</p>
            </div>
            <hr>
            <div class="large-12 right columns">
                <p>ORDER BY:</p>
            </div>
            <div class="large-12 columns">
                <ul class="button-group round even-3">
                    <li><a href="#" class="tiny button">PROXIMITY</a></li>
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
                        <input type="text" name="dateSearch" placeholder="Date" class="datepicker"/>
                    </div>
                    <div class="large-2 columns">
                        <input type="submit" id="search" name="search" class="tiny button" value="SEARCH" />
                    </div>
                </div>
            </form>
            <hr>
            <hr>
            <div class="user large-12 right columns">
                <?php
                if(isset($_POST['search'])) {
                    if(isset($_POST['departureSearch']) && isset($_POST['destinationSearch']) && isset($_POST['dateSearch'])) {
                        $departure = strtoupper($_POST['departureSearch']);
                        $destination = strtoupper($_POST['destinationSearch']);
                        $date = $_POST['dateSearch'];

                        $query = "SELECT TRIPNO, START_LOCATION, END_LOCATION, FIRSTNAME, RIDING_COST, SEATS_AVAILABLE, TRIP_DATE
                                  FROM TRIPS
                                  WHERE START_LOCATION = '".$departure."'
                                  AND END_LOCATION = '".$destination."'
                                  AND TRIP_DATE = '".$date."'";

                        $result = oci_parse($connect, $query);

                        $check = oci_execute($result, OCI_DEFAULT);
                        if($check == false) {
                            redirectToSearchPage();
                            exit;
                        }

                        // Print out results from Database
                        while($row = oci_fetch_array($result)) {
                            echo'<div class="row collapse">
                                <div class="large-4 columns">
                                    <a href="#">'.$row['FIRSTNAME'].'</a>
                                    <br>
                                    <br>
                                    <p>(Profile Picture)</p>
                                </div>
                                <div class="large-4 columns">
                                    <!--<p>4 July 2015, 6:00 pm</p>-->
                                    <p>'.$row['TRIP_DATE'].', '.$row['TIME'].'</p>
                                    <p>Departure: '.$row['START_LOCATION'].'</p>
                                    <!--<p class="smallFont">(30 km from your searched departure.)</p>-->
                                    <p>Destination: '.$row['END_LOCATION'].'</p>
                                    <!--<p class="smallFont">(30 km from your searched departure.)</p>-->
                                </div>
                                <div class="large-4 columns">
                                    <p>SGD '.$row['RIDING_COST'].' / Passenger</p>
                                    <button type="submit" value="'.$row['TRIPNO'].'" class="radius button">'.$row['SEATS_AVAILABLE'].' SEATS AVAILABLE</button>
                                </div>
                            </div>
                            <hr>
                            <hr>';
                        }
                    }
                }
                exit();
                ?>
            </div>
            <hr>
        </div>
    </div>
</div>
</body>
</html>
