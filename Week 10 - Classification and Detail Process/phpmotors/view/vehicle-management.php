<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
	header('location: /phpmotors/');
	exit;
}
if (isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
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
	<title>Vehicle Management | PHP Motors</title>
</head>

<body>
	<div id="wrapper">
		<?php require_once  '../snippets/header.php'; ?>
		<nav>
			<?php echo $navList; ?>
		</nav>
		<main>

			<div class="common-container">
				<h1>Vehicle Management</h1>
				<!-- links -->
				<ul>
					<li><a href="/phpmotors/vehicles/index.php?action=addClassification">Add Classification</a></li>
					<li><a href="/phpmotors/vehicles/index.php?action=vehicle">Add Vehicle</a></li>
				</ul>
			</div>




			<div class="common-container">
				<?php
				if (isset($message)) {
					echo $message;
				}
				if (isset($classificationList)) {
					echo '<h2>Vehicles By Classification</h2>';
					echo '<p>Choose a classification to see those vehicles</p>';
					echo $classificationList;
				}
				?>
				<noscript>
					<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
				</noscript>
				<table id="inventoryDisplay"></table>
			</div>
		</main>
		<?php require_once '../snippets/footer.php'; ?>
	</div>

	<!-- js scripting -->
	<script src="../js/inventory.js"></script>
</body>

</html>

<?php unset($_SESSION['message']); ?>