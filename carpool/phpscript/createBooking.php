<?php
  if(!isset($connect)) {
    include '../sqlconn.php';
  }

  if (isset($_POST["profileid"]) && isset($_POST["tripid"])) {
    //json_decode for numerical type, otherwise refrain from json_decode for varchar/non-numerical type
    $profileid = json_decode($_POST["profileid"]);
    $tripid = json_decode($_POST["tripid"]);

    $query = "INSERT INTO BOOKINGS (ProfileID, TripID) VALUES (".$profileid.", ".$tripid.")";

    $result = oci_parse($connect, $query);
    $check = oci_execute($result, OCI_DEFAULT);

    if($check == true) {
      oci_commit($connect);
    } else {
      //TODO
      echo $query;
    }
  }

  oci_free_statement($result);

  exit;
?>
