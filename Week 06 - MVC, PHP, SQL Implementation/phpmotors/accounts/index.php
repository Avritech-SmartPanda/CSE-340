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


  // Get the array of classifications.
  $classifications = getClassifications();

  // building a navigation bar using the $classifications array
  $navList  = '<ul>';
  $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/index.php?action=" . urldecode($classification['classificationName'])
      . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li> ";
  }
  $navList .= '</ul>';

  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = filter_input(INPUT_POST, 'action');
  }


  switch ($action) {
    case 'register':
      // Filter nad store the data.
      $clientFirstname = filter_input(INPUT_POST, 'clientFirstname');
      $clientLastname = filter_input(INPUT_POST, 'clientLastname');
      $clientEmail = filter_input(INPUT_POST, 'clientEmail');
      $clientPassword = filter_input(INPUT_POST, 'clientPassword');

      //Check for missing date
      if (empty($clientLastname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
        $message = '<p class="center">Please provide information for all empty formm fields.</p>';
        include '../view/registration.php';
        exit();
      }

      // Send the data to the model if no errors exist.
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword);

      // Check and report the result.
      if ($regOutcome === 1) {
        $message = "<p>Thanks for registering $clientFirstname. Please use your email and password to login</p>";
        include '../view/login.php';
        exit();
      } else {
        $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
        include '../view/registration.php';
        exit();
      }
      break;
    case 'login':
      include '../view/login.php';
      break;

    default:
      include '../view/home.php';
  }
