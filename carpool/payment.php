<?php

include 'libaries.php';
include 'sqlconn.php';

$resultMsg = "";

if(isset($_POST['makePayment'])) {
    if(isset($_POST['topUpAmount'])) {
        $topUpAmount = floatval($_POST['topUpAmount']);

        //================================================================
        //Create a pop-out message to double-check amount:
        //$msg = "Amount to top-up is ".$topUpAmount." ProfileID is ".$_SESSION["profileID"];
        //echo "<script type='text/javascript'>alert('$msg');</script>";
        //================================================================

        // ============================================================================
        // Simulate a Credit Card Deduction
        // ============================================================================




        // ============================================================================
        // SQL query for updating col 'ACCBALANCE' in table 'PROFILE' with new value
        // ============================================================================

        $query = "UPDATE PROFILE SET ACCBALANCE = ACCBALANCE + '".$topUpAmount."' WHERE PROFILEID ='".$_SESSION["profileID"]."'";

        echo "<script type='text/javascript'>alert('$query');</script>";

        //  Store result of query
        $result = oci_parse($connect, $query);

        // Check if query fails
        $check = oci_execute($result, OCI_DEFAULT);
        if($check == false) {
            $resultMsg = "Your top up failed. Please try again";
            exit();
        }else{
            oci_commit($connect);
        }

        // ============================================================================
        // Find the updated Account Balance
        // ============================================================================

        $sqlqry = "SELECT ACCBALANCE FROM PROFILE WHERE PROFILEID ='".$_SESSION["profileID"]."'";
        $res = oci_parse($connect, $sqlqry);
        $chck = oci_execute($res, OCI_DEFAULT);
        if($chck == false) {
            $resultMsg = "Your top up failed. Please try again";
            echo "<script type='text/javascript'>alert('$resultmsg');</script>";
            exit();
        }

        // Update session variable
        while($rw = oci_fetch_array($res)) {
            $_SESSION["profileAccountBalance"] = $rw[0];
            oci_free_statement($result);
            $resultMsg = "You have successfully top-up";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment</title>
    <link rel="stylesheet" href="./foundation/css/foundation.css" />
    <link rel="stylesheet" href="./css/customise.css" />
</head>
<body>

<?php
include 'includes/navbar.php';
?>

<div class="large-12 center-vertically columns">
    <form method="post" action="payment.php">
        <div class="row">
            <div class="large-6 large-offset-3 columns text-center white-translucent">
                <h2>Your Account Balance:</h2>
                <p id="userCurrency">
                    <?php getProfileAccountBalance() ?>
                </p>
                <label id="topUpAmount">
                    <select name = "topUpAmount" class="text-center">
                        <option class="placeholder" selected="selected" value= "" disabled="disabled">Select amount of credits to add</option>
                        <option value="5">+ SGD 5.00</option>
                        <option value="10">+ SGD 10.00</option>
                        <option value="15">+ SGD 15.00</option>
                        <option value="20">+ SGD 20.00</option>
                    </select>
                </label>
            </div>
        </div>
        <div class="row">
            <div class="large-6 large-offset-3 columns white-translucent">
                <input type="submit" name="makePayment" class="large-12 small button" value="DEDUCT FROM CREDITCARD" />
                <h5><?php echo $resultMsg ?></h5>
            </div>

        </div>
    </form>
</div>
</body>
</html>
