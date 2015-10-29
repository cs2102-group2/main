window.onload = function() {
  var arrayOfCarCapacity = JSON.parse(localStorage['capacity']);

  var carDropdown = document.getElementById("carDropdown");
  var seatsDropdown = document.getElementById("seatsDropdown");

  carDropdown.onchange = function() {
      //Remove all values associated with seatsDropdown dropdown
      $("#seatsDropdown").empty();
      //Get selected value from dropdown
      var chosenCar = carDropdown.options[carDropdown.selectedIndex].value;
      //Get corresponding values
      var maxCapacity = arrayOfCarCapacity[chosenCar];
      //Append default value
      var defaultOption = document.createElement("option");
      defaultOption.class="placeholder";
      defaultOption.value = "";
      defaultOption.disabled = "disabled";
      defaultOption.text = "Seats Available";
      defaultOption.selected = "selected";
      seatsDropdown.appendChild(defaultOption);

      if(maxCapacity == null || maxCapacity == 0) {
        return;
      }

      for (var i = 1; i <= maxCapacity; i++) {
          var option = document.createElement("option");
          option.value = i;
          option.text = i;
          seatsDropdown.appendChild(option);
      }
  }

  //Hiding of form
  $(function() {
    $("#tripPopup").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      minWidth: 500,
      title: "Posting Trip"
    });
  });
};


$(document).on("click", "#submit", function () {
  //Dropdown
  var carDropdown = document.getElementById("carDropdown");
  var seatsDropdown = document.getElementById("seatsDropdown");
  //Get variables
  var _startlocation = document.getElementById("startlocation").value;
  var _endlocation = document.getElementById("endlocation").value;
  var _tripdate = document.getElementById("tripdate").value;
  var _triptime = document.getElementById("triptime").value;
  var _ridingcost = document.getElementById("ridingcost").value;
  var _seatsavail = seatsDropdown.options[seatsDropdown.selectedIndex].value;
  var _plateno = carDropdown.options[carDropdown.selectedIndex].value;

  //Set as uppercase
  _startlocation = _startlocation.toUpperCase();
  _endlocation = _endlocation.toUpperCase();

  //Verify input
  if(!_startlocation || !_endlocation || !_tripdate || !_ridingcost || !_seatsavail || !_plateno || !(/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/.test(_triptime))) {
    alert("One (or more) of your entries is (a) left empty, or (b) does not comply with format. Please fix it before resubmitting your posting.");
    return;
  }

  var textField = "Departing from <b><u>" + _startlocation + "</u></b> to <b><u>" + _endlocation + "</u></b> at <b><u>" + _tripdate + "</u></b>, <b><u>" + _triptime + "</u></b> for <b><u>$" + _ridingcost + "</u></b> by vehicle <b><u>" + _plateno + "</u></b> with <b><u>" + _seatsavail + "</u></b> seats available.";

  textField = $.parseHTML( textField );

  $("#tripText").empty();
  $("#tripText").append(textField);
  $("#tripText").css({"font-size":"14px"});

  $("#tripPopup").dialog("open");
  $("#tripPopup").dialog("option", "buttons",
  [
    {
      text: "Cancel",
      click: function() {
        $(this).dialog("close");
        callback(false);
      }
     },
     {
      text: "Confirm",
       click: function() {
        $.ajax({
          url: "phpscript/postScript.php",
          type: "POST",
          data: {
            "startlocation": "'" + _startlocation + "'",
            "endlocation": "'" + _endlocation + "'",
            "tripdate": "'" + _tripdate + " " + _triptime + "'",
            "price": _ridingcost,
            "numOfSeats": _seatsavail,
            "plateno": "'" + _plateno + "'"
          },
          success: function (result) { if(!result.error) { alert(result); window.location.replace("post.php");} },
          error: function(exception) { alert(exception); }
        });
        $(this).dialog("close");
        callback(false);
      }
    }
  ]
 );
})
