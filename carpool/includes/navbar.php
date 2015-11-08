<nav class="top-bar" data-topbar="" role="navigation">
    <ul class="title-area">
        <li class="name">
            <h1>
                <a href="profile.php">
                    <?php getProfileName() ?>
                </a>
            </h1>
        </li>
    </ul>
    <section class="top-bar-section">
        <ul class="right">
            <?php
                if(isset($_SESSION["profileAdmin"]) && $_SESSION["profileAdmin"] == 1) {
                    echo '<li class="has-form show-for-large-up"><a href="admin.php" class="button">ADMIN</a></li>';
                    echo '<li class="divider"></li>';
                }
            ?>
            <li class="has-form show-for-large-up"><a href="payment.php" class="button">$</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a href="search.php" class="button">FIND RIDE</a></li>
            <li class="divider"></li>
            <li class="has-form show-for-large-up"><a href="post.php" class="button">OFFER RIDE</a></li>
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
