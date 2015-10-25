<?php

if(!isset($connect)) {
  include '../sqlconn.php';
}

if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['firstname'])
    && isset($_POST['lastname'])&& isset($_POST['dob'])&& isset($_POST['contactnum'])
    && isset($_POST['address']) && isset($_POST['creditcardno']) && isset($_POST['securitycode'])
    && isset($_POST['cardholderName'])) {

    $userName = $_POST['username'];
    $password = $_POST['password'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $dateOfBirth = $_POST['dob'];
    $contactNum = $_POST['contactnum'];
    $address = $_POST['address'];
    $creditCardNum = $_POST['creditcardno'];
    $securityCode = $_POST['securitycode'];
    $cardHolderName = $_POST['cardholderName'];

    $query = "INSERT INTO PROFILE (Email, Password, FirstName, LastName, PostalCode, ContactNum, DateofBirth, CreditCardNum, CardSecurityCode, CardHolderName)
              VALUES ("
                      .$userName.", "
                      .$password.", "
                      .$firstName.", "
                      .$lastName.", "
                      .$address.", "
                      .$contactNum.", "
                      .$dateOfBirth.", "
                      .$creditCardNum.", "
                      .$securityCode.", "
                      .$cardHolderName.
                      ")";

    $result = oci_parse($connect, $query);
    $check = oci_execute($result, OCI_DEFAULT);

    if($check == true) {
      oci_commit($connect);
      echo "Registration successful!";
      oci_free_statement($result);
    } else {
      oci_free_statement($result);
      echo $query;
    }
}

exit;

?>
