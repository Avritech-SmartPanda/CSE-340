<?php
if ($_SESSION['clientData']['clientLevel'] == 1 ) {
	header('location: /phpmotors/');
	exit;
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
	<title>Add Classification | PHP Motors</title>
</head>

<body>
	<div id="wrapper">
		<?php require_once  '../snippets/header.php'; ?>
		<nav><?php echo $navList; ?></nav>
		<main>

			<?php
			if (isset($message)) {
				echo $message;
			}
			?>
			<form id="vehicles" method="post" action="/phpmotors/vehicles/index.php">
				<h1>Add Car Classification</h1>
				<fieldset>
					<legend></legend>
					<div>
						<label for="classification_id">Insert New Type of Vehicle Here </label><br />
						<input type="text" id="classification_id" name="classificationName" placeholder="E.g.: Convertible" class="input-width-100" <?php if (isset($classificationName)) {
																																						echo "value='$classificationName'";
																																					}  ?>required>

					</div>
					<div class="my-2">
						<!-- Button -->
						<input type="submit" id="submit_id" value="Add Classification" class="btn">
						<input type="hidden" name="action" value="addClassification">

					</div>
				</fieldset>
			</form>
		</main>
		<?php require_once '../snippets/footer.php'; ?>
	</div>
	<script src="../js/script.js"></script>
</body>

</html>