<?php
if ($_SESSION['loggedin'] != TRUE || $_SESSION['clientData']['clientLevel'] < 2) {
	header('location: /phpmotors/');
	exit;
}
  // Build a dropdown menu
  $dropdown = '<select name="classificationId" id="classificationId">';
  $dropdown .= "<option>Choose  Car Classification</option>";
  foreach ($classifications as $classification) {
    $dropdown .= "<option value='$classification[classificationId]'";
    if (isset($classificationId)) {
      if ($classification['classificationId'] === $classificationId) {
        $dropdown .= ' selected ';
      }
    } elseif (isset($invInfo['classificationId'])) {
      if ($classification['classificationId'] === $invInfo['classificationId']) {
        $dropdown .= ' selected ';
      }
    }
    $dropdown .= ">$classification[classificationName]</option>";
  }
  $dropdown .= '</select>';
?><!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="/phpmotors/css/main.css">
	<title><?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
				echo "Modify $invInfo[invMake] $invInfo[invModel]";
			} elseif (isset($invMake) && isset($invModel)) {
				echo "Modify $invMake $invModel";
			} ?> | PHP Motors</title>
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
				<h1>
					<?php
					if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
						echo "Modify $invInfo[invMake] $invInfo[invModel]";
					} elseif (isset($invMake) && isset($invModel)) {
						echo "Modify$invMake $invModel";
					} ?>
				</h1>
				<p>* Note all Fields are Required.</p>
				<fieldset>
					<legend>Add information about a new vehicle here</legend>

					<?php echo $dropdown; ?>
					<div>
						<label for="make_id">Make * </label><br />
						<input type="text" id="make_id" name="invMake" required <?php
																				if (isset($invMake)) {
																					echo "value='$invMake'";
																				} elseif (isset($invInfo['invMake'])) {
																					echo "value='$invInfo[invMake]'";
																				} ?>>
					</div>
					<div>
						<label for="model_id">Model *</label><br />
						<input type="text" id="model_id" name="invModel" required <?php if (isset($invModel)) {
																						echo "value='$invModel'";
																					} elseif (isset($invInfo['invModel'])) {
																						echo "value='$invInfo[invModel]'";
																					}  ?>>
					</div>
					<div>
						<label for="description_id">Description *</label><br />
						<textarea id="description_id" name="invDescription" rows="6" required> <?php if (isset($invDescription)) {
																									echo "$invDescription";
																								} elseif (isset($invInfo['invDescription'])) {
																									echo "$invInfo[invDescription]";
																								} ?></textarea>
					</div>
					<div>
						<label for="image_id">Image Path * </label><br />
						<input type="text" id="image_id" name="invImage"  required <?php if (isset($invImage)) {
																													echo "value='$invImage'";
																												} elseif (isset($invInfo['invImage'])) {
																													echo "value='$invInfo[invImage]'";
																												}  ?>>
					</div>
					<div>
						<label for="thumbnail_id">Thumbnail Path * </label><br />
						<input type="text" id="thumbnail_id" name="invThumbnail"  required <?php if (isset($invThumbnail)) {
																																echo "value='$invThumbnail'";
																															} elseif (isset($invInfo['invThumbnail'])) {
																																echo "value='$invInfo[invThumbnail]'";
																															}   ?>>
					</div>
					<div>
						<label for="price_id">Price *</label><br />
						<input type="text" id="price_id" name="invPrice" placeholder="E.g.: 28475.45" pattern="([0-9]+(?:\.[0-9]*)?)" required <?php if (isset($invPrice)) {
																																					echo "value='$invPrice'";
																																				} elseif (isset($invInfo['invPrice'])) {
																																					echo "value='$invInfo[invPrice]'";
																																				}  ?>>
					</div>
					<div>
						<label for="stock_id"># In Stock * </label><br />
						<input type="text" id="stock_id" name="invStock" placeholder="E.g. in units: 4" pattern="(^\d{1,10}$)" required <?php if (isset($invStock)) {
																																			echo "value='$invStock'";
																																		} elseif (isset($invInfo['invStock'])) {
																																			echo "value='$invInfo[invStock]'";
																																		}  ?>>
					</div>
					<div>
						<label for="color_id">Color * </label><br />
						<input type="text" id="color_id" name="invColor" placeholder="E.g.: Black" required <?php if (isset($invColor)) {
																												echo "value='$invColor'";
																											} elseif (isset($invInfo['invColor'])) {
																												echo "value='$invInfo[invColor]'";
																											}  ?>>
					</div>
					<!-- Button -->
					<div class="my-2">
						<input type="submit" id="submit_id" value="Update  Vehicle" class="btn">
						<!-- Trigger. Tells the controller what action we need it to process. -->
						<input type="hidden" name="action" value="updateVehicle">
						<input type="hidden" name="invId" value="<?php if (isset($invId)) {
																		echo "value='$invId'";
																	} elseif (isset($invInfo['invId'])) {
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