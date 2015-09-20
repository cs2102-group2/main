<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>My Profile</title>
  <link rel="stylesheet" href="./foundation/css/foundation.css" />
  <link rel="stylesheet" href="./css/customise.css" />
</head>
<body>
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

  <div class="large-12 columns ">
    <div class="large-8 large-offset-2 columns">

      <div class="row collapse">
        <!--Get the username-->
        <div class="username large-12 columns">
          Bobby
        </div>

      </div>

      <div class="row collapse">
        <!--Query user's car-->
        <caption>Your Car(s)</caption>
        <table class="large-12 columns">
          <tr>
            <th>Car Plate Number</th>
            <th>Model</th>
            <th>Seats Available</th>
            <th>Actions</th>
          </tr>
          <tr>
            <td>99999FF</td>
            <td>No Model</td>
            <td>100</td>
            <td>iconedit</td>
            <td>icondelete</td>
          </tr>
        </table>
      </div>

      <div class="row collapse">
        <!--Query user's pending passengers-->
        <caption>Pending: Your Passenger(s)</caption>
        <table class="large-12 columns">
          <tr>
            <th>Passenger(s)</th>
            <th>Contact</th>
            <th>Departure</th>
            <th>Destination</th>
            <th>Departure Time</th>
          </tr>
          <tr>
            <td>The Egg</td>
            <td>9999-9999</td>
            <td>Egg Farm</td>
            <td>Frying Pan</td>
            <td>23 Jun 15, 08:00</td>
          </tr>
        </table>
      </div>

      <div class="row collapse">
        <!--Query user's pending ride-->
        <caption>Pending: Your Rides(s)</caption>
        <table class="large-12 columns">
          <tr>
            <th>Driver(s)</th>
            <th>Contact</th>
            <th>Model</th>
            <th>Seats</th>
            <th>Departure</th>
            <th>Destination</th>
            <th>Departure Time</th>
          </tr>
          <tr>
            <td>June</td>
            <td>9999-9999</td>
            <td>No Model</td>
            <td>3 / 4</td>
            <td>Kent Ridge</td>
            <td>Kent Ridge</td>
            <td>23 Jun 15, 08:00</td>
          </tr>
        </table>
      </div>

      <div class="row collapse">
        <caption>What Are Others Saying?</caption>

        <!--Per Comment Queried-->
        <div class="commentHolder">
          <div class="row collapse">
            <div class="large-12 passenger columns">
              <a href="#">Passenger's Name</a>
            </div>
            </div>
            <div class="row collapse">
            <!--Comments goes here-->
            <p class="large-9 columns">HELLO</p>
            <div class="rating large-3 columns">
            <!--Rating Goes here-->
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

</body>
</html>
