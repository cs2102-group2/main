<?php
  if(!isset($connect)) {
    include '../sqlconn.php';
  }

  if (isset($_POST["id"]) && isset($_POST["platenum"]) && isset($_POST["profileid"]) && isset($_POST["model"]) && isset($_POST["seatsnum"])) {
    //json_decode for numerical type, otherwise refrain from json_decode for varchar/non-numerical type
    $id = $_POST["id"];
    $platenum = $_POST["platenum"];
    $profileid = json_decode($_POST["profileid"]);
    $model = $_POST["model"];
    $seatsnum = json_decode($_POST["seatsnum"]);

    $query = "UPDATE VEHICLE
              SET PLATENO = ".$platenum.",
                  PROFILEID = ".$profileid.",
                  MODEL = ".$model.",
                  NUMOFSEATS = ".$seatsnum."
              WHERE PLATENO = ".$id;

    $result = oci_parse($connect, $query);
    $check = oci_execute($result, OCI_DEFAULT);

    if($check == true) {
      oci_commit($connect);
      echo $query;
    } else {
      //TODO
      echo $query;
    }

    oci_free_statement($result);

  }

  else if (isset($_POST["id"]) && isset($_POST["platenum"]) && isset($_POST["model"]) && isset($_POST["seatsnum"])) {

    $id = $_POST["id"];
    $platenum = $_POST["platenum"];
    $model = $_POST["model"];
    $seatsnum = json_decode($_POST["seatsnum"]);

    $query = "UPDATE VEHICLE
              SET PLATENO = ".$platenum.",
                  PROFILEID = ".$profileid.",
                  MODEL = ".$model.",
                  NUMOFSEATS = ".$seatsnum."
              WHERE PLATENO = ".$id;

    $result = oci_parse($connect, $query);
    $check = oci_execute($result, OCI_DEFAULT);

    if($check == true) {
      oci_commit($connect);
      echo $query;
    } else {
      //TODO
      echo $query;
    }

    oci_free_statement($result);

  }

  exit;
?>
