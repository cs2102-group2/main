window.onload = function() {
  $(function() {
    $("#editVehicleForm").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      minWidth: 500,
      title: "Edit Vehicle"
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
}

//Edit Vehicle Button
$(document).on("click", ".editVehicleButton", function () {
  //Retrieve values from row
  var _plateno = String.trim($(this).closest("tr").find(".plateno").text());
  var _model = $(this).closest("tr").find(".model").text();
  var _numofseats = $(this).closest("tr").find(".numofseats").text();

  //Pop up for user to enter value
  $("#editVehicleForm").dialog("open");
  document.getElementById("idplateno").value=_plateno;
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
