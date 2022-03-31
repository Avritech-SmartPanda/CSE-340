<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="icon" type="image/png" href="favicon.png">
	<link rel="stylesheet" href="/phpmotors/css/main.css">
	<title>Account Registration | PHP Motors</title>
	<style>
		body {
			font-size: medium;
		}
	</style>
</head>

<body>
	<div id="wrapper">
		<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
		<nav>
			<?php echo $navList; ?>
		</nav>
		<main>
			<?php
			if (isset($message)) {
				echo $message;
			}
			?>
			<form id="registration" method="post" action="/phpmotors/accounts/index.php">
				<h1>Register</h1>	

			

					<label for="clientFirstname">First Name*</label>
					<div><input type="text" id="clientFirstname" name="clientFirstname" placeholder="John" required></div>


					<label for="clientLastname">Last Name*</label>
					<div><input type="text" id="clientLastname" name="clientLastname" placeholder="Doe" required></div>


					<label for="clientEmail">Email*</label>
					<div><input type="email" id="clientEmail" name="clientEmail" placeholder="example@mail.com" required></div>

					<p>Passwords must be at least 8 characters and  contain at least 1 number, 1 capital letter and 1 special character.</p>
					<label for="password">Password* </label>
					<div> <input type="password" id="password" name="clientPassword" placeholder="See password requirements" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"></div>
					<!-- <div ><input type="button" class="showBtn" value="Show Password"></div> -->
					<div class="my-2"><input type="submit" id="submit_id" value="Submit" class="btn"></div>

			
			</form>
		</main>
		<?php require $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
	</div>
</body>

</html>