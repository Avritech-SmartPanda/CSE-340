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
