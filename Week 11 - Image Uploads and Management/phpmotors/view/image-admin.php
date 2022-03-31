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
            <h2>Add New Vehicle Image</h2>
            <?php
            if (isset($_SESSION['message'])) {
                echo $_SESSION['message'];
            } ?>

            <form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
                <label for="invItem">Vehicle</label>
                <?php echo $prodSelect; ?>
                <fieldset class="my-30">
                    <label>Is this the main image for the vehicle?</label>
                    <div class="my-30" class="my-30">
                        <label for="priYes" class="pImage">Yes</label>
                        <input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
                        <label for="priNo" class="pImage">No</label>
                        <input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
                    </div>

                </fieldset>
                <label  for="fileUpload" >Upload Image:</label>
                <input  id="fileUpload"  type="file" name="file1">
                <div class="my-30" class="my-30">
                    <input type="submit" class="regbtn" value="Upload">
                    <input type="hidden" name="action" value="upload">
                </div>
            </form>
            <hr>

            <h2>Existing Images</h2>
            <p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
            <?php
            if (isset($imageDisplay)) {
                echo $imageDisplay;
            } ?>
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