<?php
if (!$_SESSION['loggedin']) {
    header('Location: ../index.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="favicon.png">
    <link rel="stylesheet" href="/phpmotors/css/main.css">
    <title>Admin | PHP Motors</title>
</head>

<body>
    <?php
    // Check if the firstname cookie exists, get its value
    if (isset($_SESSION['clientData'])) {
        $cookieFirstname = $_SESSION['clientData']['clientFirstname'];
    }
    ?>
    <div id="wrapper">
        <header>
            <img id="logo" src="/phpmotors/images/site/logo.png" alt="Company Logo">
            <?php if (isset($_SESSION['clientData'])) {
                echo "<span id=\"acctLink\"> $cookieFirstname | <a href=\"/phpmotors/accounts/index.php/?action=logout\">Logout</a></span>";
            }else {
                echo "<a id=\"acctLink\" href=\"/phpmotors/accounts/index.php/?action=login-page\">My Account</a>";
            } ?>
           
        </header>
        <nav><?php echo $navList; ?></nav>
        <main>

            <?php if (isset($_SESSION['clientData']) == false) {
                header('Location: /phpmotors/index.php');
                exit;
            }   ?>

            <!-- 1 -->
            <div class="user-data">
                <h1><?php echo $_SESSION['clientData']['clientFirstname'] . ' ' . $_SESSION['clientData']['clientLastname']; ?></h1>

            </div>

            <!-- 2 -->
            <div class="user-info">
                <h2>You are logged in: </h2>
                <ul>
                    <li> First name: <?php echo $_SESSION['clientData']['clientFirstname'] ?> </li>
                    <li> Last name: <?php echo $_SESSION['clientData']['clientLastname'] ?> </li>
                    <li> Email: <?php echo $_SESSION['clientData']['clientEmail'] ?> </li>
                </ul>
            </div>

            <?php if ($_SESSION['clientData']['clientLevel'] > 1) {
                echo '<div class="user-info">';
                echo '<h2>Inventory Management</h2>' . '<p>Use the link below to manage the inventory.</p>';
                echo '<a href="/phpmotors/vehicles/" class="link-header">Vehicle Management</a>';
                echo '</div>';
            } ?>
        </main>
        <?php require_once '../snippets/footer.php'; ?>
    </div>
    <script src="../js/script.js"></script>
</body>

</html>