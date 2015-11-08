<?php
  if(!isset($connect)) {
    include '../sqlconn.php';
  }

  if (isset($_POST["id"])) {
    //json_decode for numerical type, otherwise refrain from json_decode for varchar/non-numerical type
    $id = $_POST["id"];

    $query = "DELETE FROM BOOKINGS WHERE RECEIPTNO = ".$id;

    $result = oci_parse($connect, $query);
    $check = oci_execute($result, OCI_DEFAULT);

    if($check == true) {
      oci_commit($connect);
    } else {
      //TODO
    }
  }

  oci_free_statement($result);

  exit;
?>
