<?php

include 'libaries.php';
include 'sqlconn.php';

//Visitors not logged in should not be allowed to post
if(isUserLoggedIn() == false) {
    redirectToLoginPage();
}

$submitMsg = "";

if(isset($_POST['submit'])) {
    if (isset($_POST['departureLocation']) && isset($_POST['destinationLocation']) && isset($_POST['departureDate'])
        && isset($_POST['passengerPayment'])&& isset($_POST['carType'])&& isset($_POST['numOfSeats'])) {

        $startlocation = strtoupper($_POST['departureLocation']);
        $endlocation = strtoupper($_POST['destinationLocation']);
        $date = $_POST['departureDate'];
        $price = intval($_POST['passengerPayment']);
        $car = strtoupper($_POST['carType']);
        $numOfSeats = intval($_POST['numOfSeats']);

        //================================================================
        //Create a pop-out message to double-check all information to be added:
        //$msg = "Departing from ".$startlocation." to ".$endlocation." at ".$time." for $".$price." by vehicle ".$car." with ".$numOfSeats." seats available";
        //echo "<script type='text/javascript'>alert('$msg');</script>";
        //================================================================

        // TO DO: Add SQL queries to add information into database
        $query = "INSERT INTO TRIPS(START_LOCATION, END_LOCATION, RIDING_COST,SEATS_AVAILABLE, TRIP_DATE, FIRSTNAME, PROFILEID)
                  VALUES('".$startlocation."','".$endlocation."','".$price."','".$numOfSeats."','".$date."','".$_SESSION["profileName"]."','".$_SESSION["profileID"]."')";

        $result = oci_parse($connect, $query);

        $check = oci_execute($result, OCI_DEFAULT);
        if($check == false) {
            redirectToHomePage();
            exit;
        }else {
            $submitMsg = "Successfully posted";
            oci_commit($connect);
        }

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
    <?php
    include 'includes/datepicker.html';
    ?>
</head>
<body>

<?php
include 'includes/navbar.php';
?>

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
                                <input type="text" name="departureDate" placeholder="Departure Date" class="datepicker"/>
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
                                        <select name="carType" class="text-center" id="carDropdown">
                                            <option class="placeholder" selected="selected" value= "" disabled="disabled">Choose your car:</option>
                                            <?php
                                            $userID = getProfileID();

                                            //Associative array to be passed to javascript, so that it can determine the max value of the following dropdown bar
                                            $maxVehicleCapacity = array();

                                            $query = "SELECT PLATENO, MODEL, NUMOFSEATS FROM VEHICLE WHERE PROFILEID =".$userID;

                                            $result = oci_parse($connect, $query);

                                            $check = oci_execute($result, OCI_DEFAULT);
                                            if($check == true) {
                                                while($row = oci_fetch_array($result)) {
                                                    echo '<option value="'.$row['PLATENO'].'">'.$row['MODEL'].' ('.$row['PLATENO'].')</option>';

                                                //Building associative array
                                                    $maxVehicleCapacity[$row['PLATENO']] = $row['NUMOFSEATS'];
                                                }

                                                oci_free_statement($result);
                                            }

                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row collapse">
                                    <div class="large-12 left columns">
                                        <!--Query to Get Car Seats-->
                                        <script type="text/javascript">
                                            var arrayOfCarCapacity = <?php echo json_encode($maxVehicleCapacity)?>;
                                            localStorage['capacity'] = JSON.stringify(arrayOfCarCapacity);
                                        </script>
                                        <select name="numOfSeats" class="text-center" id="seatsDropdown">
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
                    <h5><?php echo $submitMsg ?></h5>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="js/post.js"></script>
</body>
</html>
