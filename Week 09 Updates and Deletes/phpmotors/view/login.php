<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Account Login | PHP Motors</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/phpmotors/css/main.css">
</head>

<body >
	<div id="wrapper">
		<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
		<nav>
			<?php echo $navList; ?>
		</nav>

		<main>
			<h1>Sign In</h1>
			<?php if (isset($_SESSION['message'])) {
				echo $_SESSION['message'];
			}
			if (isset($message)) {
				echo $message;
			}
			?>

			<form action="/phpmotors/accounts/index.php" method="post">

				<label for="clientEmail">Email</label>
				<div>
					<input type="email" name="clientEmail" id="clientEmail" placeholder="Your Email" autocomplete="off"  <?php if (isset($clientEmail)) {
																											echo "value='$clientEmail'";
																										}  ?> required>
				</div>

				<label for="clientPassword">Password</label>
				<div>
					<input type="password" name="clientPassword" id="clientPassword" placeholder="Your Password" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" autocomplete="off" required>
				</div>
				<div class="my-2">
					<input type="submit" name="Submit" value="Sign-in" class="btn">
					<input type="hidden" name="action" value="login">

				</div>
			</form>
			<a id='notamember' href="/phpmotors/accounts/?action=registration">Not a member yet?</a>
		</main>
		<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
	</div>
</body>

</html>