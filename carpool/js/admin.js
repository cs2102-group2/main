//==================================================
// Table toggling
//==================================================
function showProfile() {
  $("div#profileDiv").show();
  $("div#vehicleDiv").hide();
  $("div#bookingDiv").hide();
  $("div#tripDiv").hide();
}

function showVehicle() {
  $("div#profileDiv").hide();
  $("div#vehicleDiv").show();
  $("div#bookingDiv").hide();
  $("div#tripDiv").hide();
}

function showBooking() {
  $("div#profileDiv").hide();
  $("div#vehicleDiv").hide();
  $("div#bookingDiv").show();
  $("div#tripDiv").hide();
}

function showTrip() {
  $("div#profileDiv").hide();
  $("div#vehicleDiv").hide();
  $("div#bookingDiv").hide();
  $("div#tripDiv").show();
}

window.onload = function() {
  //Show profile table by default
  showProfile();
  //Hide all forms
  //(1) For Profile Table
  $(function() {
    $("#editProfileForm").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      minWidth: 500
    });
  });

  $(function() {
    $("#deleteProfileForm").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      title: "Delete Profile"
    });
  });

  //(2) For Vehicle Table
  $(function() {
    $("#editVehicleForm").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      minWidth: 500
    });
  });

  $(function() {
    $("#deleteVehicleForm").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      title: "Delete Vehicle"
    });
  });


  //(3) For Booking Table
  $(function() {
    $("#editBookingForm").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      minWidth: 500
    });
  });

  $(function() {
    $("#deleteBookingForm").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      title: "Delete Booking"
    });
  });


  //(4) For Trip Table
  $(function() {
    $("#editTripForm").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind"
    });
  });

  $(function() {
    $("#deleteTripForm").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      title: "Delete Trip"
    });
  });
};

//==================================================
// Query submission to Oracle
// TABLE PROFILE
//==================================================
//Create Profile Button
$(document).on("click", ".createProfileButton", function () {
  //Set title
  $("#editProfileForm").dialog("option", "title", "Create Profile");
  //Clear values
  $("#editProfileForm").dialog("open");
  document.getElementById("idprofile").value="";
  document.getElementById("idemail").value="";
  document.getElementById("idpasswd").value="";
  document.getElementById("idfrname").value="";
  document.getElementById("idlstname").value="";
  document.getElementById("idpostal").value="";
  document.getElementById("idcontact").value="";
  document.getElementById("iddob").value="";
  document.getElementById("idcardno").value="";
  document.getElementById("idcsc").value="";
  document.getElementById("idcardname").value="";
  document.getElementById("idacct").value="";
  $("input[name='admin'][value=0]").attr('checked', true);

  //Disable irrelevant textfield
  $("#idprofile").attr("disabled", "disabled");

  $("#editProfileForm").dialog( "option", "buttons",
    [
      {
        text: "Cancel",
        click: function() {
          $("#idprofile").removeAttr("disabled");
          $(this).dialog("close");
          callback(false);
        }
       }, {
        text: "Create",
        click: function() {
          //Input validation

          //Enable textfield
          $("#idprofile").removeAttr("disabled");

          //TODO
          $.ajax({
            url: "phpscript/createProfile.php",
            type: "POST",
            data: {
              //Note that "'" is used for non-integer/float values to encase it in single quotations
              "firstname": "'" + document.getElementById("idfrname").value + "'",
              "lastname": "'" + document.getElementById("idlstname").value + "'",
              "email":  "'" + document.getElementById("idemail").value + "'",
              "password": "'" + document.getElementById("idpasswd").value + "'",
              "postalcode": document.getElementById("idpostal").value,
              "contactnum": document.getElementById("idcontact").value,
              "dob": "'" + document.getElementById("iddob").value + "'",
              "creditcardnum": document.getElementById("idcardno").value,
              "csc": document.getElementById("idcsc").value,
              "cardholder": "'" + document.getElementById("idcardname").value + "'",
              "acct": document.getElementById("idacct").value,
              "admin": $("input[name='admin']:checked").val()
             },
            success: function (result) { if(!result.error) location.reload(true); },
            error: function(exception) { alert('Something went wrong with the transaction...'); }
          });

          $(this).dialog("close");
          callback(false);
        }
      }
    ]
  );
})

