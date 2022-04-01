<?php
// ===========================================================
// MAIN CONTROLLER
// ===========================================================  
// Create or access a Session
session_start();


// import required php files into scope
require_once 'library/connections.php';
require_once 'library/functions.php';
require_once 'model/main-model.php';
require_once 'model/accounts-model.php';

// getting the array of classifications.
$classifications = getClassifications();

// var_dump($classifications);
// exit;

// building a navigation bar using the $classifications array
$navList  = createNavList();

// echo $navList;
// exit;


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
}
// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

switch ($action) {
    case 'template':
        include 'view/template.php';
        break;
    default:
        if (isset($_SESSION['loggedin'])) {
            $clientId = $_SESSION['clientData']['clientId'];
            $reviewList = getClientReviews($clientId);
            $reviewsDisplay = adminReviewDisplay($reviewList);
            include 'view/admin.php';
            exit();
        } else {
            include 'view/home.php';
            exit();
        }
        break;
}
