<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="stylesheet" href="../css/main.css" media="screen">
	<title><?php if (isset($invMake)) {
				$title = $invMake;
				$title .= ' ' . $invModel;
				echo $title;
			} else {
				echo 'No vehicle found';
			} ?> | PHP Motors, Inc.</title>
</head>

<body>
	<div id="wrapper">
		<?php require_once '../snippets/header.php'; ?>
		<nav><?php echo $navList; ?></nav>
		<main class='vehicleDisplay'>
			<!-- Server Message -->
			<?php if (isset($message)) {
				echo $message;
			} ?>

			<div class="innerVehicleDisplay">		

				<!-- inv-display-thumbnails-mod -->
				<?php if (isset($thumbnailsDisplay)) {
					echo $thumbnailsDisplay;
				} ?>	
				<?php if (isset($vehicleDisplay)) {
					echo $vehicleDisplay;
				} ?>
			</div>
		</main>
		<?php require_once '../snippets/footer.php'; ?>
	</div>
</body>

</html>