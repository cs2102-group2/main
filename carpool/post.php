<?php

include 'libaries.php';
include 'sqlconn.php';

//Visitors not logged in should not be allowed to post
if(isUserLoggedIn() == false) {
    redirectToLoginPage();
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
    <br>
    <div class="large-6 large-offset-3 white-translucent columns">
        <div class="large-12 columns">
            <div class="row">
                <form>
                    <br>
                    <label>
                        <b>Route</b>
                        <div class="row journeyPoint">
                            <div class="large-6 columns">
                                <input type="text" id="startlocation" name="departureLocation" placeholder="Departure" />
                            </div>
                            <div class="large-3 columns">
                                <input type="text" id="tripdate" name="departureDate" placeholder="Departure Date" class="datepicker"/>
                            </div>
                            <div class="large-3 columns">
                                <input type="text" id="triptime" name="depatureTime" placeholder="00:00"/>
                            </div>
                        </div>
                        <div class="row journeyPoint">
                            <div class="large-6 columns">
                                <input type="text" id="endlocation" name="destinationLocation" placeholder="Destination" />
                            </div>
                        </div>
                    </label>
                    <hr>
                    <div class="row collapse">
                        <div class="large-5 columns">
                            <label>
                                <b>Payment</b>
                                <div class="row collapse">
                                    <div class="large-2 left columns">
                                        <span class="prefix">SGD</span>
                                    </div>
                                    <div class="large-10 left columns">
                                        <input type="text" id="ridingcost" name="passengerPayment" placeholder="Price Per Passenger" />
                                    </div>
                                </div>
                            </label>
                            <label>
                                <b>Car</b>
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
                    <a id="submit" class="large-12 columns tiny button">SUBMIT</a>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="tripPopup">
    <div id="tripText">
    </div>
</div>

<script src="js/post.js"></script>
</body>
</html>