//Edit Profile Button
$(document).on("click", ".editProfileButton", function () {
  //Set title
  $("#editProfileForm").dialog("option", "title", "Edit Profile");
  //Retrieve values from row
  var _profileid = $(this).closest("tr").find(".profileid").text();
  var _email = $(this).closest("tr").find(".email").text();
  var _password = $(this).closest("tr").find(".password").text();
  var _firstname = $(this).closest("tr").find(".firstname").text();
  var _lastname = $(this).closest("tr").find(".lastname").text();
  var _postalcode = $(this).closest("tr").find(".postalcode").text();
  var _contactnum = $(this).closest("tr").find(".contactnum").text();
  var _dateofbirth = $(this).closest("tr").find(".dateofbirth").text();
  var _creditcardnum = $(this).closest("tr").find(".creditcardnum").text();
  var _cardsecuritycode = $(this).closest("tr").find(".cardsecuritycode").text();
  var _cardholdername = $(this).closest("tr").find(".cardholdername").text();
  var _accbalance = $(this).closest("tr").find(".accbalance").text();
  var _isadmin = $(this).closest("tr").find(".admin").text();

  //Pop up for user to enter value
  $("#editProfileForm").dialog("open");
  document.getElementById("idprofile").value=_profileid;
  document.getElementById("idemail").value=_email;
  document.getElementById("idpasswd").value=_password;
  document.getElementById("idfrname").value=_firstname;
  document.getElementById("idlstname").value=_lastname;
  document.getElementById("idpostal").value=_postalcode;
  document.getElementById("idcontact").value=_contactnum;
  document.getElementById("iddob").value=_dateofbirth;
  document.getElementById("idcardno").value=_creditcardnum;
  document.getElementById("idcsc").value=_cardsecuritycode;
  document.getElementById("idcardname").value=_cardholdername;
  document.getElementById("idacct").value=_accbalance;

  if(_isadmin === "1") {
    $("input[name='admin'][value=1]").attr('checked', true);
  } else {
    $("input[name='admin'][value=0]").attr('checked', true);
  }


  //Check if modified
  $("#editProfileForm").dialog( "option", "buttons",
    [
      {
        text: "Cancel",
        click: function() {
          $(this).dialog("close");
          callback(false);
        }
       }, {
        text: "Submit",
        click: function() {
          if(document.getElementById("idprofile").value === _profileid &&
             document.getElementById("idemail").value===_email &&
             document.getElementById("idpasswd").value===_password &&
             document.getElementById("idfrname").value===_firstname &&
             document.getElementById("idlstname").value===_lastname &&
             document.getElementById("idpostal").value===_postalcode &&
             document.getElementById("idcontact").value===_contactnum &&
             document.getElementById("iddob").value===_dateofbirth &&
             document.getElementById("idcardno").value===_creditcardnum &&
             document.getElementById("idcsc").value===_cardsecuritycode &&
             document.getElementById("idcardname").value===_cardholdername &&
             document.getElementById("idacct").value===_accbalance &&
             $('input[name="admin"]:checked').val()===_isadmin) {
            $(this).dialog("close");
            return;
          }

          $.ajax({
            url: "phpscript/editProfile.php",
            type: "POST",
            data: {
              //Note that "'" is used for non-integer/float values to encase it in single quotations
              "id": _profileid,
              "profileid": document.getElementById("idprofile").value,
              "firstname": "'" + document.getElementById("idfrname").value + "'",
              "lastname": "'" + document.getElementById("idlstname").value + "'",
              "email":  "'" + document.getElementById("idemail").value + "'",
              "password": "'" + document.getElementById("idpasswd").value + "'",
              "postalcode": document.getElementById("idpostal").value,
              "contactnum": document.getElementById("idcontact").value,
              "dob": "'" + document.getElementById("iddob").value + "'",
              "creditcardnum": document.getElementById("idcardno").value,
              "csc": document.getElementById("idcsc").value,
              "cardholder": "'" + document.getElementById("idcardname").value + "'",
              "acct": document.getElementById("idacct").value,
              "admin": $("input[name='admin']:checked").val()
             },
            success: function (result) { if(!result.error) location.reload(true); },
            error: function(exception) { alert('Something went wrong with the transaction...'); }
          });

          $(this).dialog("close");
          callback(false);
        }
      }
    ]
  );
})

