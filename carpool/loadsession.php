<?php
/**
 * Created by PhpStorm.
 * User: Bobby
 * Date: 21/9/2015
 * Time: 9:09 AM
 */

session_start();

// Initialize Session variables
function initSessionVar($row)
{
    $_SESSION["profileID"] = $row[0];
    $_SESSION["profileName"] = $row[3];
    $_SESSION["profileAccountBalance"] = $row[11];
    $_SESSION["profileCreditCardNo"] = $row[8];
}

// ==============================================
// Redirect methods
// ==============================================
function redirectToLoginPage()
{
    echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
}

function redirectToSearchPage()
{
    echo "<script type='text/javascript'> document.location = 'search.php'; </script>";
}


function redirectToHomePage()
{
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
}

// ==============================================
// Check methods
// ==============================================
function isUserLoggedIn()
{
    if((isset($_SESSION["profileID"]) && isset($_SESSION["profileName"])) == false) {
        return false;
    }
    else {
        return true;
    }
}

// ==============================================
// Setters and Getters methods
// ==============================================
function getProfileName() {
    if(isset($_SESSION["profileName"]) == false) {
        echo "User not logged in";
    }
    else {
        echo $_SESSION["profileName"];
    }
}

function getProfileAccountBalance() {
    if(isset($_SESSION["profileAccountBalance"]) == false) {
        echo "Account is not logged in";
    }
    else {
        echo $_SESSION["profileAccountBalance"];
    }
}

?>
