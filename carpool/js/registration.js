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
