<?php
// if the user is not logged in. If not, the user is redirected to the main controller
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
	<link rel="stylesheet" href="../css/main.css" media="screen">
	<title>User Profile | PHP Motors</title>
</head>

<body>
	<div id="wrapper">
		<?php require_once '../snippets/header.php'; ?>
		<nav><?php echo $navList; ?></nav>
		<main>
			<?php
			if (isset($_SESSION['clientData'])) {
				$clientFirstname = $_SESSION['clientData']['clientFirstname'];
				$clientLastname = $_SESSION['clientData']['clientLastname'];
				$clientEmail = $_SESSION['clientData']['clientEmail'];
				$clientId = $_SESSION['clientData']['clientId'];
			} ?>
			<div class="user-data">
				<h1>Manage Account</h1>

				<?php
				if (isset($message)) {
					echo $message;
				}
				?>
			</div>

			<!-- update client Form  -->
			<form id="account" method="post" action="/phpmotors/accounts/?action=update-client">
				<h3>Update Account</h3>
				<div>
					<label for="firstname">First Name</label><br />
					<input type="text" id="firstname" name="clientFirstname" required <?php if (isset($clientFirstname)) {
																							echo "value='$clientFirstname'";
																						} ?> pattern=".{0,15}">

				</div>
				<div>
					<label for="lastname">Last Name</label><br />
					<input type="text" id="lastname" name="clientLastname" required <?php if (isset($clientLastname)) {
																						echo "value='$clientLastname'";
																					} ?>>
				</div>
				<div>
					<label for="email">Email</label><br />
					<input type="email" id="email" name="clientEmail" required <?php if (isset($clientEmail)) {
																					echo "value='$clientEmail'";
																				} ?>>
				</div>
				<div class="my-2">
					<input type="submit" value="Update Info" class="btn">
					<input type="hidden" name="action" value="update-client">
					<input type="hidden" name="clientId" value="<?php if (isset($clientId)) {
																	echo $clientId;
																} ?>">
				</div>
			</form>

			<!-- password form -->
			<form id="passwordForm" method="post" action="/phpmotors/accounts/">
				<fieldset>
					<legend>Security Information</legend>
					<?php
					if (isset($messagePassword)) {
						echo $messagePassword;
					}
					?>

					<div>
						<p>Passwords must be  at least 8 characters and contain  at least  1 number, 1 capital letter and 1 special character.</p>
						<p>*note your original password will be changed.</p>
					</div>

					<div>
						<label for="password">Password</label><br />
						<input type="password" id="password" name="clientPassword" placeholder="Password requirements above" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$">
					</div>


					<div class="my-2">
						<!-- Button -->
						<input type="submit" value="Update Password" class="btn">
						<!-- Trigger. Tells the controller what action we need it to process. -->
						<input type="hidden" name="action" value="updatePassword">
						<input type="hidden" name="clientId" value="<?php if (isset($clientId)) {
																		echo $clientId;
																	} ?>">
					</div>

				</fieldset>
			</form>
		</main>
		<?php require_once '../snippets/footer.php'; ?>
	</div>
	<script src="../js/script.js"></script>
</body>

</html>