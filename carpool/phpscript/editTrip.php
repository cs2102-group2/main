<?php
  if(!isset($connect)) {
    include '../sqlconn.php';
  }

  if (isset($_POST["id"]) && isset($_POST["tripid"]) && isset($_POST["startloc"]) && isset($_POST["endloc"]) && isset($_POST["ridingcost"]) && isset($_POST["seatsavail"]) && isset($_POST["tripdate"]) && isset($_POST["triptime"]) && isset($_POST["plateno"])) {
    //json_decode for numerical type, otherwise refrain from json_decode for varchar/non-numerical type
    $id = json_decode($_POST["id"]);
    $tripid = json_decode($_POST["tripid"]);
    $startloc = $_POST["startloc"];
    $endloc = $_POST["endloc"];
    $ridingcost = json_decode($_POST["ridingcost"]);
    $seatsavail = json_decode($_POST["seatsavail"]);
    $tripdate = "'".$_POST["tripdate"]." ".$_POST["triptime"]."'";
    $plateno = $_POST["plateno"];

    $query = "UPDATE TRIPS
              SET TRIPNO = ".$tripid.",
                  START_LOCATION = ".$startloc.",
                  END_LOCATION = ".$endloc.",
                  RIDING_COST = ".$ridingcost.",
                  SEATS_AVAILABLE = ".$seatsavail.",
                  TRIP_DATE = TO_DATE(".$tripdate.", 'DD-Mon-YY HH24:MI'),
                  PLATENO = ".$plateno."
              WHERE TRIPNO = ".$id;

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
