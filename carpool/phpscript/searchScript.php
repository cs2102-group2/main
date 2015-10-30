<?php

if(!isset($connect)) {
  include '../libaries.php';
  include '../sqlconn.php';
}

if (isset($_POST['tripID'])) {
    $tripID = json_decode($_POST['tripID']);

    $query = "CALL BookingTransaction(:passengerID, :tripID)";
    $result = oci_parse($connect, $query);

    oci_bind_by_name($result, ':passengerID', getProfileID()) ;
    oci_bind_by_name($result, ':tripID', $tripID) ;

    $check = oci_execute($result, OCI_DEFAULT);

    if($check == true) {
      oci_commit($connect);
      echo "Booking successful!";
    } else {
      echo $query;
    }
    oci_free_statement($result);
}

exit;
?>
