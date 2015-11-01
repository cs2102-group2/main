window.onload = function() {
  $(function() {
    $("#registrationPopup").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      minWidth: 500,
      title: "Registration Confirmation"
    });
  });
}

$(document).on("click", "#confirm", function () {
  //Get variables
  var email = document.getElementById("idusername").value;
  var password = document.getElementById("idpassword").value;
  var firstname = document.getElementById("idfirstname").value;
  var lastname = document.getElementById("idlastname").value;
  var dob = document.getElementById("iddob").value;
  var contact = document.getElementById("idcontactnum").value;
  var address = document.getElementById("idaddress").value;
  var creditno = document.getElementById("idcreditcardno").value;
  var csc = document.getElementById("idsecurityno").value;
  var cardholder = document.getElementById("idcardholder").value;

  var errorMsg = "Something wrong with following: ";
  var isError = false;

  //Verify input
  if (!email) {
    isError = true;
    errorMsg += "\nNo email";
  } else if (!isEmail(email)) {
    isError = true;
    errorMsg += "\nInvalid email format";
    document.getElementById("idusername").value = "";
  } 

  if (!password) {
    isError = true;
    errorMsg += "\nNo password";
  }

  if (!firstname) {
    isError = true;
    errorMsg += "\nNo first name";
  }

  if (!lastname) {
    isError = true;
    errorMsg += "\nNo last name";
  }

  if (!dob) {
    isError = true;
    errorMsg += "\nNo date of birth";
  } 

  if (!contact) {
    isError = true;
    errorMsg += "\nNo contact number"
  } else if (!isNumeric(contact)) {
    isError = true;
    errorMsg += "\nContact number must be number";
    document.getElementById("idcontactnum").value = "";
  }

  if (!address) {
    isError = true;
    errorMsg += "\nNo address postal code";
  } else if (!isNumeric(address)) {
    isError = true;
    errorMsg += "\nAddress postal code must be number";
    document.getElementById("idaddress").value = "";
  }

  if (!creditno) {
    isError = true;
    errorMsg += "\nNo credit card number";
  } else if (!isNumeric(creditno)) {
    isError = true;
    errorMsg += "\nCredit number contains non-number";
    document.getElementById("idcreditcardno").value = "";
  } else if (creditno.toString().length != 16) {
    isError = true;
    errorMsg += "\nCredit number must be a 16-digit number";
    document.getElementById("idcreditcardno").value = "";
  }

  if (!csc) {
    isError = true;
    errorMsg += "\nNo security code";
  } else if (!isNumeric(csc)) {
    isError = true;
    errorMsg += "\nSecurity code contains non-number";
    document.getElementById("idsecurityno").value = "";
  } else if (csc.toString().length != 3) {
    isError = true;
    errorMsg += "\nSecurity code must be a 3-digit number";
    document.getElementById("idsecurityno").value = "";
  }

  if (!cardholder) {
    isError = true;
    errorMsg += "\nNo card holder name";
  }

  if (isError) {
    alert(errorMsg);
    return;
  }

  function isEmail(email) {
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
  }

  function isNumeric(num) {
    return !isNaN(num);
  }      

  var textField = "I, <b><u>" + firstname + " " + lastname + "</u></b>, confirm that the following information I have provided are true: " + "<br><hr>" +
   "<b>Email: </b>" + email + "<br>" +
   "<b>Password: </b>" + password + "<br>" +
   "<b>Date of Birth: </b>" + dob + "<br>" +
   "<b>Contact Number: </b>" + contact + "<br>" +
   "<b>Address: </b>" + address + "<br>" +
   "<b>Credit Card No.: </b>" + creditno + "<br>" +
   "<b>Card Security Code: </b>" + csc + "<br>" +
   "<b>Card Holder Name: </b>" + cardholder;

  textField = $.parseHTML( textField );

  $("#registrationText").empty();
  $("#registrationText").append(textField);
  $("#registrationText").css({"font-size":"14px"});

  $("#registrationPopup").dialog("open");
  $("#registrationPopup").dialog( "option", "buttons",
  [
    {
      text: "Cancel",
      click: function() {
        $(this).dialog("close");
        callback(false);
      }
     }, {
      text: "Confirm",
       click: function() {
        $.ajax({
          url: "phpscript/registrationScript.php",
          type: "POST",
          data: {
            "username": "'" + email + "'",
            "password": "'" + password + "'",
            "firstname": "'" + firstname + "'",
            "lastname": "'" + lastname + "'",
            "dob": "'" + dob + "'",
            "contactnum": "'" + contact + "'",
            "address": "'" + address + "'",
            "creditcardno": "'" + creditno + "'",
            "securitycode": "'" + csc + "'",
            "cardholderName": "'" + cardholder + "'"
          },
          success: function (result) { if(!result.error) { alert(result); window.location.replace("login.php");} },
          error: function(exception) { alert(exception); }
        });
        $(this).dialog("close");
        callback(false);
      }
    }
  ]
 );
})
