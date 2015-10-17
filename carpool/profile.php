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
    <title>My Profile</title>
    <link rel="stylesheet" href="./foundation/css/foundation.css" />
    <link rel="stylesheet" href="./css/customise.css" />

    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<body>

<?php
include 'includes/navbar.php';
?>

<div class="large-12 columns ">
    <div class="large-8 large-offset-2 columns">

        <div class="row collapse">
            <div class="username large-12 columns">
                <h2 class="white-font"><?php getProfileName() ?></h2>
            </div>
        </div>

        <!--Query user's car-->
        <div class="row collapse">
            <table class="large-12 columns">
            <caption class="white-font"><b>Your Car(s)</b></caption>
                <tr>
                    <th>Car Plate Number</th>
                    <th>Model</th>
                    <th>Seats Available</th>
                    <th>Actions</th>
                </tr>
                <?php

                $userID = getProfileID();

                $query = "SELECT PLATENO, MODEL, NUMOFSEATS FROM VEHICLE WHERE PROFILEID=".$userID."";

                $result = oci_parse($connect, $query);
                $check = oci_execute($result, OCI_DEFAULT);

                if($check == true) {
                    while($row = oci_fetch_array($result)) {
                        echo'<tr>
                                <td>'.$row['PLATENO'].'</td>
                                <td>'.$row['MODEL'].'</td>
                                <td>'.$row['NUMOFSEATS'].'</td>
                                <td><span title="Edit" class="ui-icon ui-icon-pencil"></span></td>
                                <td><span title="Delete" class="ui-icon ui-icon-trash"></span></td>
                            </tr>';
                    }
                }

                echo'<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><span title="Add" class="ui-icon ui-icon-plus"></span></td>
                    <td></td>
                </tr>';

                oci_free_statement($result);

                ?>
            </table>
        </div>

        <div class="row collapse">
            <!--Query user's pending passengers-->
            <table class="large-12 columns">
            <caption class="white-font"><b>Pending: Your Passenger(s)</b></caption>
                <tr>
                    <th>Passenger(s)</th>
                    <th>Contact</th>
                    <th>Departure</th>
                    <th>Destination</th>
                    <th>Departure Time</th>
                </tr>
                <tr>
                    <td>The Egg</td>
                    <td>9999-9999</td>
                    <td>Egg Farm</td>
                    <td>Frying Pan</td>
                    <td>23 Jun 15, 08:00</td>
                </tr>
            </table>
        </div>

        <div class="row collapse">
            <!--Query user's pending ride-->
            <table class="large-12 columns">
            <caption class="white-font"><b>Pending: Your Rides(s)</b></caption>
                <tr>
                    <th>Driver(s)</th>
                    <th>Contact</th>
                    <th>Model</th>
                    <th>Seats</th>
                    <th>Departure</th>
                    <th>Destination</th>
                    <th>Departure Time</th>
                </tr>
                <tr>
                    <td>June</td>
                    <td>9999-9999</td>
                    <td>No Model</td>
                    <td>3 / 4</td>
                    <td>Kent Ridge</td>
                    <td>Kent Ridge</td>
                    <td>23 Jun 15, 08:00</td>
                </tr>
            </table>
        </div>

        <!--
        <div class="row collapse">
            <caption>What Are Others Saying?</caption>

            <div class="commentHolder">
                <div class="row collapse">
                    <div class="large-12 passenger columns">
                        <a href="#">Passenger's Name</a>
                    </div>
                </div>
                <div class="row collapse">
                    <p class="large-9 columns">HELLO</p>
                    <div class="rating large-3 columns">
                    </div>
                </div>
            </div>
        </div>
        -->

    </div>
</div>

</body>
</html>
