<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Administration: Direct Manipulation of Underlying SQL Table</title>
    <link rel="stylesheet" href="./foundation/css/foundation.css" />
    <link rel="stylesheet" href="./css/customise.css" />
</head>
<body>

<?php
include 'includes/navbar.php';
?>
    <div class="large-12 columns">
        <div class="large-8 left large-offset-2 columns">
            <h3>Profiles</h3>
            <div class="row collapse">
                <table class="large-12 columns">
                    <tr>
                        <th>Profile ID</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Postal Code</th>
                        <th>Contact Number</th>
                        <th>DOB</th>
                        <th>Credit Card No.</th>
                        <th>Card Security No.</th>
                        <th>Card Name</th>
                        <th>Account Balance</th>
                        <th>Action(s)</th>
                    </tr>
                    <!--TODO: POPULATE TABLE WITH INFO USING BELOW TEMPLATE-->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>iconedit</td>
                        <td>icondelete</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="large-8 left large-offset-2 columns">
            <h3>Bookings</h3>
            <div class="row collapse">
                <table class="large-12 columns">
                    <tr>
                        <th>S/N</th>
                        <th>Profile ID (Owner)</th>
                        <th>Trip ID</th>
                        <th>Receipt ID</th>
                        <th>Action(s)</th>
                    </tr>
                    <!--TODO: POPULATE TABLE WITH INFO USING BELOW TEMPLATE-->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>iconedit</td>
                        <td>icondelete</td>
                    </tr>
                </table>
            </div>
        </div>


        <div class="large-8 left large-offset-2 columns">
            <h3>Vehicles</h3>
            <div class="row collapse">
                <table class="large-12 columns">
                    <tr>
                        <th>Plate Number</th>
                        <th>Profile ID (Owner)</th>
                        <th>Model</th>
                        <th>Number of Seats</th>
                        <th>Action(s)</th>
                    </tr>
                    <!--TODO: POPULATE TABLE WITH INFO USING BELOW TEMPLATE-->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>iconedit</td>
                        <td>icondelete</td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="large-8 left large-offset-2 columns">
            <h3>Vehicles</h3>
            <div class="row collapse">
                <table class="large-12 columns">
                    <tr>
                        <th>Trip ID</th>
                        <th>Start Location</th>
                        <th>End Location</th>
                        <th>Riding Cost</th>
                        <th>No. Seats Avail</th>
                        <th>Trip Date</th>
                        <th>First Name</th>
                        <th>Profile ID</th>
                        <th>Action(s)</th>
                    </tr>
                    <!--TODO: POPULATE TABLE WITH INFO USING BELOW TEMPLATE-->
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>iconedit</td>
                        <td>icondelete</td>
                    </tr>
                </table>
            </div>
        </div>

    </div>
</div>
</body>
</html>
