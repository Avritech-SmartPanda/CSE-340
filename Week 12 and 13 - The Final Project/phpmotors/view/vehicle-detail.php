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
			<hr />

			<?php
			echo '<h2>Customer Reviews</h2>';
			echo '<a id="bottom1"></a>';


			if (isset($_COOKIE['firstname'])) {
				$first = substr($_SESSION['clientData']['clientFirstname'], 0, 1);
				$last = $_SESSION['clientData']['clientLastname'];
				$screenName = $first . ' ' . $last;
				$clientId = $_SESSION['clientData']['clientId'];


				if (isset($_COOKIE['reviewFormMessage'])) {
					echo $_COOKIE['reviewFormMessage'];
				}
				echo '<form action="/phpmotors/reviews/index.php" method="post" id="review-form">' . "\n";

				echo	'<fieldset>';

				echo '<label for="screenName">Screen Name:</label><br />';
				echo "<input type='text' readonly name='screenName' id='screenName' value='$screenName'>";
				echo '<label for="reviewText">Review:</label><br />' . "\n";
				echo '<textarea cols="50" id="reviewText" name="reviewText" placeholder="Leave a product review here" required rows="5"></textarea>' . "\n";
				echo '<br>' . "\n";
				echo '<input class="button" name="submit" type="submit" value="Submit Review">' . "\n";
				echo "<input type='hidden' name='clientId' value='$clientId'>" . "\n";
				echo "<input type='hidden' name='invId' value='$invId'>" . "\n";
				echo '<input type="hidden" name="action" value="add-review">' . "\n";
				echo '</fieldset>' . "\n";
				echo '</form>' . "\n";

				if (!count($vehicleReviews)) {
					echo '<p>Be the first one to review this vehicle</p>';
				} else {
					echo $reviewsDisplay;
				}
			} else {
				echo "<p>You must <a href='/phpmotors/accounts/index.php?action=login'>Login</a> to write a review." . "\n";
				
				if (count($vehicleReviews)) {
					echo $reviewsDisplay;
				}
			}

















			?>
		</main>
		<?php require_once '../snippets/footer.php'; ?>
	</div>
</body>

</html>