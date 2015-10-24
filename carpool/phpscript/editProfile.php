<?php
  if(!isset($connect)) {
    include '../sqlconn.php';
  }

  if (isset($_POST["id"]) && isset($_POST["profileid"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["postalcode"]) && isset($_POST["contactnum"]) && isset($_POST["dob"]) && isset($_POST["creditcardnum"]) && isset($_POST["csc"]) && isset($_POST["cardholder"]) && isset($_POST["acct"])) {
    //json_decode for numerical type, otherwise refrain from json_decode for varchar/non-numerical type
    $id = json_decode($_POST["id"]);
    $profileid = json_decode($_POST["profileid"]);
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $postalcode = json_decode($_POST["postalcode"]);
    $contactnum = json_decode($_POST["contactnum"]);
    $dob = $_POST["dob"];
    $creditcardnum = json_decode($_POST["creditcardnum"]);
    $csc = json_decode($_POST["csc"]);
    $cardholder = $_POST["cardholder"];
    $acct = $_POST["acct"];

    $query = "UPDATE PROFILE
              SET PROFILEID = ".$profileid.",
                  EMAIL = ".$email.",
                  PASSWORD = ".$password.",
                  FIRSTNAME = ".$firstname.",
                  LASTNAME = ".$lastname.",
                  POSTALCODE = ".$postalcode.",
                  CONTACTNUM = ".$contactnum.",
                  DATEOFBIRTH = ".$dob.",
                  CREDITCARDNUM =  ".$creditcardnum.",
                  CARDSECURITYCODE = ".$csc.",
                  CARDHOLDERNAME = ".$cardholder.",
                  ACCBALANCE = ".$acct."
              WHERE PROFILEID = ".$id;

    $result = oci_parse($connect, $query);
    $check = oci_execute($result, OCI_DEFAULT);

    if($check == true) {
      oci_commit($connect);
    } else {
      //TODO
      echo $query;
    }
  }

  exit;
?>
