<?php
if ($_SESSION['loggedin'] != TRUE || $_SESSION['clientData']['clientLevel'] < 2) {
	header('location: /phpmotors/');
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="/phpmotors/css/main.css">
	<title><?php if (isset($invInfo['invMake'])) {
				echo "Delete $invInfo[invMake] $invInfo[invModel]";
			} ?> | PHP Motors</title>
</head>

<body>

	<div id="wrapper">
		<?php require_once '../snippets/header.php'; ?>
		<nav><?php echo $navList; ?></nav>
		<main>

			<h1>
				<?php
				if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
					echo "Delete $invInfo[invMake] $invInfo[invModel]";
				}  ?>
			</h1>
			<?php
			if (isset($message)) {
				echo $message;
			}
			?>
			<p class="error">Confirm Vehicle Deletion.The delete id permanet.</p>
			<form id="vehicles" method="post" action="/phpmotors/vehicles/index.php">
				<fieldset>

					<div>
						<label for="invMake">Vehicle Make</label><br />
						<input type="text" readonly name="invMake" id="invMake" <?php
																				if (isset($invInfo['invMake'])) {
																					echo "value='$invInfo[invMake]'";
																				} ?>>
					</div>
					<div>
						<label for="invModel">Vehicle Model</label><br />
						<input type="text" readonly name="invModel" id="invModel" <?php
																					if (isset($invInfo['invModel'])) {
																						echo "value='$invInfo[invModel]'";
																					} ?>>
					</div>
					<div>
						<label for="invDescription">Vehicle Description</label><br />
						<textarea name="invDescription" readonly id="invDescription"><?php
																						if (isset($invInfo['invDescription'])) {
																							echo $invInfo['invDescription'];
																						}
																						?></textarea>
					</div>



					<!-- Button -->
					<div class="my-2">
						<input type="submit" id="submit_id" value="Delete  Vehicle" class="btn">
						<!-- Trigger. Tells the controller what action we need it to process. -->
						<input type="hidden" name="action" value="deleteVehicle">
						<input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
																		echo "value='$invInfo[invId]'";
																	}  ?>">
					</div>
				</fieldset>
			</form>
		</main>
		<?php require_once  '../snippets/footer.php'; ?>
	</div>

</body>

</html>