 <?php
  /***************************************************************************************************
   * ACCOUNT CONTROLLER
   * **************************************************************************************************/
  // Create or access a Session
  session_start();


  //  Get the database connection file.
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
    case 'registration':
      include '../view/registration.php';
      break;



    case 'register':
      // Filter and store the data.
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);



      // Check existing email address in the table
      $existingEmail = checkExistingEmail($clientEmail);
      if ($existingEmail) {
        $message =  '<p class="error"> That email address already exists. Do you want to login instead? </p>';
        include '../view/login.php';
        exit;
      }

      //Check for missing date
      if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)) {
        $message = '<p class="center  error">Please provide information for all empty form fields.</p>';
        include '../view/registration.php';
        exit();
      }

      // Hash the checked password
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

      // Send the data to the model if no errors exist.
      $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

      // Check and report the result.
      if ($regOutcome == 1) {
        setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
        $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
        header('Location: /phpmotors/accounts/?action=login-page');
        exit();
      } else {
        $message = "<p>Sorry, $clientFirstname, but the registration failed. Please, try again</p>";
        include '../view/registration.php';
        exit();
      }
      exit();
      break;




    case 'login-page':
      include '../view/login.php';
      break;



    case 'login':
      // Filter and store the data.
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));

      $clientEmail = checkEmail($clientEmail);
      $checkPassword = checkPassword($clientPassword);

      // Run basic checks, return if errors
      if (empty($clientEmail) || empty($clientEmail)) {
        $message = '<p class="notice">Please provide a valid email address and password.</p>';
        include '../view/login.php';
        exit();
      }

      // A valid password exists, proceed with the login process
      $clientData = getClient($clientEmail);
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      // If the hashes don't match create an error
      if (!$hashCheck) {
        $message = '<p class="error">Please check your password and try again.</p>';
        include '../view/login.php';
        exit();
      }
      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;

      // firstname from session is stored as cookie for a year
      setcookie('firstname', $clientData['clientFirstname'], strtotime('+1 year'), '/');
      // Send them to the admin view
      
      include '../view/admin.php';
      exit();
      break;




    case 'logout':
      if (isset($_COOKIE['firstname'])) {
        unset($_COOKIE['firstname']);
        setcookie('firstname', '', time() - 3600, '/'); // empty value and old timestamp
      }
      session_unset();
      session_destroy();
      header('Location: /phpmotors/index.php');
      exit();
      break;


    case 'client-update':
      include '../view/client-update.php';
      break;



    case 'update-client':
      # Filters look into the POST object
      $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_STRING));
      $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_STRING));
      $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);

      if ($clientEmail != $_SESSION['clientData']['clientEmail']) {
        $existingEmail = checkExistingEmail($clientEmail); // 0 is false, 1 is true
        if ($existingEmail) {
          $message =  '<p class="error"> Email address already exists. <br> Please, try with a different email or login with the email address. </p>';
          include '../view/client-update.php';
          exit;
        }
      }

      if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)) {
        $message = '<p class="error">Please, provide information for all empty form fields.</p>';
        include '../view/client-update.php';
        exit;
      }

      $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
      # Check and report the result
      if ($updateResult == 1) {
        /* Registering message, OPTIONAL previous redirectioning */
        $message = '<p class="success">' . $clientFirstname . ', your information  has been updated.</p>';
        $_SESSION['message'] = $message;
        $clientData = getClient($clientEmail);
        array_pop($clientData);
        $_SESSION['clientData'] = $clientData;
        include '../view/admin.php';
        exit;
      } else {
        $message = '<p class="notice">' . $clientFirstname . ', no changes has been made.</p>';
        include '../view/client-update.php';
        exit;
      }
      break;
      exit;


    case 'updatePassword':
      /* DATA COLLECTION */
      $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_STRING));
      $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
      $clientFirstname = $_SESSION['clientData']['clientFirstname'];
      $clientLastname = $_SESSION['clientData']['clientLastname'];
      $clientEmail = $_SESSION['clientData']['clientEmail'];

      $checkPassword = checkPassword($clientPassword);
   
      if (empty($checkPassword)) {
        $messagePassword = '<p class="error">Please, make sure your password matches the desired pattern.</p>';
        include '../view/client-update.php';
        exit;
      }
      $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
      $updatePasswordOutcome = updatePassword($clientId, $hashedPassword);
      if ($updatePasswordOutcome == 1) {
        $messagePassword = '<p class="success">' . $clientFirstname . ', your password has been updated.';
        $_SESSION['message'] = $messagePassword ;
        include '../view/admin.php';
        exit;
      } else {
        $messagePassword = "<p>Sorry, $clientFirstname, but the password update failed. Please, try again</p>";
        include '../view/client-update.php';
        exit;
      }
      break;
      exit;

    default:
      include '../view/home.php';
  }
