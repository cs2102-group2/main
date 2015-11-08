<?php
  if(!isset($connect)) {
    include '../sqlconn.php';
  }

  if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["postalcode"]) && isset($_POST["contactnum"]) && isset($_POST["dob"]) && isset($_POST["creditcardnum"]) && isset($_POST["csc"]) && isset($_POST["cardholder"]) && isset($_POST["acct"]) && isset($_POST["admin"])) {
    //json_decode for numerical type, otherwise refrain from json_decode for varchar/non-numerical type
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
    $acct = json_decode($_POST["acct"]);
    $admin = json_decode($_POST["admin"]);

    $query = "INSERT INTO PROFILE (Email, Password, FirstName, LastName, PostalCode, ContactNum, DateOfBirth, CreditCardNum, CardSecurityCode, CardHolderName, AccBalance, Admin)
              VALUES (".$email.", ".$password.", ".$firstname.", ".$lastname.", ".$postalcode.", ".$contactnum.", ".$dob.", ".$creditcardnum.", ".$csc.", ".$cardholder.", ".$acct.", ".$admin.")";

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
