<?php
// This is the main PHP Motors Model

function getClassifications()
{
    // creating a connection object from the phphmotors connection function
    $db = phpmotorsConnect();

    // the SQL statement to be used with the database
    // $sql = 'SELECT classificationName FROM carclassification ORDER BY classificationName ASC';
    $sql = 'SELECT * FROM carclassification ORDER BY classificationName ASC';

    // creating the prepared statement using the phphmotors connection.
    $stmt = $db->prepare($sql);

    // running the prepared statement
    $stmt->execute();   

    // getting data from the database and storing it as an array in thr $classifications variable.
    $classifications = $stmt->fetchAll();

    // closing the interaction with the database.
    $stmt->closeCursor();

    // sending the rray of data back to where the function was called (this should be the controller).
    return $classifications;

    

}


?>