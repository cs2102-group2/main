<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Post Advertisment</title>
  <link rel="stylesheet" href="./foundation/css/foundation.css" />
  <link rel="stylesheet" href="./css/customise.css" />
</head>
<body>
  <!--Export to php-->
  <!-- <?php include(./includes/navbar.html); ?> -->
  <nav class="top-bar" data-topbar="" role="navigation">
    <ul class="title-area">
      <li class="name"><h1><a href="#">Bao Bao</a></h1></li>
    </ul>
    <section class="top-bar-section">
      <ul class="right">
        <li class="has-form show-for-large-up"><a href="#" class="button">$</a></li>
        <li class="divider"></li>
        <li class="has-form show-for-large-up"><a href="#" class="button">FIND RIDE</a></li>
        <li class="divider"></li>
        <li class="has-form show-for-large-up"><a href="#" class="button">OFFER RIDE</a></li>
        <li class="divider"></li>
        <li class="has-form show-for-large-up"><a href="#" class="button">LOGIN</a></li>
      </ul>
    </section>
  </nav>
  <!-- End include -->
  <div class="large-12 columns">
    <div class="large-6 large-offset-3 white-translucent full-length columns">
      <div class="large-12 columns">
        <div class="row">
          <form>
            <label>
              Route
              <div class="row journeyPoint">
                <div class="large-8 columns">
                  <input type="text" name="departureLocation" placeholder="Departure" />
                </div>
                <div class="large-4 columns">
                  <input type="text" name="departureTime" placeholder="Departure Time" />
                </div>
              </div>
              <div class="row journeyPoint">
                <div class="large-8 columns">
                  <input type="text" name="destinationLocation" placeholder="Destination" />
                </div>
              </div>
            </label>
            <a href="#" class="large-12 columns tiny button">+ ADD MORE STOPS</a>

            <div class="row collapse">
              <div class="large-5 columns">
                <label>
                  Payment
                  <div class="row collapse">
                    <div class="large-2 left columns">
                      <span class="prefix">SGD</span>
                    </div>
                    <div class="large-10 left columns">
                     <input type="text" name="passangerPayment" placeholder="Price Per Passanger" />
                   </div>
                 </div>
               </label>
               <label>
                Car
                <div class="row collapse">
                  <div class="large-12 left columns">
                    <!--Query to Get Car-->
                    <select class="text-center">
                      <option class="placeholder" selected="selected" value= "" disabled="disabled">Choose your car:</option>
                      <option value="firstCar">BMW</option>
                      <option value="secondCar">Toy Car</option>
                    </select>
                  </div>
                </div>
                <div class="row collapse">
                  <div class="large-12 left columns">
                    <!--Query to Get Car Seats-->
                    <select class="text-center">
                      <option class="placeholder" selected="selected" value= "" disabled="disabled">Seats Available:</option>
                      <option value="firstCar">1</option>
                      <option value="secondCar">2</option>
                    </select>
                  </div>
                </div>
              </label>
            </div>
            <div class="large-6 large-offset-1 columns">
              <label>
                Additional Information (Maximum 500 characters)
                <textarea name="additionalInfo" placeholder="Additional information you'd like your passangers to know." style="resize: vertical;"></textarea>
              </label>
            </div>
          </div>
          <a href="#" class="large-12 columns tiny button">SUBMIT</a>
        </form>
      </div>
    </div>
  </div>
</div>

</body>
</html>
