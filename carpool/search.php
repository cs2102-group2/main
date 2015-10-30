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
    <script src="js/search.js" ></script>

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
                        $date = $_POST['dateSearch'];

                        $query = "SELECT COUNT(*) AS AVAIL_CARPOOL, MIN(TRIP_TIME) AS MIN_TRIP_TIME, MAX(TRIP_TIME) AS MAX_TRIP_TIME, MIN(COST) AS MIN_COST, MAX(COST) AS MAX_COST
                                  FROM SEARCHQUERY
                                  WHERE DEPARTURE = '".$departure."'
                                  AND DESTINATION = '".$destination."'
                                  AND TRIP_DATE = '".$date."'";

                        $result = oci_parse($connect, $query);

                        $check = oci_execute($result, OCI_DEFAULT);
                        if($check == false) {
                            redirectToSearchPage();
                            exit;
                        }

                        $row = oci_fetch_array($result);

                        //Retrieve available number of carpool
                        echo'<p id="availCarpool">'.$row['AVAIL_CARPOOL'].'</p>';
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
                <ul class="button-group radius even-3">
                    <li><a href="#" class="tiny button" id="seatSort">Seats</a></li>
                    <li><a href="#" class="tiny button" id="timeSort">TIME</a></li>
                    <li><a href="#" class="tiny button" id="priceSort">PRICE</a></li>
                </ul>
            </div>
            <div class="large-12 right columns">
                <p>FIlTER BY:</p>
            </div>
            <div class="large-12 right columns">
                <!--Set Time Range too!-->
                <label>Time <?php echo '('.$row['MIN_TRIP_TIME'].' - '.$row['MAX_TRIP_TIME'].')' ?>
                    <div class="range-slider radius" data-slider>
                        <span class="range-slider-handle" role="slider" tabindex="0"></span>
                        <span class="range-slider-active-segment"></span>
                        <input type="hidden">
                    </div>
                </label>
            </div>

            <!--
            <div class="large-12 right columns">
                <label>Distance - Departure (2.3km - 40km)
                    <div class="range-slider radius" data-slider>
                        <span class="range-slider-handle" role="slider" tabindex="0"></span>
                        <span class="range-slider-active-segment"></span>
                        <input type="hidden">
                    </div>
                </label>
                <label>Distance - Destination (2.3km - 40km)
                    <div class="range-slider radius" data-slider>
                        <span class="range-slider-handle" role="slider" tabindex="0"></span>
                        <span class="range-slider-active-segment"></span>
                        <input type="hidden">
                    </div>
                </label>
            </div>
            -->

            <div class="large-12 right columns">
                <!--Set Price Range too!-->
                <label>Price <?php echo '( SGD '.$row['MIN_COST'].' -  SGD '.$row['MAX_COST'].')' ?>
                    <div class="range-slider radius" data-slider>
                        <span id="priceFilter" class="range-slider-handle" role="slider" tabindex="0"></span>
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

                        $query = "SELECT TRIPNO, DRIVER, DEPARTURE, DESTINATION, COST, SEATS_AVAILABLE, TRIP_DATE, TRIP_TIME
                                  FROM SEARCHQUERY
                                  WHERE DEPARTURE = '".$departure."'
                                  AND DESTINATION = '".$destination."'
                                  AND TRIP_DATE = '".$date."'";

                        $result = oci_parse($connect, $query);

                        $check = oci_execute($result, OCI_DEFAULT);
                        if($check == false) {
                            redirectToSearchPage();
                            exit;
                        }

                        // Print out results from Database
                        while($row = oci_fetch_array($result)) {
                            echo'<div class="row collapse" data-tripid="'.$row['TRIPNO'].'" data-cost="'.$row['COST'].'" data-start="'.$row['DEPARTURE'].'" data-end="'.$row['DESTINATION'].'" data-date="'.$row['TRIP_DATE'].'" data-time="'.$row['TRIP_TIME'].'" data-seats-avail="'.$row['SEATS_AVAILABLE'].'">
                                <div class="large-4 columns">
                                    <br>
                                    <br>
                                    <p><b>'.$row['DRIVER'].'</b></p>
                                </div>
                                <div class="large-4 columns">
                                    <!--<p>4 July 2015, 6:00 pm</p>-->
                                    <p>'.$row['TRIP_DATE'].', '.$row['TRIP_TIME'].'</p>
                                    <p>Departure: '.$row['DEPARTURE'].'</p>
                                    <!--<p class="smallFont">(30 km from your searched departure.)</p>-->
                                    <p>Destination: '.$row['DESTINATION'].'</p>
                                    <!--<p class="smallFont">(30 km from your searched departure.)</p>-->
                                </div>
                                <div class="large-4 columns">
                                    <p>SGD '.$row['COST'].' / Passenger</p>
                                    <a value="'.$row['TRIPNO'].'" class="bookingSubmit radius button">'.$row['SEATS_AVAILABLE'].' SEATS AVAILABLE</a>
                                </div>
                                <hr>
                                <hr>
                            </div>
                            ';
                        }
                    }
                }
                ?>
            </div>
            <hr>
        </div>
    </div>
</div>

<div id="bookingPopup">
    <div id="bookingText">
    </div>
</div>

  <script src="js/foundation/foundation.js"></script>
  <script src="js/foundation/foundation.slider.js"></script>
  <script>
    $(document).foundation('slider', 'reflow');
  </script>
</body>
</html>
