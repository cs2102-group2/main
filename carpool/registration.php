<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Payment</title>
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

    <div class="row  primary-background-translucent">
      <div class="large-8 columns">
        <div class="row">
          <p>REGISTRATION</p>
          <div class="large-6 columns">
            <p><u>Profile Information</u></p>
            <input type="text" name="username" placeholder="Username" />
            <input type="text" name="password" placeholder="Password" />
            <input type="text" name="firstname" placeholder="First Name" />
            <input type="text" name="lastname" placeholder="Last Name" />
            <input type="text" name="dob" placeholder="Birth Date" />
            <input type="text" name="contactnum" placeholder="Contact Number" />
            <input type="text" name="address" placeholder="Address" />
          </div>
          <div class="large-6 columns">
            <p><u>Payment Information</u></p>
            <input type="text" name="creditcardno" placeholder="Credit Card Number" />
            <input type="text" name="securitycode" placeholder="Security Code" />
            <input type="text" name="cardholder" placeholder="Card Holder Name" />
          </div>
        </div>
      </div>
      <div class="large-4 columns">
        <p>Some privacy and disclaimer text here.</p>
      </div>
    </div>

  </div>
</body>
</html>
