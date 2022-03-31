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
