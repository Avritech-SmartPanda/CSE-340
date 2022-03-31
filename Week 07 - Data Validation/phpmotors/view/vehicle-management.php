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
	<div id="wrapper" class="main-container">
		<?php require_once  '../snippets/header.php'; ?>
        <nav>
		<?php echo $navList; ?>	
		</nav>
		<main>

			<div class="common-container">
				<!-- php code -->
				<?php
				if (isset($message)) {
					echo $message;
				}
				?>
				<h1>Vehicle Management</h1>
				
				<!-- links -->
				<ul>
					<li><a href="/phpmotors/vehicles/index.php?action=addClassification">Add Classification</a></li>
					<li><a href="/phpmotors/vehicles/index.php?action=vehicle">Add Vehicle</a></li>
				</ul>
			</div>

			<div class="common-container">
				<!-- php code -->
				<?php
					if (isset($classificationListManagement)) {
						echo '<h2>Vehicles by Classification</h2>';
						echo '<label for="classificationListManagement">Choose a classification to see those vehicles: <br><br>';
						echo $classificationListManagement; # Displays the classification list which has been encoded into an HTML select element.
						echo '</label>';
					}
				?>
	
				<!-- no script message -->
				<noscript>
				<!-- If the browser detects that JavaScript is disabled, it will show the <noscript> element and its contents. If JavaScript is enabled the <noscript> element is hidden. -->
					<p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
				</noscript>
	
				<!-- table, js injected -->
				<table id="inventoryDisplay">
					<!-- Injected content goes here -->
				</table>
			</div>
		</main>
		<?php require_once '../snippets/footer.php'; ?>
	</div>

	<!-- js scripting -->
	<script src="../js/inventory.js"></script>
<script src="../js/script.js"></script>
</body>

</html>