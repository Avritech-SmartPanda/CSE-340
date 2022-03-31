<?php
/*
* Accounts Model
*/

// Register a new client
function regClient($clientFirstname, $clientLastname, $clientEmail, $clientPassword)
{
    // creating a connection object from the phphmotors connection function
    $db = phpmotorsConnect();

    // the SQL statement to be used with the database
    $sql = 'INSERT INTO clients (clientFirstname, clientLastname, clientEmail, clientPassword)
    VALUES (:clientFirstname, :clientLastname, :clientEmail, :clientPassword)';

    // creating the prepared statement using the phphmotors connection.
    $stmt = $db->prepare($sql);

    // The next four lines replace the placeholders in the SQL statement with the actual values
    // in the variables and tells the database the type of data it is.
    $stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);

    // running the prepared statement to insert data.
    $stmt->execute();

    // Ask how many rows changed as a result of our insert.
    $rowsChanged = $stmt->rowCount();

    // close the interaction with the database.
    $stmt->closeCursor();

    // sending the array of data back to where the function was called (this should be the controller).
    return $rowsChanged;
}



/* Check for existing email address */
function checkExistingEmail($clientEmail)
{
    $db = phpMotorsConnect();
    $sql = 'SELECT clientEmail FROM clients WHERE clientEmail = :email';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':email', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $matchEmail = $stmt->fetch(PDO::FETCH_NUM);
    $stmt->closeCursor();
    if (empty($matchEmail)) {
        return 0;
    } else {
        return 1;
    }
}


// Get client based on email address
function getClient($clientEmail)
{
    $db = phpmotorsConnect();
    $sql = 'SELECT clientId, clientFirstname, clientLastname, clientEmail, clientLevel, clientPassword FROM clients WHERE clientEmail = :clientEmail';
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->execute();
    $clientData = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $clientData;
}



/* Update client */
function updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId) {	
	$db = phpMotorsConnect();
	$sql = 'UPDATE clients SET clientFirstname = :clientFirstname, clientLastname = :clientLastname, clientEmail = :clientEmail WHERE clientId = :clientId';	
	$stmt = $db -> prepare($sql);
	
	$stmt->bindValue(':clientFirstname', $clientFirstname, PDO::PARAM_STR);
    $stmt->bindValue(':clientLastname', $clientLastname, PDO::PARAM_STR);
    $stmt->bindValue(':clientEmail', $clientEmail, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

	$stmt -> execute();
	$rowsChanged = $stmt -> rowCount();
	$stmt -> closeCursor();
	return $rowsChanged;
}

/* Update client password */
function updatePassword($clientId, $clientPassword) {
	
	$db = phpMotorsConnect();
	// 4 values here
	$sql = 'UPDATE clients SET clientPassword = :clientPassword WHERE clientId = :clientId';
	
	$stmt = $db -> prepare($sql);
	
	$stmt->bindValue(':clientPassword', $clientPassword, PDO::PARAM_STR);
    $stmt->bindValue(':clientId', $clientId, PDO::PARAM_INT);

	$stmt -> execute();
	$rowsChanged = $stmt -> rowCount();
	$stmt -> closeCursor();
	return $rowsChanged;
}