$(document).on("click", ".delProfileButton", function () {
  var _profileid = $(this).closest("tr").find(".profileid").text();
  var textField = "Are you sure you want to delete Profile ID " + _profileid + "?";
  $("#deleteProfileText").text(textField);
  $("#deleteProfileText").css({"font-size":"12px"});

  $("#deleteProfileForm").dialog("open");
  $("#deleteProfileForm").dialog( "option", "buttons",
  [
    {
      text: "Cancel",
      click: function() {
        $(this).dialog("close");
        callback(false);
      }
     }, {
      text: "Delete",
       click: function() {
        $.ajax({
          url: "phpscript/deleteProfile.php",
          type: "POST",
          data: {"id": _profileid },
          success: function (result) { if(!result.error) location.reload(true); },
          error: function(exception) { alert("Something went wrong with the transaction..."); }
        });
        $(this).dialog("close");
        callback(false);
      }
    }
  ]
 );
})

//==================================================
// Query submission to Oracle
// TABLE VEHICLE
//==================================================
//Create Vehicle Button
$(document).on("click", ".createVehicleButton", function () {
  //Set title
  $("#editVehicleForm").dialog("option", "title", "Create Vehicle");
  //Clear values
  $("#editVehicleForm").dialog("open");
  document.getElementById("idplateno").value="";
  document.getElementById("profileid1").value="";
  document.getElementById("idmodel").value="";
  document.getElementById("idnumseats").value="";

    //Check if modified
  $("#editVehicleForm").dialog( "option", "buttons",
    [
      {
        text: "Cancel",
        click: function() {
          $(this).dialog("close");
          callback(false);
        }
       }, {
        text: "Create",
        //TODO
        click: function() {
          //Input validation

          $.ajax({
            url: "phpscript/createVehicle.php",
            type: "POST",
            data: {
              //Note that "'" is used for non-integer/float values to encase it in single quotations
              "platenum": "'" + document.getElementById("idplateno").value + "'",
              "profileid": document.getElementById("profileid1").value,
              "model": "'" + document.getElementById("idmodel").value + "'",
              "seatsnum": document.getElementById("idnumseats").value
             },
            success: function (result) { if(!result.error) location.reload(true); },
            error: function(exception) { alert('Something went wrong with the transaction...'); }
          });

          $(this).dialog("close");
          callback(false);
        }
      }
    ]
  );
})

//Edit Vehicle Button
$(document).on("click", ".editVehicleButton", function () {
  //Set title
  $("#editVehicleForm").dialog("option", "title", "Edit Vehicle");
  //Retrieve values from row
  var _plateno = String.trim($(this).closest("tr").find(".plateno").text());
  var _profileid = $(this).closest("tr").find(".profileid").text();
  var _model = $(this).closest("tr").find(".model").text();
  var _numofseats = $(this).closest("tr").find(".numofseats").text();

  //Pop up for user to enter value
  $("#editVehicleForm").dialog("open");
  document.getElementById("idplateno").value=_plateno;
  document.getElementById("profileid1").value=_profileid;
  document.getElementById("idmodel").value=_model;
  document.getElementById("idnumseats").value=_numofseats;

  //Check if modified
  $("#editVehicleForm").dialog( "option", "buttons",
    [
      {
        text: "Cancel",
        click: function() {
          $(this).dialog("close");
          callback(false);
        }
       }, {
        text: "Submit",
        click: function() {
          if( document.getElementById("idplateno").value===_plateno &&
              document.getElementById("profileid1").value===_profileid &&
              document.getElementById("idmodel").value===_model &&
              document.getElementById("idnumseats").value===_numofseats) {
            $(this).dialog("close");
            return;
          }

          $.ajax({
            url: "phpscript/editVehicle.php",
            type: "POST",
            data: {
              //Note that "'" is used for non-integer/float values to encase it in single quotations
              "id": "'" + _plateno + "'",
              "platenum": "'" + document.getElementById("idplateno").value + "'",
              "profileid": document.getElementById("profileid1").value,
              "model": "'" + document.getElementById("idmodel").value + "'",
              "seatsnum": document.getElementById("idnumseats").value
             },
            success: function (result) { if(!result.error) location.reload(true); },
            error: function(exception) { alert('Something went wrong with the transaction...'); }
          });

          $(this).dialog("close");
          callback(false);
        }
      }
    ]
  );
})

