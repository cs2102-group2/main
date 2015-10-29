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
};
