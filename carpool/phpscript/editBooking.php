<?php
  if(!isset($connect)) {
    include '../sqlconn.php';
  }

  if (isset($_POST["id"]) && isset($_POST["profileid"]) && isset($_POST["tripid"]) && isset($_POST["receiptno"])) {
    //json_decode for numerical type, otherwise refrain from json_decode for varchar/non-numerical type
    $id = $_POST["id"];
    $profileid = json_decode($_POST["profileid"]);
    $tripid = json_decode($_POST["tripid"]);
    $receiptno = $_POST["receiptno"];

    $query = "UPDATE BOOKINGS
              SET PROFILEID = ".$profileid.",
                  TRIPID = ".$tripid.",
                  RECEIPTNO = ".$receiptno."
              WHERE RECEIPTNO = ".$id;

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
