<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/phpmotors/css/main.css">
    <title><?php echo $classificationName; ?> Vehicles | PHP Motors, Inc.</title>
</head>

<body>
    <div id="wrapper">
        <?php require_once  '../snippets/header.php'; ?>
        <nav><?php echo $navList; ?></nav>
        <main>
            <h1><?php echo $classificationName; ?> Vehicles</h1>
            <?php if (isset($message)) {
                echo $message;
            } ?>
            <?php if (isset($vehicleDisplay)) {
                echo $vehicleDisplay;
            } ?>
        </main>
        <?php require_once  '../snippets/footer.php'; ?>
    </div>
</body>

</html>