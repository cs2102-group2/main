<?php

include 'loadsession.php';
//include 'sqlconn.php';

$resultMsg = "";

if(isset($_POST['makePayment'])) {
    if(isset($_POST['topUpAmount'])) {
        $topUpAmount = $_POST['topUpAmount'];

        //================================================================
        //Create a pop-out message to double-check amount:
        //$msg = "Amount to top-up is ".$topUpAmount;
        //echo "<script type='text/javascript'>alert('$msg');</script>";
        //================================================================



        // ============================================================================
        // Simulate a Credit Card Deduction
        // ============================================================================




        // ============================================================================
        // SQL query for updating col 'ACCBALANCE' in table 'PROFILE' with new value
        // ============================================================================

        $query = "UPDATE PROFILE SET ACCBALANCE = ACCBALANCE + ".$topUpAmount." WHERE ID='".$_SESSION["profileID"]."'";

        //  Store result of query
        $result = oci_parse($connect, $query);

        // Check if query fails
        $check = oci_execute($result, OCI_DEFAULT);
        if($check == false) {
            $resultMsg = "Your top up failed. Please try again";
            exit;
        }

        // ============================================================================
        // Find the updated Account Balance
        // ============================================================================

        $query = "SELECT ACCBALANCE FROM PROFILE WHERE Id='".$_SESSION["profileID"]."'";
        $result = oci_parse($connect, $query);
        $check = oci_execute($result, OCI_DEFAULT);
        if($check == false) {
            redirectToPaymentPage();
            exit;
        }

        // Update session variable
        while($row = oci_fetch_array($result)) {
            $_SESSION["profileAccountBalance"] = $row[0];
        }

        oci_free_statement($result);
        $resultMsg = "You have successfully top-up";
        exit;
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
<nav class="top-bar" data-topbar="" role="navigation">
    <ul class="title-area">
        <ul class="title-area">
            <li class="name">
                <h1><a href="#">
                        <?php getProfileName() ?>
                    </a>
                </h1>
            </li>
        </ul>
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
<div class="large-12 center-vertically columns">
    <form method="post" >
        <div class="row">
            <div class="large-6 large-offset-3 columns text-center white-translucent">
                <h2>Your Account Balance:</h2>
                <p id="userCurrency">
                    <?php getProfileAccountBalance() ?>
                </p>
                <label id="topUpAmount" action="payment.php">
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
                <input type="submit" name="makePayment" class="large-12 small button" value="MAKE PAYMENT" />
                <h5><?php echo $resultMsg ?></h5>
            </div>

        </div>
    </form>
</div>
</body>
</html>
