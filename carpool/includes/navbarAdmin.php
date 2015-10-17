<nav class="top-bar" data-topbar="" role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1>
                <a href="./index.php">
                    Administrator: <?php getProfileName() ?>
                </a>
            </h1>
        </li>
    </ul>
    <section class="top-bar-section">
        <ul class="right">
            <li class="has-form show-for-large-up"><a onclick="showProfile(); return false;" class="button">PROFILE</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a onclick="showVehicle(); return false;" class="button">VEHICLES</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a onclick="showBooking(); return false;" class="button">BOOKINGS</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a onclick="showTrip(); return false;" class="button">TRIPS</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up">
                <?php
                if(isset($_SESSION["profileID"])) {
                    echo '<a href="loggedout.php" class="button">LOG OUT</a>';
                }
                else {
                    echo '<a href="login.php" class="button">LOGIN</a>';
                }
                ?>
            </li>
        </ul>
    </section>
</nav>
