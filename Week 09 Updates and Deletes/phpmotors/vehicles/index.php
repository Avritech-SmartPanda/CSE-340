 <?php
  // ===========================================================
  // VEHICLES CONTROLLER
  // ===========================================================
  // Create or access a Session
  session_start();

  // Get the database connection file.
  require_once '../library/connections.php';
  // Get the php motors model.
  require_once '../model/main-model.php';
  // Get the vehicles model.
  require_once '../model/vehicles-model.php';
  // Get the functions library
  require_once '../library/functions.php';


  // Get the array of classifications.
  $classifications = getClassifications();


  // var_dump($classifications);
  // exit;



  // building a navigation bar using the $classifications array
  $navList  = createNavList();


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











  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
  }


  switch ($action) {
    case 'management':
      include '../view/vehicle-management.php';
      break;

    case 'vehicle':
      include '../view/add-vehicle.php';
      break;

    case 'register':
      include '../view/registration.php';
      break;
    case 'addClassification':

      # STEP 1: Filter and Store. Filters look into the POST object, get the data an assign it to a local variable
      $classificationName = filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_STRING);

      # STEP 2: Check for missing or incorrect data
      if (empty($classificationName)) {
        $message = "<p class='server-message color-blue'>Please, provide information for the empty form field.</p>";
        # STEP 3: Return to the client if data is incorrect
        include '../view/add-classification.php';
        exit;
      }

      # STEP 4: Process data if there's no error
      # Send the data to the model, in /model/vehicles-model.php
      $regOutcome = addClassification($classificationName);

      # STEP 5: Check previous registration result to the data server, and report it.
      if ($regOutcome == 1) {
        header('Location: index.php?action=management'); // Redirect to browser
        exit;
      } else {
        # STEP 6: Notify the client whenever necessary
        $message = "<p class='server-message color-red' style='color: red;'>Sorry, adding $classificationName, failed. Please, try again.</p>";
        include '../view/add-classification.php';
        exit;
      }
      break;

    case 'addVehicle':
      # Filters look into the POST object
      $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_STRING);
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_STRING);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_STRING);
      $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_STRING);
      $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_STRING);
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_STRING);
      $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
      $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_STRING);



      # Check for missing data
      if (
        empty($invMake) ||
        empty($invModel) ||
        empty($invDescription) ||
        empty($invImage) ||
        empty($invThumbnail) ||
        empty($invPrice) ||
        empty($invStock) ||
        empty($invColor)
      ) {
        $message = "<p class='error'>Please, provide information for all empty form fields (including Car Classification).</p>";
        include '../view/add-vehicle.php';
        exit;
      }

      $regOutcome = regVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId);

      if ($regOutcome == 1) {
        $message = "<p class='success'>The $invMake $invModel was added successfully!</p>";
        unset($classificationId);
        unset($invMake);
        unset($invModel);
        unset($invDescription);
        unset($invImage);
        unset($invThumbnail);
        unset($invPrice);
        unset($invStock);
        unset($invColor);
        include '../view/add-vehicle.php';
        exit;
      } else {
        $message = "<p class='error'>Sorry, adding $invMake $invModel failed. Please, try again.</p>";
        include '../view/add-vehicle.php';
        exit;
      }

      break;
      /* * ********************************** 
      * Get vehicles by classificationId - Used for starting Update & Delete process 
      * ********************************** */
    case 'getInventoryItems':
      // Get the classificationId 
      $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
      // Fetch the vehicles by classificationId from the DB 
      $inventoryArray = getInventoryByClassification($classificationId);
      // Convert the array to a JSON object and send it back 
      echo json_encode($inventoryArray);
      break;
    case 'mod':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if (count($invInfo) < 1) {
        $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-update.php';
      exit;
      break;

    case 'updateVehicle':
      $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
      $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
      $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

      if (
        empty($classificationId) || empty($invMake) || empty($invModel)
        || empty($invDescription) || empty($invImage) || empty($invThumbnail)
        || empty($invPrice) || empty($invStock) || empty($invColor)
      ) {
        $message = "<p  class='error'>Please complete all information for the item! Double check the classification of the item.</p>";
        include '../view/vehicle-update.php';
        exit;
      }

      $updateResult = updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId);
      if ($updateResult == 1) {
        $message = "<p class='success'>Congratulations, the $invMake $invModel was successfully updated.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
      } else {
        $message = "<p class='error'>Error. the $invMake $invModel was not updated.</p>";
        include '../view/vehicle-update.php';
        exit;
      }
      break;
    case 'del':
      $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
      $invInfo = getInvItemInfo($invId);
      if (count($invInfo) < 1) {
        $message = 'Sorry, no vehicle information could be found.';
      }
      include '../view/vehicle-delete.php';
      exit;
      break;
    case 'deleteVehicle':
      $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
      $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

      $deleteResult = deleteVehicle($invId);
      if ($deleteResult == 1) {
        $message = "<p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
      } else {
        $message = "<p class='notice'>Error: $invMake $invModel was not
        deleted.</p>";
        $_SESSION['message'] = $message;
        header('location: /phpmotors/vehicles/');
        exit;
      }
      break;
    default:
      $classificationList = buildClassificationList($classifications);
      include '../view/vehicle-management.php';
      exit;
      break;
  }
