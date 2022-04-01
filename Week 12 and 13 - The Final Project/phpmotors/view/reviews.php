<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Motors</title>
    <link rel="stylesheet" href="../css/main.css">

</head>

<body id="wrapper">
    <?php
    // Check if the firstname cookie exists, get its value
    if (isset($_COOKIE['firstname'])) {
        $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }
    ?>
    <div id="wrapper">
        <header>
            <img id="logo" src="/phpmotors/images/site/logo.png" alt="Company Logo">
            <?php if (isset($cookieFirstname)) {
                echo "<span id=\"acctLink\"> $cookieFirstname | <a href=\"/phpmotors/accounts/index.php/?action=logout\">Logout</a></span>";
            } else {
                echo "<a id=\"acctLink\" href=\"/phpmotors/accounts/index.php/?action=login-page\">My Account</a>";
            } ?>
        </header>
        <nav><?php echo $navList; ?></nav>
        <main>
            <h2>Reviews</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            } ?>



            <form action="/phpmotors/reviews/index.php" method="post">
                <fieldset class="my-30">
                    <label>Vehicle</label>
                    <?php echo $prodSelect; ?>
                </fieldset>
                <fieldset class="my-30">
                    <label>Rating</label>
                    <select name="rating">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </fieldset>
                <fieldset class="my-30">
                    <label>Comments</label>
                    <textarea name="comments" rows="5" cols="50"></textarea>
                </fieldset>
                <div class="my-30" class="my-30">
                    <input type="submit" class="regbtn" value="Submit">
                    <input type="hidden" name="action" value="showAddForm">
                </div>
        </main>
        <footer>
            <hr>
            <p>&copy; PHP Motors, All rights reserved.</p>
            <p>All images are believed to be "Fair Use". Please notify the author if any are not and they will be removed.</p>
            <p id="bottom">Last Updated: <?php echo date("d M Y") ?></p>
        </footer>
    </div>

</body>

</html>
<?php unset($_SESSION['message']); ?>