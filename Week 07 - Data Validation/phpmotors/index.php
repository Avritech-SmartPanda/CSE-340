<?php
// This is the main controller

// getting the database connection file.
require_once 'library/connections.php';
// getting thephphmotors model.
require_once 'model/main-model.php';
// Get the functions library
require_once 'library/functions.php';

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


switch ($action) {
    case 'template':
        include 'view/template.php';
        break;
    default:
        include 'view/home.php';
        break;
}