$(document).on("click", ".delVehicleButton", function () {
  var _plateno = $(this).closest("tr").find(".plateno").text();
  var textField = "Are you sure you want to delete Vehicle " + _plateno + "?";
  $("#deleteVehicleText").text(textField);
  $("#deleteVehicleText").css({"font-size":"12px"});

  $("#deleteVehicleForm").dialog("open");
  $("#deleteVehicleForm").dialog( "option", "buttons",
  [
    {
      text: "Cancel",
      click: function() {
        $(this).dialog("close");
        callback(false);
      }
     }, {
      text: "Delete",
       click: function() {
        $.ajax({
          url: "phpscript/deleteVehicle.php",
          type: "POST",
          data: {"id": "'" + _plateno + "'"},
          success: function (result) { if(!result.error) location.reload(true); },
          error: function(exception) { alert("Something went wrong with the transaction..."); }
        });
        $(this).dialog("close");
        callback(false);
      }
    }
  ]
 );
})

//==================================================
// Query submission to Oracle
// TABLE BOOKINGS
//==================================================
//Create Booking Button
$(document).on("click", ".createBookingButton", function () {
  //Set title
  $("#editBookingForm").dialog("option", "title", "Create Booking");
  //Clear values
  $("#editBookingForm").dialog("open");
  document.getElementById("idprofileid2").value="";
  document.getElementById("idtripid1").value="";
  document.getElementById("idreceiptno").value="";

  $("#idbno").attr("disabled", "disabled");
  $("#idreceiptno").attr("disabled", "disabled");

    //Check if modified
  $("#editBookingForm").dialog( "option", "buttons",
    [
      {
        text: "Cancel",
        click: function() {
          $("#idbno").removeAttr("disabled");
          $("#idreceiptno").removeAttr("disabled");
          $(this).dialog("close");
          callback(false);
        }
       }, {
        //TODO
        text: "Create",
        click: function() {
          //Input validation


          $("#idbno").removeAttr("disabled");
          $("#idreceiptno").removeAttr("disabled");

          $.ajax({
            url: "phpscript/createBooking.php",
            type: "POST",
            data: {
              //Note that "'" is used for non-integer/float values to encase it in single quotations
              "profileid": document.getElementById("idprofileid2").value,
              "tripid": document.getElementById("idtripid1").value
             },
            success: function (result) { if(!result.error) location.reload(true); },
            error: function(exception) { alert('Something went wrong with the transaction...'); }
          });

          $(this).dialog("close");
          callback(false);
        }
      }
    ]
  );
})

