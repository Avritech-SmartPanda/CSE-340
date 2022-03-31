<?php
// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_STRING);
}
?>


<header>
    <img id="logo" src="/phpmotors/images/site/logo.png" alt="Company Logo">
    <?php if (isset($_COOKIE['firstname'])) {
        echo "<span id=\"acctLink\"> $cookieFirstname | <a href=\"/phpmotors/accounts/index.php/?action=logout\">Logout</a></span>";
    } else {
        echo "<a id=\"acctLink\" href=\"/phpmotors/accounts/index.php/?action=login-page\">My Account</a>";
    } ?>
</header>