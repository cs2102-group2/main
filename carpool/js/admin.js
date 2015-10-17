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
};