//Edit Booking Button
$(document).on("click", ".editBookingButton", function () {
  //Set title
  $("#editBookingForm").dialog("option", "title", "Edit Booking");
  //Retrieve values from row
  var _profileid = $(this).closest("tr").find(".profileid").text();
  var _tripid = $(this).closest("tr").find(".tripid").text();
  var _receiptno = $(this).closest("tr").find(".receiptno").text();

  //Pop up for user to enter value
  $("#editBookingForm").dialog("open");
  document.getElementById("idprofileid2").value=_profileid;
  document.getElementById("idtripid1").value=_tripid;
  document.getElementById("idreceiptno").value=_receiptno;

  //Check if modified
  $("#editBookingForm").dialog( "option", "buttons",
    [
      {
        text: "Cancel",
        click: function() {
          $(this).dialog("close");
          callback(false);
        }
       }, {
        text: "Submit",
        click: function() {
          if(document.getElementById("idprofileid2").value===_profileid &&
              document.getElementById("idtripid1").value===_tripid &&
              document.getElementById("idreceiptno").value===_receiptno) {
            $(this).dialog("close");
            return;
          }

          $.ajax({
            url: "phpscript/editBooking.php",
            type: "POST",
            data: {
              //Note that "'" is used for non-integer/float values to encase it in single quotations
              "id": "'" + _receiptno + "'",
              "profileid": document.getElementById("idprofileid2").value,
              "tripid": document.getElementById("idtripid1").value,
              "receiptno": "'" + document.getElementById("idreceiptno").value + "'"
             },
            success: function (result) { if(!result.error) location.reload(true); },
            error: function(exception) { alert('Something went wrong with the transaction...'); }
          });

          $(this).dialog("close");
          callback(false);
        }
      }
    ]
  );
})

$(document).on("click", ".delBookingButton", function () {
  var _receiptno = $(this).closest("tr").find(".receiptno").text();
  var textField = "Are you sure you want to delete Booking #" + _receiptno + "?";
  $("#deleteBookingText").text(textField);
  $("#deleteBookingText").css({"font-size":"12px"});

  $("#deleteBookingForm").dialog("open");
  $("#deleteBookingForm").dialog( "option", "buttons",
  [
    {
      text: "Cancel",
      click: function() {
        $(this).dialog("close");
        callback(false);
      }
     }, {
      text: "Delete",
       click: function() {
        $.ajax({
          url: "phpscript/deleteBooking.php",
          type: "POST",
          data: {"id": _receiptno },
          success: function (result) { if(!result.error) location.reload(true); },
          error: function(exception) { alert("Something went wrong with the transaction..."); }
        });
        $(this).dialog("close");
        callback(false);
      }
    }
  ]
 );
})

//==================================================
// Query submission to Oracle
// TABLE TRIPS
//==================================================
//Create Trip Button
$(document).on("click", ".createTripButton", function () {
  //Set title
  $("#editTripForm").dialog("option", "title", "Create Trip");
  //Clear values
  $("#editTripForm").dialog("open");
  document.getElementById("idtripno2").value="";
  document.getElementById("idstartlocation").value="";
  document.getElementById("idendlocation").value="";
  document.getElementById("idcost").value="";
  document.getElementById("idseatsavail").value="";
  document.getElementById("idtripdate").value="";
  document.getElementById("idtriptime").value="";
  document.getElementById("idplateno1").value="";

  $("#idtripno2").attr("disabled", "disabled");

    //Check if modified
  $("#editTripForm").dialog( "option", "buttons",
    [
      {
        text: "Cancel",
        click: function() {
          $("#idtripno2").removeAttr("disabled");
          $(this).dialog("close");
          callback(false);
        }
       }, {
        //TODO
        text: "Create",
        click: function() {
          //Input validation

          $("#idtripno2").removeAttr("disabled");

          $.ajax({
            url: "phpscript/createTrip.php",
            type: "POST",
            data: {
              //Note that "'" is used for non-integer/float values to encase it in single quotations
              "startloc": "'" + document.getElementById("idstartlocation").value + "'",
              "endloc": "'" + document.getElementById("idendlocation").value + "'",
              "ridingcost": document.getElementById("idcost").value,
              "seatsavail": document.getElementById("idseatsavail").value,
              "tripdate": document.getElementById("idtripdate").value,
              "triptime": document.getElementById("idtriptime").value,
              "plateno": "'" + document.getElementById("idplateno1").value + "'"
             },
            success: function (result) { if(!result.error) location.reload(true); },
            error: function(exception) { alert('Something went wrong with the transaction...'); }
          });

          $(this).dialog("close");
          callback(false);
        }
      }
    ]
  );
})

