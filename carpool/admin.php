<?php
include 'libaries.php';
    include 'sqlconn.php'; // Connect to database
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Administration: Direct Manipulation of Underlying SQL Table</title>
        <link rel="stylesheet" href="./foundation/css/foundation.css" />
        <link rel="stylesheet" href="./css/customise.css" />

        <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/jquery-1.10.2.js"></script>
        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

        <script src="js/admin.js"></script>
    </head>
    <body>

        <?php
        include 'includes/navbarAdmin.php';
        ?>
        <div class="large-12 columns">
            <div id="profileDiv" class="large-12 left columns">
                <h3 class="white-font">Profiles</h3>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Postal Code</th>
                        <th>Contact Number</th>
                        <th>DOB</th>
                        <th>Credit Card</th>
                        <th>CSC</th>
                        <th>Card Name</th>
                        <th>Acct. Balance</th>
                        <!--<th>Action(s)</th>-->
                    </tr>
                    <?php

                    $query = "SELECT PROFILEID, EMAIL, PASSWORD, FIRSTNAME, LASTNAME, POSTALCODE, CONTACTNUM, DATEOFBIRTH, CREDITCARDNUM, CARDSECURITYCODE, CARDHOLDERNAME, ACCBALANCE FROM PROFILE";

                    $result = oci_parse($connect, $query);

                    $check = oci_execute($result, OCI_DEFAULT);
                    if($check == false) {
                        redirectToLoginPage();
                        exit;
                    }

                    while($row = oci_fetch_array($result)) {
                        echo '<tr>
                        <td>'.$row['PROFILEID'].'</td>
                        <td>'.$row['EMAIL'].'</td>
                        <td>'.$row['PASSWORD'].'</td>
                        <td>'.$row['FIRSTNAME'].'</td>
                        <td>'.$row['LASTNAME'].'</td>
                        <td>'.$row['POSTALCODE'].'</td>
                        <td>'.$row['CONTACTNUM'].'</td>
                        <td>'.$row['DATEOFBIRTH'].'</td>
                        <td>'.$row['CREDITCARDNUM'].'</td>
                        <td>'.$row['CARDSECURITYCODE'].'</td>
                        <td>'.$row['CARDHOLDERNAME'].'</td>
                        <td>'.$row['ACCBALANCE'].'</td>
                        <td><span title="Edit" class="ui-icon ui-icon-pencil"></span></td>
                        <td><span title="Delete" class="ui-icon ui-icon-trash"></span></td>
                    </tr>';
                }
                oci_free_statement($result);
                ?>
            </table>
        </div>

        <div id="vehicleDiv" class="large-12 left columns">
            <h3 class="white-font">Vehicles</h3>
            <table class="large-12 left columns">
                <tr>
                    <th>Plate Number</th>
                    <th>Model</th>
                    <th>No. of Seats</th>
                    <th>Profile ID (Owner)</th>
                    <!--<th>Action(s)</th>-->
                </tr>
                <?php

                $query = "SELECT PLATENO, MODEL, NUMOFSEATS, PROFILEID FROM VEHICLE";

                $result = oci_parse($connect, $query);

                $check = oci_execute($result, OCI_DEFAULT);
                if($check == true) {
                    while($row = oci_fetch_array($result)) {
                        echo '<tr>
                        <td>'.$row['PLATENO'].'</td>
                        <td>'.$row['MODEL'].'</td>
                        <td>'.$row['NUMOFSEATS'].'</td>
                        <td>'.$row['PROFILEID'].'</td>
                        <td><span title="Edit" class="ui-icon ui-icon-pencil"></span></td>
                        <td><span title="Delete" class="ui-icon ui-icon-trash"></span></td>
                    </tr>';
                }
            }

            oci_free_statement($result);
            ?>
        </table>
    </div>

    <div id="bookingDiv" class="large-12 left columns">
        <h3 class="white-font">Bookings</h3>
        <table class="large-12 columns">
            <tr>
                <th>S/N</th>
                <th>Profile ID (Owner)</th>
                <th>Trip ID</th>
                <th>Receipt ID</th>
                <!--<th>Action(s)</th>-->
            </tr><?php

            $query = "SELECT BNO, PROFILEID, TRIPID, RECEIPTNO FROM BOOKINGS";

            $result = oci_parse($connect, $query);

            $check = oci_execute($result, OCI_DEFAULT);
            if($check == true) {
                while($row = oci_fetch_array($result)) {
                    echo '<tr>
                    <td>'.$row['BNO'].'</td>
                    <td>'.$row['PROFILEID'].'</td>
                    <td>'.$row['TRIPID'].'</td>
                    <td>'.$row['RECEIPTNO'].'</td>
                    <td><span title="Edit" class="ui-icon ui-icon-pencil"></span></td>
                    <td><span title="Delete" class="ui-icon ui-icon-trash"></span></td>
                </tr>';
            }
        }

        oci_free_statement($result);
        ?>
    </table>
</div>

<div id="tripDiv" class="large-12 left columns">
    <h3 class="white-font">Trips</h3>
    <table class="large-12 columns">
        <tr>
            <th>Trip ID</th>
            <th>Start Location</th>
            <th>End Location</th>
            <th>Cost</th>
            <th>Seats Avail</th>
            <th>Date</th>
            <th>First Name</th>
            <th>Profile ID</th>
            <!--<th>Action(s)</th>-->
        </tr>
        <?php

        $query = "SELECT TRIPNO, START_LOCATION, END_LOCATION, RIDING_COST, SEATS_AVAILABLE, TRIP_DATE, FIRSTNAME, PROFILEID FROM TRIPS";

        $result = oci_parse($connect, $query);

        $check = oci_execute($result, OCI_DEFAULT);
        if($check == true) {
            while($row = oci_fetch_array($result)) {
                echo '<tr>
                <td>'.$row['TRIPNO'].'</td>
                <td>'.$row['START_LOCATION'].'</td>
                <td>'.$row['END_LOCATION'].'</td>
                <td>'.$row['RIDING_COST'].'</td>
                <td>'.$row['SEATS_AVAILABLE'].'</td>
                <td>'.$row['TRIP_DATE'].'</td>
                <td>'.$row['FIRSTNAME'].'</td>
                <td>'.$row['PROFILEID'].'</td>
                <td><span title="Edit" class="ui-icon ui-icon-pencil"></span></td>
                <td><span title="Delete" class="ui-icon ui-icon-trash"></span></td>
            </tr>';
        }
    }

    oci_free_statement($result);
    exit();
    ?>
</table>
</div>
</div>
</body>
</html>
