 <?php
  /*
* Accounts controller.
*/

  // Get the database connection file.
  require_once '../library/connections.php';
  // Get the php motors model.
  require_once '../model/main-model.php';
  // Get the accounts model.
  require_once '../model/accounts-model.php';
  // Get the functions library
  require_once '../library/functions.php';

  // Get the array of classifications.
  $classifications = getClassifications();

  // building a navigation bar using the $classifications array
 $navList  = createNavList();

  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
  }


  switch ($action) {
    case 'register':
      // Filter and store the data.
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

      //Check for missing date
      if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
        $message = '<p class="center  error">Please provide information for all empty formm fields.</p>';
        include '../view/registration.php';
        exit();
      }

      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      // Send the data to the model if no errors exist.
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword );

      // Check and report the result.
      if ($regOutcome === 1) {
        $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login</p>";
        include '../view/login.php';
        exit();
      } else {
        $message = "<p class="error">Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit();
      }
      break;
    case 'Login':
       // Filter and store the data.
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        //Check for missing date
        if (empty($clientEmail) || empty($checkPassword)) {
          $message = '<p class="center error">Please provide information for all empty formm fields.</p>';
          include '../view/login.php';
          exit();
        }

      include '../view/login.php';
      break;

    default:
      include '../view/home.php';
  }