//Edit Trip Button
$(document).on("click", ".editTripButton", function () {
  //Set title
  $("#editTripForm").dialog("option", "title", "Edit Trip");
  //Retrieve values from row
  var _tripno = $(this).closest("tr").find(".tripno").text();
  var _startlocation = $(this).closest("tr").find(".startlocation").text();
  var _endlocation = $(this).closest("tr").find(".endlocation").text();
  var _ridingcost = $(this).closest("tr").find(".ridingcost").text();
  var _seatsavailable = $(this).closest("tr").find(".seatsavailable").text();
  var _tripdate = $(this).closest("tr").find(".tripdate").text();
  var _triptime = $(this).closest("tr").find(".triptime").text();
  var _plateno = $(this).closest("tr").find(".plateno").text();
  var _profileid = $(this).closest("tr").find(".profileid").text();

  //Pop up for user to enter value
  $("#editTripForm").dialog("open");
  document.getElementById("idtripno2").value=_tripno;
  document.getElementById("idstartlocation").value=_startlocation;
  document.getElementById("idendlocation").value=_endlocation;
  document.getElementById("idcost").value=_ridingcost;
  document.getElementById("idseatsavail").value=_seatsavailable;
  document.getElementById("idtripdate").value=_tripdate;
  document.getElementById("idtriptime").value=_triptime;
  document.getElementById("idplateno1").value=_plateno;

  //Check if modified
  $("#editTripForm").dialog( "option", "buttons",
    [
      {
        text: "Cancel",
        click: function() {
          $(this).dialog("close");
          callback(false);
        }
       }, {
        text: "Submit",
        click: function() {
          if( document.getElementById("idtripno2").value===_tripno &&
              document.getElementById("idstartlocation").value===_startlocation &&
              document.getElementById("idendlocation").value===_endlocation &&
              document.getElementById("idcost").value===_ridingcost &&
              document.getElementById("idseatsavail").value===_seatsavailable &&
              document.getElementById("idtripdate").value===_tripdate &&
              document.getElementById("idtriptime").value===_triptime &&
              document.getElementById("idplateno1").value===_plateno) {
            $(this).dialog("close");
            return;
          }

          $.ajax({
            url: "phpscript/editTrip.php",
            type: "POST",
            data: {
              //Note that "'" is used for non-integer/float values to encase it in single quotations
              "id": _tripno,
              "tripid": document.getElementById("idtripno2").value,
              "startloc": "'" + document.getElementById("idstartlocation").value + "'",
              "endloc": "'" + document.getElementById("idendlocation").value + "'",
              "ridingcost": document.getElementById("idcost").value,
              "seatsavail": document.getElementById("idseatsavail").value,
              "tripdate": document.getElementById("idtripdate").value,
              "triptime": document.getElementById("idtriptime").value,
              "plateno": "'" + document.getElementById("idplateno1").value + "'"
             },
            success: function (result) { if(!result.error) location.reload(true); },
            error: function(exception) { alert('Something went wrong with the transaction...'); }
          });

          $(this).dialog("close");
          callback(false);
        }
      }
    ]
  );
})

$(document).on("click", ".delTripButton", function () {
  var _tripno = $(this).closest("tr").find(".tripno").text();
  var textField = "Are you sure you want to delete Trip #" + _tripno + "?";
  $("#deleteTripText").text(textField);
  $("#deleteTripText").css({"font-size":"12px"});

  $("#deleteTripForm").dialog("open");
  $("#deleteTripForm").dialog( "option", "buttons",
  [
    {
      text: "Cancel",
      click: function() {
        $(this).dialog("close");
        callback(false);
      }
     }, {
      text: "Delete",
       click: function() {
        $.ajax({
          url: "phpscript/deleteTrip.php",
          type: "POST",
          data: {"id": _tripno },
          success: function (result) { if(!result.error) location.reload(true); },
          error: function(exception) { alert("Something went wrong with the transaction..."); }
        });
        $(this).dialog("close");
        callback(false);
      }
    }
  ]
 );
})
