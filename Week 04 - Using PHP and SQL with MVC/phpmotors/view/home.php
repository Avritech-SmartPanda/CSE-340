<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Motors</title>
    <link rel="stylesheet" href="/phpmotors/css/main.css">

</head>


<body>

    <div class="page">

        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        <nav>
		<?php echo $navList; ?>	
		</nav>
        <main>
            <header>
                <h1>Welcome to PHP Motors!</h1>
                <div id="carDetails">
                    <h2>DMC Delorean</h2>
                    <div>3 Cup holders</div>
                    <div>Superman doors</div>
                    <div>Fuzzy dice!</div>
                    <button type="button" class="todayBtn">Own Today</button>

                    <img src="../phpmotors/images/delorean.jpg" alt="Delorean">

                </div>
            </header>
            <div class="grid-container">

                <div class="grid-item">
                    <div id="col2">
                        <h3>Delorean Upgrades</h3>
                        <div id="minigrid">
                            <div class="upgrades">
                                <img src="images/upgrades/flux-cap.png" alt="Flux capacitor">
                                <a href="#">Flux Capacitor</a>
                            </div>
                            <div class="upgrades">
                                <img src="images/upgrades/flame.jpg" alt="Flames">
                                <a href="#">Flame Decals</a>

                            </div>
                            <div class="upgrades">
                                <img src="images/upgrades/bumper_sticker.jpg" alt="Bumper sticker">
                                <a href="#">Bumper Sticker</a>

                            </div>
                            <div class="upgrades">
                                <img src="images/upgrades/hub-cap.jpg" alt="Hub Cap">
                                <a href="#">Hub Caps</a>

                            </div>
                        </div>


                    </div>
                </div>
                <div class="grid-item">
                    <div id="col1">
                        <h3>DMC Delorean Reviews</h3>
                        <ul>
                            <li>"So fast it's almost like traveling in time." (4/5)</li>
                            <li>"Coolest ride on the road." (4/5)</li>
                            <li>"I'm feeling Marty McFly!" (5/5)</li>
                            <li>"The most futuristic ride of our day." (4.5/5)</li>
                            <li>"80s livin and I love it!" (5/5)</li>
                        </ul>
                    </div>
                </div>
            </div>
        </main>
        <?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
    </div>

</body>

</html>