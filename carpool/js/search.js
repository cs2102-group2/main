window.onload = function() {
  $(function() {
    $("#bookingPopup").dialog({
      autoOpen : false,
      modal : true,
      show : "blind",
      hide : "blind",
      minWidth: 500,
      title: "Booking confirmation"
    });
  });
}

$(document).on("click", "#priceSort", function () {
  var $wrapper = $('.user');

  $wrapper.find('.row').sort(function (a, b) {
    var contentA = parseInt($(a).data('cost'));
    var contentB = parseInt($(b).data('cost'));
    return (contentA - contentB);
  }).appendTo($wrapper);

  return false;
})

$(document).on("click", "#timeSort", function () {
  var $wrapper = $('.user');

  $wrapper.find('.row').sort(function (a, b) {
    var contentA = new Date('1970/01/01 ' + $(a).data('time'));
    var contentB = new Date('1970/01/01 ' + $(b).data('time'));
    return (contentA - contentB);
  }).appendTo($wrapper);

  return false;
})

$(document).on("click", "#seatSort", function () {
  var $wrapper = $('.user');

  $wrapper.find('.row').sort(function (a, b) {
    var contentA = parseInt($(a).data('seats-avail'));
    var contentB = parseInt($(b).data('seats-avail'));
    return (contentA - contentB);
  }).appendTo($wrapper);

  return false;
})

$(document).on("click", ".bookingSubmit", function () {
  //Retrieve values from row
  var tripInformation = $(this).parent().parent();
  var tripID = $(tripInformation).data('tripid');

  var _cost = $(tripInformation).data('cost');
  var _start = $(tripInformation).data('start');
  var _end = $(tripInformation).data('end');
  var _date = $(tripInformation).data('date');
  var _time = $(tripInformation).data('time');

  var textField = "<b>Confirm the following booking</b>" +
                  "<hr>" +
                  "<b>Departure: </b>" + _start + "<br>" +
                  "<b>Destination: </b>" + _end + "<br>" +
                  "<b>Time: </b>" + _date + ", " + _time + "<br>" +
                  "<b>Cost: </b>" + _cost;

  textField = $.parseHTML( textField );
  $("#bookingText").empty();
  $("#bookingText").append(textField);
  $("#bookingText").css({"font-size":"14px"});

  //Pop up for user to enter value
  $("#bookingPopup").dialog("open");
  $("#bookingPopup").dialog( "option", "buttons",
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
          $.ajax({
            url: "phpscript/searchScript.php",
            type: "POST",
            data: {
              "tripID": tripID
             },
            success: function (result) { if(!result.error) location.reload(true); },
            error: function(exception) { alert(exception); }
          });

          $(this).dialog("close");
          callback(false);
        }
      }
    ]
  );
})
