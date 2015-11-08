<?php
  if(!isset($connect)) {
    include '../sqlconn.php';
  }

  if (isset($_POST["startloc"]) && isset($_POST["endloc"]) && isset($_POST["ridingcost"]) && isset($_POST["seatsavail"]) && isset($_POST["tripdate"]) && isset($_POST["triptime"]) && isset($_POST["plateno"])) {
    //json_decode for numerical type, otherwise refrain from json_decode for varchar/non-numerical type
    $startloc = $_POST["startloc"];
    $endloc = $_POST["endloc"];
    $ridingcost = json_decode($_POST["ridingcost"]);
    $seatsavail = json_decode($_POST["seatsavail"]);
    $tripdate = "'".$_POST["tripdate"]." ".$_POST["triptime"]."'";
    $plateno = $_POST["plateno"];

    $query = "INSERT INTO (Start_Location, End_Location, Riding_Cost, Seats_Available, Trip_Date, PlateNo) VALUES (".$startloc.", ".$endloc.", ".$ridingcost.", ".$seatsavail.", TO_DATE(".$tripdate.", 'DD-MM-YY HH24:MI'), ".$plateno.")";

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
