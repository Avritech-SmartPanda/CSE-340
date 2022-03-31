
<?php
function checkEmail($clientEmail)
{
  $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
  return $valEmail;
}

// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
  $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
  return preg_match($pattern, $clientPassword);
}


function createNavList()
{
  // Get the array of classifications.
  $classifications = getClassifications();
  $navList  = '<ul>';
  $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
  foreach ($classifications as $classification) {
    $navList .= "<li><a href='/phpmotors/vehicles/index.php?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
  }
  $navList .= '</ul>';
  return $navList;
}




// Build the classifications select list 
function buildClassificationList($classifications)
{
  $classificationList = '<select name="classificationId" id="classificationList">';
  $classificationList .= "<option>Choose a Classification</option>";
  foreach ($classifications as $classification) {
    $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
  }
  $classificationList .= '</select>';
  return $classificationList;
}


//build a display of vehicles within an unordered list.
function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $currency =  number_format($vehicle['invPrice']);
        $dv .= "<li><a href='?action=details&invId=$vehicle[invId]'>";
        $dv .= "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'>";
        $dv .= '<hr>';
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2>";
        $dv .= "<span>$$currency</span>";
        $dv .= '</a></li>';
    }
    $dv .= '</ul>';
    return $dv;
}



function buildVehicleByIdDisplay($vehicle)
{
  foreach ($vehicle as $data) {
    $currency =  number_format($data['invPrice']);
    $dv = "<h1>$data[invMake] $data[invModel]</h1>";

    $dv .= '<div class="vehicle-container">';
    $dv .= "<div class='vehicle-image'>";
    $dv .= "<img src='$data[invImage]' width='600' alt='Image of $data[invMake] $data[invModel]'>";
    $dv .= "<div class='vehicle-amount'>Price: $$currency</div>";
    $dv .= '</div>';
    $dv .= "<div class='vehicle-details'>";
    $dv .= "<h4>$data[invMake] $data[invModel] Details</h4>";
    $dv .= "<div class='vehicle-description'><p>$data[invDescription]</p></div>";
    $dv .= "<div class='vehicle-color'>Color: $data[invColor]</div>";
    $dv .= "<div class='vehicle-instock'><p># in stock: $data[invStock]</p></div>";
    $dv .= '</div>';
  }

  $dv .= '</div>'; // Close main container
  return $dv; // Display Vehicles
}

















?>