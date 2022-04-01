<?php
if ($_SESSION['clientData']['clientLevel'] == 1) {
 header('location: /phpmotors/');
 exit;
}
?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="/phpmotors/css/main.css">
	<title>Add Vehicle | PHP Motors</title>
</head>

<body>

	<div id="wrapper">
		<?php require_once '../snippets/header.php'; ?>
		<nav><?php echo $navList; ?></nav>
		<main>

			<?php
			if (isset($message)) {
				echo $message;
			}
			?>

			<form id="vehicles" method="post" action="/phpmotors/vehicles/index.php">
				<h1>Add Vehicle</h1>
				<p>* Note all Fields are Required.</p>
				<fieldset>
					<legend>Add information about a new vehicle here</legend>

					<?php echo $dropdown; ?>
					<div>
						<label for="make_id">Make * </label><br />
						<input type="text" id="make_id" name="invMake" placeholder="E.g.: Jeep" required <?php if (isset($invMake)) {
																												echo "value='$invMake'";
																											}  ?>>
					</div>
					<div>
						<label for="model_id">Model *</label><br />
						<input type="text" id="model_id" name="invModel" placeholder="E.g.: Wrangler" required <?php if (isset($invModel)) {
																													echo "value='$invModel'";
																												}  ?>>
					</div>
					<div>
						<label for="description_id">Description *</label><br />
						<textarea id="description_id" name="invDescription" placeholder="E.g.: JW, is a series of compact and mid-size, four-wheel drive off-road SUVs... etc." rows="6" required> <?php if (isset($invDescription)) {
																																																		echo "$invDescription";
																																																	}  ?></textarea>
					</div>
					<div>
						<label for="image_id">Image Path * </label><br />
						<input type="text" id="image_id" name="invImage" placeholder="/phpmotors/images/vehicles/no-image.png" required <?php if (isset($invImage)) {
																													echo "value='$invImage'";
																												}  ?>>
					</div>
					<div>
						<label for="thumbnail_id">Thumbnail Path * </label><br />
						<input type="text" id="thumbnail_id" name="invThumbnail" placeholder="/phpmotors/images/vehicles/no-image-tn.png" required <?php if (isset($invThumbnail)) {
																																echo "value='$invThumbnail'";
																															}  ?>>
					</div>
					<div>
						<label for="price_id">Price *</label><br />
						<input type="text" id="price_id" name="invPrice" placeholder="E.g.: 28475.45" pattern="([0-9]+(?:\.[0-9]*)?)" required <?php if (isset($invPrice)) {
																																					echo "value='$invPrice'";
																																				}  ?>>
					</div>
					<div>
						<label for="stock_id"># In Stock * </label><br />
						<input type="text" id="stock_id" name="invStock" placeholder="E.g. in units: 4" pattern="(^\d{1,10}$)" required <?php if (isset($invStock)) {
																																			echo "value='$invStock'";
																																		}  ?>>
					</div>
					<div>
						<label for="color_id">Color * </label><br />
						<input type="text" id="color_id" name="invColor" placeholder="E.g.: Black" required <?php if (isset($invColor)) {
																												echo "value='$invColor'";
																											}  ?>>
					</div>
					<!-- Button -->
					<div class="my-2">
						<input type="submit" id="submit_id" value="Add Vehicle" class="btn">
						<!-- Trigger. Tells the controller what action we need it to process. -->
						<input type="hidden" name="action" value="addVehicle">
					</div>
				</fieldset>
			</form>
		</main>
		<?php require_once  '../snippets/footer.php'; ?>
	</div>
</body>

</html>