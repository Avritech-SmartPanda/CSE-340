<?php
// ===========================================================
// VEHICLES MODEL
// ===========================================================

// Register a new vehicle to the inventory table
function regVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId)
{
    // creating a connection object from the phphmotors connection function
    $db = phpmotorsConnect();

    // the SQL statement to be used with the database
    $sql = 'INSERT INTO inventory (invMake, invModel, invDescription, invImage, invThumbnail, invPrice, invStock, invColor, classificationId)
    VALUES (:invMake, :invModel, :invDescription, :invImage, :invThumbnail, :invPrice, :invStock, :invColor, :classificationId)';

    // creating the prepared statement using the phphmotors connection.
    $stmt = $db->prepare($sql);

    // The next lines replace the placeholders in the SQL statement with the actual values
    // in the variables and tells the database the type of data it is.
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);

    // running the prepared statement to insert data.
    $stmt->execute();

    // Ask how many rows changed as a result of our insert.
    $rowsChanged = $stmt->rowCount();

    // close the interaction with the database.
    $stmt->closeCursor();

    // sending the array of data back to where the function was called (this should be the controller).
    return $rowsChanged;
}



/* Create a new classification entry into the sql data table */
function addClassification($classificationName)
{
    //Create a database connection object using the phpmotors connection function
    $db = phpMotorsConnect();
    $sql = 'INSERT INTO carclassification (classificationName) VALUES (:classificationName)';

    // creating the prepared statement using the phphmotors connection.
    $stmt = $db->prepare($sql);

    // The next line replace the placeholders in the SQL statement with the actual values
    // in the variables and tells the database the type of data it is.
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);

    // Insert the data
    $stmt->execute();

    // Ask how many rows changed as a result of our insert.
    $rowsChanged = $stmt->rowCount();

    // Close the database interaction
    $stmt->closeCursor();

    // sending the array of data back to where the function was called (this should be the controller).
    return $rowsChanged;
}



// Get vehicle information by invId
function getInvItemInfo($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $invInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}



function updateVehicle($invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor, $classificationId, $invId)
{

    $db = phpmotorsConnect();
    $sql = 'UPDATE inventory SET 
    invMake = :invMake,
    invModel = :invModel, 
	invDescription = :invDescription,
    invImage = :invImage, 
	invThumbnail = :invThumbnail, 
    invPrice = :invPrice, 
	invStock = :invStock,
    invColor = :invColor, 
	classificationId = :classificationId WHERE invId = :invId';

    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invMake', $invMake, PDO::PARAM_STR);
    $stmt->bindValue(':invModel', $invModel, PDO::PARAM_STR);
    $stmt->bindValue(':invDescription', $invDescription, PDO::PARAM_STR);
    $stmt->bindValue(':invImage', $invImage, PDO::PARAM_STR);
    $stmt->bindValue(':invThumbnail', $invThumbnail, PDO::PARAM_STR);
    $stmt->bindValue(':invPrice', $invPrice, PDO::PARAM_STR);
    $stmt->bindValue(':invStock', $invStock, PDO::PARAM_STR);
    $stmt->bindValue(':invColor', $invColor, PDO::PARAM_STR);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_STR);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();

    $rowsChanged = $stmt->rowCount();

    $stmt->closeCursor();
    return $rowsChanged;
}


function deleteVehicle($invId)
{
    $db = phpmotorsConnect();
    $sql = 'DELETE FROM inventory WHERE invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $rowsChanged = $stmt->rowCount();
    $stmt->closeCursor();
    return $rowsChanged;
}


// Get vehicles by classificationId 
function getInventoryByClassification($classificationId)
{
    $db = phpmotorsConnect();
    $sql = ' SELECT * FROM inventory WHERE classificationId = :classificationId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationId', $classificationId, PDO::PARAM_INT);
    $stmt->execute();
    $inventory = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $inventory;
}

// Get vehicles by classification
function getVehiclesByClassification($classificationName)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE classificationId IN (SELECT classificationId FROM carclassification WHERE classificationName = :classificationName)';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':classificationName', $classificationName, PDO::PARAM_STR);
    $stmt->execute();
    $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicles;
}

function getVehiclesById($invId)
{
    $db = phpmotorsConnect();
    $sql =
        'SELECT inventory.invId, invModel, invMake, invPrice, invDescription, invColor, invStock, imgName,imgPath
	FROM inventory
	JOIN images
	ON inventory.invId = images.invId
	WHERE inventory.invId = :invId	
	AND imgName NOT LIKE "%-tn%"';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $vehicle = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicle;
}

function getVehicleById($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT * FROM inventory WHERE inventory.invId = :invId';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $vehicle = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $vehicle;
}


//  Get information for all vehicles
function getVehicles()
{
    $db = phpmotorsConnect();
    $sql = 'SELECT invId, invMake, invModel FROM inventory';
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $invInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $invInfo;
}


// Search reviews for a specific inventory item

function getInventoryItemReviews($invId)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT reviewId, reviewText, reviewDate, invId, clients.clientFirstname, 
    clients.clientLastname, clients.clientId   
    FROM reviews
    INNER JOIN clients ON reviews.clientId = clients.clientId
    WHERE invId = :invId';


    $stmt = $db->prepare($sql);
    $stmt->bindValue(':invId', $invId, PDO::PARAM_INT);
    $stmt->execute();
    $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $reviews;
}
