<?php
include 'libaries.php';
include 'sqlconn.php'; // Connect to database
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin</title>
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
                <td class="profileid">'.$row['PROFILEID'].'</td>
                <td class="email">'.$row['EMAIL'].'</td>
                <td class="password">'.$row['PASSWORD'].'</td>
                <td class="firstname">'.$row['FIRSTNAME'].'</td>
                <td class="lastname">'.$row['LASTNAME'].'</td>
                <td class="postalcode">'.$row['POSTALCODE'].'</td>
                <td class="contactnum">'.$row['CONTACTNUM'].'</td>
                <td class="dateofbirth">'.$row['DATEOFBIRTH'].'</td>
                <td class="creditcardnum">'.$row['CREDITCARDNUM'].'</td>
                <td class="cardsecuritycode">'.$row['CARDSECURITYCODE'].'</td>
                <td class="cardholdername">'.$row['CARDHOLDERNAME'].'</td>
                <td class="accbalance">'.$row['ACCBALANCE'].'</td>
                <td><a title="Edit" class="ui-icon ui-icon-pencil editProfileButton"></a></td>
                <td><a title="Delete" class="ui-icon ui-icon-trash delProfileButton"></a></td>
            </tr>';
        }
        oci_free_statement($result);
        ?>
    </table>
</div>

<form id="editProfileForm" >
    <label for="idprofile">ID:</label>
    <input type="text" name="profile" id="idprofile">
    <label for="idfrname">First Name:</label>
    <input type="text" name="frname" id="idfrname">
    <label for="idlstname">Last Name:</label>
    <input type="text" name="lstname" id="idlstname">
    <label for="idemail">Email:</label>
    <input type="text" name="email" id="idemail">
    <label for="idpasswd">Password:</label>
    <input type="text" name="passwd" id="idpasswd">
    <label for="profileid">Postal Code:</label>
    <input type="text" name="postal" id="idpostal">
    <label for="idcontact">Contact:</label>
    <input type="text" name="contact" id="idcontact">
    <label for="iddob">DOB:</label>
    <input type="text" name="dob" id="iddob">
    <label for="idcardno">Credit Card No:</label>
    <input type="text" name="cardno" id="idcardno">
    <label for="idcsc">Card Security No:</label>
    <input type="text" name="csc" id="idcsc">
    <label for="idcardname">Credit Card Holder:</label>
    <input type="text" name="csc" id="idcardname">
    <label for="idacct">Account Balance:</label>
    <input type="text" name="acct" id="idacct">
</form>

<div id="deleteProfileForm">
    <div id="deleteProfileText">
    </div>
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
                <td class="plateno">'.$row['PLATENO'].'</td>
                <td class="model">'.$row['MODEL'].'</td>
                <td class="numofseats">'.$row['NUMOFSEATS'].'</td>
                <td class="profileid">'.$row['PROFILEID'].'</td>
                <td><a title="Edit" class="ui-icon ui-icon-pencil editVehicleButton"></a></td>
                <td><a title="Delete" class="ui-icon ui-icon-trash delVehicleButton"></a></td>
            </tr>';
            }
        }

        oci_free_statement($result);
        ?>
    </table>
</div>

<form id="editVehicleForm" >
    <label for="idplateno">Plate Number:</label>
    <input type="text" name="platenum" id="idplateno">
    <label for="profileid1">Profile ID (Ref):</label>
    <input type="text" name="profileid" id="profileid1">
    <label for="idmodel">Model:</label>
    <input type="text" name="model" id="idmodel">
    <label for="idnumseats">No. Of Seats:</label>
    <input type="text" name="numseats" id="idnumseats">
</form>

<div id="deleteVehicleForm">
    <div id="deleteVehicleText">
    </div>
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
                <td class="bno">'.$row['BNO'].'</td>
                <td class="profileid">'.$row['PROFILEID'].'</td>
                <td class="tripid">'.$row['TRIPID'].'</td>
                <td class="receiptno">'.$row['RECEIPTNO'].'</td>
                <td><a title="Edit" class="ui-icon ui-icon-pencil editBookingButton"></a></td>
                <td><a title="Delete" class="ui-icon ui-icon-trash delBookingButton"></a></td>
            </tr>';
        }
    }

    oci_free_statement($result);
    ?>
</table>
</div>

<form id="editBookingForm" >
    <label for="idbno">Booking ID:</label>
    <input type="text" name="platenum" id="idbno">
    <label for="idprofileid2">Profile ID (Ref):</label>
    <input type="text" name="profileid" id="idprofileid2">
    <label for="idtripid1">Trip ID (Ref):</label>
    <input type="text" name="model" id="idtripid1">
    <label for="idreceiptno">Receipt No:</label>
    <input type="text" name="receiptno" id="idreceiptno">
</form>

<div id="deleteBookingForm">
    <div id="deleteBookingText">
    </div>
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
            <th>Plate No</th>
            <th>Profile ID</th>
            <!--<th>Action(s)</th>-->
        </tr>
        <?php

        $query = "SELECT TRIPNO, START_LOCATION, END_LOCATION, RIDING_COST, SEATS_AVAILABLE, TRIP_DATE, PLATENO, PROFILEID
                  FROM TRIPS";

        $result = oci_parse($connect, $query);

        $check = oci_execute($result, OCI_DEFAULT);
        if($check == true) {
            while($row = oci_fetch_array($result)) {
                echo '<tr>
                <td class="tripno">'.$row['TRIPNO'].'</td>
                <td class="startlocation">'.$row['START_LOCATION'].'</td>
                <td class="endlocation">'.$row['END_LOCATION'].'</td>
                <td class="ridingcost">'.$row['RIDING_COST'].'</td>
                <td class="seatsavailable">'.$row['SEATS_AVAILABLE'].'</td>
                <td class="tripdate">'.$row['TRIP_DATE'].'</td>
                <td class="plateno">'.$row['VEHICLENO'].'</td>
                <td class="profileid">'.$row['PROFILEID'].'</td>
                <td><a title="Edit" class="ui-icon ui-icon-pencil editTripButton"></a></td>
                <td><a title="Delete" class="ui-icon ui-icon-trash delTripButton"></a></td>
            </tr>';
        }
    }

    oci_free_statement($result);
    ?>
</table>
</div>

<form id="editTripForm" >
    <label for="idtripno2">Trip ID (Ref):</label>
    <input type="text" name="tripid" id="idtripno2">
    <label for="idstartlocation">Start Location:</label>
    <input type="text" name="startloc" id="idstartlocation">
    <label for="idendlocation">End Location:</label>
    <input type="text" name="endloc" id="idendlocation">
    <label for="idcost">Riding Cost:</label>
    <input type="text" name="ridingcost" id="idcost">
    <label for="idseatsavail">Seats Available:</label>
    <input type="text" name="seatsavail" id="idseatsavail">
    <label for="idtripdate">Trip Date:</label>
    <input type="text" name="tripdate" id="idtripdate">
    <label for="idplateno1">Plate No:</label>
    <input type="text" name="plateno" id="idplateno1">
    <label for="idprofileid3">Profile ID:</label>
    <input type="text" name="profileid" id="idprofileid3">
</form>

<div id="deleteTripForm">
    <div id="deleteTripText">
    </div>
</div>

</div>
</body>
</html>
