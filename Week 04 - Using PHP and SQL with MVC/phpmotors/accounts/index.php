<?php
// This is the accounts controller.

// getting the database connection file.
require_once '../library/connections.php';
// getting the php motors model.
require_once '../model/main-model.php';


// getting the array of classifications.
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
    case 'login':
      include '../view/login.php';
      break;
    case 'register':
      include '../view/registration.php';
      break;  
    default:
      include '../view/home.php';
  }
  