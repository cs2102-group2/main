<?php
if(!isset($connect)) {
  include '../libaries.php';
  include '../sqlconn.php';
}

if (isset($_POST['startlocation']) && isset($_POST['endlocation']) && isset($_POST['tripdate']) && isset($_POST['price'])&& isset($_POST['plateno'])&& isset($_POST['numOfSeats'])) {

    $startlocation = strtoupper($_POST['startlocation']);
    $endlocation = strtoupper($_POST['endlocation']);
    $tripdate = $_POST['tripdate'];
    $price = intval(json_decode($_POST['price']));
    $plateno = strtoupper($_POST['plateno']);
    $numOfSeats = intval(json_decode($_POST['numOfSeats']));

    $query = "INSERT INTO TRIPS(START_LOCATION, END_LOCATION, RIDING_COST, SEATS_AVAILABLE, TRIP_DATE, PLATENO)
    VALUES(".$startlocation.",".$endlocation.",".$price.",".$numOfSeats.",(TO_DATE(".$tripdate.",'DD-Mon-YY HH24:MI')),".$plateno.")";

    $result = oci_parse($connect, $query);
    $check = oci_execute($result, OCI_DEFAULT);

    if($check == false) {
      echo "Posting unsuccessful...\n";
      echo $query;
    } else {
      echo "Successfully posted!";
      oci_commit($connect);
    }

    oci_free_statement($result);
}
?>
